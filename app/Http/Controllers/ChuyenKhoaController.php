<?php

namespace App\Http\Controllers;

use App\Models\ChuyenKhoa;
use App\Models\CoSo;
use App\Models\LichSu;
use App\Models\NhanVien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

use PhpOffice\PhpSpreadsheet\Style\Border;

class ChuyenKhoaController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Quản lý chuyên khoa';

        $dsCoSo = CoSo::all();
        // Lấy user đang đăng nhập
        $user = Auth::user();

        if ($user->role === 'hospital') {
            // Nếu là nhân viên cơ sở
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {

                $query = ChuyenKhoa::query(); // Khởi tạo query

                // Chỉ lấy các chuyên khoa thuộc cơ sở của nhân viên đó
                $query = ChuyenKhoa::with('coso')->where('id_coso', $nhanvien->id_coso);

                $coso = Coso::find($nhanvien->id_coso);
                // Lọc theo keyword nếu có
                if ($request->filled('keyword')) {
                    $keyword = $request->keyword;
                    $query->where('id_coso', $nhanvien->id_coso)
                        ->where(function ($q) use ($keyword) {
                            $q->where('tenkhoa', 'like', "%$keyword%")
                                ->orWhere('giakham', 'like', "%$keyword%")
                                ->orWhere('mota', 'like', "%$keyword%");
                        });
                }

                $lstCK = $query->paginate(10);
                $title = 'Trang quản trị của ' . $coso->tencoso . ' - EbookCare';

                return view('admin.chuyenkhoa.index', [
                    'title' => $title,
                    'lstCK' => $lstCK,
                    'dsCoSo' => $dsCoSo,
                    'cs_nv' => $coso
                ]);
            }
        } else {
            // Tạo query cơ bản
            $query = ChuyenKhoa::with('coso');

            // Nếu không phải hospital
            $dsCoSo = CoSo::all();

            // Lọc theo từ khoá nếu có
            if ($request->filled('keyword')) {
                $keyword = $request->keyword;
                $query->where(function ($q) use ($keyword) {
                    $q->where('tenkhoa', 'like', "%$keyword%")
                        ->orWhere('giakham', 'like', "%$keyword%")
                        ->orWhere('mota', 'like', "%$keyword%");
                });
            }

            // Lọc theo cơ sở nếu được chọn
            if ($request->filled('id_coso')) {
                $query->where('id_coso', $request->id_coso);
            }

            $lstCK = $query->paginate(10);

            return view('admin.chuyenkhoa.index', [
                'title' => $title,
                'lstCK' => $lstCK,
                'dsCoSo' => $dsCoSo
            ]);
        }
    }

    public function store(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $validated = $request->validate([
            'id_coso'  => 'required|exists:coso,id', // Cơ sở phải tồn tại
            'tenkhoa'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('chuyenkhoa')->where(function ($query) use ($request) {
                    return $query->where('id_coso', $request->id_coso);
                })
            ],
            'giakham'  => 'required|integer|min:0', // Giá khám phải là số nguyên dương
            'mota'     => 'nullable|string'
        ], [
            'id_coso.required' => 'Cơ sở là bắt buộc.',
            'id_coso.exists'   => 'Cơ sở không hợp lệ.',
            'tenkhoa.required' => 'Tên chuyên khoa không được để trống.',
            'tenkhoa.unique'   => 'Tên chuyên khoa đã tồn tại.',
            'giakham.required' => 'Giá khám là bắt buộc.',
            'giakham.integer'  => 'Giá khám phải là số nguyên.',
            'giakham.min'      => 'Giá khám phải lớn hơn hoặc bằng 0.',

        ]);

        // Nếu dữ liệu hợp lệ, thêm chuyên khoa vào database
        $chuyenKhoa = ChuyenKhoa::create($validated);

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm Chuyên Khoa "'  . $chuyenKhoa->tenkhoa . '" vào CSDL!';
        $ls->save();
        return redirect()->route('chuyenkhoa.index')->with('success', 'Thêm dữ liệu thành công!');
    }

    public function edit($id)
    {
        $lstCK = ChuyenKhoa::all();
        $ck = ChuyenKhoa::find($id);
        $lstCS = CoSo::all(); // Lấy danh sách cơ sở
        $title = 'Cập nhật chuyên khoa' . $ck->tenkhoa;
        return view('admin.chuyenkhoa.edit', ['title' => $title, 'lstCK' => $lstCK, 'ck' => $ck, 'lstCS' => $lstCS]);
    }

    public function update(Request $request, $id)
    {
        $user = Auth::user();
        // Kiểm tra dữ liệu đầu vào
        $rules = [
            'tenkhoa'  => 'required|string|max:255|unique:chuyenkhoa,tenkhoa,' . $id,
            'giakham'  => 'required|integer|min:0',
            'mota'     => 'nullable|string'
        ];
        // Nếu là hospital thì bắt buộc chọn id_coso
        if ($user->role != 'hospital') {
            $rules['id_coso'] = 'required|exists:coso,id';
        }
        $messages = [
            'id_coso.required' => 'Cơ sở là bắt buộc.',
            'id_coso.exists'   => 'Cơ sở không hợp lệ.',
            'tenkhoa.required' => 'Tên chuyên khoa không được để trống.',
            'tenkhoa.unique'   => 'Tên chuyên khoa đã tồn tại.',
            'giakham.required' => 'Giá khám là bắt buộc.',
            'giakham.integer'  => 'Giá khám phải là số nguyên.',
            'giakham.min'      => 'Giá khám phải lớn hơn hoặc bằng 0.',

        ];
        $request->validate($rules, $messages);
        //$data = $request->all();

        $ck = ChuyenKhoa::find($id);
        if ($user->role != 'hospital') {
            $ck->update([
                'id_coso' => $request->id_coso,
                'tenkhoa' => $request->tenkhoa,
                'giakham' => $request->giakham,
                'mota' => $request->mota,
            ]);
        } else {
            $ck->update([

                'tenkhoa' => $request->tenkhoa,
                'giakham' => $request->giakham,
                'mota' => $request->mota,
            ]);
        }
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin của Chuyên Khoa "'  . $ck->tenkhoa . '" vào CSDL!';
        $ls->save();

        return redirect()->route('chuyenkhoa.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function delete($id)
    {
        $ck = ChuyenKhoa::find($id);
        try {
            // Tìm chuyên khoa theo ID
            $ck = ChuyenKhoa::findOrFail($id);
            $tenkhoa = $ck->tenkhoa;
            // Xóa chuyên khoa
            $ck->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Chuyên Khoa "'  . $tenkhoa . '" khỏi CSDL!';
            $ls->save();

            return redirect()->route('chuyenkhoa.index')->with('success', 'Xóa dữ liệu thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->route('chuyenkhoa.index')->with('error', 'Không thể xóa chuyên khoa vì có dữ liệu liên quan.');
            }
            return redirect()->route('chuyenkhoa.index')->with('error', 'Có lỗi xảy ra khi xóa chuyên khoa.');
        }
    }

    public function export(Request $request)
    {
        // Lấy user đang đăng nhập
        $user = Auth::user();
        $spreadsheet = new Spreadsheet();

        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {

                $sheet = $spreadsheet->getActiveSheet();

                // Lấy danh sách bác sĩ theo id_coso
                $chuyenkhoaList = ChuyenKhoa::where('id_coso', $nhanvien->id_coso)
                    ->get();

                // Ghi tiêu đề cột
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Tên chuyên khoa');
                $sheet->setCellValue('C1', 'Giá khám');
                $sheet->setCellValue('D1', 'Mô tả');

                $row = 2;

                foreach ($chuyenkhoaList as  $chuyenKhoa) {
                    $sheet->setCellValue('A' . $row, $chuyenKhoa->id);
                    $sheet->setCellValue('B' . $row, $chuyenKhoa->tenkhoa);
                    $sheet->setCellValue('C' . $row, $chuyenKhoa->giakham);
                    $sheet->setCellValue('D' . $row, $chuyenKhoa->mota ?? '');
                    $row++;
                }

                // Tự động căn độ rộng
                foreach (range('A', 'D') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Kẻ viền đẹp
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ];
                $sheet->getStyle('A1:D' . ($row - 1))->applyFromArray($styleArray);
            }
        } else {
            $coSoList = CoSo::with('chuyenKhoa')->get();

            $sheetIndex = 0;

            foreach ($coSoList as $coSo) {
                // Nếu không phải sheet đầu tiên thì tạo sheet mới
                if ($sheetIndex > 0) {
                    $spreadsheet->createSheet();
                }

                $spreadsheet->setActiveSheetIndex($sheetIndex);
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setTitle(substr($coSo->tencoso, 0, 30)); // Excel giới hạn 31 ký tự cho tên sheet

                // Ghi tiêu đề cột
                $sheet->setCellValue('A1', 'ID');
                $sheet->setCellValue('B1', 'Tên chuyên khoa');
                $sheet->setCellValue('C1', 'Giá khám');
                $sheet->setCellValue('D1', 'Mô tả');


                // Lấy danh sách chuyên khoa và sắp xếp theo tên chuyên khoa
                $chuyenKhoaList = $coSo->chuyenKhoa;

                $row = 2;
                foreach ($chuyenKhoaList as $chuyenKhoa) {
                    $sheet->setCellValue('A' . $row, $chuyenKhoa->id);
                    $sheet->setCellValue('B' . $row, $chuyenKhoa->tenkhoa);
                    $sheet->setCellValue('C' . $row, $chuyenKhoa->giakham);
                    $sheet->setCellValue('D' . $row, $chuyenKhoa->mota ?? '');
                    $row++;
                }
                // Tự động căn độ rộng
                foreach (range('A', 'C') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Kẻ viền đẹp
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ];
                $sheet->getStyle('A1:C' . ($row - 1))->applyFromArray($styleArray);
                $sheetIndex++;
            }

            // Set active sheet lại sheet đầu tiên
            $spreadsheet->setActiveSheetIndex(0);
        }
        // Xuất file ra trình duyệt
        $fileName = 'danh_sach_chuyen_khoa.xlsx';
        $writer = new Xlsx($spreadsheet);

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
