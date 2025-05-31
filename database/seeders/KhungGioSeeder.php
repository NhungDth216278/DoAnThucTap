<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KhungGioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khungGios = [
            ['buoi' => 'sáng', 'thoigianbatdau' => '07:00', 'thoigianketthuc' => '08:00'],
            ['buoi' => 'sáng', 'thoigianbatdau' => '08:00', 'thoigianketthuc' => '09:00'],
            ['buoi' => 'sáng', 'thoigianbatdau' => '09:00', 'thoigianketthuc' => '10:00'],
            ['buoi' => 'sáng', 'thoigianbatdau' => '10:00', 'thoigianketthuc' => '11:00'],
            ['buoi' => 'chiều', 'thoigianbatdau' => '13:30', 'thoigianketthuc' => '14:30'],
            ['buoi' => 'chiều', 'thoigianbatdau' => '14:30', 'thoigianketthuc' => '15:30'],
            ['buoi' => 'chiều', 'thoigianbatdau' => '15:30', 'thoigianketthuc' => '16:00'],
        ];

        foreach ($khungGios as $khunggio) {
            DB::table('khunggio')->insert([
                'buoi' => $khunggio['buoi'],
                'thoigianbatdau' => $khunggio['thoigianbatdau'],
                'thoigianketthuc' => $khunggio['thoigianketthuc'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
