<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KhungGio extends Model
{
    use HasFactory;
    protected $table = 'khunggio';
    protected $fillable = ['buoi','thoigianbatdau', 'thoigianketthuc'];

    public function lichKhams() {
        return $this->belongsToMany(LichKham::class, 'lichkham_khunggio')
            ->withPivot('soluongtoida', 'soluongdadat', 'trangthai')
            ->withTimestamps();
    }
}
