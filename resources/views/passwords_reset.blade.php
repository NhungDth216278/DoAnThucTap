<!DOCTYPE html>
<html lang="vi">

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

<body class="d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-11 col-lg-5">
        <div class="text-center mb-4">
            <a href="{{ route('home.index') }}">
                <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="50" alt="Logo EbookCare">
            </a>
        </div>


        <div class="card rounded-4 shadow">
            <div class="card-body">
                <h3 class="text-center"><b>Đặt lại mật khẩu</b></h3>
                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <input type="hidden" name="email" value="{{ $email }}">

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">Email</label>

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
                            <label for="password" class="col-md-4 col-form-label text-md-end">Mật khẩu mới</label>

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
                                <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility()">
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
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">Xác nhận mật
                                khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                    name="password_confirmation" autocomplete="new-password">
                            </div>
                            <div class="col-md-2">
                                <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility2()">
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
                                    Đặt lại mật khẩu
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
