<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhanVien extends Model
{
    use HasFactory;

    protected $table = 'nhanvien'; // Tên bảng trong database

    protected $fillable = [
        'id_user',
        'id_coso',
        'hoten',
        'sodienthoai',
        'diachi',
        'gioitinh',
    ];

    /**
     * Mối quan hệ 1-1 với bảng Users
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tintucs()
    {
        return $this->hasMany(TinTuc::class, 'id_nhanvien');
    }

    public function coso()
    {
        return $this->belongsTo(Coso::class, 'id_coso');
    }
}
