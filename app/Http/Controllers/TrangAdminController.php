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
use App\Models\BacSi;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TrangAdminController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Trang quản trị - EbookCare';

        $user = Auth::user();
        if ($user->role === 'hospital') {

            $nhanvien = NhanVien::where('id_user', $user->id)->first();
            if ($nhanvien && $nhanvien->id_coso) {
                $cs = CoSo::find($nhanvien->id_coso);
                $title = 'Trang quản trị của ' . $cs->tencoso . ' - EbookCare';
                return view('admin.index', compact('cs', 'title', 'user'));
            }
        }
        if ($user->role === 'news') {

            return redirect(route('dstintuc.index'))->with('success', 'Đăng nhập thành công!');
        }

        if ($user->role === 'manage') {
            $title = 'Thống kê - EbookCare';
            $dsCoSo = CoSo::all();

            // Mặc định: thống kê ngày hôm trước
            $cosoId = null;
            $time = Carbon::yesterday()->format('d/m/Y'); // ✅ Đổi ở đây

            $lichHenQuery = LichHen::query()
                ->whereHas('bacsi', function ($q) use ($cosoId) {
                    // Không lọc cơ sở nếu null
                });

            $lichHenQuery->whereDate('ngayhen', Carbon::yesterday());

            $total = (clone $lichHenQuery)->count();
            $cancelled = (clone $lichHenQuery)->where('trangthai', 0)->count();
            $completed = (clone $lichHenQuery)->where('trangthai', 2)->count();

            $newPatients = BenhNhan::whereDate('created_at', Carbon::yesterday())->count();

            $currentYear = now()->year;
            return view('admin.index', [
                'title' => $title,
                'khoang_tg' => $time,
                'tong_lich' => $total,
                'da_kham' => $completed,
                'da_huy' => $cancelled,
                'benhnhan_moi' => $newPatients,
                'dsCoSo' => $dsCoSo,
                'currentYear' => $currentYear,
            ]);
        }

        return redirect(route('lichsu.index'))->with('success', 'Đăng nhập thành công!');
    }

    public function ajaxThongKe(Request $request)
    {
        $time = $request->input('time', 'day');
        $cosoId = $request->input('coso_id');
        $dateValue = $request->input('date_value');
        $weekValue = $request->input('week_value');
        $monthValue = $request->input('month_value');

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
        $cosoId = $request->coso_id;
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
        $cosoId = $request->input('coso_id');
        $year = $request->year ?? now()->year;

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

    public function showbacsi($id)
    {
        $bacsi = BacSi::with('coso', 'chuyenkhoa')->find($id);

        if (!$bacsi) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy bác sĩ']);
        }

        return response()->json([
            'success' => true,
            'bacsi' => $bacsi,
        ]);
    }

    public function privacy()
    {
        $title = 'Quyền riêng tư';

        return view('admin.privacy', ['title' => $title]);
    }

    public function support()
    {
        $title = 'Hỗ trợ người dùng';

        return view('admin.support', ['title' => $title]);
    }

    public function helpcenter()
    {
        $title = 'Trung tâm trợ giúp';

        return view('admin.helpcenter', ['title' => $title]);
    }
    public function terms()
    {
        $title = 'Điều khoản';

        return view('admin.terms', ['title' => $title]);
    }
    public function profile()
    {
        $title = 'Hồ sơ cá nhân - EbookCare';
        // Lấy thông tin user đang đăng nhập
        $user = Auth::user();

        // Lấy thông tin nhân viên tương ứng
        $nhanvien = NhanVien::where('id_user', $user->id)->first();

        return view('admin.profile', compact('title', 'user', 'nhanvien'));
    }
    public function updateProfile(Request $request)
    {
        $user = Auth::user();
        $nhanvien = $user->nhanvien; // Giả sử đã có quan hệ 1-1: User -> NhanVien

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'hoten' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'diachi' => 'required|string',
            'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Cập nhật thông tin user
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Cập nhật thông tin nhân viên
        $nhanvien->hoten = $request->hoten;
        $nhanvien->gioitinh = $request->gioitinh;
        $nhanvien->diachi = $request->diachi;
        $nhanvien->sodienthoai = $request->sodienthoai;

        // Xử lý avatar
        if ($request->hasFile('avatar')) {
            //  Xóa ảnh cũ nếu có và không phải ảnh mặc định
            if (!empty($nhanvien->avatar) && file_exists(public_path($nhanvien->avatar))) {
                unlink(public_path($nhanvien->avatar));
            }


            //  Lưu ảnh mới
            $file = $request->file('avatar');
            $path = 'upload/avatars/nhanvien';
            $extension = $file->getClientOriginalExtension();
            $filename = 'nv_' . time() . '.' . $extension;
            $file->move(public_path($path), $filename);
            $nhanvien->avatar = $path . $filename;
        } elseif ($request->has('XoaAnh')) {
            //  Nếu chọn dùng ảnh mặc định → xóa ảnh cũ nếu tồn tại
            if (!empty($nhanvien->avatar) && file_exists(public_path($nhanvien->avatar))) {
                unlink(public_path($nhanvien->avatar));
            }
            $nhanvien->avatar = null;
        }

        $nhanvien->save();

        // Làm mới thông tin user
        Auth::user()->refresh();

        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Người dùng có tên tài khoản' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin cá nhân!';
        $ls->save();

        return redirect(route('admin.profile'))->with('success', 'Thông tin cá nhân của bạn đã được cập nhật!');
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
                'confirmed',
            ],
        ], [
            'current_password.required' => 'Vui lòng nhập mật khẩu hiện tại!',
            'new_password.required' => 'Vui lòng nhập mật khẩu mới!',
            'new_password.min' => 'Mật khẩu phải có ít nhất 5 ký tự!',
            'new_password.max' => 'Mật khẩu không được vượt quá 25 ký tự!',
            'new_password.regex' => 'Mật khẩu phải bao gồm chữ thường, chữ hoa, chữ số và ký tự đặc biệt!',
            'new_password.confirmed' => 'Mật khẩu mới không khớp với mật khẩu xác nhận',
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
}
