<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BacSi extends Model
{
    use HasFactory;
    protected $table = 'bacsi';
    protected $fillable = [
        'hoten',
        'gioitinh',
        'diachi',
        'id_coso',
        'id_chuyenkhoa',
        'hocham',
        'trangthai',
        'hinhanh',
    ];

    // Quan hệ với bảng Cơ sở
    public function CoSo()
    {
        return $this->belongsTo(CoSo::class, 'id_coso');
    }

    // Quan hệ với bảng Chuyên khoa
    public function ChuyenKhoa()
    {
        return $this->belongsTo(ChuyenKhoa::class, 'id_chuyenkhoa');
    }

    // BacSi.php (Model Bác sĩ)
    public function LichKham()
    {
        return $this->hasMany(LichKham::class, 'id_bacsi');
    }
    // BacSi.php (Model Bác sĩ)
    public function LichHen()
    {
        return $this->hasMany(LichHen::class, 'id_bacsi');
    }
}
