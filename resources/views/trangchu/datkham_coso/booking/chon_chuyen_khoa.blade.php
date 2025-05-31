@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

@section('content')
<div class="container mt-4">
    <div class="row">
        <!-- Cột trái: Thông tin Cơ sở -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0 rounded">
                <div class="card-header text-white text-uppercase fw-bold" style="background: linear-gradient(to right, #00c6ff, #0072ff) !important;">
                    Thông tin cơ sở y tế
                </div>
                <div class="card-body">
                    <h6 class="fw-bold">
                        <i class="bi bi-hospital me-1"></i> {{ $coSo->tencoso }}
                    </h6>
                    <p class="text-muted">
                        {{ $coSo->diachi }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Cột phải: Danh sách Chuyên khoa -->
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-white text-uppercase fw-bold text-center" style="background: linear-gradient(to right, #00c6ff, #0072ff) !important;">
                    Vui lòng chọn chuyên khoa
                </div>
                <div class="card-body">
                    <div class="input-group mb-3">
                        <input type="text" id="tuKhoa" class="form-control" placeholder="Tìm kiếm chuyên khoa...">
                        <span class="input-group-text" id="basic-addon1">
                            <i class="bi bi-search"></i>
                        </span>
                    </div>
                </div>
                <ul id="danhSachChuyenKhoa" class="list-group">
                    @if ($chuyenKhoas->isEmpty())
                    <li class="list-group-item text-center text-danger">
                        <i class="bi bi-exclamation-circle"></i> Không có chuyên khoa nào!
                    </li>
                    @endif
                    @foreach ($chuyenKhoas as $chuyenKhoa)
                        <li class="list-group-item">
                            <a class="text-decoration-none" href="{{ route('datkhamcoso.bacsi', ['coSo' => $coSo->id, 'chuyenKhoa' => $chuyenKhoa->id]) }}">

                                <strong>{{ mb_strtoupper($chuyenKhoa->tenkhoa, 'UTF-8') }}</strong><br>
                                <p>{!! $chuyenKhoa->mota !!}</p>
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="javascript:history.back()" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tuKhoa').on('keyup', function() {
            var tuKhoa = $(this).val().toLowerCase();
            $('#danhSachChuyenKhoa li').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(tuKhoa) > -1);
            });
        });
    });
</script>

@endsection
