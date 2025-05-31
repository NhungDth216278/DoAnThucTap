<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChuyenKhoa extends Model
{
    //use HasFactory;
    protected $table = 'chuyenkhoa';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_coso',
        'tenkhoa',
        'giakham',
        'mota',
    ];

    // Một cơ sở có nhiều chuyên khoa
    public function CoSo()
    {
        return $this->belongsTo(CoSo::class, 'id_coso', 'id');
    }

    // Một cơ sở có nhiều bác sĩ
    public function BacSi()
    {
        return $this->hasMany(BacSi::class,'id_chuyenkhoa', 'id');
    }
}
