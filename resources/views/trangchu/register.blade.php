@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Đăng ký</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('home.register.proc') }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label text-md-end">Tên tài khoản</label>

                                <div class="col-md-6">
                                    <input id="name" type="text"
                                        class="form-control @error('name') is-invalid @enderror" name="name"
                                        value="{{ old('name') }}" autocomplete="name" autofocus>

                                    @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">Email</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
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
                                         autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-lg"
                                    onclick="togglePasswordVisibility()">
                                    <i class="align-middle" id="btnMK" data-feather="eye"></i>
                                </button>
                                </div>

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
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">Xác nhận mật khẩu</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation"  autocomplete="new-password">
                                </div>
                                <div class="col-md-2">
                                    <button type="button" class="btn btn-lg"
                                    onclick="togglePasswordVisibility2()">
                                    <i class="align-middle" id="btnMKXN" data-feather="eye"></i>
                                </button>
                                </div>

                                <script>
                                    function togglePasswordVisibility2() {
                                        const passwordField = document.getElementById("password-confirm");
                                        const eyeIcon = document.getElementById("btnMKXN");
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
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                       Đăng ký
                                    </button>
                                </div>
                            </div>
                        </form>
                        <div class="d-flex justify-content-center mt-3">
                            <p>Đã có tài khoản? <a href="{{ url('login') }}">Đăng nhập ngay</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
