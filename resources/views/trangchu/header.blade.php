<!-- Link Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<style>
    /* CSS chung cho thông báo */
    .alert-custom {
        position: fixed;
        top: 20px;
        right: 20px;
        min-width: 400px;
        max-width: 500px;
        padding: 20px;
        font-size: 16px;
        font-weight: bold;
        display: flex;
        align-items: center;
        z-index: 1050;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        border-radius: 10px;
        animation: fadeIn 0.5s ease-in-out;
    }

    /* Hiệu ứng hiện ra */
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Màu sắc cho thông báo thành công */
    .alert-success-custom {
        background-color: #28a745;
        /* Xanh lá */
        color: white;
        border: 2px solid #218838;
    }

    /* Màu sắc cho thông báo lỗi */
    .alert-danger-custom {
        background-color: #dc3545;
        /* Đỏ */
        color: white;
        border: 2px solid #c82333;
    }

    .search-dropdown {
        position: absolute;
        width: 100%;
        background: white;
        border-radius: 5px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        max-height: 300px;
        overflow-y: auto;
        display: none;
    }

    .search-item {
        padding: 10px;
        border-bottom: 1px solid #ddd;
    }

    .search-item:hover {
        background-color: #f8f9fa;
        cursor: pointer;
    }


    .search-container {
        display: flex;
        align-items: center;
        background: white;
        border-radius: 30px;
        padding: 10px 15px;
        box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 500px;
        position: relative;
    }

    .search-icon {
        color: gray;
        font-size: 18px;
        margin-right: 10px;
    }

    .search-input {
        border: none;
        outline: none;
        font-size: 16px;
        width: 100%;
        color: gray;
        background: transparent;
    }

    .search-input::placeholder {
        color: lightgray;
    }


    .search-results {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: white;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        display: none;
        max-height: 300px;
        overflow-y: auto;
        z-index: 1000;
    }

    .search-results .result-section {
        padding: 5px 10px;
        font-weight: bold;
        background: #f1f1f1;
    }

    .search-results .result-item {
        padding: 10px;
        border-bottom: 1px solid #eee;
        cursor: pointer;
    }

    .search-results .result-item:hover {
        background: #f8f9fa;
    }

    .result-item .title {
        font-weight: bold;
        color: #007bff;
    }

    .result-item .subtitle {
        font-size: 14px;
        color: #666;
    }
</style>

<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
    <symbol id="check-circle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z" />
    </symbol>
    <symbol id="info-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z" />
    </symbol>
    <symbol id="exclamation-triangle-fill" fill="currentColor" viewBox="0 0 16 16">
        <path
            d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z" />
    </symbol>
</svg>
@if (session('success'))
    <div class="alert alert-success alert-custom alert-success-custom" role="alert" id="success-alert">
        <svg class="bi flex-shrink-0 me-2" width="28" height="28" role="img" aria-label="Success:">
            <use xlink:href="#check-circle-fill" />
        </svg>
        <div>
            {{ session('success') }}
        </div>
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger alert-custom alert-danger-custom" role="alert" id="error-alert">
        <svg class="bi flex-shrink-0 me-2" width="28" height="28" role="img" aria-label="Error:">
            <use xlink:href="#exclamation-triangle-fill" />
        </svg>
        <div>
            {{ session('error') }}
        </div>
    </div>
@endif

<script>
    setTimeout(function() {
        let successAlert = document.getElementById('success-alert');
        if (successAlert) {
            successAlert.style.transition = "opacity 0.5s";
            successAlert.style.opacity = "0";
            setTimeout(() => successAlert.remove(), 500);
        }

        let errorAlert = document.getElementById('error-alert');
        if (errorAlert) {
            errorAlert.style.transition = "opacity 0.5s";
            errorAlert.style.opacity = "0";
            setTimeout(() => errorAlert.remove(), 500);
        }
    }, 5000); // 5 giây

    function timKiem() {
        let input = document.getElementById("searchInput").value.toLowerCase();
        let resultContainer = document.getElementById("searchResults");

        if (input.length === 0) {
            resultContainer.style.display = "none";
            return;
        }

        fetch(`/search?q=${input}`)
            .then(response => response.json())
            .then(data => {
                resultContainer.innerHTML = "";

                if (data.coso.length > 0) {
                    resultContainer.innerHTML += `<div class="result-section">Cơ sở y tế</div>`;
                    data.coso.forEach(coSo => {
                        resultContainer.innerHTML += `
                    <div class="result-item" onclick='chonKetQua("coso", ${JSON.stringify(coSo)}, "${coSo.tencoso}")'>
                        <div class="title">${coSo.tencoso}</div>
                        <div class="subtitle">${coSo.diachi}</div>
                    </div>`;
                    });
                }

                if (data.chuyenkhoa.length > 0) {
                    resultContainer.innerHTML += `<div class="result-section">Chuyên khoa</div>`;
                    data.chuyenkhoa.forEach(khoa => {
                        resultContainer.innerHTML += `
                    <div class="result-item" onclick='chonKetQua("chuyenkhoa", ${JSON.stringify(khoa)}, "${khoa.tenkhoa}")'>
                        <div class="title">${khoa.tenkhoa}</div>
                    </div>`;
                    });
                }

                if (data.bacsi.length > 0) {
                    resultContainer.innerHTML += `<div class="result-section">Bác sĩ</div>`;
                    data.bacsi.forEach(bacsi => {
                        resultContainer.innerHTML += `
                    <div class="result-item" onclick='chonKetQua("bacsi", ${JSON.stringify(bacsi)}, "${bacsi.hoten}")'>
                        <div class="title">${bacsi.hoten} | ${bacsi.coso_tencoso}</div>
                    </div>`;
                    });
                }

                resultContainer.style.display = "block";
            })
            .catch(error => console.error("Lỗi tìm kiếm:", error));
    }

    const routes = {
        datkham_coso: "{{ route('datkham_coso.hinhthucdat', ['id' => 0]) }}",
        datkham_chuyenkhoa: "{{ route('datkham_chuyenkhoa.chon-bac-si', ['coSo' => 0, 'chuyenKhoa' => 0]) }}",
        datkham_bacsi: "{{ route('datkham.thoi-gian', ['coSo' => 0, 'chuyenKhoa' => 0, 'bacSi' => 0]) }}"

    };


    // Cập nhật hàm chọn kết quả để điều hướng
    function chonKetQua(loai, data, ten) {
        document.getElementById("searchInput").value = ten;
        document.getElementById("searchResults").style.display = "none";

        let url = "";

        if (loai === 'coso') {
            url = routes.datkham_coso.replace('/0', `/${data.id}`);
        } else if (loai === 'chuyenkhoa') {
            url = routes.datkham_chuyenkhoa
                .replace('/0/0', `/${data.id_coso}/${data.id}`);
        } else if (loai === 'bacsi') {
            url = routes.datkham_bacsi
                .replace('/0/0/0', `/${data.id_coso}/${data.id_chuyenkhoa}/${data.id}`);
        }

        window.location.href = url;
    }

    function toggleClearButton() {
        const input = document.getElementById('searchInput');
        const clearBtn = document.getElementById('clearButton');
        clearBtn.style.display = input.value.trim() ? 'block' : 'none';
    }

    function clearSearch() {
        const input = document.getElementById('searchInput');
        input.value = '';
        toggleClearButton(); // ẩn nút xóa
        timKiem(); // gọi lại hàm tìm kiếm nếu cần reset kết quả
    }
</script>


<div class="container">
    <header class="row justify-content-center">
        <div class="col-12">
            <div class="row my-3">
                <div class="col-12 col-lg-auto text-center">
                    <a href="{{ route('home.index') }}" class="d-inline-flex link-body-emphasis text-decoration-none">
                        <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="48" alt="Logo web Dặt lịch khám">
                    </a>
                </div>
                <div class="col my-auto">
                    <div class="search-container position-relative">
                        <i class="bi bi-search search-icon"></i>

                        <input type="text" id="searchInput" class="search-input"
                            placeholder="Tìm kiếm cơ sở, chuyên khoa, bác sĩ..."
                            onkeyup="timKiem(); toggleClearButton();">

                        <!-- Nút xóa -->
                        <i class="bi bi-x-circle clear-icon" id="clearButton" onclick="clearSearch()"
                            style="display: none;"></i>

                        <div id="searchResults" class="search-results"></div>
                    </div>
                </div>

                <!-- GIỮA THANH TÌM KIẾM VÀ ĐĂNG NHẬP -->
                <div class="col-12 col-lg-auto d-flex align-items-center justify-content-center gap-3 mt-3 mt-lg-0">
                    <a href="https://www.tiktok.com/@datvo_03" target="_blank"
                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                        <img src="{{ asset('imgs/tiktok_logo.jpeg') }}" alt="Facebook" width="16" height="16">
                        Tiktok
                    </a>
                    <span class="text-muted">|</span>
                    <a href="https://www.facebook.com/share/15ygFJkizW/" target="_blank"
                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                        <img src="{{ asset('imgs/facebook_logo.svg') }}" alt="Facebook" width="16" height="16">
                        Facebook
                    </a>
                    <span class="text-muted">|</span>
                    <a href="https://id.zalo.me/" target="_blank"
                        class="text-dark text-decoration-none d-flex align-items-center gap-1">
                        <img src="{{ asset('imgs/zalo_logo.svg') }}" alt="Zalo" width="16" height="16"> Zalo
                    </a>

                </div>

                <div class="col-12 col-lg-auto d-none d-lg-block my-auto">
                    @if (Auth::check())
                        @php
                            $user = Auth::user();
                        @endphp
                        <div class="nav-item">
                            <a class="nav-link dropdown-toggle dropdown" href="#" data-bs-toggle="dropdown">
                                <span class="text-primary fw-bold border border-primary rounded px-2 py-1">
                                    {{ $user->name }}
                                </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="{{ route('home.profile') }}">
                                    <i class="align-middle me-1" data-feather="user"></i>
                                    Trang cá nhân
                                </a>
                                <a class="dropdown-item" href="{{ route('home.hosobenhnhan') }}">
                                    <i class="bi bi-clipboard-pulse align-middle me-1"></i>
                                    Hồ sơ bệnh nhân
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('home.login') }}" class="btn btn-custom me-1 text-nowrap">
                            Đăng nhập
                        </a>
                        <a href="{{ route('home.register') }}" class="btn btn-custom text-nowrap">
                            Đăng ký
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </header>
</div>

<style>
    /* Khi di chuột vào mục menu */
    .navbar-nav .nav-item .nav-link:hover,
    .navbar-nav .dropdown-menu .dropdown-item:hover {
        font-weight: bold;
        /* Chữ in đậm */
        color: #00bef4 !important;
        /* Màu xanh dương */
    }

    /* Định dạng mặc định: Nền trắng, chữ màu #00bef4 */
    .btn-custom {
        background-color: white;
        color: #00bef4 !important;
        border: 2px solid #00bef4;
        /* Viền cùng màu chữ */
        transition: all 0.3s ease-in-out;
        /* Hiệu ứng mượt */
    }

    /* Khi di chuột vào: Nền #00bef4, chữ trắng */
    .btn-custom:hover {
        background: linear-gradient(to right, #00c6ff, #0072ff) !important;
        color: white !important;
    }
</style>

<div>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                <div class="offcanvas-header bg-white">
                    <a href="{{ route('home.index') }}" class="offcanvas-title" id="offcanvasNavbarLabel">
                        <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="48"
                            alt="Logo web Dặt lịch khám">
                    </a>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                        aria-label="Close"></button>
                </div>

                <div class="d-lg-none p-3 justify-content-center bg-info-subtle">
                    @if (Auth::check())
                        <div class="dropdown">
                            <a class="nav-link dropdown-toggle dropdown" href="#" data-bs-toggle="dropdown">
                                <span class="text-primary fw-bold border border-primary rounded px-2 py-1">
                                    {{ $user->name }}
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('home.profile') }}">
                                        <i class="align-middle me-1" data-feather="user"></i> Trang cá nhân
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('home.hosobenhnhan') }}">
                                        <i class="bi bi-clipboard-pulse align-middle me-1"></i> Hồ sơ bệnh nhân
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="align-middle me-1" data-feather="log-out"></i> Đăng xuất
                                    </a>
                                </li>
                            </ul>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    @else
                        <div class="pb-2">
                            Đăng nhập để hưởng những đặc quyền dành riêng cho thành viên.
                        </div>

                        <a href="{{ route('home.login') }}" class="btn btn-custom me-1 text-nowrap">
                            Đăng nhập
                        </a>
                        <a href="{{ route('home.register') }}" class="btn btn-custom text-nowrap">
                            Đăng ký
                        </a>
                    @endif
                </div>

                <div class="offcanvas-body">
                    <ul class="navbar-nav justify-content-center flex-grow-1 pe-3">
                        <li class="nav-item dropdown">
                            <a class="nav-link" href="{{ route('home.index') }}" role="button"
                                aria-expanded="false">Trang chủ</a>
                        </li>
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle @if (strpos($_SERVER['REQUEST_URI'], 'dat-kham') !== false) active @endif"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Dịch vụ y tế
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('datkham_coso.index') }}">Đặt khám tại cơ
                                        sở</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('datkham_chuyenkhoa.index') }}">Đặt khám
                                        theo chuyên khoa</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('datkham_bacsi.index') }}">Đặt khám theo
                                        bác sĩ</a>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if (strpos($_SERVER['REQUEST_URI'], 'tintuc') !== false) active @endif"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Tin tức
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('tintuc.show', ['loai' => 1]) }}">Tin
                                        dịch vụ</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('tintuc.show', ['loai' => 2]) }}">Tin y
                                        tế</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('tintuc.show', ['loai' => 3]) }}">Y tế
                                        thường thức</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle @if (strpos($_SERVER['REQUEST_URI'], 'huong-dan') !== false) active @endif"
                                href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Hướng dẫn
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="{{ route('huongdan') }}">Đặt lịch khám</a>

                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('cauhoi') }}">Câu hỏi thường gập</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </nav>


</div>
