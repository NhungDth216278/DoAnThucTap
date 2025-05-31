@extends('admin.main') <!-- Kế thừa layout chung -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
@section('content')
    <style>
        .article-container {
            text-align: justify;
            /* Căn đều nội dung */
        }

        .article-title {
            font-size: 2.2rem;
            /* Chữ lớn hơn */
            font-weight: bold;
            color: #08356a;
            /* Màu xanh đậm */
            text-align: left;
            /* Tiêu đề căn trái */
        }

        .article-meta {
            font-size: 1rem;
            color: #6c757d;
            /* Màu chữ nhạt */
        }

        .article-summary {
            font-size: 1.2rem;
            font-weight: 500;
            color: #333;
        }

        .article-image {
            width: 100%;
            max-height: 400px;
            object-fit: cover;
            border-radius: 10px;
        }

        .article-content {
            font-size: 1.1rem;
            line-height: 1.7;
            color: #222;
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

        .article-summary {
            font-style: italic;
            /* In nghiêng */
            padding-left: 10px;
            /* Tạo khoảng cách với thanh dọc */
            border-left: 5px solid orange;
            /* Thanh dọc màu cam */
            color: #444;
            /* Màu chữ nhẹ hơn */
            font-size: 1.1rem;
            /* Cỡ chữ vừa phải */
        }
    </style>

    <div class="container-fluid p-0">

        <div class="row justify-content-center pt-5">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-body">

                        <h1 class="article-title">{{ $baiviet->tieude }}</h1>
                        <p class="article-meta">
                            <i class="bi bi-calendar-event"></i> {{ date('d/m/Y, H:i', strtotime($baiviet->created_at)) }}
                            - {{ $baiviet->nhanvien ? $baiviet->nhanvien->hoten : 'Không xác định' }}
                        </p>

                        <p class="article-summary">
                            {!! $baiviet->mota !!}
                        </p>

                        <div class="article-content">
                            {!! $baiviet->noidung !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="javascript:history.back()" class="back-link mt-3 d-inline-block text-decoration-none text-primary">
        <i class="bi bi-arrow-left me-2"></i> Quay lại
    </a>

@endsection
