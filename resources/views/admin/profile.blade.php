@extends('admin.main')

@section('content')
    <div class="row justify-content-center">
        <div class="col-10 col-md-8">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="card p-5">
                <div class="card-header">
                    <h3 class="text-info text-center">THÔNG TIN NGƯỜI DÙNG</h3>
                </div>
                <div class="card-body">
                    <form method="POST" enctype="multipart/form-data" action="{{ route('admin.profile.update') }}">
                        @csrf
                        @method('POST')
                        <div class="text-center">
                            <img class="img-thumbnail"
                                @if (is_null($nhanvien->avatar)) src="{{ asset('upload/avatars/avatar.png') }}"
                            @else src="{{ asset($nhanvien->avatar) }}" @endif
                                alt="{{ $nhanvien->hoten }}" width="100px">
                        </div>

                        <div class="my-3 row">
                            <div class="col-8">
                                <label>Tên tài khoản</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" placeholder="" value="{{ $user->name }}">
                                @error('name')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label>Quyền hạn</label>
                                <input type="text" class="form-control" id="role" disabled
                                    placeholder="{{ $user->role }}">
                            </div>
                        </div>
                        <div class="my-3 row">
                            <div class="col-12">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" placeholder="vidu@gmail.com.vn"
                                    value="{{ $user->email }}">
                                @error('email')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                        </div>

                        <div class="my-3 row">
                            <div class="col-8">
                                <label>Họ và tên</label>
                                <input type="text" class="form-control @error('hoten') is-invalid @enderror"
                                    id="hoten" name="hoten" placeholder="Họ và tên nhân viên"
                                    value="{{ $nhanvien->hoten }}">
                                @error('hoten')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label for="gioitinh">Giới tính</label>
                                <select class="form-control" name="gioitinh" required>
                                    <option value="Nam" {{ $nhanvien->gioitinh == 'Nam' ? 'selected' : '' }}>Nam
                                    </option>
                                    <option value="Nữ" {{ $nhanvien->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                                </select>

                            </div>
                        </div>

                        <div class="my-3 row">
                            <div class="col-8">
                                <label for="diachi">Địa chỉ</label>
                                <textarea class="form-control @error('diadhi') is-invalid @enderror" id="diachi" name="diachi" rows="2"
                                    placeholder="">{{ $nhanvien->diachi }}</textarea>
                                @error('diachi')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label for="sodt">Số điện thoại</label>
                                <input type="tel" class="form-control @error('sodienthoai') is-invalid @enderror"
                                    id="sodienthoai" name="sodienthoai" placeholder="(084+)"
                                    value="{{ $nhanvien->sodienthoai }}" />
                                @error('sodienthoai')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>
                        </div>

                        <div class="my-3">
                            <input type="hidden" name="aatarCu" value="{{ $nhanvien->avatar }}">
                            <a data-bs-toggle="collapse" data-bs-target="#demo" class="btn btn-info rounded-5">
                                <i class="align-middle me-2" data-feather="feather"></i>
                                Đổi hình ảnh đại diện
                            </a>
                            <div id="demo" class="collapse m-3">
                                <input type="file" class="form-control" name="avatar" accept="image/*">
                            </div>
                            <label class="form-check mt-2">
                                <input class="form-check-input" type="checkbox" name="XoaAnh" value="1">
                                <span class="form-check-label">
                                    Dùng ảnh đại diện mặc định
                                </span>
                            </label>
                        </div>

                        <div class="my-3 text-center">
                            <input class="btn btn-primary" type="submit" value="Cập nhật">
                            <input class="btn btn-warning" type="reset" value="Đặt lại">
                            <a class="btn btn-danger" onclick="togglePasswordForm()">Đổi mật khẩu</a>
                        </div>
                    </form>

                    @if (is_null($user->email_verified_at))
                    <div class="alert alert-warning text-center mt-4">
                        <strong>Email của bạn chưa được xác thực!</strong>
                        <form method="POST" action="{{ route('admin.profile.sendVerifyAdmin') }}" class="d-inline"
                            id="frmXacThuc">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-info rounded-pill ms-2 px-3"
                                id="btnXacThuc">
                                Xác thực email
                            </button>
                        </form>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const frmXacThuc = document.getElementById('frmXacThuc')
                                const btnXacThuc = doscument.getElementById('btnXacThuc');

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
                </div>
            </div>

            {{-- Đổi mật khẩu --}}
            <div class="card p-4 shadow-sm d-none" id="password-form">
                <form method="POST" action="{{ route('admin.profile.password') }}">
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
                            <input type="password" name="new_password"  id="new_password"
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
            <script>
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

        </div>
    </div>
@endsection
