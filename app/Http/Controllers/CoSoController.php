<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CoSo;
use Illuminate\Support\Facades\File;
use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class CoSoController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Quản lý cơ sở';

        $query = CoSo::query();

        // Tìm kiếm theo các trường
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where(function ($q) use ($keyword) {
                $q->where('tencoso', 'LIKE', "%$keyword%")
                    ->orWhere('diachi', 'LIKE', "%$keyword%")
                    ->orWhere('email', 'LIKE', "%$keyword%")
                    ->orWhere('sodienthoai', 'LIKE', "%$keyword%")
                    ->orWhere('mota', 'LIKE', "%$keyword%");
            });
        }

        $lstCS = $query->paginate(10);

        return view('admin.coso.index', ['title' => $title, 'lstCS' => $lstCS]);
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu hợp lệ
        $request->validate([
            'tencoso' => 'required|string|max:255',
            'diachi' => 'required|string|max:500',
            'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
            'email' => 'required|email|unique:coso,email',
            'mota' => 'nullable|string',
            'noidung' => 'nullable|string',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'tencoso.required' => 'Vui lòng nhập tên cơ sở.',
            'diachi.required' => 'Vui lòng nhập địa chỉ.',
            'sodienthoai.required' => 'Vui lòng nhập số điện thoại.',
            'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'hinhanh.required' => 'Vui lòng chọn hình ảnh',
            'hinhanh.image' => 'File tải lên phải là hình ảnh.',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng JPG, PNG, JPEG.',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);
        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $fileName = 'cs_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/coso'), $fileName);
            $hinhanhPath = 'upload/coso/' . $fileName;
        }

        // $data = $request->all();

        // $cs = new CoSo();
        //$cs->tencoso = $data["tencoso"];
        // $cs->diachi = $data["diachi"];
        // $cs->sodienthoai = $data["sodienthoai"];
        // $cs->email = $data["email"];
        // $cs->mota = $data["mota"];

        $coso = CoSo::create([
            'tencoso' => $request->tencoso,
            'diachi' => $request->diachi,
            'sodienthoai' => $request->sodienthoai,
            'email' => $request->email,
            'mota' => $request->mota,
            'noidung' => $request->noidung,
            'hinhanh' => $hinhanhPath, // Đường dẫn lưu trong database
        ]);

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm Cơ Sở "'  . $coso->tencoso . '" vào CSDL!';
        $ls->save();

        return redirect(route('coso.index'))->with('success', 'Thêm dữ liệu thành công!');
    }

    public function edit($id)
    {
        $lstCS = CoSo::all();
        $cs = CoSo::find($id);
        $title = 'Cập nhật cơ sở ' . $cs->tencoso;
        return view('admin.coso.edit', ['title' => $title, 'lstCS' => $lstCS, 'cs' => $cs]);
    }

    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu hợp lệ
        $request->validate([
            'tencoso' => 'required|string|max:255',
            'diachi' => 'required|string|max:500',
            'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
            'email' => 'required|email|unique:coso,email,' . $id,
            'mota' => 'nullable|string',
            'noidung' => 'nullable|string',
            'hinhanh' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ], [
            'tencoso.required' => 'Vui lòng nhập tên cơ sở.',
            'diachi.required' => 'Vui lòng nhập địa chỉ.',
            'sodienthoai.required' => 'Vui lòng nhập số điện thoại.',
            'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Email không hợp lệ.',
            'email.unique' => 'Email đã tồn tại.',
            'hinhanh.image' => 'File tải lên phải là hình ảnh.',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng JPG, PNG, JPEG.',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB.',
        ]);

        $coso = CoSo::findOrFail($id);

        $data = $request->all();
        if ($request->hasFile('hinhanh')) {
            if ($coso->hinhanh && file_exists(public_path($coso->hinhanh))) {
                unlink(public_path($coso->hinhanh));
            }
            $file = $request->file('hinhanh');
            $fileName = 'cs_' . time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/coso'), $fileName);
            $data['hinhanh'] = 'upload/coso/' . $fileName;
        }
        $coso->update($data);
        //  $data = $request->all();

        // $cs = CoSo::find($id);
        // $cs->tencoso = $data["tencoso"];
        // $cs->diachi = $data["diachi"];
        // $cs->sodienthoai = $data["sodienthoai"];
        // $cs->email = $data["email"];
        //  $cs->mota = $data["mota"];
        //$cs->update();

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin của Cơ Sở "'  . $coso->tencoso . '" vào CSDL!';
        $ls->save();

        if ($user->role === 'hospital') {
            return redirect()->route('admin.index')->with('success', 'Cập nhật dữ liệu thành công!');
        }
        return redirect()->route('coso.index')->with('success', 'Cập nhật dữ liệu của "' . $coso->tencoso . '" thành công!');
    }

    public function delete($id)
    {
        try {
            // Tìm chuyên khoa theo ID
            $coso = CoSo::findOrFail($id);
            $tencoso = $coso->tencoso;
            // Xóa chuyên khoa
            $coso->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Cơ Sở "'  . $tencoso . '" khỏi CSDL!';
            $ls->save();

            return redirect()->route('coso.index')->with('success', 'Xóa dữ liệu thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->route('coso.index')->with('error', 'Không thể xóa cơ sở vì có dữ liệu liên quan.');
            }
            return redirect()->route('coso.index')->with('error', 'Có lỗi xảy ra khi xóa cơ sở.');
        }
    }

    public function export()
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Tên cơ sở');
        $sheet->setCellValue('C1', 'Địa chỉ');
        $sheet->setCellValue('D1', 'Số điện thoại');
        $sheet->setCellValue('E1', 'Email');
        $sheet->setCellValue('F1', 'Mô tả');
        $sheet->setCellValue('G1', 'Nội dung');

        // Dữ liệu
        $cosos = CoSo::all();
        $row = 2;
        foreach ($cosos as $coso) {
            $sheet->setCellValue('A' . $row, $coso->id);
            $sheet->setCellValue('B' . $row, $coso->tencoso);
            $sheet->setCellValue('C' . $row, $coso->diachi);
            $sheet->setCellValue('D' . $row, $coso->sodienthoai);
            $sheet->setCellValue('E' . $row, $coso->email);
            $sheet->setCellValue('F' . $row, $coso->mota);
            $sheet->setCellValue('G' . $row, $coso->noidung);
            $row++;
        }

        // Xuất file
        $writer = new Xlsx($spreadsheet);
        $fileName = 'danh-sach-co-so.xlsx';
        $temp_file = tempnam(sys_get_temp_dir(), $fileName);
        $writer->save($temp_file);

        return response()->download($temp_file, $fileName)->deleteFileAfterSend(true);
    }
}
