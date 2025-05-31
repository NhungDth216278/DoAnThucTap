@extends('admin.main')

@section('content')
<div class="container py-4">
    <h2 class="mb-4 text-primary fw-bold"><i data-feather="file-text" class="me-2"></i>Điều khoản sử dụng</h2>

    <p class="text-muted">Vui lòng đọc kỹ các điều khoản dưới đây trước khi sử dụng hệ thống đặt lịch khám bệnh trực tuyến.</p>

    <div class="mb-4">
        <h4><i data-feather="check-circle" class="me-1"></i>1. Chấp nhận điều khoản</h4>
        <p>Khi sử dụng website, bạn đồng ý tuân thủ các điều khoản sử dụng này. Nếu bạn không đồng ý với bất kỳ điều khoản nào, vui lòng không tiếp tục sử dụng dịch vụ.</p>
    </div>

    <div class="mb-4">
        <h4><i data-feather="user-check" class="me-1"></i>2. Tài khoản người dùng</h4>
        <ul>
            <li>Người dùng cần đăng ký tài khoản để sử dụng đầy đủ chức năng.</li>
            <li>Thông tin cá nhân cung cấp phải chính xác và đầy đủ.</li>
            <li>Người dùng chịu trách nhiệm bảo mật thông tin đăng nhập.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="calendar" class="me-1"></i>3. Quy định về đặt lịch khám</h4>
        <ul>
            <li>Chỉ được đặt lịch cho bản thân hoặc người được ủy quyền.</li>
            <li>Không đặt nhiều lịch trùng nhau gây ảnh hưởng đến hệ thống và bác sĩ.</li>
            <li>Cần đến đúng giờ theo lịch đã hẹn. Hủy lịch nếu không thể tham gia.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="lock" class="me-1"></i>4. Bảo mật thông tin</h4>
        <p>Chúng tôi cam kết bảo mật các thông tin cá nhân theo quy định pháp luật. Mọi dữ liệu sẽ được sử dụng cho mục đích chăm sóc sức khỏe và không chia sẻ cho bên thứ ba nếu không được phép.</p>
    </div>

    <div class="mb-4">
        <h4><i data-feather="alert-circle" class="me-1"></i>5. Hành vi bị nghiêm cấm</h4>
        <ul>
            <li>Giả mạo danh tính người khác.</li>
            <li>Đặt lịch giả mạo hoặc gây rối hệ thống.</li>
            <li>Can thiệp, tấn công hoặc phá hoại hệ thống website.</li>
        </ul>
    </div>

    <div class="mb-4">
        <h4><i data-feather="refresh-ccw" class="me-1"></i>6. Thay đổi điều khoản</h4>
        <p>Chúng tôi có quyền cập nhật và thay đổi các điều khoản sử dụng này bất cứ lúc nào. Các thay đổi sẽ được thông báo trên hệ thống. Việc tiếp tục sử dụng dịch vụ sau khi điều khoản thay đổi có nghĩa là bạn đã đồng ý với điều khoản mới.</p>
    </div>

    <div class="mb-4">
        <h4><i data-feather="mail" class="me-1"></i>7. Liên hệ</h4>
        <p>Nếu bạn có bất kỳ thắc mắc hoặc góp ý nào liên quan đến điều khoản sử dụng, vui lòng liên hệ:</p>
        <ul class="list-unstyled">
            <li><strong>Email:</strong> hotro@bacsi24h.vn</li>
            <li><strong>Hotline:</strong> 1900 1234</li>
        </ul>
    </div>

    <p class="text-center text-muted mt-5">Cảm ơn bạn đã sử dụng dịch vụ của chúng tôi!</p>
</div>
@endsection

