@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Định dạng thẻ chứa tin tức */
    .card {
        border-radius: 10px;
        /* Bo tròn góc */
        overflow: hidden;
    }

    /* Định dạng tiêu đề */
    h5.fw-bold a {
        font-size: 1.3rem;
        /* Tăng kích thước tiêu đề */
        color: #009fe3;
        /* Màu xanh dương nhạt */
        transition: color 0.3s ease-in-out;
        /* Hiệu ứng màu mượt mà */
        font-weight: bold;
        /* Chữ đậm */
    }

    h5.fw-bold a:hover {
        color: hsl(199, 81%, 63%);
        /* Màu xanh dương đậm khi hover */
    }

    /* Định dạng mô tả */
    p.text-muted.small {
        font-size: 1.05rem;
        /* Lớn hơn chữ mặc định */
        color: #666;
        /* Màu xám nhạt */
        line-height: 1.6;
    }

    /* Định dạng thẻ "Tin y tế" */
    p.text-warning {
        color: #f4a100 !important;
        /* Màu vàng */
    }

    .text-warning.fw-bold.small {
        font-size: 0.9rem;
        /* Tăng kích thước chữ */
        font-weight: bold;
        /* Đậm hơn */
    }

    /* Định dạng ngày tháng và tác giả */
    span.text-muted {
        font-size: 0.9rem;
        color: #666;
    }

    /* Định dạng nút "Xem tiếp" */
    a.text-primary {
        font-size: 1rem;
        color: #009fe3;
        font-weight: bold;
    }

    a.text-primary:hover {
        color: #007bb5;
        /* Màu đậm hơn khi hover */
    }

    .dot {
        display: inline-block;
        width: 6px;
        height: 6px;
        background-color: #f4a100;
        border-radius: 50%;
        margin-right: 6px;
        /* Tạo khoảng cách giữa chấm tròn và chữ */
    }
</style>
@section('content')
    <div class="container mt-5">
        <div class="row">
            @foreach ($tintucs as $tin)
                <div class="col-md-4 mb-4">
                    <div class="card border-0 shadow-sm">
                        <img src="{{ asset($tin->hinhanh) }}" class="card-img-top" alt="{{ $tin->tieude }}">

                        <div class="card-body">
                            @if ($tin->loai == 1)
                                <p class="text-warning fw-bold small"><span class="dot"></span> Tin dịch vụ</p>
                            @elseif ($tin->loai == 2)
                                <p class="text-warning fw-bold small"><span class="dot"></span> Tin y tế</p>
                            @else
                                <p class="text-warning fw-bold small"><span class="dot"></span> Y tế thường thức</p>
                            @endif

                            <h5 class="fw-bold">
                                <a href="{{ route('tintuc.detail', ['loai' => $tin->loai, 'id' => $tin->id]) }}"
                                    class="text-dark text-decoration-none">
                                    {!! $tin->tieude !!}
                                </a>
                            </h5>
                            <p class="text-muted small">
                                {{ Str::limit(strip_tags($tin->mota), 100, '...') }}
                            </p>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted small">
                                    <i class="bi bi-calendar-event"></i> {{ $tin->created_at->format('d/m/Y') }} -
                                    {{ $tin->nhanvien ? $tin->nhanvien->hoten : 'Không xác định' }}
                                </span>
                                <a href="{{ route('tintuc.detail', ['loai' => $tin->loai, 'id' => $tin->id]) }}"
                                    class="text-primary fw-bold small">
                                    Xem tiếp →
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="d-flex justify-content-center">
            {{ $tintucs->withQueryString()->links() }}
        </div>
    </div>
@endsection
