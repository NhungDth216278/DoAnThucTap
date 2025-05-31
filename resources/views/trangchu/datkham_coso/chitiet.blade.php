@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .border-primary:hover {
        background-color: rgba(0, 123, 255, 0.1);
        /* Nền xanh nhạt khi hover */
        transition: 0.3s;
    }

    .content-box {
        border: 2px solid #007bff;
        padding: 15px;
        border-radius: 10px;
        background-color: #f7fcff;
        flex: 2;
        /* Mô tả chiếm nhiều hơn */

    }

    .info-box h2,
    .content-box h2 {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
    }

    .map-and-description {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        /* Khoảng cách giữa bản đồ và mô tả */
    }

    .map-container {
        flex: 1;
        /* Bản đồ chiếm 1 phần */
        max-width: 500px;
        /* Giới hạn chiều rộng bản đồ */
    }


    iframe {
        width: 100%;
        height: 400px;
        border-radius: 10px;
        /* Bo góc bản đồ */
    }

    .info-box {
        border: 2px solid #007bff;
        /* Viền màu xanh */
        padding: 15px;
        border-radius: 10px;
        text-align: justify;
        margin-bottom: 20px;
    }
</style>
@section('content')
    <div class="container mt-4">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav class="w-full max-w-4xl p-4 text-gray-600">
                <a href="/" class="text-decoration-none text-dark">Trang chủ</a> >
                <b class="text-primary">{{ $title }}</b>
            </nav>
        </div>
        <div class="row">
            <!-- Cột thông tin cơ sở -->
            <div class="col-md-4">
                <div class="card p-2">
                    <img src="{{ asset($coso->hinhanh) }}" class="img-fluid mx-auto" style="max-width: 150px;"
                        alt="Logo">
                    <h4 class="mt-2 text-primary text-center">{{ $coso->tencoso }}</h4>
                    <p><i class="bi bi-geo-alt"></i> {{ $coso->diachi }}</p>
                    <p><i class="bi bi-clock"></i> Thứ 2 - Thứ 6 (7:30 - 16:30), Thứ 7 (7:30 - 11:30)</p>
                    <p><i class="bi bi-telephone"></i> Số điện thoại: {{ $coso->sodienthoai }}</p>
                    <button class="btn btn-primary rounded-pill px-4"
                        style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">Đặt khám
                        ngay</button>
                </div>
            </div>
            <!-- Cột dịch vụ -->
            <div class="col-md-8">
                <h4 class="text-primary text-center">Các dịch vụ</h4>
                <div class="row">
                    <div class="col-8 col-md-6 text-center">
                        <a href="{{ route('booking.chuyen-khoa', [$coso->id]) }}" class="text-decoration-none text-dark">
                            <div class="p-3 border border-primary rounded">
                                <img src="{{ asset('imgs/chuyenkhoa.png') }}" class="me-2"
                                    style="width: 80px; height: 80px;" alt="lịch khám">
                                <p class="mt-2">Đặt khám theo chuyên khoa</p>
                            </div>
                        </a>
                    </div>
                    <div class="col-8 col-md-6 text-center">
                        <a href="{{ route('cs_bacsi.bac-si', [$coso->id]) }}" class="text-decoration-none text-dark">
                            <div class="p-3 border border-primary rounded">
                                <img src="{{ asset('imgs/bacsi.png') }}" class="me-2" style="width: 80px; height: 80px;"
                                    alt="lịch khám">
                                <p class="mt-2">Đặt khám theo bác sĩ</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>
        <div class="map-and-description">
            <div class="map-container">
                <div class="info-box">
                    <h2>Mô tả</h2>
                    <div class="formatted-content">
                        @if (!empty($coso->mota))
                            {!! $coso->mota !!}
                        @else
                            <span class="text-muted">Chưa có thông tin</span>
                        @endif
                    </div>
                </div>
                <iframe width="100%" height="400" style="border:0;" loading="lazy" allowfullscreen
                    src="https://www.google.com/maps?q={{ urlencode($coso->diachi) }}&output=embed">
                </iframe>
            </div>

            <!-- Nội dung -->
            <div class="content-box">
                <h2>Nội dung</h2>
                <div class="formatted-content">
                    @if (!empty($coso->noidung))
                        {!! $coso->noidung !!}
                    @else
                        <span class="text-muted">Chưa có thông tin</span>
                    @endif
                </div>
            </div>
        </div>
        <div class="mt-5">
            <a href="javascript:history.back()" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
        </div>
    </div>
@endsection
