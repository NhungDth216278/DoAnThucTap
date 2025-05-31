<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TinTuc;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Auth;
use App\Models\LichSu;
use Carbon\Carbon;

class VietTinTuc extends Controller
{
    public function index(Request $request)
    {
        $nhanvien = NhanVien::where('id_user', Auth::id())->first();

        $query = TinTuc::query();
        $query = TinTuc::with('nhanvien')->where('id_nhanvien', $nhanvien->id);

        // Tìm theo tiêu đề, mô tả, nội dung
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('tieude', 'like', "%$keyword%")
                  ->orWhere('mota', 'like', "%$keyword%")
                  ->orWhere('noidung', 'like', "%$keyword%");
            });
        }

        // Lọc theo loại tin (nếu là cột trong bảng)
        if ($request->filled('loai')) {
            $query->where('loai', $request->loai);
        }

        // Lọc theo trạng thái
        if ($request->filled('trangthai')) {
            $query->where('trangthai', $request->trangthai);
        }

        // Lọc theo ngày tạo
        if ($request->filled('from_date')) {
            $query->whereDate('created_at', '>=', Carbon::parse($request->from_date));
        }
        if ($request->filled('to_date')) {
            $query->whereDate('created_at', '<=', Carbon::parse($request->to_date));
        }

        $lstTintuc = $query->orderBy('created_at', 'desc')->paginate(10);

        $title = "Danh sách tin tức - EbookCare";
        //$tintuc = TinTuc::where('trangthai', 1)->orderBy('ngaydang', 'desc')->get();
        return view('admin.viet_tintuc.index', compact('lstTintuc', 'title'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tieude' => 'required',
            'mota' => 'required',
            'noidung' => 'required',
            'loai' => 'required|in:1,2,3', // Chỉ chấp nhận giá trị 1 hoặc 2 hoặc 3
            'hinhanh' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/tintuc'), $fileName);
            $hinhanhPath = 'upload/tintuc/' . $fileName;
        }
        // Lấy user đang đăng nhập
        $user = Auth::user();

        // Tìm nhân viên liên kết với user
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        if (!$nhanvien) {
            return back()->with('error', 'Không tìm thấy thông tin nhân viên liên kết với tài khoản.');
        }
        $tintuc = TinTuc::create([
            'id_nhanvien' => $nhanvien->id,
            'tieude' => $request->tieude,
            'mota' => $request->mota,
            'noidung' => $request->noidung,
            'loai' => $request->loai,
            'hinhanh' => $hinhanhPath, // Đường dẫn lưu trong database
        ]);

        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm Tin Tức "'  . $tintuc->tieude . '" vào CSDL!';
        $ls->save();
        return redirect()->route('dstintuc.index')->with('success', 'Tin tức đã được đăng!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tintuc = TinTuc::findOrFail($id);
        $title = 'Cập nhật tin tức ' . $tintuc->tieude;
        $user = Auth::user();

        // Lấy nhân viên đang đăng nhập
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        // Nếu là admin hoặc là nhân viên đã viết bài thì cho sửa
        if (($nhanvien && $tintuc->id_nhanvien == $nhanvien->id)) {
            return view('admin.viet_tintuc.edit', compact('title', 'tintuc'));
        }

        return redirect()->back()->with('error', 'Bạn không có quyền sửa bài này.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tieude' => 'required',
            'mota' => 'required',
            'noidung' => 'required',
            'loai' => 'required|in:1,2,3', // Chỉ chấp nhận giá trị 1 hoặc 2 hoặc 3
            'hinhanh' => 'image|mimes:jpeg,png,jpg|max:2048',
        ]);
        $tintuc = TinTuc::findOrFail($id);

        $data = $request->all();
        if ($request->hasFile('hinhanh')) {
            if ($tintuc->hinhanh && file_exists(public_path($tintuc->hinhanh))) {
                unlink(public_path($tintuc->hinhanh));
            }
            $file = $request->file('hinhanh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/tintuc'), $fileName);
            $data['hinhanh'] = 'upload/tintuc/' . $fileName;
        }
        $tintuc->update($data);

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật Tin Tức "'  . $tintuc->tieude . '" vào CSDL!';
        $ls->save();
        return redirect()->route('dstintuc.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function delete($id)
    {
        $user = Auth::user();
        $tintuc = TinTuc::findOrFail($id);
        $tieude = $tintuc->tieude;
        // Lấy nhân viên đang đăng nhập
        $nhanvien = NhanVien::where('id_user', $user->id)->first();
        if ($user->role == 'admin' || ($nhanvien && $tintuc->id_nhanvien == $nhanvien->id)) {

            $tintuc->delete();
            // Ghi nhận lịch sử
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Tin Tức "'  . $tieude . '" khỏi CSDL!';
            $ls->save();
            return redirect()->route('dstintuc.index')->with('success', 'Xóa dữ liệu thành công!');
        } else {
            return redirect()->route('dstintuc.index')->with('error', 'Chỉ admin mới được xóa bài viết.');
        }
    }
}
