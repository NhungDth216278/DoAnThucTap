@extends('admin.main')

@section('content')
    <div class="container-fluid p-0">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('nhanvien.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các nhân viên
        </a>

        <h1 class="h3 mb-3"><strong>Thêm</strong> Thông tin nhân viên</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('nhanvien.store') }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center mb-3">

                        <div class="col-4">
                            <label for="name">Tên tài khoản</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" placeholder="" value="{{ old('name') }}">
                            @error('name')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <div class="col-8">
                            <label for="email">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                name="email" placeholder="" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-4">
                            <label>Quyền:</label>
                            <select name="role" id="loaitaikhoan" onchange="toggleCosoSelect()"
                                class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}">
                                <option value="">-- Chọn quyền --</option>
                                <option value="manage">Nhân viên quản lý</option>
                                <option value="news">Nhân viên đăng tin</option>
                                <option value="hospital">Nhân viên bệnh viện</option>
                            </select>
                            @error('role')
                            <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                        @enderror
                        </div>

                        <div class="col-8">
                            <label for="matkhau">Mật khẩu</label>
                            <div class="input-group">
                                <input type="password" class="form-control @error('matkhau') is-invalid @enderror"
                                    id="matkhau" name="matkhau" placeholder="" value="{{ old('matkhau') }}">
                                <div class="input-group-append position-relative">
                                    <button type="button" class="btn" onclick="togglePasswordVisibility()">
                                        <i class="align-middle" id="btnMK" data-feather="eye"></i>
                                    </button>
                                </div>
                                @error('matkhau')
                                    <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                                @enderror
                            </div>

                            <script>
                                function togglePasswordVisibility() {
                                    const passwordField = document.getElementById("matkhau");
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
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-12" id="coso-group" style="display: none">
                            <label for="id_coso">Cơ sở</label>
                            <select name="id_coso" class="form-control @error('id_coso') is-invalid @enderror">
                                <option selected value="">-- Chọn cơ sở --</option>
                                @foreach ($lstCS as $coso)
                                    <option value="{{ $coso->id }}">
                                        {{ $coso->tencoso }}
                                    </option>
                                @endforeach
                            </select>
                            @error('id_coso')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-10">
                            <label for="hoten">Họ tên nhân viên</label>
                            <input type="text" class="form-control @error('hoten') is-invalid @enderror" id="hoten"
                                name="hoten" placeholder="Họ và tên nhân viên" value="{{ old('hoten') }}">
                            @error('hoten')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <div class="col-2">
                            <label for="gioitinh">Giới tính</label>
                            <select class="form-control @error('gioitinh') is-invalid @enderror" id="gioitinh"
                                name="gioitinh">
                                <option selected value="">-- Chọn giới tính --</option>
                                <option @if (old('gioitinh') == 'Nam') selected @endif value="Nam">Nam</option>
                                <option @if (old('gioitinh') == 'Nữ') selected @endif value="Nữ">Nữ</option>
                            </select>
                            @error('gioitinh')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center mb-3">
                        <div class="col-3">
                            <label for="sodt">Số điện thoại</label>
                            <input type="tel" class="form-control @error('sodienthoai') is-invalid @enderror"
                                id="sodienthoai" name="sodienthoai" placeholder="(084+)"
                                value="{{ old('sodienthoai') }}" />
                            @error('sodienthoai')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>

                        <div class="col-9">
                            <label for="diachi">Địa chỉ</label>
                            <textarea class="form-control @error('"diachi') is-invalid @enderror" id="diachi" name="diachi" rows="2"
                                placeholder="">{{ old('"diachi') }}</textarea>
                            @error('"diachi')
                                <div class="invalid-feedback"><strong>{{ $message }}</strong></div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mb-3">
                        <div class="col-12">
                            <span>Trạng thái:</span>

                            <label class="form-check">
                                <input class="form-check-input" type="radio" value="1" name="trangthai" checked>
                                <span class="form-check-label">
                                    Mở khóa tài khoản
                                </span>
                            </label>

                            <label class="form-check">
                                <input class="form-check-input" type="radio" value="0" name="trangthai"
                                    @if (old('trangthai') == 0) checked @endif>
                                <span class="form-check-label">
                                    Khóa tài khoản
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <label for="avatar">Hình đại diện nhân viên (nếu có)</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                        </div>
                    </div>

                    <div class="mt-4">
                        <input class="btn btn-info me-2" type="submit" value="Tạo tài khoản nhân viên">
                        <input class="btn btn-warning" type="reset" value="Làm trống">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function toggleCosoSelect() {
            const type = document.getElementById('loaitaikhoan').value;
            document.getElementById('coso-group').style.display = (type === 'hospital') ? 'block' : 'none';
        }
        document.addEventListener('DOMContentLoaded', toggleCosoSelect);
    </script>
@endsection
