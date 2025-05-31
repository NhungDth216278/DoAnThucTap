<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CoSo;
use App\Models\BacSi;
use App\Models\ChuyenKhoa;
use App\Models\BenhNhan;
use App\Models\TinTuc;
use App\Models\LichSu;
use App\Models\LichHen;
use App\Models\LichKhamKhungGio;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class TrangChuController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Web đặt lịch khám - EbookCare';

        $cosos = CoSo::all();

        $bacsis = BacSi::with(['coso', 'chuyenkhoa'])->get();

        $tintucs = TinTuc::where('trangthai', 1)
            ->where('created_at', '>=', Carbon::now()->subMonth())
            ->with('nhanvien') // lấy thông tin người viết
            ->orderBy('created_at', 'desc')
            ->get();


        return view('trangchu.index', compact('title', 'cosos', 'bacsis', 'tintucs'));
    }
    public function search(Request $request)
    {
        $query = $request->input('q');

        if (!$query) {
            return response()->json([]);
        }

        // Tìm kiếm gần đúng trong Cơ sở, Chuyên khoa, Bác sĩ
        $coso = CoSo::where('tencoso', 'LIKE', "%$query%")->limit(5)->get();
        $chuyenkhoa = ChuyenKhoa::where('tenkhoa', 'LIKE', "%$query%")->limit(5)->get();
        $bacsi = BacSi::where('hoten', 'LIKE', "%$query%")
            ->with('coso') // Load quan hệ chuyên khoa
            ->limit(5)
            ->get();


        return response()->json([
            'coso' => $coso,
            'chuyenkhoa' => $chuyenkhoa,
            'bacsi' => $bacsi->map(function ($b) {
                return [
                    'id' => $b->id,
                    'hoten' => $b->hoten,
                    'coso_tencoso' => $b->coso->tencoso ?? 'Không xác định', // Kiểm tra null,
                    'id_coso' => $b->id_coso,
                    'id_chuyenkhoa' => $b->id_chuyenkhoa
                ];
            })
        ]);
    }

    public function profile()
    {
        $title = 'Trang thông tin tài khoản - EbookCare';
        $user = Auth::user();
        return view('trangchu.user.profile', compact('user', 'title'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate(
            [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:25',
                    'regex:/^[a-zA-Z0-9]+$/',
                ],
                'email' => 'required|email|unique:users,email,' . $user->id,
            ],
            [
                'name.required' => 'Vui lòng nhập tên tài khoản!',
                'name.min' => 'Tên tài khoản phải có ít nhất 5 ký tự!',
                'name.max' => 'Tên tài khoản không được vượt quá 25 ký tự!',
                'name.regex' => 'Tên tài khoản chỉ được chứa chữ cái và số!',

                'email.required' => 'Vui lòng nhập email!',
                'email.email' => 'Email không đúng định dạng!',
                'email.unique' => 'Email đã tồn tại trong hệ thống!',
            ]
        );

        $user = Auth::user();
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // Làm mới thông tin user
        Auth::user()->refresh();

        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Người dùng có tên tài khoản' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin cá nhân!';
        $ls->save();

        return back()->with('success', 'Cập nhật thông tin thành công.');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password'  => [
                'required',
                'string',
                'min:5',
                'max:25',
                'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{5,25}$/',
            ],
            [
                'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại!',
                'new_password.required' => 'Vui lòng nhập mật khẩu mới!',
                'new_password.min' => 'Mật khẩu phải có ít nhất 5 ký tự!',
                'new_password.max' => 'Mật khẩu không được vượt quá 25 ký tự!',
                'new_password.regex' => 'Mật khẩu phải bao gồm chữ thường, chữ hoa, chữ số và ký tự đặc biệt!',
            ]
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('error', 'Mật khẩu hiện tại không đúng.');
        }

        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        // Làm mới thông tin user
        Auth::user()->refresh();

        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Người dùng có tên tài khoản' . $user->name . ' (' . $user->email . ') đã đổi mật khẩu!';
        $ls->save();

        return back()->with('success', 'Đổi mật khẩu thành công.');

    }

    public function getHoSoBenhNhan()
    {
        // Lấy ID người dùng hiện tại
        $userId = Auth::id();

        $title = 'Hồ sơ bệnh nhân - EbookCare';
        // Tìm tất cả hồ sơ bệnh nhân của người dùng này
        $hoSoBenhNhans = BenhNhan::where('id_user', $userId)->get();

        return view('trangchu.user.hosobenhnhan', compact('hoSoBenhNhans', 'title'));
    }
    // Thêm mới
    public function storeBenhNhan(Request $request)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'sdt' => 'required|regex:/^0[0-9]{9,10}$/',
            'dia_chi' => 'required|string|max:255',
            'ngay_sinh' => 'required|date|before:today',
            'cccd' => 'required|digits:12|unique:benhnhan,cccd',
            'gioi_tinh' => 'required|in:Nam,Nữ',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ và tên.',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
            'ho_ten.max' => 'Họ tên không được quá 255 ký tự.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
            'dia_chi.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'dia_chi.max' => 'Địa chỉ không được quá 255 ký tự.',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh.',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',
            'ngay_sinh.before' => 'Ngày sinh phải trước ngày hiện tại.',
            'cccd.required' => 'Vui lòng nhập số CCCD.',
            'cccd.digits' => 'CCCD phải có đúng 12 chữ số.',
            'cccd.unique' => 'Số CCCD này đã được sử dụng.',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính.',
            'gioi_tinh.in' => 'Giới tính không hợp lệ.',
        ]);

        $avatarPath = null;
        // Xử lý ảnh tải lên
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();

            $fileName = 'bn_' . time() . '.' . $extension;
            $path = 'upload/avatars/benhnhan';
            $file->move($path, $fileName);

            $avatarPath = $path . $fileName;
        }

        $bn = BenhNhan::create([
            'id_user' => Auth::id(),
            'hoten' => $request->ho_ten,
            'ngaysinh' => $request->ngay_sinh,
            'gioitinh' => $request->gioi_tinh,
            'sodienthoai' => $request->sdt,
            'diachi' => $request->dia_chi,
            'cccd' => $request->cccd,
            'avatar' => $avatarPath,
        ]);
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm hồ sơ bệnh nhân "'  . $bn->hoten . '" vào CSDL!';
        $ls->save();

        return redirect()->back()->with('success', 'Hồ sơ bệnh nhân "' . $bn->hoten . '" đã được thêm thành công!');
    }

    public function updateBenhNhan(Request $request, string $id)
    {
        $request->validate([
            'ho_ten' => 'required|string|max:255',
            'sdt' => 'required|regex:/^0[0-9]{9,10}$/',
            'dia_chi' => 'required|string|max:255',
            'ngay_sinh' => 'required|date|before:today',
            'cccd' => 'required|digits:12|unique:benhnhan,cccd,' . $id,
            'gioi_tinh' => 'required|in:Nam,Nữ',
        ], [
            'ho_ten.required' => 'Vui lòng nhập họ và tên.',
            'ho_ten.string' => 'Họ tên phải là chuỗi ký tự.',
            'ho_ten.max' => 'Họ tên không được quá 255 ký tự.',
            'sdt.required' => 'Vui lòng nhập số điện thoại.',
            'sdt.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',
            'dia_chi.required' => 'Vui lòng nhập địa chỉ.',
            'dia_chi.string' => 'Địa chỉ phải là chuỗi ký tự.',
            'dia_chi.max' => 'Địa chỉ không được quá 255 ký tự.',
            'ngay_sinh.required' => 'Vui lòng nhập ngày sinh.',
            'ngay_sinh.date' => 'Ngày sinh không hợp lệ.',
            'ngay_sinh.before' => 'Ngày sinh phải trước ngày hiện tại.',
            'cccd.required' => 'Vui lòng nhập số CCCD.',
            'cccd.digits' => 'CCCD phải có đúng 12 chữ số.',
            'cccd.unique' => 'Số CCCD này đã được sử dụng.',
            'gioi_tinh.required' => 'Vui lòng chọn giới tính.',
            'gioi_tinh.in' => 'Giới tính không hợp lệ.',
        ]);
        $bn = BenhNhan::findOrFail($id);

        $avatarPath = null;
        // Xử lý ảnh tải lên
        if ($request->hasFile('avatar')) {
            if ($bn->avatar && file_exists(public_path($bn->avatar))) {
                unlink(public_path($bn->avatar));
            }
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();

            $fileName = 'bn_' . time() . '.' . $extension;
            $path = 'imgs/avatars/';
            $file->move($path, $fileName);

            $avatarPath = $path . $fileName;
        }

        $data = $request->all();
        if (isset($data["XoaAnh"]) && $data["XoaAnh"] == 1 && !is_null($request->old_avatar)) {
            File::delete($request->old_avatar);
            $avatarPath = null;
        }
        $bn->hoten = $data["ho_ten"];
        $bn->diachi = $data["dia_chi"];
        $bn->sodienthoai = $data["sdt"];
        $bn->ngaysinh = $data["ngay_sinh"];
        $bn->gioitinh = $data["gioi_tinh"];
        $bn->cccd = $data["cccd"];
        $bn->avatar = $avatarPath;


        $bn->update();

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin hồ sơ bệnh nhân "'
            . $bn->hoten . '" của mình vào CSDL!';
        $ls->save();
        return redirect()->route('home.hosobenhnhan')->with('success', 'Cập nhật thông tin bệnh nhân "'  . $bn->hoten . ' " thành công!');
    }

    public function deleteBenhNhan(string $id)
    {
        try {
            // Tìm chuyên khoa theo ID
            $bn = BenhNhan::find($id);
            $hotenbn = $bn->hoten;

            // Xóa bệnh nhân
            $bn->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa hồ sơ bệnh nhân "'  . $hotenbn . '" của mình ra khỏi CSDL!';
            $ls->save();

            return redirect()->route('user.hosobenhnhan')->with('success', 'Xóa hồ sơ bệnh nhân "'  . $hotenbn . ' " thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->route('user.hosobenhnhan')->with('error', 'Không thể xóa bệnh nhân vì có dữ liệu liên quan.');
            }
            return redirect()->route('user.hosobenhnhan')->with('error', 'Có lỗi xảy ra khi xóa bệnh nhân.');
        }
    }

    public function lichHenBenhNhan($id)
    {
        $title = 'Chi tiết các lịch hẹn bệnh nhân';

        $benhnhan = BenhNhan::with([
            'lichhen.bacsi.coso',
            'lichhen.bacsi.chuyenkhoa'
        ])->findOrFail($id);


        if (!$benhnhan) {
            return redirect()->route('benhnhan.index')->with('error', 'Bệnh nhân không tồn tại.');
        }

        return view('trangchu.user.lichhen_benhnhan', compact('benhnhan', 'title'));
    }


    public function huyLichHen($id)
    {
        $lichhen = LichHen::find($id);

        if (!$lichhen) {
            return redirect()->back()->with('error', 'Lịch hẹn không tồn tại');
        }

        // Cập nhật trạng thái về đã hủy
        $lichhen->trangthai = 0;
        $lichhen->save();

        $idLichKhamKhungGio = $lichhen->getAttribute('id_lichkhamkhunggio');

        // Nếu trạng thái là 0, giảm soluongdadat trong bảng lichkham_khunggio
        if ($lichhen->trangthai == 0) {
            $lichKhamKhungGio = LichKhamKhungGio::where('id', $idLichKhamKhungGio)->first();
            if ($lichKhamKhungGio && $lichKhamKhungGio->soluongdadat > 0) {

                $lichKhamKhungGio->decrement('soluongdadat');
            }
        }

        $listLichHen = LichHen::with(['bacsi.chuyenkhoa', 'bacsi.coso', 'benhnhan.user'])->find($lichhen->id);

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã hủy Lịch Hẹn của bệnh nhân "'
            . $listLichHen->benhnhan->hoten . ' đặt khám với bác sĩ '
            . $listLichHen->bacsi->hocham . '.' . $listLichHen->bacsi->hoten . '(' . $listLichHen->bacsi->chuyenkhoa->tenkhoa . ' - '
            . $listLichHen->bacsi->coso->tencoso . ')" vào CSDL';
        $ls->save();

        return redirect()->back()->with('success', 'Đã hủy lịch hẹn thành công');
    }

    public function deleteLichHen($id)
    {
        $lichHen = LichHen::findOrFail($id);
        $listLichHen = LichHen::with(['bacsi.chuyenkhoa', 'bacsi.coso', 'benhnhan.user'])->find($lichHen->id);

        if ($lichHen->trangthai == 0) {
            $lichHen->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Lịch Hẹn của bệnh nhân '  . $listLichHen->benhnhan->hoten . ' đặt khám với bác sĩ '
                . $listLichHen->bacsi->hocham . '.' . $listLichHen->bacsi->hoten . '(' . $listLichHen->bacsi->chuyenkhoa->tenkhoa . ' - '
                . $listLichHen->bacsi->coso->tencoso . ')" khỏi CSDL';

            return redirect()->route('hosobenhnhan.lichhen', $listLichHen->benhnhan->id)->with('success', 'Xóa dữ liệu thành công!');
        }
        return redirect()->route('hosobenhnhan.lichhen', $listLichHen->benhnhan->id)->with('error', 'Có lỗi xảy ra khi xóa lich hẹn.');
    }

    public function gioithieu()
    {
        $title = 'Giới thiệu về EbookCare';

        return view('trangchu.gioithieu', ['title' => $title]);
    }

    public function dieukhoan()
    {
        $title = 'Điều khoản dịch vụ - EbookCare';

        return view('trangchu.dieukhoan', ['title' => $title]);
    }

    public function chinhsach()
    {
        $title = 'Chính sách bảo mật - EbookCare';

        return view('trangchu.chinhsach', ['title' => $title]);
    }

    public function quydinh()
    {
        $title = 'Quy định sử dụng - EbookCare';

        return view('trangchu.quydinh', ['title' => $title]);
    }
}
