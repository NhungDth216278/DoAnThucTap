@extends('trangchu.main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .card-wrapper {
        display: block;
        transition: all 0.3s ease-in-out;
        border-radius: 20px;
        height: 100%;
    }

    .custom-card .card-title {
        margin-top: 0;
        /* loại bỏ khoảng cách trên nếu có */
        font-size: 1.1rem;
        font-weight: bold;
    }

    .custom-card {
        border: 2px solid transparent;
        border-radius: 20px;
        background: white;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.08);
        padding: 20px;
        transition: all 0.3s ease;
        height: 100%;
        min-height: 360px;
        /* 💡 Chiều cao card tăng lên */
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .custom-card:hover {
        border-color: #00aaff;
        box-shadow: 0 0 0 3px rgba(0, 170, 255, 0.3);
        cursor: pointer;
    }

    .custom-card img {
        height: 140px;
        /* tăng từ 100px lên 120px */
        object-fit: contain;
        margin-bottom: 4px;
        /* giảm khoảng cách dưới để tên gần hơn */
    }


    .btn-book-now {
        background-color: #00bfff;
        color: white;
        font-weight: bold;
        border-radius: 10px;
        padding: 10px 14px;
        transition: 0.3s ease;
        margin-top: 20px;
    }

    .btn-book-now:hover {
        background-color: #009fdc;
        color: #fff;
    }

    .logo-title {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 8px;
        /* khoảng cách giữa logo và tên */
        margin-bottom: 10px;
    }

    .logo-img {
        width: 140px;
        height: 140px;
        object-fit: contain;
    }

    .card-title {
        font-size: 0.9rem;
        font-weight: bold;
        margin: 0;
        line-height: 1.3;
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

    /*danh sách cơ sở */
    .horizontal-scroll-wrapper {

        scroll-behavior: smooth;
        overflow-x: auto;
        display: flex;
        padding-bottom: 10px;
    }

    .coso-card {
        width: 265px;
        scroll-snap-align: start;
        flex-shrink: 0;
    }

    .scroll-container {
        position: relative;
        padding: 0 40px;
        /* Cho khoảng không đủ để đặt nút trái/phải bên ngoài */
    }

    .scroll-btn {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    /*danh sách bác sĩ */
    .scroll-container-bs {
        position: relative;
        padding: 0 40px;
        /* Dành chỗ cho nút cuộn trái/phải */
        margin-top: 30px;
    }

    .horizontal-scroll-wrapper-bs {
        scroll-behavior: smooth;
        white-space: nowrap;
        overflow-x: auto;
        padding-bottom: 10px;
        /* Khoảng cách với thanh cuộn */
    }

    .scroll-btn-bs {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: white;
    }


    /* Bổ sung cho danh sách bác sĩ */
    .coso-card-bs {
        min-width: 250px;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }

    /* Đảm bảo nội dung trong thẻ p hoặc h5 xuống dòng */
    .coso-card-bs .card-title,
    .coso-card-bs .info-text {
        white-space: normal;
        word-break: break-word;
    }


    /*danh sách tin tức */
    .scroll-container-tt {
        position: relative;
        padding: 0 40px;
        /* Dành chỗ cho nút cuộn trái/phải */
        margin-top: 30px;
    }

    .horizontal-scroll-wrapper-tt {
        scroll-behavior: smooth;
        white-space: nowrap;
        overflow-x: auto;
        padding-bottom: 10px;
        /* Khoảng cách với thanh cuộn */
    }

    .scroll-btn-tt {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        z-index: 10;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: white;
    }


    /* Bổ sung cho danh sách bác sĩ */
    .coso-card-tt {
        min-width: 250px;
        word-wrap: break-word;
        word-break: break-word;
        white-space: normal;
    }

</style>


@section('content')
    <div class="container">
        <div class="bg-warning py-2 text-white font-weight-bold d-flex align-items-center">
            <marquee behavior="scroll" direction="left" scrollamount="5">
                📢 Đặt khám ngay để người thân luôn được chăm sóc sức khỏe 📢
                Đặt khám ngay để người thân luôn được chăm sóc sức khỏe 📢 Đặt khám ngay để người thân luôn được chăm sóc sức khỏe
            </marquee>
        </div>

        <div id="cs1" class="carousel slide mt-4" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#cs1" data-bs-slide-to="0" aria-label="Banner Trang 1" class="active"
                    aria-current="true"></button>
                <button type="button" data-bs-target="#cs1" data-bs-slide-to="1" aria-label="Banner Trang 2"></button>
                <button type="button" data-bs-target="#cs1" data-bs-slide-to="2" aria-label="Banner Trang 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('imgs/Banner_1.png') }}" class="d-block w-100 d-md-none" alt="banner_1">

                    <!-- Hình ảnh cho mobile -->
                    <img src="{{ asset('imgs/Banner_1.png') }}" class="d-block w-100 d-none d-md-block" alt="banner_1">

                    <!-- Hình ảnh cho md và lớn hơn -->
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imgs/Banner_2.png') }}" class="d-block w-100 d-md-none" alt="banner_2">
                    <img src="{{ asset('imgs/Banner_2.png') }}" class="d-block w-100 d-none d-md-block" alt="banner_2">
                </div>
                <div class="carousel-item">
                    <img src="{{ asset('imgs/Banner_3.png') }}" class="d-block w-100 d-md-none" alt="banner_3">
                    <img src="{{ asset('imgs/Banner_3.png') }}" class="d-block w-100 d-none d-md-block" alt="banner_3">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#cs1" data-bs-slide="prev">
                <span class="carousel-control-prev-icon ms-3 me-auto" aria-hidden="true"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#cs1" data-bs-slide="next">
                <span class="carousel-control-next-icon ms-auto me-3" aria-hidden="true"></span>
            </button>
        </div>

        <h2 class="text-center mb-4 text-uppercase fw-bold mt-5">Cơ sở y tế </h2>
        <div class="scroll-container position-relative">
            <!-- Nút trái -->
            <button class="btn btn-light scroll-btn scroll-left d-none" style="left: -25px;">
                <i class="bi bi-chevron-left"></i>
            </button>

            <!-- Vùng cuộn -->
            <div class="horizontal-scroll-wrapper d-flex overflow-auto px-3">
                @foreach ($cosos as $coso)
                    <div class="coso-card flex-shrink-0 me-3">
                        <div class="custom-card w-100 h-100">
                            <a href="{{ route('coso.chitiet', $coso->id) }}" class="text-decoration-none">
                                <div class="card-body d-flex flex-column">
                                    <div class="logo-title mb-2">
                                        <img src="{{ $coso->hinhanh }}" class="logo-img" alt="Logo Cơ sở">
                                        <h5 class="card-title text-dark mt-2">{{ $coso->tencoso }}</h5>
                                    </div>
                                    <p class="card-text text-muted mb-1">
                                        <i class="bi bi-geo-alt"></i> {{ $coso->diachi }}
                                    </p>
                                    <a href="{{ route('datkham_coso.hinhthucdat', ['id' => $coso->id]) }}"
                                        class="btn btn-primary mt-auto rounded-pill px-4"
                                        style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">
                                        Đặt khám ngay
                                    </a>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nút phải -->
            <button class="btn btn-light scroll-btn scroll-right" style="right: -25px;">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const scrollContainer = document.querySelector('.horizontal-scroll-wrapper');
                const scrollLeftBtn = document.querySelector('.scroll-left');
                const scrollRightBtn = document.querySelector('.scroll-right');

                function updateButtonVisibility() {
                    const scrollLeft = scrollContainer.scrollLeft;
                    const maxScrollLeft = scrollContainer.scrollWidth - scrollContainer.clientWidth;

                    scrollLeftBtn.classList.toggle('d-none', scrollLeft <= 0);
                    scrollRightBtn.classList.toggle('d-none', scrollLeft >= maxScrollLeft - 1);
                }

                scrollLeftBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                });

                scrollRightBtn.addEventListener('click', () => {
                    scrollContainer.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                });

                scrollContainer.addEventListener('scroll', updateButtonVisibility);
                window.addEventListener('resize', updateButtonVisibility);

                updateButtonVisibility(); // Lần đầu khi load
            });
        </script>

        <h2 class="text-center mb-4 text-uppercase fw-bold mt-5">Danh sách bác sĩ</h2>
        <div class="scroll-container-bs position-relative">
            <!-- Nút cuộn trái -->
            <button class="btn btn-light scroll-btn-bs scroll-left-bs d-none" style="left: -25px;">
                <i class="bi bi-chevron-left"></i>
            </button>

            <!-- Danh sách bác sĩ -->
            <div class="horizontal-scroll-wrapper-bs d-flex overflow-auto px-3">
                @foreach ($bacsis as $bs)
                    <div class="coso-card-bs flex-shrink-0 me-3" style="width: 265px;">
                        <div class="custom-card w-100 h-100">
                            <div class="card-body d-flex flex-column">
                                <div class="logo-title">
                                    <img src="{{ $bs->hinhanh }}" alt="Bác sĩ" class="logo-img mb-2">
                                    <h5 class="card-title text-dark">{{ $bs->hocham }} {{ $bs->hoten }}</h5>
                                </div>
                                <p class="info-text mb-1"><i class="fas fa-hospital me-1"></i> {{ $bs->coso->tencoso }}</p>
                                <p class="info-text mb-1"><i class="fas fa-stethoscope me-1"></i>
                                    {{ $bs->chuyenkhoa->tenkhoa }}</p>
                                <p class="info-text mb-2"><i class="fas fa-money-bill me-1"></i>
                                    {{ number_format($bs->chuyenkhoa->giakham) }} VNĐ</p>
                                <a href="{{ route('datkham.thoi-gian', ['coSo' => $bs->coso->id, 'chuyenKhoa' => $bs->chuyenkhoa->id, 'bacSi' => $bs]) }}"
                                    class="btn btn-primary mt-auto rounded-pill px-4"
                                    style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">
                                    Đặt khám ngay
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Nút cuộn phải -->
            <button class="btn btn-light scroll-btn-bs scroll-right-bs" style="right: -25px;">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const scrollContainerBs = document.querySelector('.horizontal-scroll-wrapper-bs');
                const scrollLeftBtnBs = document.querySelector('.scroll-left-bs');
                const scrollRightBtnBs = document.querySelector('.scroll-right-bs');

                function updateButtonVisibilityBs() {
                    const scrollLeft = scrollContainerBs.scrollLeft;
                    const maxScrollLeft = scrollContainerBs.scrollWidth - scrollContainerBs.clientWidth;

                    scrollLeftBtnBs.classList.toggle('d-none', scrollLeft <= 0);
                    scrollRightBtnBs.classList.toggle('d-none', scrollLeft >= maxScrollLeft - 1);
                }

                scrollLeftBtnBs.addEventListener('click', () => {
                    scrollContainerBs.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                });

                scrollRightBtnBs.addEventListener('click', () => {
                    scrollContainerBs.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                });

                scrollContainerBs.addEventListener('scroll', updateButtonVisibilityBs);
                window.addEventListener('resize', updateButtonVisibilityBs);

                updateButtonVisibilityBs();
            });
        </script>

        <h2 class="text-center mb-4 text-uppercase fw-bold mt-5">Tin tức nổi bật</h2>

        <div class="scroll-container-tt position-relative">
            <!-- Nút cuộn trái -->
            <button class="btn btn-light scroll-btn-tt scroll-left-tt d-none" style="left: -25px;">
                <i class="bi bi-chevron-left"></i>
            </button>

            <!-- Danh sách tin tức -->
            <div class="horizontal-scroll-wrapper-tt d-flex overflow-auto px-3">
                @foreach ($tintucs as $tin)
                    <div class="coso-card-tt flex-shrink-0 me-3" style="width: 265px;">
                        <div class="custom-card w-100">
                            <div class="card-body d-flex flex-column">
                                <div class="logo-title">
                                    <img src="{{ asset($tin->hinhanh) }}" class="card-img-top" alt="{{ $tin->tieude }}">
                                    <h5 class="card-title text-dark">{{ $tin->tieude }}</h5>
                                </div>


                                @if ($tin->loai == 1)
                                    <p class="text-muted mb-1"><span class="dot"></span> Tin dịch vụ</p>
                                @elseif ($tin->loai == 2)
                                    <p class="text-muted mb-1"><span class="dot"></span> Tin y tế</p>
                                @else
                                    <p class="text-muted mb-1"><span class="dot"></span> Y tế thường thức</p>
                                @endif

                                <p class="text-muted mb-1"><i class="fas fa-calendar-alt me-1"></i>
                                    {{ $tin->created_at->format('d/m/Y') }} - <i class="fas fa-user me-1"></i>
                                    {{ $tin->nhanvien->hoten }}</p>


                                <a href="{{ route('tintuc.detail', ['loai' => $tin->loai, 'id' => $tin->id]) }}"
                                    class="btn btn-primary mt-auto rounded-pill px-4"
                                    style="background: linear-gradient(to right, #00c6ff, #0072ff); border: none;">
                                    Xem chi tiết
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <!-- Nút cuộn phải -->
            <button class="btn btn-light scroll-btn-tt scroll-right-tt" style="right: -25px;">
                <i class="bi bi-chevron-right"></i>
            </button>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                const scrollContainerTT = document.querySelector('.horizontal-scroll-wrapper-tt');
                const scrollLeftBtnTT = document.querySelector('.scroll-left-tt');
                const scrollRightBtnTT = document.querySelector('.scroll-right-tt');

                function updateButtonVisibilityTT() {
                    const scrollLeft = scrollContainerTT.scrollLeft;
                    const maxScrollLeft = scrollContainerTT.scrollWidth - scrollContainerTT.clientWidth;

                    scrollLeftBtnTT.classList.toggle('d-none', scrollLeft <= 0);
                    scrollRightBtnTT.classList.toggle('d-none', scrollLeft >= maxScrollLeft - 1);
                }

                scrollLeftBtnTT.addEventListener('click', () => {
                    scrollContainerTT.scrollBy({
                        left: -300,
                        behavior: 'smooth'
                    });
                });

                scrollRightBtnTT.addEventListener('click', () => {
                    scrollContainerTT.scrollBy({
                        left: 300,
                        behavior: 'smooth'
                    });
                });

                scrollContainerTT.addEventListener('scroll', updateButtonVisibilityTT);
                window.addEventListener('resize', updateButtonVisibilityTT);

                updateButtonVisibilityTT();
            });
        </script>



    </div>
@endsection
