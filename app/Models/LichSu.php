<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LichSu extends Model
{
    use HasFactory;

    protected $table = 'lichsu';

    public $timestamps = false;

    protected $fillable = [
        'noidung',
        'thoigian',
    ];
}

