@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <div class="container">
        <h2 class="h3 mb-3 mt-3"><strong> Hồ sơ bệnh nhân của bạn</strong></h2>

        <!-- Nút thêm mới -->
        <button class="btn btn-info mb-4 rounded" onclick="showForm()">
            <i class="align-middle me-2" data-feather="plus-square"></i> Thêm hồ sơ mới
        </button>
        <!-- Form thêm/sửa -->
        <div id="form-hoso" style="display: {{ $errors->any() ? 'block' : 'none' }};" class="card p-4 mb-4">
            <form id="hoso-form" method="POST"
                action="{{ old('id') ? route('hosobenhnhan.update', old('id')) : route('hosobenhnhan.store') }}"
                enctype="multipart/form-data">
                @csrf
                @if (old('id'))
                    @method('PUT')
                @endif

                <input type="hidden" name="id" id="benhnhan_id" value="{{ old('id') }}"> <!-- dùng cho sửa -->
                <input type="hidden" name="old_avatar" id="old_avatar" value="{{ old('avatar', $benhnhan->avatar ?? '') }}">

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Họ tên</label>
                        <input type="text" class="form-control @error('ho_ten') is-invalid @enderror" name="ho_ten"
                            id="ho_ten" value="{{ old('ho_ten') }}">
                        @error('ho_ten')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Ngày sinh</label>
                        <input type="date" class="form-control @error('ngay_sinh') is-invalid @enderror" name="ngay_sinh"
                            id="ngay_sinh" value="{{ old('ngay_sinh') }}" max="{{ now()->format('Y-m-d') }}">
                        @error('ngay_sinh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-3">
                        <label>Giới tính</label>
                        <select class="form-control @error('gioi_tinh') is-invalid @enderror" name="gioi_tinh"
                            id="gioi_tinh">
                            <option value="">-- Chọn giới tính --</option>
                            <option value="Nam" {{ old('gioi_tinh') == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ old('gioi_tinh') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                        @error('gioi_tinh')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Số điện thoại</label>
                        <input type="text" class="form-control @error('sdt') is-invalid @enderror" name="sdt"
                            id="sdt" value="{{ old('sdt') }}">
                        @error('sdt')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Địa chỉ</label>
                        <input type="text" class="form-control @error('dia_chi') is-invalid @enderror" name="dia_chi"
                            id="dia_chi" value="{{ old('dia_chi') }}">
                        @error('dia_chi')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>CCCD</label>
                        <input type="text" class="form-control @error('cccd') is-invalid @enderror" name="cccd"
                            id="cccd" value="{{ old('cccd') }}">
                        @error('cccd')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>Avatar</label>
                        <input type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar"
                            id="avatar">
                        @error('avatar')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                        <div id="xoa-anh-wrapper" class="mt-2" style="display: none;">
                            <label class="form-check">
                                <input class="form-check-input" type="checkbox" name="XoaAnh" value="1"
                                    @if (old('XoaAnh') == 1) checked @endif>
                                <span class="form-check-label">
                                    Xóa ảnh đại diện
                                </span>
                            </label>
                        </div>

                    </div>
                </div>
                <button type="submit" class="btn btn-success">
                    <i class="bi bi-plus-circle me-2"></i> {{ old('id') ? 'Cập nhật' : 'Thêm Hồ Sơ' }}
                </button>
                <button type="button" class="btn btn-secondary" onclick="hideForm()">
                    <i class="bi bi-x-circle"></i> Hủy
                </button>
            </form>
        </div>



        <!-- Danh sách hồ sơ -->
        <div class="card">
            <div class="card-body">
                @if ($hoSoBenhNhans->isEmpty())
                    <p><i class="bi bi-search"></i> Bạn chưa có hồ sơ nào.</p>
                @else
                    <table class="table table-bordered table-hover">
                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Avatar</th>
                                <th>Họ tên</th>
                                <th class="d-none d-lg-table-cell">Ngày sinh</th>
                                <th>CCCD</th>
                                <th>Giới tính</th>
                                <th class="d-none d-md-table-cell">SĐT</th>
                                <th class="d-none d-xl-table-cell">Địa chỉ</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hoSoBenhNhans as $index => $bn)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>
                                        @if ($bn->avatar)
                                            <img src="{{ asset($bn->avatar) }}" class="img-thumbnail"
                                                style="width: 80px; height: 80px; object-fit: cover;">
                                        @else
                                            <span>Chưa có ảnh</span>
                                        @endif
                                    </td>
                                    <td>{{ $bn->hoten }}</td>
                                    <td class="d-none d-lg-table-cell">{{ $bn->ngaysinh }}</td>
                                    <td>{{ $bn->cccd }}</td>
                                    <td>{{ $bn->gioitinh }}</td>
                                    <td class="d-none d-md-table-cell">{{ $bn->sodienthoai }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $bn->diachi }}</td>
                                    <td>
                                        <a href="{{ route('hosobenhnhan.lichhen', $bn->id) }}" class="btn btn-primary btn-sm">
                                            <i class="bi bi-calendar-check"></i> Lịch hẹn
                                        </a>

                                        <button class="btn btn-warning btn-sm"
                                            onclick="editBenhNhan({{ json_encode($bn) }})">
                                            <i class="align-middle" data-feather="edit"></i> Sửa
                                        </button>
                                        <div class="mt-2">
                                        <form action="{{ route('hosobenhnhan.delete', $bn->id) }}" method="POST"
                                            style="display:inline-block;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa hồ sơ bệnh nhân của {{ $bn->hoten }} có id {{ $bn->id }} không?');">
                                                <i class="align-middle" data-feather="trash-2"></i> Xóa
                                            </button>
                                        </form>
                                    </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <script>
        window.onload = function() {
            @if ($errors->any())
                document.getElementById('form-hoso').style.display = 'block';
            @endif
        };
    </script>

    <script>
        function showForm() {
            document.getElementById('form-hoso').style.display = 'block';
            document.getElementById('hoso-form').reset();
            document.getElementById('benhnhan_id').value = '';

             // Ẩn checkbox xóa ảnh khi thêm mới
    document.getElementById('xoa-anh-wrapper').style.display = 'none';
        }

        function hideForm() {
            document.getElementById('form-hoso').style.display = 'none';
        }

        function editBenhNhan(bn) {
            if (!bn) {
                alert("Không có dữ liệu hồ sơ bệnh nhân.");
                return;
            }
            showForm();
            // Hiển thị checkbox xóa ảnh nếu bệnh nhân có avatar
            if (bn.avatar && bn.avatar !== '') {
                document.getElementById('xoa-anh-wrapper').style.display = 'block';
            } else {
                document.getElementById('xoa-anh-wrapper').style.display = 'none';
            }
            document.getElementById('benhnhan_id').value = bn.id;
            document.getElementById('ho_ten').value = bn.hoten ?? '';
            document.getElementById('ngay_sinh').value = bn.ngaysinh ?? '';
            document.getElementById('gioi_tinh').value = bn.gioitinh ?? '';
            document.getElementById('sdt').value = bn.sodienthoai ?? '';
            document.getElementById('dia_chi').value = bn.diachi ?? '';
            document.getElementById('cccd').value = bn.cccd ?? '';
            document.getElementById('avatar').value = ""; // không thể gán value file
            document.getElementById('old_avatar').value = bn.avatar;

            document.getElementById('hoso-form').action = `/ho-so-benh-nhan/update/${bn.id}`;
        }
    </script>
@endsection
