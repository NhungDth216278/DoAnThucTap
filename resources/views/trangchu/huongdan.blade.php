@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <div class="container">
        <header class="text-center my-4">
            <h1 class="text-primary">Hướng dẫn đặt khám nhanh</h1>
            <p class="text-muted">Trải nghiệm dịch vụ chăm sóc sức khỏe tối ưu và đặt lịch khám một cách dễ dàng, nhanh chóng
                với EbookCare</p>
        </header>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold text-dark fs-2">CHỌN THÔNG TIN ĐẶT KHÁM</h2>
                <ul class="fs-4">
                    <li>Tạo hoặc đăng nhập tài khoản trên website hoặc ứng dụng di động.</li>
                    <li>Chọn Đặt khám tại cơ sở hoặc Đặt khám theo bác sĩ.</li>
                    <li>Chọn cơ sở khám bệnh.</li>
                    <li>Chọn thông tin khám: Chuyên khoa, bác sĩ, ngày khám, giờ khám và có BHYT hay không.</li>
                    <li>Nhập thông tin bệnh nhân: Tạo mới hồ sơ mới hoặc chọn hồ sơ sẵn có.</li>
                </ul>

            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold text-dark fs-2">CHỌN/ TẠO MỚI HỒ SƠ BỆNH NHÂN</h2>
                <ul class="fs-4">
                    <li><b>Cách 1:</b> Quét mã BHYT.</li>
                    <li><b>Cách 2:</b> Nếu đã từng khám ở bệnh viện, nhập số hồ sơ.</li>
                    <li><b>Cách 3:</b> Chưa từng khám, đăng ký mới (nhập đầy đủ thông tin: Họ và tên, Ngày sinh, Giới tính,
                        Mã bảo hiểm y tế,...).</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold text-dark fs-2">THANH TOÁN PHÍ KHÁM</h2>
                <ul class="fs-4">
                    <li>Chọn phương thức thanh toán: Quét mã QR, Chuyển khoản 24/7, Thẻ khám bệnh,...</li>
                    <li>Kiểm tra thông tin thanh toán và xác nhận thanh toán.</li>
                    <li>Thực hiện thanh toán trên Ví điện tử hoặc Ứng dụng Ngân hàng.</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold text-dark fs-2">NHẬN PHIẾU KHÁM ĐIỆN TỬ</h2>
                <ul class="fs-4">
                    <li>Sau khi thanh toán thành công, bạn sẽ nhận được ngay phiếu khám bệnh điện tử.</li>
                </ul>
            </div>
        </div>

        <div class="card mb-4">
            <div class="card-body">
                <h2 class="fw-bold text-dark fs-2">Khám và thực hiện cận lâm sàng</h2>
                <ul class="fs-4">
                    <li>Đến ngày khám, vui lòng đến trực tiếp phòng khám hoặc quầy tiếp nhận.</li>
                    <li>Người bệnh được khám lâm sàng theo quy trình của Bệnh viện.</li>
                    <li>Nếu có chỉ định cận lâm sàng của bác sĩ, thực hiện thanh toán và vào phòng cận lâm sàng.</li>
                    <li>Người bệnh quay lại phòng khám ban đầu để nhận kết quả.</li>
                </ul>
            </div>
        </div>

    </div>
@endsection
