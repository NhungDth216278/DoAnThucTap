<!DOCTYPE html>
<html lang="vi">
<!-- Link Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<head>
    @include('admin.head')

    <style>
        /* CSS chung cho thông báo */
        .alert-custom {
            position: fixed;
            top: 20px;
            right: 20px;
            min-width: 400px;
            max-width: 500px;
            padding: 20px;
            font-size: 16px;
            font-weight: bold;
            display: flex;
            align-items: center;
            z-index: 1050;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            animation: fadeIn 0.5s ease-in-out;
        }

        /* Hiệu ứng hiện ra */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Màu sắc cho thông báo thành công */
        .alert-success-custom {
            background-color: #28a745;
            /* Xanh lá */
            color: white;
            border: 2px solid #218838;
        }

        /* Màu sắc cho thông báo lỗi */
        .alert-danger-custom {
            background-color: #dc3545;
            /* Đỏ */
            color: white;
            border: 2px solid #c82333;
        }
    </style>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
        </symbol>
        <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
        </symbol>
        <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
            <path
                d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
        </symbol>
    </svg>
    @if (session('success'))
        <div class="alert alert-success alert-custom alert-success-custom" role="alert" id="success-alert">
            <svg class="bi flex-shrink-0 me-2" width="28" height="28" role="img" aria-label="Success:">
                <use xlink:href="#check-circle-fill" />
            </svg>
            <div>
                {{ session('success') }}
            </div>
        </div>
    @endif


    @if (session('error'))
        <div class="alert alert-danger alert-custom alert-danger-custom" role="alert" id="error-alert">
            <svg class="bi flex-shrink-0 me-2" width="28" height="28" role="img" aria-label="Error:">
                <use xlink:href="#exclamation-triangle-fill" />
            </svg>
            <div>
                {{ session('error') }}
            </div>
        </div>
    @endif

    <script>
        setTimeout(function() {
            let successAlert = document.getElementById('success-alert');
            if (successAlert) {
                successAlert.style.transition = "opacity 0.5s";
                successAlert.style.opacity = "0";
                setTimeout(() => successAlert.remove(), 500);
            }

            let errorAlert = document.getElementById('error-alert');
            if (errorAlert) {
                errorAlert.style.transition = "opacity 0.5s";
                errorAlert.style.opacity = "0";
                setTimeout(() => errorAlert.remove(), 500);
            }
        }, 5000); // 5 giây
    </script>
</head>

<body>
    <main class="d-flex w-100">
        <div class="container d-flex flex-column">
            <div class="row vh-100">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 mx-auto d-table h-100">
                    <div class="d-table-cell align-middle">

                        <div class="text-center mt-1">
                            <a class="sidebar-brand" href="{{ route('home.index') }}">
                                <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="50" alt="Logo EbookCare">
                            </a>

                            <h1 class="h2">Chào mừng bạn đến trang quản lý!</h1>
                            <p class="lead">
                                Bạn cần đăng nhập trước khi vào trang
                            </p>
                        </div>

                        <div class="card rounded-4">
                            <div class="card-body">
                                <div class="m-sm-3">
                                    <form method="POST" action="{{ route('home.login.proc') }}">
                                        @csrf
                                        <input type="hidden" name="redirect_to"
                                            value="{{ request()->input('redirect_to', url()->previous()) }}">

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-3 col-form-label text-md-end">Tài
                                                khoản</label>
                                            <div class="col-md-8">
                                                <input id="tendangnhap" type="tendangnhap"
                                                    class="form-control @error('tendangnhap') is-invalid @enderror"
                                                    placeholder="Nhập email hoặc tên đăng nhập" name="tendangnhap"
                                                    value="{{ old('tendangnhap') }}" required autocomplete="tendangnhap"
                                                    autofocus>

                                                @error('tendangnhap')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="password" class="col-md-3 col-form-label text-md-end">Mật
                                                khẩu</label>

                                            <div class="col-md-8">
                                                <input id="password" type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required autocomplete="current-password">

                                                @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                            <div class="col-md-1">
                                                <button type="button" class="btn btn-lg"
                                                    onclick="togglePasswordVisibility()">
                                                    <i class="align-middle" id="btnMK" data-feather="eye"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-6 offset-md-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>

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
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row mb-3 justify-content-center mt-2">
                                        <div class="col-auto d-flex align-items-center gap-2">
                                            <label class="form-label m-0">
                                                Hoặc đăng nhập bằng
                                            </label>
                                            <a href="{{ route('auth.google.redirect') }}"
                                                class="btn btn-light rounded-circle p-2">
                                                <img src="{{ asset('imgs/Google__G__logo.png') }}" alt="Google Logo"
                                                    width="24" height="24">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="text-center mb-3">
                                        <a class="btn btn-link" href="{{ route('password.forgot') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

</body>

</html>
