<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BenhNhan extends Model
{
    use HasFactory;

    protected $table = 'benhnhan';

    protected $fillable = ['id_user', 'hoten', 'sodienthoai', 'diachi', 'ngaysinh', 'cccd', 'gioitinh',];

    public function lichhen()
    {
        return $this->hasMany(LichHen::class, 'id_benhnhan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
}
