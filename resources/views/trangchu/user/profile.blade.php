@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <div class="container mt-2">
        <h3 class="mb-4">Thông Tin Tài Khoản</h3>

        {{-- Thông tin tài khoản --}}
        <div class="card shadow-sm p-4 mb-4">
            <form method="POST" action="{{ route('home.profile.update') }}" id="profile-form">
                @csrf
                <div class="mb-3">
                    <label>Tên tài khoản:</label>
                    <input type="text" name="name" class="form-control border-0" id="name"
                        value="{{ $user->name }}" readonly>
                </div>
                <div class="mb-3">
                    <label>Email:</label>
                    <input type="email" name="email" class="form-control border-0" id="email"
                        value="{{ $user->email }}" readonly>
                </div>
                <div class="mb-3 text-muted">
                    <strong>Ngày tạo:</strong> {{ $user->created_at->format('d/m/Y H:i') }} <br>
                    <strong>Cập nhật gần nhất:</strong> {{ $user->updated_at->format('d/m/Y H:i') }}
                </div>

                <div class="d-flex justify-content-between">
                    <div>
                        <button type="button" class="btn btn-outline-primary" onclick="enableEdit()">Sửa thông tin</button>
                        <button type="button" class="btn btn-secondary d-none" id="cancel-btn"
                            onclick="cancelEdit()">Hủy</button>
                    </div>
                    <button type="submit" class="btn btn-success d-none" id="save-btn">Lưu thay đổi</button>
                </div>
                @if (is_null($user->email_verified_at))
                <div class="alert alert-warning text-center mt-4">
                    <strong>Email của bạn chưa được xác thực!</strong>
                    <form method="POST" action="{{ route('user.profile.sendVerifyUser') }}" class="d-inline"
                        id="frmXacThuc">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-info rounded-pill ms-2 px-3" id="btnXacThuc">
                            Xác thực email
                        </button>
                    </form>

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const frmXacThuc = document.getElementById('frmXacThuc')
                            const btnXacThuc = document.getElementById('btnXacThuc');

                            btnXacThuc.addEventListener('click', function(event) {
                                btnXacThuc.disabled = true;
                                btnXacThuc.innerText = 'Đang xử lý ...';

                                const loading = document.getElementById('globalLoading');
                                if (loading) {
                                    loading.style.display = 'block';
                                }

                                frmXacThuc.submit();
                            });
                        });
                    </script>
                </div>
            @else
                <div class="alert alert-success text-center mt-4">
                    <strong>Email của bạn đã được xác thực!</strong>
                </div>
            @endif
            </form>
        </div>

        {{-- Đổi mật khẩu --}}
        <div class="text-end mb-2">
            <button class="btn btn-outline-danger" onclick="togglePasswordForm()">Đổi mật khẩu</button>
        </div>
        <div class="card p-4 shadow-sm d-none" id="password-form">
            <form method="POST" action="{{ route('home.profile.password') }}">
                @csrf
                <div class="mb-3 position-relative">
                    <label>Mật khẩu hiện tại:</label>
                    <div class="input-group">

                        <input type="password" name="current_password" id="password"
                            class="form-control @error('current_password') is-invalid @enderror">
                        <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility()">
                            <i class="align-middle" id="btnMK" data-feather="eye"></i>
                        </button>
                    </div>
                    @error('current_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="mb-3 position-relative">
                    <label>Mật khẩu mới:</label>
                    <div class="input-group">
                        <input type="password" name="new_password" id="new_password"
                            class="form-control @error('new_password') is-invalid @enderror">
                        <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility2()">
                            <i class="align-middle" id="btnMKMoi" data-feather="eye"></i>
                        </button>
                    </div>
                    @error('new_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="mb-3 position-relative">
                    <label>Xác nhận mật khẩu mới:</label>
                    <div class="input-group">
                        <input type="password" name="new_password_confirmation" id="new_password_confirmation"
                            class="form-control @error('new_password_confirmation') is-invalid @enderror">
                        <button type="button" class="btn btn-lg" onclick="togglePasswordVisibility3()">
                            <i class="align-middle" id="btnMKXN" data-feather="eye"></i>
                        </button>
                    </div>
                    @error('new_password_confirmation')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <button type="submit" class="btn btn-warning">Xác nhận đổi mật khẩu</button>
            </form>
        </div>
    </div>

    <script>
        const nameInput = document.getElementById('name');
        const emailInput = document.getElementById('email');
        const saveBtn = document.getElementById('save-btn');
        const cancelBtn = document.getElementById('cancel-btn');

        const originalName = nameInput.value;
        const originalEmail = emailInput.value;

        function enableEdit() {
            nameInput.readOnly = false;
            emailInput.readOnly = false;
            nameInput.classList.remove('border-0');
            emailInput.classList.remove('border-0');
            saveBtn.classList.remove('d-none');
            cancelBtn.classList.remove('d-none');
        }

        function cancelEdit() {
            nameInput.value = originalName;
            emailInput.value = originalEmail;
            nameInput.readOnly = true;
            emailInput.readOnly = true;
            nameInput.classList.add('border-0');
            emailInput.classList.add('border-0');
            saveBtn.classList.add('d-none');
            cancelBtn.classList.add('d-none');
        }

        function togglePasswordForm() {
            document.getElementById('password-form').classList.toggle('d-none');
        }

        document.addEventListener("DOMContentLoaded", function() {
            const form = document.querySelector("#password-form form");
            form.addEventListener("submit", function(e) {
                const newPassword = form.querySelector('input[name="new_password"]').value;
                const confirmPassword = form.querySelector('input[name="new_password_confirmation"]').value;

                if (newPassword !== confirmPassword) {
                    e.preventDefault();
                    alert("Mật khẩu mới và xác nhận không khớp!");
                }
            });
        });

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

        function togglePasswordVisibility2() {
            const passwordField = document.getElementById("new_password");
            const eyeIcon = document.getElementById("btnMKMoi");
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

        function togglePasswordVisibility3() {
            const passwordField = document.getElementById("new_password_confirmation");
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
@endsection
