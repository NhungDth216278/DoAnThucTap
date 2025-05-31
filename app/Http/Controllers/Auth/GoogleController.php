<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\BenhNhan;
use App\Models\LichSu;
use App\Models\User;
use App\Models\NhanVien;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback(Request $request)
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            // Nếu chưa có user thì tạo mới
            if (!$user) {
                $user = User::create([
                    'name' =>  $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    // Lấy mật khẩu mặc định là 123456
                    'password' =>  Hash::make('123456'),

                    // Loại Khách hàng
                    'role' => 'user',
                    'status' => 1,
                    // Xác thực tự động
                    'email_verified_at' => Carbon::now(),
                ]);
            }

            Auth::login($user, true);

            // Kiểm tra tài khoản có bị khóa hay không
            if ($user->status == 0) {
                Auth::logout(); // Đăng xuất user
                $request->session()->invalidate(); // Hủy session hiện tại
                $request->session()->regenerateToken(); // Tạo CSRF token mới

                return redirect(route($user->role != 'user' ? 'admin.login' : 'home.login'))
                    ->with('error', 'Tài khoản của bạn đã bị khóa! Xin vui lòng liên hệ Quản lý nếu có sai sót!');
            }
            // Ghi nhận lịch sử
            $ls = new LichSu();
            $ls->noidung = 'Người dùng có tên tài khoản ' . $user->name . ' (' . $user->email . ') đã đăng nhập vào hệ thống!';
            $ls->save();

            // Điều hướng theo Loại người dùng
            return redirect()->route($user->role === 'user' ? 'home.index' : 'admin.index');
        } catch (\Exception $e) {
            return redirect()->route('home.login')->with('error', 'Đăng nhập Google thất bại!');
        }
    }
}
