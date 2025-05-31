<?php

namespace App\Http\Controllers;

use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LichHen;
use App\Models\BenhNhan;
use App\Models\NhanVien;
use App\Models\BacSi;
use App\Models\ChuyenKhoa;
use App\Models\CoSo;
use App\Models\LichKhamKhungGio;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Log;

class LichHenController extends Controller
{
    public function index(Request $request)
    {
        // Lấy danh sách bác sĩ, cơ sở, chuyên khoa để lọc
        $bacSiList = BacSi::all();
        $coSoList = CoSo::all();
        $chuyenKhoaList = ChuyenKhoa::all();

        $user = Auth::user();

        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $query = LichHen::whereHas('bacsi', function ($q) use ($nhanvien) {
                    $q->where('id_coso', $nhanvien->id_coso);
                })->with([
                    'bacsi',
                    'bacsi.coso',
                    'bacsi.chuyenkhoa',
                    'benhnhan',
                    'benhnhan.user' // Thêm dòng này để eager load user liên kết với benhnhan
                ])->orderBy('ngayhen', 'desc');

                // Xử lý tìm kiếm
                if ($request->filled('search')) {
                    $search = $request->search;
                    $query->whereHas('benhNhan', function ($q) use ($search) {
                        $q->where('hoten', 'like', "%$search%");
                    })->orWhereHas('bacSi.coSo', function ($q) use ($search) {
                        $q->where('tencoso', 'like', "%$search%");
                    })->orWhereHas('bacSi.chuyenKhoa', function ($q) use ($search) {
                        $q->where('tenkhoa', 'like', "%$search%");
                    });
                }

                // Xử lý lọc theo trạng thái, ngày hẹn, buổi, bác sĩ, cơ sở, chuyên khoa
                if ($request->filled('trangthai')) {
                    $query->where('trangthai', $request->trangthai);
                }
                // Lọc theo khoảng ngày
                if ($request->filled('from_date') && $request->filled('to_date')) {
                    $query->whereBetween('ngayhen', [$request->from_date, $request->to_date]);
                }

                // Chỉ lọc theo 1 ngày
                if ($request->filled('from_date') && !$request->filled('to_date')) {
                    $query->whereDate('ngayhen', $request->from_date);
                }

                if ($request->filled('buoi')) {
                    $query->where('buoi', $request->buoi);
                }
                if ($request->filled('id_bacsi')) {
                    $query->where('id_bacsi', $request->id_bacsi);
                }

                // Lấy dữ liệu phân trang
                $lichHenList = $query->paginate(10);
                $cs_nv = Coso::find($nhanvien->id_coso);
                $title = 'Trang quản trị của ' . $cs_nv->tencoso . ' - EbookCare';
                return view('admin.lichhen.index', compact('title', 'lichHenList', 'bacSiList', 'cs_nv'));
            }
        }

        // Lấy danh sách lịch hẹn với thông tin liên quan
        $query = LichHen::with(['benhNhan', 'bacSi.chuyenKhoa', 'bacSi.coSo', 'benhnhan.user'])
            ->orderBy('ngayhen', 'desc');

        // Xử lý tìm kiếm
        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('benhNhan', function ($q) use ($search) {
                $q->where('hoten', 'like', "%$search%");
            })->orWhereHas('bacSi.coSo', function ($q) use ($search) {
                $q->where('tencoso', 'like', "%$search%");
            })->orWhereHas('bacSi.chuyenKhoa', function ($q) use ($search) {
                $q->where('tenkhoa', 'like', "%$search%");
            });
        }

        // Xử lý lọc theo trạng thái, ngày hẹn, buổi, bác sĩ, cơ sở, chuyên khoa
        if ($request->filled('trangthai')) {
            $query->where('trangthai', $request->trangthai);
        }

        // Lọc theo khoảng ngày
        if ($request->filled('from_date') && $request->filled('to_date')) {
            $query->whereBetween('ngayhen', [$request->from_date, $request->to_date]);
        }

        // Chỉ lọc theo 1 ngày
        if ($request->filled('from_date') && !$request->filled('to_date')) {
            $query->whereDate('ngayhen', $request->from_date);
        }

        if ($request->filled('buoi')) {
            $query->where('buoi', $request->buoi);
        }
        if ($request->filled('id_bacsi')) {
            $query->where('id_bacsi', $request->id_bacsi);
        }

        $lichHenList = $query->paginate(10);

        $title = 'Quản lý lịch hẹn';
        return view('admin.lichhen.index', compact('title', 'lichHenList', 'bacSiList'));
    }

    public function updateStatus(Request $request)
    {

        $lichHen = LichHen::find($request->id);

        if (!$lichHen) {
            Log::warning('Lịch hẹn không tồn tại', ['id' => $request->id]);
            return response()->json(['success' => false, 'message' => 'Lịch hẹn không tồn tại!']);
        }

        // Cập nhật trạng thái
        $lichHen->trangthai = $request->trangthai;
        $lichHen->save();

        $idLichKhamKhungGio = $lichHen->getAttribute('id_lichkhamkhunggio');

        // Nếu trạng thái là 0, giảm soluongdadat trong bảng lichkham_khunggio
        if ($request->trangthai == 0) {
            $lichKhamKhungGio = LichKhamKhungGio::where('id', $idLichKhamKhungGio)->first();
            if ($lichKhamKhungGio && $lichKhamKhungGio->soluongdadat > 0) {

                $lichKhamKhungGio->decrement('soluongdadat');
            }
        }
        $trangThaiMap = [
            0 => 'Đã hủy',
            1 => 'Đặt lịch thành công',
            2 => 'Đã khám',
        ];

        $trangThaiText = $trangThaiMap[$lichHen->trangthai] ?? 'Không xác định';

        $listLichHen = LichHen::with(['bacsi.chuyenkhoa', 'bacsi.coso', 'benhnhan.user'])->find($lichHen->id);

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật trạng thái "'
            . $trangThaiText . '" cho Lịch Hẹn của bệnh nhân "'  . $listLichHen->benhnhan->hoten . 'thuộc tài khoản '
            . $listLichHen->benhnhan->user->name . '(' . $listLichHen->benhnhan->user->email . ') đặt khám với bác sĩ '
            . $listLichHen->bacsi->hocham . '.' . $listLichHen->bacsi->hoten . '(' . $listLichHen->bacsi->chuyenkhoa->tenkhoa . ' - '
            . $listLichHen->bacsi->coso->tencoso . ')" vào CSDL';
        $ls->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }


    public function delete($id)
    {
        $lichHen = LichHen::findOrFail($id);
        $listLichHen = LichHen::with(['bacsi.chuyenkhoa', 'bacsi.coso', 'benhnhan.user'])->find($lichHen->id);
        if ($lichHen->trangthai == 0) {
            $lichHen->delete();

            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Lịch Hẹn của bệnh nhân '  . $listLichHen->benhnhan->hoten . 'thuộc tài khoản '
                . $listLichHen->benhnhan->user->name . '(' . $listLichHen->benhnhan->user->email . ') đặt khám với bác sĩ '
                . $listLichHen->bacsi->hocham . '.' . $listLichHen->bacsi->hoten . '(' . $listLichHen->bacsi->chuyenkhoa->tenkhoa . ' - '
                . $listLichHen->bacsi->coso->tencoso . ')" khỏi CSDL';

            return redirect()->route('lichhen.index')->with('success', 'Xóa dữ liệu thành công!');
        }
        return redirect()->route('lichhen.index')->with('error', 'Có lỗi xảy ra khi xóa lich hẹn.');
    }

    public function showbenhnhan($id)
    {
        $benhNhan = BenhNhan::find($id);
        $user = $benhNhan->user;
        if (!$benhNhan) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy bệnh nhân']);
        }

        return response()->json([
            'success' => true,
            'benhnhan' => $benhNhan,
            'user' => $user,
        ]);
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
                $sheet->setCellValue('C1', 'Họ tên bệnh nhân');
                $sheet->setCellValue('D1', 'Ngày hẹn');
                $sheet->setCellValue('E1', 'Buổi');
                $sheet->setCellValue('F1', 'Khung giờ');
                $sheet->setCellValue('G1', 'Trạng thái');

                $row = 2;
                // Lấy danh sách bác sĩ thuộc cơ sở
                $bacSiList = BacSi::where('id_coso', $nhanvien->id_coso)
                    ->with(['chuyenKhoa', 'lichHen.benhnhan'])
                    ->get();
                // Gom tất cả lịch hẹn của cơ sở thành một mảng phẳng
                $lichHenList = collect();
                foreach ($bacSiList as $bacSi) {
                    foreach ($bacSi->lichHen as $lichHen) {
                        $lichHenList->push([
                            'tenkhoa' => $bacSi->chuyenKhoa->tenkhoa ?? '',
                            'tenbacsi' => ($bacSi->hocham ?? '') . ' ' . ($bacSi->hoten ?? ''),
                            'tenbenhnhan' => $lichHen->benhnhan->hoten ?? '',
                            'ngayhen' => $lichHen->ngayhen ?? '',
                            'buoi' => $lichHen->buoi ?? '',
                            'thoigian' => $lichHen->thoigian ?? '',
                            'trangthai' => $lichHen->trangthai ?? 0,
                        ]);
                    }
                }

                // Sắp xếp theo: tenkhoa -> ngayhen -> thoigian
                $lichHenList = $lichHenList->sortBy([
                    ['tenkhoa', 'asc'],
                    ['ngayhen', 'asc'],
                    ['thoigian', 'asc'],
                ]);

                // Ghi dữ liệu ra sheet
                foreach ($lichHenList as $item) {
                    $sheet->setCellValue('A' . $row, $item['tenkhoa']);
                    $sheet->setCellValue('B' . $row, $item['tenbacsi']);
                    $sheet->setCellValue('C' . $row, $item['tenbenhnhan']);
                    $sheet->setCellValue('D' . $row, $item['ngayhen']);
                    $sheet->setCellValue('E' . $row, $item['buoi']);
                    $sheet->setCellValue('F' . $row, $item['thoigian']);

                    $trangthaiText = match ($item['trangthai']) {
                        0 => 'Đã hủy',
                        1 => 'Đã đặt thành công',
                        2 => 'Đã khám',
                        default => 'Không xác định',
                    };
                    $sheet->setCellValue('G' . $row, $trangthaiText);

                    $row++;
                }


                // Gộp ô cùng chuyên khoa
                $this->mergeSameValueCells($sheet, 'A', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'B', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'C', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'D', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'F', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'G', 2, $row - 1);

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);
            }
        } else {
            $sheetIndex = 0;

            // Lấy danh sách cơ sở cùng tất cả lịch khám liên quan
            $coSoList = CoSo::with([
                'bacSi.chuyenKhoa',
                'bacSi.lichHen.benhnhan'
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
                $sheet->setCellValue('C1', 'Họ tên bệnh nhân');
                $sheet->setCellValue('D1', 'Ngày hẹn');
                $sheet->setCellValue('E1', 'Buổi');
                $sheet->setCellValue('F1', 'Khung giờ');
                $sheet->setCellValue('G1', 'Trạng thái');

                $row = 2;
                // Gom tất cả lịch hẹn của cơ sở thành một mảng phẳng
                $lichHenList = collect();
                foreach ($coSo->bacSi as $bacSi) {
                    foreach ($bacSi->lichHen as $lichHen) {
                        $lichHenList->push([
                            'tenkhoa' => $bacSi->chuyenKhoa->tenkhoa ?? '',
                            'tenbacsi' => ($bacSi->hocham ?? '') . ' ' . ($bacSi->hoten ?? ''),
                            'tenbenhnhan' => $lichHen->benhnhan->hoten ?? '',
                            'ngayhen' => $lichHen->ngayhen ?? '',
                            'buoi' => $lichHen->buoi ?? '',
                            'thoigian' => $lichHen->thoigian ?? '',
                            'trangthai' => $lichHen->trangthai ?? 0,
                        ]);
                    }
                }

                // Sắp xếp theo: tenkhoa -> ngayhen -> thoigian
                $lichHenList = $lichHenList->sortBy([
                    ['tenkhoa', 'asc'],
                    ['ngayhen', 'asc'],
                    ['thoigian', 'asc'],
                ]);

                // Ghi dữ liệu ra sheet
                foreach ($lichHenList as $item) {
                    $sheet->setCellValue('A' . $row, $item['tenkhoa']);
                    $sheet->setCellValue('B' . $row, $item['tenbacsi']);
                    $sheet->setCellValue('C' . $row, $item['tenbenhnhan']);
                    $sheet->setCellValue('D' . $row, $item['ngayhen']);
                    $sheet->setCellValue('E' . $row, $item['buoi']);
                    $sheet->setCellValue('F' . $row, $item['thoigian']);

                    $trangthaiText = match ($item['trangthai']) {
                        0 => 'Đã hủy',
                        1 => 'Đã đặt thành công',
                        2 => 'Đã khám',
                        default => 'Không xác định',
                    };
                    $sheet->setCellValue('G' . $row, $trangthaiText);

                    $row++;
                }


                // Gộp ô cùng chuyên khoa
                $this->mergeSameValueCells($sheet, 'A', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'B', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'C', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'D', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'F', 2, $row - 1);
                $this->mergeSameValueCells($sheet, 'G', 2, $row - 1);

                $sheet->getColumnDimension('A')->setAutoSize(true);
                $sheet->getColumnDimension('B')->setAutoSize(true);
                $sheet->getColumnDimension('C')->setAutoSize(true);
                $sheet->getColumnDimension('D')->setAutoSize(true);
                $sheet->getColumnDimension('E')->setAutoSize(true);
                $sheet->getColumnDimension('F')->setAutoSize(true);
                $sheet->getColumnDimension('G')->setAutoSize(true);

                $sheetIndex++;
            }

            $spreadsheet->setActiveSheetIndex(0);
        }
        $writer = new Xlsx($spreadsheet);
        $fileName = 'lich_hen_kham_benh.xlsx';

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
