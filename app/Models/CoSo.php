<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class CoSo extends Model
{
    use HasFactory;
    protected $table = 'coso';
    protected $fillable = [
        'tencoso', // Thêm trường này vào để cho phép mass assignment
        'diachi',
        'sodienthoai',
        'email',
        'mota',
        'noidung',
        'hinhanh'
    ];

    public function nhanviens()
    {
        return $this->hasMany(NhanVien::class, 'id_coso');
    }
    // Một cơ sở có nhiều chuyên khoa
    public function ChuyenKhoa()
    {
        return $this->hasMany(ChuyenKhoa::class, 'id_coso', 'id');
    }

    // Một cơ sở có nhiều bác sĩ
    public function BacSi()
    {
        return $this->hasMany(BacSi::class, 'id_coso', 'id');
    }

     // Định dạng ngày tháng theo 'd-m-Y H:i:s'
     public function getCreatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }

    public function getUpdatedAtAttribute($value) {
        return Carbon::parse($value)->format('d-m-Y H:i:s');
    }
}
