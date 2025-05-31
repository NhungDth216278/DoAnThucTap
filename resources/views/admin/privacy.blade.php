@extends('admin.main')


@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold"><i data-feather="shield" class="me-2"></i>Chính sách quyền riêng tư</h2>

    <p class="text-muted">Chúng tôi cam kết bảo vệ quyền riêng tư và bảo mật thông tin cá nhân của người dùng khi sử dụng hệ thống đặt lịch khám.</p>

    <div class="mb-4">
        <h4><i data-feather="info" class="me-1"></i>1. Thông tin thu thập</h4>
        <p>Chúng tôi có thể thu thập các thông tin sau từ bạn:</p>
        <ul>
            <li>Họ tên, số điện thoại, địa chỉ, ngày sinh, CCCD, giới tính.</li>
            <li>Thông tin lịch sử đặt lịch khám.</li>
            <li>Thông tin tài khoản khi đăng ký, đăng nhập.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="lock" class="me-1"></i>2. Mục đích sử dụng thông tin</h4>
        <p>Thông tin của bạn sẽ được sử dụng cho các mục đích:</p>
        <ul>
            <li>Xác nhận và quản lý các cuộc hẹn khám bệnh.</li>
            <li>Gửi thông báo, nhắc nhở hoặc cập nhật về lịch khám.</li>
            <li>Cải thiện chất lượng dịch vụ và hỗ trợ khách hàng.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="users" class="me-1"></i>3. Chia sẻ thông tin</h4>
        <p>Chúng tôi không chia sẻ thông tin cá nhân cho bên thứ ba ngoại trừ:</p>
        <ul>
            <li>Bệnh viện, phòng khám nơi bạn đặt lịch.</li>
            <li>Cơ quan có thẩm quyền khi có yêu cầu hợp pháp.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="shield-off" class="me-1"></i>4. Bảo mật thông tin</h4>
        <p>Chúng tôi áp dụng các biện pháp kỹ thuật và quản lý để đảm bảo an toàn cho dữ liệu người dùng, bao gồm:</p>
        <ul>
            <li>Sử dụng kết nối bảo mật (HTTPS).</li>
            <li>Mã hóa thông tin nhạy cảm.</li>
            <li>Giới hạn truy cập thông tin cá nhân.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="edit" class="me-1"></i>5. Quyền của người dùng</h4>
        <p>Bạn có quyền:</p>
        <ul>
            <li>Xem, cập nhật hoặc yêu cầu xóa thông tin cá nhân.</li>
            <li>Yêu cầu ngừng sử dụng thông tin của bạn cho mục đích tiếp thị.</li>
            <li>Liên hệ với chúng tôi để thực hiện các quyền của mình.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="refresh-cw" class="me-1"></i>6. Thay đổi chính sách</h4>
        <p>Chúng tôi có thể cập nhật chính sách này theo thời gian. Các thay đổi sẽ được thông báo công khai trên website.</p>
    </div>

    <div class="mb-4">
        <h4><i data-feather="mail" class="me-1"></i>7. Liên hệ</h4>
        <p>Mọi thắc mắc về chính sách quyền riêng tư xin vui lòng liên hệ:</p>
        <ul class="list-unstyled">
            <li><strong>Email:</strong> baomat@bacsi24h.vn</li>
            <li><strong>Hotline:</strong> 1900 1234</li>
        </ul>
    </div>

    <p class="text-center text-muted mt-5">Chúng tôi cam kết giữ gìn sự riêng tư và bảo vệ thông tin của bạn.</p>
</div>
@endsection

@section('scripts')
<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>
@endsection

