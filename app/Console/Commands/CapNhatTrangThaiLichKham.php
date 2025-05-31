<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CapNhatTrangThaiLichKham extends Command
{
    protected $signature = 'lichkham:capnhat-trangthai';
    protected $description = 'Cập nhật trạng thái các khung giờ lịch khám đã quá ngày thành 0';

    public function handle()
    {
        $today = Carbon::today();

        DB::table('lichkham_khunggio')
            ->join('lichkham', 'lichkham_khunggio.id_lichkham', '=', 'lichkham.id')
            ->whereDate('lichkham.ngaykham', '<', $today)
            ->update([
                'lichkham_khunggio.trangthai' => 2
            ]);

        $this->info('Đã cập nhật trạng thái các khung giờ lịch khám đã quá ngày.');
    }
}
