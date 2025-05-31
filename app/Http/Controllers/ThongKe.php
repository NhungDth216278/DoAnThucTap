<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\NhanVien;
use App\Models\LichSu;
use App\Models\CoSo;
use Carbon\Carbon;
use App\Models\LichHen;
use App\Models\BenhNhan;
use Illuminate\Support\Facades\DB;

class ThongKe extends Controller
{
    public function index(Request $request)
    {

        $user = Auth::user();
        // Nếu là nhân viên cơ sở
        $nhanvien = NhanVien::where('id_user', $user->id)->first();
        $title = 'Thống kê - EbookCare';

        if ($nhanvien && $nhanvien->id_coso) {
            $cosoId = $nhanvien->id_coso;
        }

        $time = Carbon::yesterday()->format('d/m/Y'); // ✅ Đổi ở đây

        $lichHenQuery = LichHen::query()
            ->whereHas('bacsi', function ($q) use ($cosoId) {
                $q->where('id_coso', $cosoId);
            });

        $lichHenQuery->whereDate('ngayhen', Carbon::yesterday());

        $total = (clone $lichHenQuery)->count();
        $cancelled = (clone $lichHenQuery)->where('trangthai', 0)->count();
        $completed = (clone $lichHenQuery)->where('trangthai', 2)->count();

        $newPatients = BenhNhan::whereDate('created_at', Carbon::yesterday())->count();
        $currentYear = now()->year;
        return view('admin.thongke.index', [
            'title' => $title,
            'khoang_tg' => $time,
            'tong_lich' => $total,
            'da_kham' => $completed,
            'da_huy' => $cancelled,
            'benhnhan_moi' => $newPatients,
            'currentYear' => $currentYear,
        ]);
    }

    public function ajaxThongKe(Request $request)
    {
        $time = $request->input('time', 'day');

        $dateValue = $request->input('date_value');
        $weekValue = $request->input('week_value');
        $monthValue = $request->input('month_value');

        $user = Auth::user();
        // Nếu là nhân viên cơ sở
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        if ($nhanvien && $nhanvien->id_coso) {
            $cosoId = $nhanvien->id_coso;
        }

        $lichHenQuery = LichHen::with('benhnhan', 'bacsi');
        // Lọc theo cơ sở nếu được chọn
        if ($cosoId && $cosoId != 'all') {
            $lichHenQuery->whereHas('bacsi', function ($q) use ($cosoId) {
                $q->where('id_coso', $cosoId);
            });
        }

        // Xác định khoảng thời gian lọc
        switch ($time) {
            case 'day':
                $date = $dateValue ? Carbon::parse($dateValue) : Carbon::yesterday();
                $lichHenQuery->whereDate('ngayhen', $date);
                $rangeText = 'Ngày ' . $date->format('d/m/Y');
                break;

            case 'week':
                if ($weekValue) {
                    [$year, $week] = explode('-W', $weekValue);
                    $startOfWeek = Carbon::now()->setISODate($year, $week)->startOfWeek();
                    $endOfWeek = Carbon::now()->setISODate($year, $week)->endOfWeek();
                } else {
                    $startOfWeek = Carbon::now()->startOfWeek();
                    $endOfWeek = Carbon::now()->endOfWeek();
                }
                $lichHenQuery->whereBetween('ngayhen', [$startOfWeek, $endOfWeek]);
                $rangeText = 'Tuần ' . $startOfWeek->format('d/m') . ' - ' . $endOfWeek->format('d/m');
                break;

            case 'month':
                if ($monthValue) {
                    [$year, $month] = explode('-', $monthValue);
                    $startOfMonth = Carbon::createFromDate($year, $month, 1)->startOfMonth();
                    $endOfMonth = Carbon::createFromDate($year, $month, 1)->endOfMonth();
                } else {
                    $startOfMonth = Carbon::now()->startOfMonth();
                    $endOfMonth = Carbon::now()->endOfMonth();
                }
                $lichHenQuery->whereBetween('ngayhen', [$startOfMonth, $endOfMonth]);
                $rangeText = 'Tháng ' . $startOfMonth->format('m/Y');
                break;

            default:
                $date = Carbon::yesterday();
                $lichHenQuery->whereDate('ngayhen', $date);
                $rangeText = 'Ngày ' . $date->format('d/m/Y');
                break;
        }

        $lichHenList = (clone $lichHenQuery)->paginate(8); // 10 dòng mỗi trang


        // Thống kê
        $total = (clone $lichHenQuery)->count();
        $cancelled = (clone $lichHenQuery)->where('trangthai', 0)->count();
        $completed = (clone $lichHenQuery)->where('trangthai', 2)->count();

        // Ensure variables are defined in the parent scope
        $date = $date ?? null;
        $startOfWeek = $startOfWeek ?? null;
        $endOfWeek = $endOfWeek ?? null;
        $startOfMonth = $startOfMonth ?? null;
        $endOfMonth = $endOfMonth ?? null;


        $newPatients = BenhNhan::when($cosoId && $cosoId != 'all', function ($query) use ($cosoId) {
            $query->whereHas('lichhen.bacsi', function ($q) use ($cosoId) {
                $q->where('id_coso', $cosoId);
            });
        })->where(function ($query) use ($time, $date, $startOfWeek, $endOfWeek, $startOfMonth, $endOfMonth) {
            switch ($time) {
                case 'day':
                    $query->whereDate('created_at', $date);
                    break;
                case 'week':
                    $query->whereBetween('created_at', [$startOfWeek, $endOfWeek]);
                    break;
                case 'month':
                    $query->whereBetween('created_at', [$startOfMonth, $endOfMonth]);
                    break;
                default:
                    $query->whereDate('created_at', now()->subDay());
                    break;
            }
        })->distinct()->count('id');

        return response()->json([
            'total' => $total,
            'completed' => $completed,
            'cancelled' => $cancelled,
            'new_patients' => $newPatients,
            'range_text' => $rangeText,
            'lichHenList' => $lichHenList->items(),
            'pagination' => [
                'current_page' => $lichHenList->currentPage(),
                'last_page' => $lichHenList->lastPage(),
                'per_page' => $lichHenList->perPage(),
                'total' => $lichHenList->total(),
                'next_page_url' => $lichHenList->nextPageUrl(),
                'prev_page_url' => $lichHenList->previousPageUrl(),
            ]

        ]);
    }

    public function getChartData(Request $request)
    {
        $user = Auth::user();
        // Nếu là nhân viên cơ sở
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        if ($nhanvien && $nhanvien->id_coso) {
            $cosoId = $nhanvien->id_coso;
        }
        $year = $request->year ?? now()->year;
        $months = [];  // Các biểu đồ (đường và cột)
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Nếu là năm hiện tại -> chỉ lấy đến tháng hiện tại
        if ($year == $currentYear) {
            for ($i = 1; $i <= $currentMonth; $i++) {
                $months[] = now()->setMonth($i)->format('M');
            }
        } else {
            // Nếu là năm quá khứ -> lấy đủ 12 tháng
            for ($i = 1; $i <= 12; $i++) {
                $months[] = now()->setMonth($i)->format('M');
            }
        }
        $placed = [];
        $cancelled = [];
        $completed = [];
        $newPatients = [];

        foreach ($months as $index => $month) {
            $monthNumber = $index + 1;
            $startDate = Carbon::create($year, $monthNumber, 1)->startOfMonth();
            $endDate = Carbon::create($year, $monthNumber, 1)->endOfMonth();

            $placedCount = DB::table('lichhen')
                ->join('bacsi', 'lichhen.id_bacsi', '=', 'bacsi.id')
                ->whereBetween('ngayhen', [$startDate, $endDate])
                ->when($cosoId != 'all', function ($query) use ($cosoId) {
                    $query->where('bacsi.id_coso', $cosoId);
                })
                ->count();

            $cancelledCount = DB::table('lichhen')
                ->join('bacsi', 'lichhen.id_bacsi', '=', 'bacsi.id')
                ->whereBetween('ngayhen', [$startDate, $endDate])
                ->when($cosoId != 'all', function ($query) use ($cosoId) {
                    $query->where('bacsi.id_coso', $cosoId);
                })
                ->where('lichhen.trangthai', 0)
                ->count();


            $completedCount = DB::table('lichhen')
                ->join('bacsi', 'lichhen.id_bacsi', '=', 'bacsi.id')
                ->whereBetween('ngayhen', [$startDate, $endDate])
                ->when($cosoId != 'all', function ($query) use ($cosoId) {
                    $query->where('bacsi.id_coso', $cosoId);
                })
                ->where('lichhen.trangthai', 2)
                ->count();

            // Bệnh nhân mới trong tháng
            $newPatientCount = BenhNhan::when($cosoId && $cosoId != 'all', function ($query) use ($cosoId) {
                $query->whereHas('lichhen.bacsi', function ($q) use ($cosoId) {
                    $q->where('id_coso', $cosoId);
                });
            })->whereBetween('created_at', [$startDate, $endDate])
                ->count();
            $placed[] = $placedCount;
            $cancelled[] = $cancelledCount;
            $completed[] = $completedCount;
            $newPatients[] = $newPatientCount;
        }

        return response()->json([
            'months' => $months,
            'placed' => $placed,
            'cancelled' => $cancelled,
            'completed' => $completed,
            'new_patients' => $newPatients
        ]);
    }

    public function getDoanhThuTheoThang(Request $request)
    {
        $year = $request->year ?? now()->year;
        $user = Auth::user();
        // Nếu là nhân viên cơ sở
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        if ($nhanvien && $nhanvien->id_coso) {
            $cosoId = $nhanvien->id_coso;
        }

        $query = DB::table('lichhen')
            ->join('bacsi', 'lichhen.id_bacsi', '=', 'bacsi.id')
            ->where('lichhen.trangthai', 2)
            ->whereYear('lichhen.ngayhen', $year)
            ->select(DB::raw('MONTH(lichhen.ngayhen) as month'), DB::raw('SUM(lichhen.giakham) as total'));

        if ($cosoId && $cosoId !== 'all') {
            $query->where('bacsi.id_coso', $cosoId);
        }

        $doanhThuTheoThang = $query->groupBy(DB::raw('MONTH(lichhen.ngayhen)'))->pluck('total', 'month');

        $doanhThuData = [];
        $currentYear = now()->year;
        $currentMonth = now()->month;

        // Nếu là năm hiện tại -> chỉ lấy đến tháng hiện tại
        if ($year == $currentYear) {
            for ($i = 1; $i <= $currentMonth; $i++) {
                $labels[] = now()->setMonth($i)->format('M');
                $doanhThuData[] = $doanhThuTheoThang[$i] ?? 0;
            }
        } else {
            // Nếu là năm quá khứ -> lấy đủ 12 tháng
            for ($i = 1; $i <= 12; $i++) {
                $labels[] = now()->setMonth($i)->format('M');
                $doanhThuData[] = $doanhThuTheoThang[$i] ?? 0;
            }
        }
        return response()->json([
            'labels' => $labels,
            'data' => $doanhThuData
        ]);
    }
}
