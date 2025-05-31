<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BacSi;

class DatKham_BacSiController extends Controller
{
    public function index()
    {
        $title = 'Đặt khám theo bác sĩ - EbookCare';
        $bacSis = BacSi::with(['coSo', 'chuyenKhoa', 'lichKham'])->paginate(10); // Hiển thị 5 bác sĩ mỗi trang
        return view('trangchu.datkham_bacsi.index', compact('title', 'bacSis'));
    }

}
