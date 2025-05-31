<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichHen extends Model
{
    use HasFactory;

    protected $table = 'lichhen'; // Tên bảng trong database

    protected $fillable = [
        'id_benhnhan',
        'id_bacsi',
        'id_lichkhamkhunggio',
        'giakham',
        'ngayhen',
        'buoi',
        'thoigian',
        'trangthai',
    ];

    // Quan hệ với bảng BenhNhan
    public function benhNhan()
    {
        return $this->belongsTo(BenhNhan::class, 'id_benhnhan');
    }

    // Quan hệ với bảng BacSi
    public function bacSi()
    {
        return $this->belongsTo(BacSi::class, 'id_bacsi');
    }
}
