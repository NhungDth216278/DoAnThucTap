<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;;

use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Mail;
use App\Mail\GuiLinkKhoiPhucMatKhau;
use App\Mail\GuiEmailXacThuc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;

class AuthManager extends Controller
{
    //Show form đăng nhập người dùng
    public function showLogin()
    {
        $title = 'Đăng nhập - EbookCare';

        return view('trangchu.login', ['title' => $title]);
    }

    //Show form đăng ký
    public function showRegistration()
    {
        $title = 'Đăng ký - EbookCare';


        return view('trangchu.register', ['title' => $title]);
    }

    //Show form đăng nhập quản trị
    public function showLoginAdmin()
    {
        $title = 'Đăng nhập trang quản lý';

        return view('admin.login', ['title' => $title]);
    }

    // Xử lý đăng ký
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:25',
                    'regex:/^[a-zA-Z0-9]+$/', // Chỉ cho phép chữ cái và số
                ],
                'email' => 'required|email|unique:users,email',
                'password' => [
                    'nullable',
                    'string',
                    'min:5',
                    'max:25',
                    'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{5,25}$/',
                    'confirmed',
                ],
            ],
            [
                'name.required' => 'Vui lòng nhập tên tài khoản!',
                'name.min' => 'Tên tài khoản phải có ít nhất 5 ký tự!',
                'name.max' => 'Tên tài khoản không được vượt quá 25 ký tự!',
                'name.regex' => 'Tên tài khoản chỉ được chứa chữ cái và số!',

                'email.required' => 'Vui lòng nhập email!',
                'email.email' => 'Email không đúng định dạng!',
                'email.unique' => 'Email đã tồn tại trong hệ thống!',

                'password.required' => 'Vui lòng nhập mật khẩu!',
                'password.min' => 'Mật khẩu phải có ít nhất 5 ký tự!',
                'password.max' => 'Mật khẩu không được vượt quá 25 ký tự!',
                'password.regex' => 'Mật khẩu phải bao gồm chữ thường, chữ hoa, chữ số và ký tự đặc biệt!',
                'password.confirmed' => 'Mật khẩu không khớp với mật khẩu xác nhận',
            ]
        );

        if ($validator->fails()) {
            return redirect()->route('home.register')
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);

        // Lấy trang cần chuyển hướng (mặc định là trang chủ)
        $redirectTo = $request->input('redirect_to', url('/'));

        return redirect($redirectTo)->with('success', 'Đăng ký thành công!');


        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Khách hàng có email "' . $user->email . '" đã đăng ký tài khoản trên hệ thống!';
        $ls->save();

        //return redirect(route('home.login'))->with('success', 'Tài khoản của quý khách đã được tạo thành công! Quý khách có thể đăng nhập từ giờ!');
    }

    //Xử lý đăng nhập
    public function login(Request $request)
    {
        $request->validate(
            [
                'tendangnhap' => 'required',
                'password' => 'required'
            ],
            [
                'tendangnhap.required' => 'Vui lòng nhập thông tin!',
                'password.required' => 'Vui lòng nhập mật khẩu!',
            ]
        );

        $loginInput = $request->input('tendangnhap');
        $password = $request->input('password');

        $fieldType = filter_var($loginInput, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $fieldType => $loginInput,
            'password' => $password,
        ];
        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            // Lấy thông tin user vừa đăng nhập
            $user = Auth::user();

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

            if (in_array(Auth::user()->role, ['admin', 'manage', 'hospital', 'news'])) {
                return redirect()->route('admin.index')->with('success', 'Đăng nhập thành công!');
            }

            // Nếu là user bình thường, điều hướng về trang người dùng
            $redirectTo = $request->input('redirect_to', url('/'));

            return redirect($redirectTo)->with('success', 'Đăng nhập thành công!');
        }


        return back()->with('error', 'Thông tin đăng nhập chưa chính xác! Vui lòng kiểm tra lại!')->withInput();
    }

    //Đăng xuất
    public function logout(Request $request)
    {
        $user = Auth::user();
        $right = $user->role;
        // Ghi nhận lịch sử
        $ls = new LichSu();
        $ls->noidung = 'Người dùng có tên tài khoản ' . $user->name . ' (' . $user->email . ') đã đăng xuất khỏi hệ thống!';
        $ls->save();

        // Xóa remember_token
        if ($user) {
            $user->setRememberToken(null);
            $user->save();
        }
        // Thay vì route mặc định, dùng rõ ràng như sau:
        Auth::guard('web')->logout();
        Session::flush();

        $request->session()->invalidate();             // Huỷ session hiện tại
        $request->session()->regenerateToken();        // Tạo token mới

        if ($right === 'user') {
            return redirect()->route('home.login')->with('success', 'Đăng xuất thành công!');
        }

        return redirect()->route('admin.login')->with('success', 'Đăng xuất thành công!');
    }

    //Quên mật khẩu
    public function forgotPass()
    {
        $title = 'Quên mật khẩu';

        return view('forgotPass', compact('title'));
    }

    public function guiLinkReset(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return back()->withErrors(['email' => 'Email bạn vừa nhập không tồn tại']);
        }

        if (!$user->email_verified_at) {
            $expiresAt = now()->addMinute(3); // Link hiệu lực 3 phút

            // thêm một chữ ký (signature) và thời gian hết hạn (expiresAt) vào URL
            $url = URL::temporarySignedRoute(
                'email.verifyAdmin',
                $expiresAt,
                ['id' => $user->id]
            );

            if (!$this->checkEmailDomain($user->email)) {
                return back()->with('error', 'Email không hợp lệ hoặc domain không tồn tại!');
            }

            Mail::to($user->email)->send(new GuiEmailXacThuc($user, $url));
            return back()->with('success', 'Email chưa được xác thực. Một email xác thực mới đã được gửi. Vui lòng kiểm tra hộp thư đến và cả thư rác!');
        }

        $token = Str::random(60);  // Tạo token ngẫu nhiên

        DB::table('password_reset_tokens')->updateOrInsert(
            ['email' => $request->email],
            ['token' => $token, 'created_at' => Carbon::now()]
        );

        Mail::to($request->email)->send(new GuiLinkKhoiPhucMatKhau($token, $request->email));

        return back()->with('success', 'Đã gửi liên kết để khôi phục mật khẩu. Vui lòng kiểm tra hộp thư đến và cả thư rác!');
    }

    public function showResetForm(Request $request)
    {
        $email = $request->query('email');
        $token = $request->query('token');

        if (!$email || !$token) {
            abort(403, 'Liên kết không hợp lệ.');
        }

        $record = DB::table('password_reset_tokens')->where('email', $email)->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(5)->isPast()) {
            abort(403, 'Liên kết đã hết hạn hoặc không hợp lệ.');
        }

        $title = 'Khôi phục mật khẩu';
        return view('passwords_reset', ['token' => $token, 'title' => $title, 'email' => $email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);

        $record = DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        if (!$record || Carbon::parse($record->created_at)->addMinutes(5)->isPast()) {
            return back()->withErrors(['email' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->password = Hash::make($request->password);
            $user->save();
        }

        // Xoá token sau khi dùng
        DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        return redirect(route($user->role === 'user' ? 'home.login' : 'admin.login'))->with('success', 'Đặt lại mật khẩu thành công.');
    }

    //Xác thức email
    public function checkEmailDomain($email)
    {
        $domain = substr(strrchr($email, "@"), 1);

        return checkdnsrr($domain, "MX");
    }

    public function sendVerifyAdmin(Request $request)
    {
        $user = Auth::user();

        $expiresAt = now()->addMinute(3); // Link hiệu lực 3 phút

        // thêm một chữ ký (signature) và thời gian hết hạn (expiresAt) vào URL
        $url = URL::temporarySignedRoute(
            'email.verifyAdmin',
            $expiresAt,
            ['id' => $user->id]
        );

        if (!$this->checkEmailDomain($user->email)) {
            return back()->with('error', 'Email không hợp lệ hoặc domain không tồn tại!');
        }

        try {
            Mail::to($user->email)->send(new GuiEmailXacThuc($user, $url));
        } catch (\Exception $e) {
            return back()->with('error', 'Gửi email thất bại! Vui lòng đảm bảo địa chỉ email hợp lệ và thử lại sau!');
        }

        return back()->with('success', 'Chúng tôi đã gửi email xác thực, vui lòng kiểm tra hộp thư đến và cả thư rác!');
    }

    public function verifyEmailAdmin(Request $request, $id)
    {
        // kiểm tra chữ ký trong URL có hợp lệ hay không
        if (!$request->hasValidSignature()) {
            if (Auth::check()) {
                return redirect()->route('admin.index')->with('error', 'Thư xác thực quá hạn hoặc liên kết không hợp lệ!');
            } else {
                return redirect()->route('home.index')->with('error', 'Thư xác thực quá hạn hoặc liên kết không hợp lệ!');
            }
        }

        $user = User::findOrFail($id);

        if ($user->email_verified_at) {
            if (Auth::check()) {
                return redirect()->route('admin.index')->with('success', 'Email đã được xác thực trước đó!');
            } else {
                return redirect()->route('home.index')->with('success', 'Email đã được xác thực trước đó!');
            }
        }

        $user->email_verified_at = now();
        $user->save();

        if (Auth::check()) {
            return redirect()->route('admin.index')->with('success', 'Email đã được xác thực thành công!');
        } else {
            return redirect()->route('home.index')->with('success', 'Email đã được xác thực thành công!');
        }
    }

    public function sendVerifyUser(Request $request)
    {
        $user = Auth::user();

        $expiresAt = now()->addMinute(); // Link hiệu lực 1 phút

        $url = URL::temporarySignedRoute(
            'email.verifyUser',
            $expiresAt,
            ['id' => $user->id]
        );

        if (!$this->checkEmailDomain($user->email)) {
            return back()->with('error', 'Email không hợp lệ hoặc domain không tồn tại!');
        }

        try {
            Mail::to($user->email)->send(new GuiEmailXacThuc($user, $url));
        } catch (\Exception $e) {
            return back()->with('error', 'Gửi email thất bại! Vui lòng đảm bảo địa chỉ email hợp lệ và thử lại sau!');
        }

        return back()->with('success', 'Chúng tôi đã gửi email xác thực, vui lòng kiểm tra hộp thư đến và cả thư rác!');
    }

    public function verifyEmailUser(Request $request, $id)
    {
        if (!$request->hasValidSignature()) {
            return redirect()->route('home.index')->with('error', 'Thư xác thực quá hạn hoặc liên kết không hợp lệ!');
        }

        $user = User::findOrFail($id);

        // Nếu đã xác thực rồi thì không cần làm lại
        if ($user->email_verified_at) {
            return redirect()->route('home.index')->with('success', 'Email đã được xác thực trước đó!');
        }

        $user->email_verified_at = now();
        $user->save();

        return redirect()->route('home.index')->with('verify_sent', 'Email đã được xác thực thành công!');
    }
}
