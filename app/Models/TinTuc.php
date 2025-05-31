<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinTuc extends Model
{
    use HasFactory;
    protected $table = 'tintuc';
    protected $fillable = ['id_nhanvien', 'tieude', 'mota', 'noidung', 'hinhanh','loai', 'trangthai'];
    public function nhanvien()
    {
        return $this->belongsTo(NhanVien::class, 'id_nhanvien');
    }
}
