@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    .content-wrapper {

        padding: 40px 0;
        /* Thêm khoảng cách để không bị dính vào navbar/footer */

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

    .card {
        border: 2px solid transparent;
        /* Viền nhẹ giống hình */
        transition: all 0.3s ease-in-out;
    }

    .card:hover {
        border-color: #00c6ff;
        /* Viền xanh khi hover */
    }

    .card-body {
        padding: 20px;
    }

    .row.g-4 {
        row-gap: 20px;
        /* Khoảng cách giữa các hàng */
    }
</style>

@section('content')
    <div class="container">
        <div class="content-wrapper min-h-screen flex flex-col items-center">
            <h2 class="text-center mb-4 text-uppercase fw-bold">ĐẶT KHÁM THEO CHUYÊN KHOA</h2>
            <!-- Thanh tìm kiếm -->
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search search-icon"></i>
                    </span>
                    <input type="text" id="tuKhoa" class="form-control border-0" placeholder="Tìm kiếm chuyên khoa..."
                        onkeyup="timKiemChuyenKhoa()">
                </div>
            </div>
            <br>
            <div class="row g-4" id="danhSachChuyenKhoa"> <!-- Thêm khoảng cách giữa các hàng -->
                @if ($chuyenkhoas->isEmpty())
                    <li class="list-group-item text-center text-danger">
                        <i class="bi bi-exclamation-circle"></i> Không có chuyên khoa nào!
                    </li>
                @else
                    @foreach ($chuyenkhoas as $chuyenkhoa)
                        <div class="col-md-6 chuyen-khoa-item">
                            <div class="card h-100 shadow p-3 rounded-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title fw-bold chuyen-khoa-ten">{{ $chuyenkhoa->tenkhoa }}</h5>
                                        <p class="card-text">{{ $chuyenkhoa->coso->tencoso }}</p>
                                    </div>
                                    <a href="{{ route('datkham_chuyenkhoa.chon-bac-si', ['coSo' => $chuyenkhoa->coso->id, 'chuyenKhoa' => $chuyenkhoa->id]) }}"
                                        class="btn btn-primary rounded-pill px-4"
                                        style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">
                                        Đặt khám ngay
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        <a href="javascript:history.back()" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
    </div>
    <script>
        function timKiemChuyenKhoa() {
            let tuKhoa = document.getElementById("tuKhoa").value.toLowerCase();
            let danhSach = document.getElementById("danhSachChuyenKhoa").getElementsByClassName("chuyen-khoa-item");

            for (let i = 0; i < danhSach.length; i++) {
                let tenKhoa = danhSach[i].getElementsByClassName("chuyen-khoa-ten")[0].innerText.toLowerCase();
                if (tenKhoa.includes(tuKhoa)) {
                    danhSach[i].style.display = "";
                } else {
                    danhSach[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
