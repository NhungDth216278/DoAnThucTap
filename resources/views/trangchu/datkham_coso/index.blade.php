@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .content-wrapper {

        padding: 40px 0;
        /* Thêm khoảng cách để không bị dính vào navbar/footer */

    }

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

input.form-control {
    background: transparent;
    box-shadow: none;
    outline: none;
    border: none;
}

.input-group-text {
    background: transparent;
    border: none;
}

</style>

@section('content')
    <div class="container">
        <div class="content-wrapper min-h-screen flex flex-col items-center ">
            <h2 class="text-center mb-4 text-uppercase fw-bold">ĐẶT KHÁM TẠI CƠ SỞ</h2>
            <!-- Thanh tìm kiếm -->
            <div class="search-container">
                <div class="input-group">
                    <span class="input-group-text bg-white border-0">
                        <i class="bi bi-search search-icon"></i>
                    </span>
                    <input type="text" id="tuKhoa" class="form-control border-0"
                        placeholder="Tìm kiếm cơ sở..." onkeyup="timKiemCoSo()">
                </div>
            </div>
<br>
            <div class="row g-4" id="danhSachCoSo">
                @foreach ($cosos as $coso)
                    <div class="col-md-6 co-so-item">
                        <div class="card h-100 shadow">
                            <div class="card-body d-flex align-items-center">
                                <img src="{{ asset($coso->hinhanh) }}" class="img-fluid rounded me-3"
                                    style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $coso->tencoso }}">
                                <div>
                                    <h5 class="card-title co-so-ten">{{ $coso->tencoso }}</h5>
                                    <p class="card-text">{{ $coso->diachi }}</p>
                                    <a href="{{ route('coso.chitiet', ['id' => $coso->id]) }}" class="btn btn-outline-primary rounded-pill px-4">Xem chi tiết</a>
                                    <a href="{{ route('datkham_coso.hinhthucdat', ['id' => $coso->id]) }}"
                                        class="btn btn-primary rounded-pill px-4"
                                        style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">Đặt
                                        khám ngay</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $cosos->links() }}
        </div>

        <a href="javascript:history.back()" class="text-primary">
            <i class="bi bi-arrow-left"></i> Quay lại
        </a>
    </div>

    <script>
        function timKiemCoSo() {
            let tuKhoa = document.getElementById("tuKhoa").value.toLowerCase();
            let danhSach = document.getElementById("danhSachCoSo").getElementsByClassName("co-so-item");

            for (let i = 0; i < danhSach.length; i++) {
                let tenCoSo = danhSach[i].getElementsByClassName("co-so-ten")[0].innerText.toLowerCase();
                if (tenCoSo.includes(tuKhoa)) {
                    danhSach[i].style.display = "";
                } else {
                    danhSach[i].style.display = "none";
                }
            }
        }
    </script>
@endsection
