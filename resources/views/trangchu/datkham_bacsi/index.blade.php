@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .content-wrapper {

        padding: 40px 0;
        /* Thêm khoảng cách để không bị dính vào navbar/footer */

    }

    .card {
        border-radius: 10px;
        padding: 15px;
    }

    .card img {
        border: 2px solid #ddd;
    }

    .card h5 {
        font-size: 18px;
    }

    .card p {
        font-size: 14px;
    }

    .text-muted {
        font-size: 13px;
    }

    .bac-si-item .card {
        min-height: 260px;
        /* hoặc cao hơn tùy nội dung */
    }

    /* thanh tìm kiếm */
    .search-container {
        max-width: 500px;
        margin: auto;
        background: #f8fbff;
        border-radius: 25px;
        padding: 8px 15px;
        display: flex;
        align-items: center;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .search-icon {
        font-size: 18px;
        color: #aaa;
    }
</style>

@section('content')
    <div class="container">
        <div class="content-wrapper min-h-screen flex flex-col items-center">
            <h2 class="text-center mb-4 text-uppercase fw-bold">ĐẶT KHÁM THEO BÁC SĨ</h2>

            <!-- Thanh tìm kiếm -->
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search search-icon"></i>
                    </span>
                    <input type="text" id="tuKhoa" class="form-control border-0" placeholder="Tìm kiếm bác sĩ..."
                        onkeyup="timKiemBacSi()">
                </div>
            </div>
<br>
            <div class="row g-4" id="danhSachBacSi">
                @foreach ($bacSis as $bacSi)
                    <div class="col-md-6 bac-si-item">
                        <div class="card shadow border-0 p-3">
                            <div class="row align-items-center">
                                <!-- Hình ảnh bác sĩ -->
                                <div class="col-md-2 text-center">
                                    <img src="{{ asset($bacSi->hinhanh) }}" class="rounded-circle img-fluid"
                                        style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $bacSi->hoten }}">
                                </div>

                                <!-- Thông tin bác sĩ -->
                                <div class="col-md-7 ho-ten-bac-si">
                                    <h5 class="fw-bold text-primary">
                                        {{ $bacSi->hocham }} {{ $bacSi->hoten }} | {{ $bacSi->chuyenKhoa->tenkhoa }}
                                    </h5>
                                    <p class="mb-1"><strong>Chuyên trị:</strong> {{ $bacSi->chuyenKhoa->tenkhoa }}</p>
                                    <p class="mb-1">
                                        @php
                                            // Lấy danh sách thứ không trùng nhau
                                            $thuList = $bacSi->lichKham
                                                ->map(function ($lich) {
                                                    return Str::ucfirst(
                                                        \Carbon\Carbon::parse($lich->ngaykham)->isoFormat('dddd'),
                                                    ); // Gọi Carbon trực tiếp // Lấy thứ (Monday, Tuesday,...)
                                                })
                                                ->unique(); // Loại bỏ trùng lặp
                                        @endphp
                                        <strong>Lịch khám:</strong> {{ $thuList->join(', ') }}
                                    </p>
                                    <p class="mb-1"><strong>Giá khám:</strong>
                                        {{ number_format($bacSi->chuyenKhoa->giakham, 0, ',', '.') }}đ</p>
                                </div>

                                <!-- Thông tin cơ sở + Nút đặt khám -->
                                <div class="col-md-3 text-end">
                                    <p class="text-muted">
                                        <i class="bi bi-geo-alt-fill"></i> <strong>{{ $bacSi->coSo->tencoso }}</strong>
                                    </p>
                                    <p class="text-muted">{{ $bacSi->coSo->diachi }}</p>


                                    <a href="{{ route('datkham.thoi-gian', ['coSo' => $bacSi->coSo->id, 'chuyenKhoa' => $bacSi->chuyenKhoa->id, 'bacSi' => $bacSi]) }}"
                                        class="btn btn-primary rounded-pill px-4 mt-auto"
                                        style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">
                                        Đặt ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Hiển thị phân trang -->
            <div class="d-flex justify-content-center mt-4">
                {{ $bacSis->links() }}
            </div>
        </div>
        <a href="javascript:history.back()" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
    </div>
    <script>
        function timKiemBacSi() {
            let tuKhoa = document.getElementById("tuKhoa").value.toLowerCase();
            let danhSach = document.getElementById("danhSachBacSi").getElementsByClassName("bac-si-item");

            for (let i = 0; i < danhSach.length; i++) {
                let hoten = danhSach[i].getElementsByClassName("ho-ten-bac-si")[0].innerText.toLowerCase();
                if (hoten.includes(tuKhoa)) {
                    danhSach[i].style.display = "";
                } else {
                    danhSach[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
