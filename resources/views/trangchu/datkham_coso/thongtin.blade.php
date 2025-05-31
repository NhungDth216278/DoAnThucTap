@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Làm nổi bật hồ sơ được chọn */
    .active-hoso {
        background-color: #e6f0ff;
        border-left: 4px solid #007bff;
        font-weight: bold;
    }

    /* Hiệu ứng hover cho list */
    .list-group-item:hover {
        background-color: #f1f1f1;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    /* Căn lề chung */
    .container {
        margin-top: 30px;
    }

    /* Tiêu đề */
    h2,
    h3 {
        font-weight: bold;
        color: #333;
    }

    /* Form input thẩm mỹ hơn */
    .form-control,
    .form-select {
        border-radius: 6px;
        box-shadow: none;
        transition: border 0.3s;
    }

    .form-control:focus,
    .form-select:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.15rem rgba(0, 123, 255, 0.25);
    }

    /* Nút gửi */
    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 25px;
        border-radius: 5px;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    /* Nút thêm hồ sơ */
    .btn-success {
        padding: 8px 18px;
        border-radius: 5px;
    }
</style>

@section('content')
    <div class="container">
        <div class="row">
            <!-- Hồ sơ bệnh nhân bên trái -->
            <div class="col-md-3 mt-2">
                <h3>Hồ sơ bệnh nhân</h3>
                <ul class="list-group">
                    @foreach ($benhnhans as $benhnhan)
                        <li class="list-group-item {{ request()->id_benhnhan == $benhnhan->id ? 'active-hoso' : '' }}">
                            <a
                                href="{{ route('datkham.thongtin', ['id_bacsi' => request()->id_bacsi, 'ngayhen' => request()->ngayhen, 'id_khunggio' => request()->id_khunggio, 'id_lichkham' => request()->id_lichkham, 'id_benhnhan' => $benhnhan->id]) }}">
                                {{ $benhnhan->hoten }}
                            </a>
                        </li>
                    @endforeach
                </ul>

                <a href="{{ route('datkham.thongtin', [
                    'id_bacsi' => request()->id_bacsi,
                    'ngayhen' => request()->ngayhen,
                    'id_khunggio' => request()->id_khunggio,
                    'id_lichkham' => request()->id_lichkham,
                ]) }}"
                    class="btn btn-success mt-3">
                    Thêm hồ sơ mới
                </a>

            </div>


            <!-- Cột bên trái: Thông báo -->
            <div class="col-md-3 bg-primary text-white p-4 rounded-start">
                <h5><strong>Lưu ý :</strong></h5>
                <p>Quý khách hàng vui lòng cung cấp thông tin chính xác để được phục vụ tốt nhất. Trong trường hợp cung
                    cấp sai thông tin cccd & điện thoại, việc xác nhận cuộc hẹn sẽ không hiệu lực.</p>
                <p>Quý khách sử dụng dịch vụ đặt hẹn trực tuyến, xin vui lòng đặt trước ít nhất là 24 giờ trước khi đến
                    khám.</p>
                <p>Trong trường hợp khẩn cấp hoặc nghi ngờ có các triệu chứng nguy hiểm, quý khách vui lòng <strong>ĐẾN
                        TRỰC TIẾP</strong> Phòng khám hoặc các trung tâm y tế gần nhất để kịp thời xử lý.</p>
            </div>
            <!-- Cột bên phải: Form -->
            <div class="col-md-6 bg-white border p-4 rounded-end shadow-sm">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="text-primary mb-0"><strong>ĐĂNG KÝ KHÁM</strong></h4>

                </div>
                <p class="mb-4 text-muted">Vui lòng điền thông tin vào form bên dưới để đăng ký khám bệnh theo yêu cầu
                </p>

                <form action="{{ route('datkham.luuThongTin') }}" method="POST" class="needs-validation" novalidate>
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_bacsi" value="{{ request()->id_bacsi }}">
                    <input type="hidden" name="ngayhen" value="{{ request()->ngayhen }}">
                    <input type="hidden" name="id_khunggio" value="{{ request()->id_khunggio }}">
                    <input type="hidden" name="id_lichkham" value="{{ request()->id_lichkham }}">

                    <!-- Nếu có hồ sơ được chọn, điền sẵn thông tin và không cho sửa -->
                    @if ($benhNhanSelected)
                        <input type="hidden" name="id_benhnhan" value="{{ $benhNhanSelected->id }}">
                        <div class="form-group mb-3">
                            <label for="hoten">Họ và tên</label>
                            <input type="text" class="form-control" name="hoten"
                                value="{{ $benhNhanSelected->hoten }}" placeholder="Họ và tên" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="cccd">CCCD</label>
                            <input type="text" class="form-control" name="cccd" value="{{ $benhNhanSelected->cccd }}"
                                placeholder="CCCD" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="ngaysinh">Ngày sinh</label>
                            <input type="date" class="form-control" name="ngaysinh"
                                value="{{ $benhNhanSelected->ngaysinh }}" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="text" class="form-control" name="sodienthoai"
                                value="{{ $benhNhanSelected->sodienthoai }}" placeholder="Số điện thoại" readonly>
                        </div>

                        <div class="form-group mb-3">
                            <label for="gioitinh">Giới tính</label>
                            <select name="gioitinh" class="form-select" disabled>
                                <option value="{{ $benhNhanSelected->gioitinh }}" selected>
                                    {{ $benhNhanSelected->gioitinh }}</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi"
                                value="{{ $benhNhanSelected->diachi }}" placeholder="Địa chỉ" readonly>
                        </div>
                    @else
                        <input type="hidden" name="id_benhnhan" value="">
                        <!-- Nếu không có hồ sơ, cho phép điền thông tin mới -->
                        <div class="form-group mb-3">
                            <label for="hoten">Họ và tên</label>
                            <input type="text" class="form-control" name="hoten"
                                placeholder="Họ và tên" value="{{ old('hoten') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="cccd">CCCD</label>
                            <input type="text" class="form-control" name="cccd" placeholder="CCCD" value="{{ old('cccd') }}">
                        </div>

                        <div class="form-group mb-3">
                            <label for="ngaysinh">Ngày sinh</label>
                            <input type="date" class="form-control" name="ngaysinh">
                        </div>

                        <div class="form-group mb-3">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input type="text" class="form-control" name="sodienthoai" placeholder="Số điện thoại">
                        </div>

                        <div class="form-group mb-3">
                            <label for="gioitinh">Giới tính</label>
                            <select name="gioitinh" class="form-select">
                                <option value="">Giới tính</option>
                                <option value="Nam">Nam</option>
                                <option value="Nữ">Nữ</option>
                            </select>
                        </div>

                        <div class="form-group mb-3">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" class="form-control" name="diachi" placeholder="Địa chỉ">
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">GỬI</button>
                    @if ($benhNhanSelected)
                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const form = document.querySelector('form');
                                const readOnlyFields = ['hoten', 'cccd', 'ngaysinh', 'sodienthoai', 'diachi'];
                                readOnlyFields.forEach(field => {
                                    const input = form.querySelector(`[name="${field}"]`);
                                    if (input) {
                                        input.readOnly = true;
                                    }
                                });

                                const gioitinhSelect = form.querySelector('select[name="gioitinh"]');
                                if (gioitinhSelect) {
                                    gioitinhSelect.disabled = true;
                                }
                            });
                        </script>
                    @endif

                </form>
            </div>
            <a href="javascript:history.back()" class="back-link mt-3 d-inline-block text-decoration-none text-primary">
                <i class="bi bi-arrow-left me-2"></i> Quay lại
            </a>
        </div>

        <script>
            document.getElementById('addNewRecordBtn').addEventListener('click', function() {
                const form = document.querySelector('form');

                // Reset input và select
                form.querySelectorAll('input:not([type="hidden"]), select').forEach(function(el) {
                    el.value = '';
                    el.readOnly = false;
                    el.disabled = false;
                });

                // Xóa input id_benhnhan nếu có
                const hiddenInput = form.querySelector('input[name="id_benhnhan"]');
                if (hiddenInput) {
                    hiddenInput.remove();
                }
            });
        </script>
    </div>
@endsection
