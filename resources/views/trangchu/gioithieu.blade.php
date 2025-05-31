@extends('trangchu.main') {{-- Kế thừa layout chính --}}

@section('title', 'Giới thiệu hệ thống đặt lịch khám')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <h1 class="mb-4 text-primary fw-bold">Giới thiệu về Hệ thống Đặt lịch khám bệnh</h1>

            <p class="lead">
                Website <strong>Đặt lịch khám bệnh</strong> được xây dựng nhằm giúp người dân thuận tiện hơn trong việc đăng ký khám bệnh tại các cơ sở y tế mà không cần phải xếp hàng hoặc chờ đợi lâu tại bệnh viện.
            </p>

            <h4 class="mt-4 text-success">Tính năng nổi bật</h4>
            <ul class="list-unstyled ps-3">
                <li>✔️ Tìm kiếm và chọn <strong>chuyên khoa</strong>, <strong>bác sĩ</strong> phù hợp</li>
                <li>✔️ Đặt lịch khám theo <strong>ngày</strong> và <strong>khung giờ</strong> linh hoạt</li>
                <li>✔️ Quản lý <strong>thông tin cá nhân</strong> và <strong>lịch hẹn</strong> dễ dàng</li>
                <li>✔️ Hệ thống gửi thông báo và cập nhật trạng thái lịch hẹn</li>
            </ul>

            <h4 class="mt-4 text-success">Lợi ích khi sử dụng</h4>
            <ul class="list-unstyled ps-3">
                <li>🕒 Tiết kiệm thời gian chờ đợi tại bệnh viện</li>
                <li>🏥 Chủ động chọn bệnh viện, chuyên khoa, bác sĩ theo nhu cầu</li>
                <li>📱 Đặt lịch mọi lúc, mọi nơi qua điện thoại hoặc máy tính</li>
                <li>🔒 Bảo mật thông tin người dùng</li>
            </ul>

            <h4 class="mt-4 text-success">Liên hệ hỗ trợ</h4>
            <p>Nếu bạn cần hỗ trợ, vui lòng liên hệ qua email: <a href="mailto:hotro@benhvien.com">hotro@benhvien.com</a> hoặc hotline: <strong>1800 1234</strong>.</p>

            <div class="mt-5 text-center">
                <a href="{{ route('home.index') }}" class="btn btn-primary px-4">Bắt đầu đặt lịch ngay</a>
            </div>
        </div>
    </div>
</div>
@endsection
