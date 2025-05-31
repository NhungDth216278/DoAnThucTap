@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>


@section('content')
    <div class="container-fluid p-0">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('taikhoanbenhnhan.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các tài khoản
        </a>
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Hồ sơ Bệnh nhân</h1>

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
            <div class="alert alert-success d-flex align-items-center" role="alert" id="success-alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Success:">
                    <use xlink:href="#check-circle-fill" />
                </svg>
                <div>
                    {{ session('success') }}
                </div>
            </div>

            <script>
                setTimeout(function() {
                    let alert = document.getElementById('success-alert');
                    if (alert) {
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 500); // Xoá khỏi DOM sau khi ẩn
                    }
                }, 2000); // 5 giây
            </script>
        @endif
        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert" id="error-alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{ session('error') }}
                </div>
            </div>

            <script>
                setTimeout(function() {
                    let alert = document.getElementById('error-alert');
                    if (alert) {
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 500); // Xoá khỏi DOM sau khi ẩn
                    }
                }, 2000); // 5 giây
            </script>
        @endif
        <hr>

        <div class="row justify-content-center">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h4>Danh sách hồ sơ của tài khoản: {{ $user->name }} ({{ $user->email }})</h4>

                    </div>

                    <table class="table table-hover my-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>CCCD</th>
                                <th>Ngày Sinh</th>
                                <th>Giới tính</th>
                                <th class="d-none d-xl-table-cell">SĐT</th>
                                <th class="d-none d-xl-table-cell">Địa chỉ</th>
                                <th class="d-none d-xl-table-cell">Ngày tạo</th>
                                <th class="d-none d-xl-table-cell">Ngày cập nhật</th>
                                <th>Xem lịch hẹn</th>
                                <th>Sửa</th>
                                <th>Xóa</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($user->benhnhan as $key => $bn)
                                <tr>
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $bn->hoten }}</td>
                                    <td>{{ $bn->cccd }}</td>
                                    <td>{{ $bn->ngaysinh }}</td>
                                    <td>{{ $bn->gioitinh }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $bn->sodienthoai }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $bn->diachi }}</td>

                                    <td class="d-none d-xl-table-cell">{{ $bn->created_at }}</td>
                                    <td class="d-none d-xl-table-cell">{{ $bn->updated_at }}</td>
                                    <td>
                                        <a href="{{ route('benhnhan.detail_lichhen', ['id' => $bn->id]) }}"
                                            class="btn btn-outline-primary">
                                            <i class="align-middle" data-feather="info"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-warning" href="{{ route('benhnhan.edit', ['id' => $bn->id]) }}">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>
                                    </td>
                                    <td>
                                        <a class="btn btn-danger" href="{{ route('benhnhan.delete', ['id' => $bn->id]) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bệnh nhân {{ $bn->hoten }} có id {{ $bn->id }} không?');">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
