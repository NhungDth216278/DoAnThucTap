<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichKhamKhungGio extends Model
{
    use HasFactory;
    protected $table = 'lichkham_khunggio';
    protected $fillable = ['id_lichkham', 'id_khunggio', 'soluongtoida', 'soluongdadat', 'trangthai'];
    public function LichKham()
    {
        return $this->belongsTo(LichKham::class, 'id_lichkham');
    }

    public function khungGio()
    {
        return $this->belongsTo(KhungGio::class, 'id_khunggio');
    }
}
