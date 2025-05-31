<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(KhungGioSeeder::class);
        // User::factory()->create([
        // 'name' => 'Test User',
        // 'email' => 'test@example.com',
        //]);

        $users = [
            [
                'email' => 'admin@example.com',
                'name' => 'Admin',
                'password' => 'Admin123@',
                'role' => 'admin',
                'nhanvien' => [
                    'hoten' => 'Nguyễn Văn Admin',
                    'sodienthoai' => '0987654321',
                    'diachi' => '123 Đường ABC, TP.HCM',
                    'gioitinh' => 'Nam',
                ],
            ],
            [
                'email' => 'quanly@example.com',
                'name' => 'QuanLy',
                'password' => 'Admin123@',
                'role' => 'manage',
                'nhanvien' => [
                    'hoten' => 'Nguyễn Văn A',
                    'sodienthoai' => '0987654345',
                    'diachi' => '123 Đường ABC, TP.HCM',
                    'gioitinh' => 'Nam',
                ],
            ],
            [
                'email' => 'dangtin@example.com',
                'name' => 'NguoiDangTin',
                'password' => 'Admin123@',
                'role' => 'news',
                'nhanvien' => [
                    'hoten' => 'Nguyễn Thị A',
                    'sodienthoai' => '0987654538',
                    'diachi' => '123 Đường ABC, TP.HCM',
                    'gioitinh' => 'Nữ',
                ],
            ],
        ];

        foreach ($users as $user) {
            $existingUser = DB::table('users')->where('email', $user['email'])->first();

            if (!$existingUser) {
                $userId = DB::table('users')->insertGetId([
                    'email' => $user['email'],
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                DB::table('nhanvien')->insert([
                    'id_user' => $userId,
                    'hoten' => $user['nhanvien']['hoten'],
                    'sodienthoai' => $user['nhanvien']['sodienthoai'],
                    'diachi' => $user['nhanvien']['diachi'],
                    'gioitinh' => $user['nhanvien']['gioitinh'],
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        // Thêm user vào bảng `users`
        $user = User::create([
            'name' => 'KhachHang',
            'email' => 'tranvanb@example.com',
            'password' => Hash::make('DatVo@03'),
        ]);
    }
}
