<?php

namespace App\Http\Controllers;

use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LichHen;
use App\Models\BenhNhan;
use App\Models\NhanVien;
use App\Models\CoSo;
use App\Models\User;
use App\Models\ChuyenKhoa;
use App\Models\BacSi;

use function PHPSTORM_META\elementType;

class BenhNhanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Lấy nhân viên hiện tại
        $user = Auth::user();

        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $id_coso = $nhanvien->id_coso;

                // Truy vấn danh sách users
                $query = User::where('role', 'user')
                    ->whereHas('benhnhan', function ($q1) use ($id_coso) {
                        $q1->whereHas('lichhen', function ($q2) use ($id_coso) {
                            $q2->whereHas('bacsi', function ($q3) use ($id_coso) {
                                $q3->where('id_coso', $id_coso);
                            });
                        });
                    })
                    ->with(['benhnhan.lichhen.bacsi']); // nếu cần lấy chi tiết

                if ($request->filled('keyword')) {
                    $keyword = $request->keyword;
                    $query->where(function ($q) use ($keyword) {
                        $q->where('email', 'LIKE', "%$keyword%")
                            ->orWhere('name', 'LIKE', "%$keyword%");
                    });
                }

                // Lọc theo trạng thái
                if ($request->filled('status')) {
                    $query->where('status', $request->status); // giả sử status = 0, 1
                }

                $users = $query->orderBy('created_at', 'desc')->paginate(10);
                $cs_nv = Coso::find($nhanvien->id_coso);
                $title = 'Trang quản trị của ' . $cs_nv->tencoso . ' - EbookCare';
                return view('admin.benhnhan.index', compact('users', 'title'));
            }
        }
        $title = 'Quản lý tài khoản bệnh nhân';
        $query = User::query()->where('role', 'user');

        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('email', 'LIKE', "%$keyword%")
                    ->orWhere('name', 'LIKE', "%$keyword%");
            });
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status); // giả sử status = 0, 1
        }
        $users = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.benhnhan.index', compact('users', 'title'));
    }
    public function updateStatus(Request $request)
    {

        $user_bn = User::find($request->id);

        if (!$user_bn) {
            return response()->json(['success' => false, 'message' => 'Tài khoản không tồn tại!']);
        }

        // Cập nhật trạng thái
        $user_bn->status = $request->trangthai;
        $user_bn->save();

        $trangThaiMap = [
            0 => 'Đã khóa',
            1 => 'Đã kích hoạt',
        ];

        $trangThaiText = $trangThaiMap[$user_bn->status] ?? 'Không xác định';
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật trạng thái "'
            . $trangThaiText . '" cho tài khoản "'  . $user_bn->name . ' (' . $user_bn->email . ')" vào CSDL!';
        $ls->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }

    public function danhSachBenhNhan($id)
    {
        $title = 'Quản lý hồ sơ bệnh nhân của tài khoản ' . $id;
        $user = User::with('benhnhan')->findOrFail($id);
        return view('admin.benhnhan.hoso', compact('user', 'title'));
    }

    public function xoaTaiKhoan($id)
    {
        try {
            $user_bn = User::findOrFail($id);
            $name = $user_bn->name;
            $email = $user_bn->email;
            // Kiểm tra tồn tại khóa ngoại (ví dụ bảng benhnhan liên kết với user)
            if ($user_bn->benhnhan()->exists()) {
                return redirect()->back()->with('error', 'Không thể xóa tài khoản vì đã có hồ sơ bệnh nhân liên kết.');
            }

            // Có thể kiểm tra thêm bảng khác nếu cần
            // if ($user->lichhen()->exists()) { ... }

            // Nếu không liên kết thì cho phép xóa
            $user_bn->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa tài khoản "'  . $name . ' (' . $email . ')" khỏi CSDL!';
            $ls->save();
            return redirect()->route('taikhoanbenhnhan.index')->with('success', 'Đã xóa tài khoản thành công.');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->route('taikhoanbenhnhan.index')->with('error', 'Không thể xóa tài khoản này vì có dữ liệu liên quan.');
            }
            return redirect()->route('taikhoanbenhnhan.index')->with('error', 'Có lỗi xảy ra khi xóa tài khoản.');
        }
    }

    public function detailLichHen($id, Request $request)
    {
        // Lấy danh sách bác sĩ, chuyên khoa, cơ sở để hiển thị trong bộ lọc
        $bacSiList = BacSi::all();
        $chuyenKhoaList = ChuyenKhoa::all();
        $coSoList = CoSo::all();
        $user = Auth::user();
        $title = 'Chi tiết các lịch hẹn bệnh nhân';
        // Kiểm tra bệnh nhân có tồn tại không
        $benhNhan = BenhNhan::with('user')->find($id);
        if (!$benhNhan) {
            return redirect()->route('benhnhan.index')->with('error', 'Bệnh nhân không tồn tại.');
        }
        // Nếu là nhân viên cơ sở
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        if ($nhanvien && $nhanvien->id_coso) {
            $cs_nv = Coso::find($nhanvien->id_coso);
             // Lấy danh sách bác sĩ để hiển thị trong bộ lọc
            $bacSiList = BacSi::where('id_coso', $nhanvien->id_coso)->get();
        }

        $query = LichHen::with('bacsi.coso', 'bacsi.chuyenkhoa')
            ->where('id_benhnhan', $id)
            ->orderBy('ngayhen', 'desc');

        if ($user->role != 'hospital') {
            // Lọc theo cơ sở
            if ($request->filled('id_coso')) {
                $query->whereHas('bacsi.coso', function ($q) use ($request) {
                    $q->where('id', $request->id_coso);
                });
            }
        }
        // Lọc theo chuyên khoa
        if ($request->filled('id_chuyenkhoa')) {
            $query->whereHas('bacsi.chuyenkhoa', function ($q) use ($request) {
                $q->where('id', $request->id_chuyenkhoa);
            });
        }

        // Lọc theo bác sĩ
        if ($request->filled('id_bacsi')) {
            $query->where('id_bacsi', $request->id_bacsi);
        }

        $lichHenList = $query->paginate(10);
        if ($user->role === 'hospital') {

            return view('admin.benhnhan.detail_lichhen', compact('benhNhan', 'bacSiList', 'chuyenKhoaList', 'coSoList', 'lichHenList', 'title', 'cs_nv'));
        } else {
            return view('admin.benhnhan.detail_lichhen', compact('benhNhan', 'bacSiList', 'chuyenKhoaList', 'coSoList', 'lichHenList', 'title'));
        }
    }



    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $benhNhan = BenhNhan::find($id);
        $title = 'Cập nhật bệnh nhân' . $benhNhan->hoten;
        return view('admin.benhnhan.edit', ['title' => $title, 'benhNhan' => $benhNhan]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'hoten' => 'required|string|max:255',
            'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
            'diachi' => 'required|string|max:255',
            'ngaysinh' => 'required|date|before:today',
            'cccd' => 'required|digits:12|unique:benhnhan,cccd,' . $id,
            'gioitinh' => 'required|in:Nam,Nữ',
        ], [
            'hoten.required' => 'Vui lòng nhập họ và tên.',
            'hoten.string' => 'Họ tên phải là chuỗi ký tự.',
            'hoten.max' => 'Họ tên không được quá 255 ký tự.',

            'sodienthoai.required' => 'Vui lòng nhập số điện thoại.',
            'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',

            'diachi.required' => 'Vui lòng nhập địa chỉ.',
            'diachi.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'diachi.max' => 'Địa chỉ không được quá 255 ký tự.',

            'ngaysinh.required' => 'Vui lòng nhập ngày sinh.',
            'ngaysinh.date' => 'Ngày sinh không hợp lệ.',
            'ngaysinh.before' => 'Ngày sinh phải trước ngày hiện tại.',

            'cccd.required' => 'Vui lòng nhập số CCCD.',
            'cccd.digits' => 'CCCD phải có đúng 12 chữ số.',
            'cccd.unique' => 'Số CCCD này đã được sử dụng.',

            'gioitinh.required' => 'Vui lòng chọn giới tính.',
            'gioitinh.in' => 'Giới tính không hợp lệ.',
        ]);

        $benhNhan = BenhNhan::findOrFail($id);
        $benhNhan->update($request->all());

        $id_user = $request->id_user;
        $user_bn = User::firstOrFail($id_user);
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin hồ sơ bệnh nhân "'  . $benhNhan->hoten . 'của tài khoản ' . $user_bn->name . '(' . $user_bn->email . ')" vào CSDL!';
        $ls->save();
        return redirect()->route('taikhoanbenhnhan.xemhoso', $id_user)->with('success', 'Cập nhật thông tin thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function delete(string $id)
    {
        try {
            // Tìm chuyên khoa theo ID
            $bn = BenhNhan::find($id);
            $hotenbn = $bn->hoten;

            $id_user = $bn->id_user;
            $user_bn = User::firstOrFail($id_user);
            // Xóa bệnh nhân
            $bn->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa hồ sơ bệnh nhân "'
                . $hotenbn . 'của tài khoản ' . $user_bn->name . '(' . $user_bn->email . ')" khỏi CSDL!';
            $ls->save();
            return redirect()->back()->with('success', 'Xóa dữ liệu thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->back()->with('error', 'Không thể xóa bệnh nhân vì có dữ liệu liên quan.');
            }
            return redirect()->back()->with('error', 'Có lỗi xảy ra khi xóa bệnh nhân.');
        }
    }
}
