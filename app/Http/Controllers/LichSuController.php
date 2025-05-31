<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LichSu;
use Carbon\Carbon;

class LichSuController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Lịch sử tác vụ';
        $query = LichSu::query()->orderBy('thoigian', 'desc');

        // Tìm theo keyword (trong NoiDung) trước
        if ($request->filled('keyword')) {
            $keyword = $request->keyword;
            $query->where('noidung', 'like', '%' . $keyword . '%');
        }

        // Lọc theo ngày (nếu có)
        if ($request->filled('date')) {
            $selectedDate = Carbon::parse($request->date);

            if ($request->filled('month')) {
                $selectedMonth = Carbon::parse($request->month);
                if ($selectedDate->month != $selectedMonth->month || $selectedDate->year != $selectedMonth->year) {
                    return redirect()->back()->with('error', 'Ngày được chọn không nằm trong tháng đã chọn!');
                }
            }

            $query->whereDate('thoigian', $selectedDate);
        }

        // Lọc theo tháng (nếu có)
        if ($request->filled('month')) {
            $query->whereMonth('thoigian', Carbon::parse($request->month)->month)
                ->whereYear('thoigian', Carbon::parse($request->month)->year);
        }

        $lstLS = $query->paginate(20)->appends($request->query());

        return view('admin.lichsu.index', compact('title', 'lstLS'));
    }
}
