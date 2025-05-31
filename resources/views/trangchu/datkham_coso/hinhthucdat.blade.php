@extends('trangchu.main')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    a.text-primary:hover {
        color: #00bef4 !important;
    }

    .content-wrapper {
        background-color: #e8f2f7;
        /* Màu nền theo yêu cầu */
        padding: 40px 0;
        /* Thêm khoảng cách để không bị dính vào navbar/footer */
    }

    .breadcrumb-container {
        padding-left: 40px;
        /* Đẩy breadcrumb vào trong */
        font-size: 16px;
        /* Điều chỉnh kích thước chữ */
        color: #2c7be5;
        /* Màu xanh dương nhạt */
    }

    .breadcrumb-container a {
        text-decoration: none;
        color: #2c7be5;
    }

    .breadcrumb-container a:hover {
        text-decoration: underline;
    }

    .breadcrumb-link {
        font-size: 1.2rem;
        /* Tăng cỡ chữ */
        font-weight: bold;
        /* In đậm */
        color: #000;
        /* Màu đen */
        text-decoration: none;
        /* Bỏ gạch chân */
    }

    .breadcrumb-title {
        font-size: 1.4rem;
        /* Lớn hơn */
        font-weight: bold;
        /* In đậm */
        color: #007bff;
        /* Màu xanh dương */
    }
</style>
@section('content')
    <div class="content-wrapper min-h-screen flex flex-col items-center ">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav class="w-full max-w-4xl p-4 text-gray-600">
                <a href="/" class="breadcrumb-link">Trang chủ</a> &gt;
                <a href="#" class="breadcrumb-link">{{ $title }}</a> &gt;

                <a href="#" class="breadcrumb-title">Hình thức đặt khám</a>
            </nav>
        </div>

        <div class="container text-center">
            <h2 class="text-primary fw-bold">Các hình thức đặt khám</h2>
            <p class="text-muted">Đặt khám nhanh chóng, không phải chờ đợi với nhiều cơ sở y tế trên khắp các tỉnh thành</p>

            <div class="row justify-content-center">
                <div class="col-md-3 mb-3">
                    <a href="{{ route('booking.chuyen-khoa', [$id]) }}"
                        class="btn btn-outline-info d-flex align-items-center justify-content-center p-3 w-100">
                        <img src="{{ asset('imgs/chuyenkhoa.png') }}" class="me-2" style="width: 30px; height: 30px;"
                            alt="lịch khám">
                        <h6 class="mb-0">Đặt khám theo chuyên khoa</h6>
                    </a>

                </div>
                <div class="col-md-3 mb-3">
                    <a href="{{ route('cs_bacsi.bac-si', [$id]) }}"
                        class="btn btn-outline-info d-flex align-items-center justify-content-center p-3 w-100">
                        <img src="{{ asset('imgs/bacsi.png') }}" class="me-2" style="width: 30px; height: 30px;"
                            alt="lịch khám">
                        <h6 class="mb-0">Đặt khám theo bác sĩ</h6>
                    </a>
                </div>
            </div>

            <a href="javascript:history.back()" class="back-link mt-3 d-inline-block text-decoration-none text-primary">
                <i class="bi bi-arrow-left me-2"></i> Quay lại
            </a>
        </div>
    </div>
@endsection
