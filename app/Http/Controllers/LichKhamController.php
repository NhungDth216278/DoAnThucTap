<?php

namespace App\Http\Controllers;

use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\KhungGio;
use App\Models\ChuyenKhoa;
use App\Models\CoSo;
use App\Models\LichKham;
use App\Models\BacSi;
use App\Models\NhanVien;
use Illuminate\Support\Facades\DB;
use App\Models\LichKhamKhungGio;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LichKhamController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách bác sĩ, chuyên khoa, cơ sở để hiển thị trong bộ lọc
        $bacSiList = BacSi::all();
        $chuyenKhoaList = ChuyenKhoa::all();
        $coSoList = CoSo::all();

        $user = Auth::user();
        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $query = LichKham::whereHas('bacsi', function ($query_lk) use ($nhanvien) {
                    $query_lk->where('id_coso', $nhanvien->id_coso);
                })->with(['bacsi', 'bacsi.chuyenkhoa', 'bacsi.coso']); // thêm các mối quan hệ nếu cần
            }

            // Lọc theo các tiêu chí tìm kiếm
            if ($request->filled('id_bacsi')) {
                $query->where('id_bacsi', $request->id_bacsi);
            }
            // Lọc theo Chuyên khoa
            if ($request->filled('id_chuyenkhoa')) {
                $query->whereHas('bacsi.chuyenkhoa', function ($q) use ($request) {
                    $q->where('id_chuyenkhoa', $request->id_chuyenkhoa);
                });
            }

            if ($request->filled('ngaykham')) {
                $query->whereDate('ngaykham', $request->ngaykham);
            }

            if ($request->filled('buoi')) {
                $query->where('buoi', $request->buoi);
            }
            // Lấy danh sách lịch khám
            $lichKhamList = $query->paginate(10);
            $cs_nv = Coso::find($nhanvien->id_coso);
            $title = 'Trang quản trị của ' . $cs_nv->tencoso . ' - EbookCare';

            return view('admin.lichkham.index', compact('title', 'lichKhamList', 'bacSiList', 'chuyenKhoaList', 'coSoList', 'cs_nv'));
        }
        // Truy vấn danh sách lịch khám
        $query = LichKham::with(['bacsi', 'bacsi.chuyenkhoa', 'bacsi.coso']);

        // Lọc theo các tiêu chí tìm kiếm
        if ($request->filled('id_bacsi')) {
            $query->where('id_bacsi', $request->id_bacsi);
        }
        // Lọc theo Chuyên khoa
        if ($request->filled('id_chuyenkhoa')) {
            $query->whereHas('bacsi.chuyenkhoa', function ($q) use ($request) {
                $q->where('id_chuyenkhoa', $request->id_chuyenkhoa);
            });
        }

        // Lọc theo Cơ sở
        if ($request->filled('id_coso')) {
            $query->whereHas('bacsi.coso', function ($q) use ($request) {
                $q->where('id_coso', $request->id_coso);
            });
        }

        if ($request->filled('ngaykham')) {
            $query->whereDate('ngaykham', $request->ngaykham);
        }

        if ($request->filled('buoi')) {
            $query->where('buoi', $request->buoi);
        }

        // Lấy danh sách lịch khám
        $lichKhamList = $query->paginate(10);
        $title = 'Quản lý lịch khám';

        return view('admin.lichkham.index', compact('title', 'lichKhamList', 'bacSiList', 'chuyenKhoaList', 'coSoList'));
    }

    public function show($id)
    {
        $lichKham = LichKham::with(['bacsi.coso', 'bacsi.chuyenkhoa', 'khungGios'])->findOrFail($id);
        $title = 'Chi tiết lịch khám' . $id;
        return view('admin.lichkham.show', compact('title', 'lichKham'));
    }

    public function edit($id)
    {
        $lichKham = LichKham::findOrFail($id);

        // Lấy danh sách bác sĩ theo cơ sở và chuyên khoa của lịch khám
        $bacSis = BacSi::where('id_coso', $lichKham->bacSi->id_coso)
            ->where('id_chuyenkhoa', $lichKham->bacSi->id_chuyenkhoa)
            ->get();
        $title = 'Cập nhật lich khám' . $id;
        return view('admin.lichkham.edit', compact('title', 'lichKham', 'bacSis'));
    }

    public function update(Request $request, $id)
    {
        // Tìm lịch khám cần cập nhật
        $lichKham = LichKham::findOrFail($id);
        // Kiểm tra nếu lịch khám này đã có người đặt
        $lichDaDuocDat = $lichKham->LichKhamKhungGio()->where('soluongdadat', '>', 0)->exists();
        if ($lichDaDuocDat) {
            return redirect()->route('lichkham.index')->with('error', 'Không thể sửa lịch khám vì đã có bệnh nhân đặt.');
        }

        // Validate dữ liệu
        $request->validate([
            'id_bacsi' => 'required|exists:bacsi,id',
            'ngaykham' => 'required|date|after_or_equal:today',
            'buoi' => 'required|in:Sáng,Chiều',
        ]);

        // Nếu buổi thay đổi, cập nhật lại khung giờ
        if ($request->buoi !== $lichKham->buoi) {
            // Xóa các khung giờ cũ của lịch khám này
            LichKhamKhungGio::where('id_lichkham', $lichKham->id)->delete();

            // Lấy danh sách khung giờ mới theo buổi đã chọn
            $khungGios = KhungGio::where('buoi', $request->buoi)->get();

            // Thêm lại các khung giờ mới vào lichkham_khunggio
            // Thêm khung giờ mặc định vào lịch khám
            foreach ($khungGios as $khungGio) {
                $soluongtoida = ($khungGio->thoigianbatdau == '15:30') ? 3 : 6;
                LichKhamKhungGio::create([
                    'id_lichkham' => $lichKham->id,
                    'id_khunggio' => $khungGio->id,
                    'soluongtoida' => $soluongtoida,
                    'soluongdadat' => 0
                ]);
            }
        }

        // Cập nhật thông tin lịch khám
        $lichKham->update([
            'id_bacsi' => $request->id_bacsi,
            'ngaykham' => $request->ngaykham,
            'buoi' => $request->buoi,
        ]);

        $listLichKham = LichKham::with(['bacsi.chuyenkhoa', 'bacsi.coso'])->find($lichKham->id);
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin Lịch Khám của bác sĩ "'
            . $listLichKham->bacsi->hocham . '.' . $listLichKham->bacsi->hoten . '(' . $listLichKham->bacsi->chuyenkhoa->tenkhoa . ' - '
            . $listLichKham->bacsi->coso->tencoso . ')" vào CSDL';
        $ls->save();

        return redirect()->route('lichkham.index')->with('success', 'Cập nhật lịch khám thành công.');
    }

    // Xử lý lưu lịch khám
    public function store(Request $request)
    {
        $request->validate([
            'coso_id' => 'required',
            'chuyenkhoa_id' => 'required',
            'bacsi_id' => 'required',
            'ngaykham' => 'required|date|after_or_equal:today',
            'buoi' => 'required',
        ]);

        $lichKham = LichKham::create([
            'id_bacsi' => $request->bacsi_id,
            'ngaykham' => $request->ngaykham,
            'buoi' => $request->buoi,
        ]);

        // Lấy danh sách khung giờ phù hợp với buổi của lịch khám
        $khungGios = DB::table('khunggio')
            ->where('buoi', $lichKham->buoi)
            ->get();

        // Thêm khung giờ mặc định vào lịch khám
        foreach ($khungGios as $khungGio) {
            $soluongtoida = ($khungGio->thoigianbatdau == '15:30') ? 3 : 6;
            LichKhamKhungGio::create([
                'id_lichkham' => $lichKham->id,
                'id_khunggio' => $khungGio->id,
                'soluongtoida' => $soluongtoida,
                'soluongdadat' => 0
            ]);
        }

        $listLichKham = LichKham::with(['bacsi.chuyenkhoa', 'bacsi.coso'])->find($lichKham->id);
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm Lịch Khám cho bác sĩ "'
            . $listLichKham->bacsi->hocham . '.' . $listLichKham->bacsi->hoten . '(' . $listLichKham->bacsi->chuyenkhoa->tenkhoa . ' - '
            . $listLichKham->bacsi->coso->tencoso . ')" vào CSDL';
        $ls->save();

        return redirect()->route('lichkham.index')->with('success', 'Thêm lịch khám thành công!');
    }

    public function delete($id)
    {
        // Tìm lịch khám cần xóa
        $lichKham = LichKham::findOrFail($id);

        // Kiểm tra nếu lịch khám này đã có người đặt
        $lichDaDuocDat = $lichKham->LichKhamKhungGio()->where('soluongdadat', '>', 0)->exists();
        if ($lichDaDuocDat) {
            return redirect()->route('lichkham.index')->with('error', 'Không thể sửa lịch khám vì đã có bệnh nhân đặt.');
        }
        // Xóa các khung giờ liên kết với lịch khám
        // Xóa các khung giờ cũ của lịch khám này
        LichKhamKhungGio::where('id_lichkham', $lichKham->id)->delete();

        $listLichKham = LichKham::with(['bacsi.chuyenkhoa', 'bacsi.coso'])->find($lichKham->id);
        // Xóa lịch khám
        $lichKham->delete();

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Lịch Khám của bác sĩ "'
            . $listLichKham->bacsi->hocham . '.' . $listLichKham->bacsi->hoten . '(' . $listLichKham->bacsi->chuyenkhoa->tenkhoa . ' - '
            . $listLichKham->bacsi->coso->tencoso . ')" khỏi CSDL';
        $ls->save();
        return redirect()->route('lichkham.index')->with('success', 'Xóa lịch khám thành công.');
    }

    public function getChuyenKhoa($coso_id)
    {

        $chuyenKhoaList = ChuyenKhoa::where('id_coso', $coso_id)->get();
        return response()->json($chuyenKhoaList);
    }

    public function getAllChuyenKhoa()
    {
        $chuyenkhoas = ChuyenKhoa::all(['id', 'tenkhoa']);
        return response()->json($chuyenkhoas);
    }

    public function getBacSi($chuyenkhoa_id)
    {
        $bacSiList = BacSi::where('id_chuyenkhoa', $chuyenkhoa_id)->get();
        return response()->json($bacSiList);
    }

    public function getAllBacSi()
    {
        $bacsis = BacSi::all();
        return response()->json($bacsis);
    }

    public function export()
    {
        // Lấy user đang đăng nhập
        $user = Auth::user();
        $spreadsheet = new Spreadsheet();
        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $sheet = $spreadsheet->getActiveSheet();

                // Header
                $sheet->setCellValue('A1', 'Tên chuyên khoa');
                $sheet->setCellValue('B1', 'Họ tên bác sĩ');
                $sheet->setCellValue('C1', 'Ngày khám');
                $sheet->setCellValue('D1', 'Buổi');
                $sheet->setCellValue('E1', 'Khung giờ');
                $sheet->setCellValue('F1', 'Số lượng tối đa');
                $sheet->setCellValue('G1', 'Số lượng đã đặt');

                $sheet->setCellValue('H1', 'Trạng thái');

                $row = 2;
                // Lấy danh sách bác sĩ thuộc cơ sở
                $bacSiList = BacSi::where('id_coso', $nhanvien->id_coso)
                    ->with(['chuyenKhoa', 'lichKham.lichKhamKhungGio.khungGio'])
                    ->orderBy('id_chuyenkhoa')
                    ->get();

                $lichKhamData = collect();

                foreach ($bacSiList as $bacSi) {
                    foreach ($bacSi->lichKham as $lichKham) {
                        foreach ($lichKham->lichKhamKhungGio as $lichKhamKhungGio) {
                            $lichKhamData->push([
                                'tenkhoa' => $bacSi->chuyenKhoa->tenkhoa ?? 'Chưa có chuyên khoa',
                                'tenbacsi' => ($bacSi->hocham ?? '') . ($bacSi->hoten ?? ''),
                                'ngaykham' => $lichKham->ngaykham ?? '',
                                'buoi' => $lichKham->buoi ?? '',
                                'thoigian' => $lichKhamKhungGio->khungGio->thoigianbatdau . ' - ' . $lichKhamKhungGio->khungGio->thoigianketthuc ?? '',
                                'batdau' => $lichKhamKhungGio->khungGio->thoigianbatdau ?? '',
                                'soluongtoida' => $lichKhamKhungGio->soluongtoida ?? 0,
                                'soluongdadat' => $lichKhamKhungGio->soluongdadat ?? 0,
                                'trangthai' => $lichKhamKhungGio->trangthai,
                            ]);
                        }
                    }
                }

                // Sắp xếp theo ngày khám và thời gian bắt đầu
                $lichKhamData = $lichKhamData->sortBy([
                    ['tenkhoa', 'asc'],
                    ['ngaykham', 'asc'],
                    ['batdau', 'asc'],
                ]);

                $row = 2;
                foreach ($lichKhamData as $item) {
                    $sheet->setCellValue('A' . $row, $item['tenkhoa']);
                    $sheet->setCellValue('B' . $row, $item['tenbacsi']);
                    $sheet->setCellValue('C' . $row, $item['ngaykham']);
                    $sheet->setCellValue('D' . $row, $item['buoi']);
                    $sheet->setCellValue('E' . $row, $item['thoigian']);
                    $sheet->setCellValue('F' . $row, $item['soluongtoida']);
                    $sheet->setCellValue('G' . $row, $item['soluongdadat']);

                    $trangthaiText = match ($item['trangthai']) {
                        0 => 'Đã đầy',
                        1 => 'Đang nhận',
                        2 => 'Không thể đặt',
                        default => 'Không xác định',
                    };
                    $sheet->setCellValue('H' . $row, $trangthaiText);

                    $row++;
                }

                // Gộp ô cùng chuyên khoa
                $this->mergeSameValueCells($sheet, 'A', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'B', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'C', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'D', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'F', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'G', 2, $row - 1); // Gộp cột trạng thái nếu trùng
                $this->mergeSameValueCells($sheet, 'H', 2, $row - 1);

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);
            }
        } else {
            $sheetIndex = 0;

            // Lấy danh sách cơ sở cùng tất cả lịch khám liên quan
            $coSoList = CoSo::with([
                'bacSi.chuyenKhoa',
                'bacSi.lichKham.lichKhamKhungGio.khungGio'
            ])->get();

            foreach ($coSoList as $coSo) {
                if ($sheetIndex > 0) {
                    $spreadsheet->createSheet();
                }

                $spreadsheet->setActiveSheetIndex($sheetIndex);
                $sheet = $spreadsheet->getActiveSheet();
                $safeTitle = $this->makeSheetTitleSafe($coSo->tencoso);
                $sheet->setTitle($safeTitle);

                // Header
                $sheet->setCellValue('A1', 'Tên chuyên khoa');
                $sheet->setCellValue('B1', 'Họ tên bác sĩ');
                $sheet->setCellValue('C1', 'Ngày khám');
                $sheet->setCellValue('D1', 'Buổi');
                $sheet->setCellValue('E1', 'Khung giờ');
                $sheet->setCellValue('F1', 'Số lượng tối đa');
                $sheet->setCellValue('G1', 'Số lượng đã đặt');

                $sheet->setCellValue('H1', 'Trạng thái');

                $row = 2;
                $bacSiList = $coSo->bacSi;

                $lichKhamData = collect();

                foreach ($bacSiList as $bacSi) {
                    foreach ($bacSi->lichKham as $lichKham) {
                        foreach ($lichKham->lichKhamKhungGio as $lichKhamKhungGio) {
                            $lichKhamData->push([
                                'tenkhoa' => $bacSi->chuyenKhoa->tenkhoa ?? 'Chưa có chuyên khoa',
                                'tenbacsi' => ($bacSi->hocham ?? '') . ($bacSi->hoten ?? ''),
                                'ngaykham' => $lichKham->ngaykham ?? '',
                                'buoi' => $lichKham->buoi ?? '',
                                'thoigian' => $lichKhamKhungGio->khungGio->thoigianbatdau . ' - ' . $lichKhamKhungGio->khungGio->thoigianketthuc ?? '',
                                'batdau' => $lichKhamKhungGio->khungGio->thoigianbatdau ?? '',
                                'soluongtoida' => $lichKhamKhungGio->soluongtoida ?? 0,
                                'soluongdadat' => $lichKhamKhungGio->soluongdadat ?? 0,
                                'trangthai' => $lichKhamKhungGio->trangthai,
                            ]);
                        }
                    }
                }

                // Sắp xếp theo ngày khám và thời gian bắt đầu
                $lichKhamData = $lichKhamData->sortBy([
                    ['tenkhoa', 'asc'],
                    ['ngaykham', 'asc'],
                    ['batdau', 'asc'],
                ]);

                $row = 2;
                foreach ($lichKhamData as $item) {
                    $sheet->setCellValue('A' . $row, $item['tenkhoa']);
                    $sheet->setCellValue('B' . $row, $item['tenbacsi']);
                    $sheet->setCellValue('C' . $row, $item['ngaykham']);
                    $sheet->setCellValue('D' . $row, $item['buoi']);
                    $sheet->setCellValue('E' . $row, $item['thoigian']);
                    $sheet->setCellValue('F' . $row, $item['soluongtoida']);
                    $sheet->setCellValue('G' . $row, $item['soluongdadat']);

                    $trangthaiText = match ($item['trangthai']) {
                        0 => 'Đã đầy',
                        1 => 'Đang nhận',
                        2 => 'Không thể đặt',
                        default => 'Không xác định',
                    };
                    $sheet->setCellValue('H' . $row, $trangthaiText);

                    $row++;
                }

                // Gộp ô cùng chuyên khoa
                $this->mergeSameValueCells($sheet, 'A', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'B', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'C', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'D', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'F', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'G', 2, $row - 1); // Gộp cột trạng thái nếu trùng
                $this->mergeSameValueCells($sheet, 'H', 2, $row - 1);

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
                $sheet->getColumnDimension('H')->setAutoSize(true);
                $sheet->getColumnDimension('I')->setAutoSize(true);

                $sheetIndex++;
            }

            $spreadsheet->setActiveSheetIndex(0);
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'lich_kham_bac_si.xlsx';

        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /* Hàm tự động gộp các ô cùng giá trị trong cột */
    private function mergeSameValueCells($sheet, $column, $startRow, $endRow)
    {
        $mergeStart = $startRow;
        $previousValue = $sheet->getCell($column . $startRow)->getValue();

        for ($row = $startRow + 1; $row <= $endRow + 1; $row++) {
            $currentValue = $sheet->getCell($column . $row)->getValue();
            if ($currentValue !== $previousValue || $row == $endRow + 1) {
                if ($mergeStart < $row - 1) {
                    $sheet->mergeCells("{$column}{$mergeStart}:{$column}" . ($row - 1));
                    $sheet->getStyle("{$column}{$mergeStart}")->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
                }
                $mergeStart = $row;
                $previousValue = $currentValue;
            }
        }
    }

    private function makeSheetTitleSafe($title)
    {
        // 1. Loại bỏ ký tự không hợp lệ
        $title = str_replace(['\\', '/', '*', '[', ']', ':', '?'], '', $title);
        // Cắt bỏ chữ "Bệnh viện" trong tên cơ sở
        $title = str_replace('Bệnh viện', '', $title);
        // 2. Rút gọn xuống tối đa 30 ký tự (Excel cho tối đa 31)
        $title = mb_substr($title, 0, 31);

        return $title;
    }
}
