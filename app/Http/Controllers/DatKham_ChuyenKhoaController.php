<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LichKham;
use App\Models\BenhNhan;
use App\Models\ChuyenKhoa;
use App\Models\KhungGio;
use App\Models\CoSo;
use App\Models\BacSi;
use App\Models\LichHen;
use App\Models\LichKhamKhungGio;

class DatKham_ChuyenKhoaController extends Controller
{
    // Hiển thị danh sách lịch khám theo chuyên khoa
    public function index()
    {
        $title = 'Đặt khám theo chuyên khoa - EbookCare';
        $chuyenkhoas= ChuyenKhoa::all();
        return view('trangchu.datkham_chuyenkhoa.index', compact('title', 'chuyenkhoas'));
    }

    public function chonBacSi($coSoId, $chuyenKhoaId)
    {
        $title = 'Chọn bác sĩ - EbookCare';
        $coSo = CoSo::findOrFail($coSoId);
        $chuyenKhoa = ChuyenKhoa::findOrFail($chuyenKhoaId);
        $bacSis = BacSi::where('id_chuyenkhoa', $chuyenKhoaId)->where('id_coso', $coSoId)->get();
        return view('trangchu.datkham_chuyenkhoa.chon_bac_si', compact('title', 'coSo', 'chuyenKhoa', 'bacSis'));
    }

}
