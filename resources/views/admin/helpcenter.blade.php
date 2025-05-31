@extends('admin.main')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold"><i data-feather="help-circle" class="me-2"></i>Trung tâm Trợ giúp</h2>

    <div class="mb-5">
        <h4><i data-feather="book-open" class="me-1"></i> 1. Hướng dẫn đặt lịch khám</h4>
        <ol>
            <li>Chọn <strong>Chuyên khoa</strong> cần khám</li>
            <li>Chọn <strong>Bác sĩ</strong> hoặc <strong>Cơ sở y tế</strong></li>
            <li>Chọn <strong>ngày khám</strong>, <strong>buổi khám</strong> và <strong>khung giờ</strong></li>
            <li>Nhập <strong>thông tin bệnh nhân</strong></li>
            <li>Nhấn <strong>Xác nhận</strong> để hoàn tất đặt lịch</li>
        </ol>
        <p><i class="text-muted">💡 Sau khi đặt lịch thành công, bạn có thể xem lại lịch hẹn trong mục <strong>"Hồ sơ bệnh nhân"</strong>.</i></p>
    </div>

    <div class="mb-5">
        <h4><i data-feather="user" class="me-1"></i> 2. Quản lý tài khoản</h4>
        <ul>
            <li>Cập nhật thông tin cá nhân: họ tên, số điện thoại, địa chỉ...</li>
            <li>Đổi mật khẩu trong phần <strong>Cài đặt tài khoản</strong></li>
        </ul>
    </div>

    <div class="mb-5">
        <h4><i data-feather="calendar" class="me-1"></i> 3. Theo dõi & Quản lý lịch hẹn</h4>
        <ul>
            <li>Truy cập mục <strong>"Lịch hẹn của tôi"</strong> để xem chi tiết</li>
            <li>Có thể <strong>hủy lịch</strong> nếu không thể đi khám</li>
            <li>Hệ thống sẽ cập nhật trạng thái lịch hẹn liên tục</li>
        </ul>
    </div>

    <div class="mb-5">
        <h4><i data-feather="help-circle" class="me-1"></i> 4. Câu hỏi thường gặp</h4>
        <ul>
            <li><strong>Q:</strong> Tôi có cần tạo tài khoản để đặt lịch không?
                <br><strong>A:</strong> Có, để bạn dễ dàng quản lý lịch hẹn của mình.</li>
            <li><strong>Q:</strong> Có thể đặt nhiều lịch không?
                <br><strong>A:</strong> Có thể, miễn không trùng thời gian.</li>
            <li><strong>Q:</strong> Hệ thống có nhắc lịch không?
                <br><strong>A:</strong> Có, qua email hoặc SMS nếu bạn đã điền thông tin.</li>
            <li><strong>Q:</strong> Có đổi giờ khám được không?
                <br><strong>A:</strong> Hủy lịch cũ và đặt lại lịch mới.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="phone" class="me-1"></i> 5. Liên hệ hỗ trợ</h4>
        <ul class="list-unstyled">
            <li><strong>Email:</strong> hotro@bacsi24h.vn</li>
            <li><strong>Hotline:</strong> 1900 1234</li>
            <li><strong>Giờ làm việc:</strong> Thứ 2 - Thứ 7 (8:00 - 17:00)</li>
        </ul>
    </div>
</div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
        feather.replace();
    </script>
@endsection
