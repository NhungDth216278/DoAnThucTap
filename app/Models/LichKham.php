<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichKham extends Model
{
    use HasFactory;
    protected $table = 'lichkham';
    protected $fillable = ['id_bacsi', 'ngaykham', 'buoi'];

    // LichKham.php (Model Lịch khám)
    public function BacSi()
    {
        return $this->belongsTo(BacSi::class, 'id_bacsi');
    }

    public function LichKhamKhungGio()
    {
        return $this->hasMany(LichKhamKhungGio::class, 'id_lichkham');
    }

    public function khungGios() {
        return $this->belongsToMany(KhungGio::class, 'lichkham_khunggio','id_lichkham', 'id_khunggio')
            ->withPivot('soluongtoida', 'soluongdadat', 'trangthai')
            ->withTimestamps();
    }
}
