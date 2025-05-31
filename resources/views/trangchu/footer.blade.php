
<style>
    .footer {
        font-size: 14px;
        line-height: 1.7;
    }

    .footer a {
        color: #000;
        text-decoration: none;
    }

    .footer a:hover {
        color: #007bff;
        text-decoration: underline;
    }
</style>
<footer class="footer bg-white text-dark py-5 mt-5 border-top">
    <div class="container">
        <div class="row">
            <!-- Cột thông tin liên hệ -->
            <div class="col-md-3">
                <a href="{{ route('home.index') }}" class="d-inline-flex link-body-emphasis text-decoration-none">
                    <img src="{{ asset('imgs/Logo_EbookCare.png') }}" height="45" alt="Logo web Đặt lịch khám">
                </a>
            </div>

            <!-- Dịch vụ Y tế -->
            <div class="col-md-3 mb-0">
                <h6 class="fw-bold">DỊCH VỤ Y TẾ</h6>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="{{ route('datkham_coso.index') }}">Đặt khám theo cơ
                            sở</a></li>
                    <li><a class="text-decoration-none" href="{{ route('datkham_chuyenkhoa.index') }}">Đặt khám theo chuyên khoa</a></li>
                    <li><a class="text-decoration-none" href="{{ route('datkham_bacsi.index') }}">Đặt khám theo bác sĩ</a></li>
                </ul>
            </div>


            <!-- Cơ sở y tế -->
            <div class="col-md-2 mb-2">
                <h6 class="fw-bold">TIN TỨC</h6>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="{{ route('tintuc.show', ['loai' => 1]) }}">Tin dịch vụ</a></li>
                    <li><a class="text-decoration-none" href="{{ route('tintuc.show', ['loai' => 2]) }}">Tin y tế</a></li>
                    <li><a class="text-decoration-none" href="{{ route('tintuc.show', ['loai' => 3]) }}">Y tế thường thức</a></li>
                </ul>
            </div>

            <!-- Hướng dẫn -->
            <div class="col-md-2 mb-2">
                <h6 class="fw-bold">HƯỚNG DẪN</h6>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="{{ route('huongdan') }}">Đặt lịch khám</a></li>
                    <li><a class="text-decoration-none" href="{{ route('cauhoi') }}">Câu hỏi thường gặp</a></li>
                </ul>
            </div>
            <!-- Về Medpro -->
            <div class="col-md-2 mb-2">
                <h6 class="fw-bold">Về EbookCare</h6>
                <ul class="list-unstyled">
                    <li><a class="text-decoration-none" href="{{ route('home.gioithieu') }}">Giới thiệu</a></li>
                    <li><a class="text-decoration-none" href="{{ route('home.dieukhoan') }}">Điều khoản dịch vụ</a></li>
                    <li><a class="text-decoration-none" href="{{ route('home.chinhsach') }}">Chính sách bảo mật</a></li>
                    <li><a class="text-decoration-none" href="{{ route('home.quydinh') }}">Quy định sử dụng</a></li>
                </ul>
            </div>
        </div>

        <div class="row mt-4 justify-content-end">
            <!-- Liên hệ hợp tác -->
            <div class="col-md-2 mb-3">
                <h6 class="fw-bold">KẾT NỐI VỚI CHÚNG TÔI</h6>
                <a href="https://www.tiktok.com/@datvo_03" target="_blank">
                    <img src="{{ asset('imgs/tiktok_logo.jpeg') }}" alt="Tiktok" width="30">
                </a>
                <a href="https://www.facebook.com/share/15ygFJkizW/" target="_blank">
                    <img src="{{ asset('imgs/facebook_logo.svg') }}" alt="Facebook" width="30">
                </a>
                <a href="https://id.zalo.me/" target="_blank">
                    <img src="{{ asset('imgs/zalo_logo.svg') }}" alt="Zalo" width="30">
                </a>
            </div>

        </div>
    </div>
</footer>
