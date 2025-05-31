@extends('trangchu.main') <!-- Kế thừa layout chung -->
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <div class="container">
        <!-- Breadcrumb -->
        <div class="breadcrumb-container">
            <nav class="w-full max-w-4xl p-4 text-gray-600">
                <a href="/" class="breadcrumb-link">Trang chủ</a> &gt;
                @if ($baiviet->loai == 1)
                    <a href="{{ route('tintuc.show',$baiviet->loai) }}" class="breadcrumb-link">Tin dịch vụ</a> &gt;
                @elseif ($baiviet->loai == 2)
                    <a href="{{ route('tintuc.show',$baiviet->loai) }}" class="breadcrumb-link">Tin y tế</a> &gt;
                @else
                    <a href="{{ route('tintuc.show',$baiviet->loai) }}" class="breadcrumb-link">Y tế thường thức</a> &gt;
                @endif
                <a href="#" class="breadcrumb-title">{{ $title }}</a>
            </nav>
        </div>

        <div class="row">
            <!-- Cột bài viết chiếm 8 cột -->
            <div class="col-lg-8 article-container">

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

             <!-- Cột tin tức liên quan chiếm 4 cột -->
    <div class="col-lg-4">
        <h2 class="related-title" style=" color: #007bff; font-weight: bold;">Tin tức liên quan</h2>
        <ul class="list-unstyled">
            @foreach ($relatedNews as $tin)
                <li class="mb-3 related-news-item">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset( $tin->hinhanh) }}" class="card-img-top" alt="{{ $tin->tieude }}">

                        <div class="card-body">
                            <p class="text-warning fw-bold small"><span class="dot"></span>
                                {{ $tin->loai == 1 ? 'Tin y tế' : 'Y tế thường thức' }}</p>
                            <h5 class="fw-bold">
                                <a href="{{ route('tintuc.detail',['loai' => $tin->loai, 'id' => $tin->id]) }}" class="text-dark text-decoration-none">
                                    {!! $tin->tieude !!}
                                </a>
                            </h5>
                            <p class="text-muted small">
                                {{ Str::limit(strip_tags($tin->mota), 100, '...') }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-event"></i>  {{ $tin->created_at->format('d/m/Y') }} - {{ $tin->nguoiviet }}
                                </span>
                                <a href="{{ route('tintuc.detail',['loai' => $tin->loai, 'id' => $tin->id]) }}" class="text-primary fw-bold small">
                                    Xem tiếp →
                                </a>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach


        </ul>
    </div>
        </div>
        <a href="javascript:history.back()" class="back-link mt-3 d-inline-block text-decoration-none text-primary">
            <i class="bi bi-arrow-left me-2"></i> Quay lại
        </a>


    </div>
@endsection
