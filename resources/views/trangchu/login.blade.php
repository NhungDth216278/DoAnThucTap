@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <script>
        function togglePasswordVisibility() {
            const passwordField = document.getElementById("password");
            const eyeIcon = document.getElementById("btnMK");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                eyeIcon.setAttribute('data-feather', 'eye-off');
            } else {
                passwordField.type = "password";
                eyeIcon.setAttribute('data-feather', 'eye');
            }
            // Chạy FeatherIcons để cập nhật biểu tượng
            feather.replace();
        }
    </script>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đăng nhập</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('home.login.proc') }}">
                            @csrf
                            <input type="hidden" name="redirect_to"
                                value="{{ request()->input('redirect_to', url()->previous()) }}">

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">Tài khoản</label>
                                <div class="col-md-6">
                                    <input id="tendangnhap" type="tendangnhap"
                                        class="form-control @error('tendangnhap') is-invalid @enderror" name="tendangnhap"
                                        placeholder="Nhập email hoặc tên đăng nhập"
                                        value="{{ old('tendangnhap') }}" required autocomplete="email" autofocus>

                                    @error('tendangnhap')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">Mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility()">
                                        <i class="align-middle" id="btnMK" data-feather="eye"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>

                                        <label class="form-check-label" for="remember">
                                           Ghi nhớ
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Đăng nhập
                                    </button>


                                    <a class="btn btn-link" href="{{ route('password.forgot') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                </div>
                            </div>

                            <div class="row mb-3 justify-content-center mt-2">
                                <div class="col-auto d-flex align-items-center gap-2">
                                    <label class="form-label m-0">
                                        Hoặc đăng nhập bằng
                                    </label>
                                    <a href="{{ route('auth.google.redirect') }}" class="btn btn-light rounded-circle p-2">
                                        <img src="{{ asset('imgs/Google__G__logo.png') }}" alt="Google Logo" width="24" height="24">
                                    </a>
                                </div>
                            </div>
                        </form>
                        <!-- Căn giữa đoạn văn -->
                        <div class="d-flex justify-content-center mt-3">
                            <p>Chưa có tài khoản? <a href="{{ url('register') }}">Đăng ký ngay</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
