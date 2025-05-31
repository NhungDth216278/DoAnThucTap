@extends('trangchu.main')

@section('title', 'Quy định sử dụng')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 text-primary">Quy Định Sử Dụng</h1>

    <p>Chào mừng bạn đến với hệ thống đặt lịch khám bệnh trực tuyến tại các bệnh viện. Khi sử dụng trang web này, bạn đã đồng ý tuân thủ các quy định dưới đây. Vui lòng đọc kỹ trước khi tiếp tục sử dụng dịch vụ.</p>

    <h4 class="mt-4">1. Chấp nhận điều khoản</h4>
    <p>Khi truy cập và sử dụng hệ thống, bạn đồng ý với các điều khoản, điều kiện và quy định được đưa ra trong trang này. Nếu bạn không đồng ý, vui lòng ngừng sử dụng dịch vụ.</p>

    <h4 class="mt-4">2. Đối tượng sử dụng</h4>
    <p>Trang web phục vụ cho tất cả cá nhân có nhu cầu đặt lịch khám bệnh tại các bệnh viện, phòng khám hợp tác với hệ thống. Người dùng phải cung cấp thông tin chính xác, trung thực và chịu trách nhiệm về thông tin mình đã cung cấp.</p>

    <h4 class="mt-4">3. Quyền và nghĩa vụ của người dùng</h4>
    <ul>
        <li>Cung cấp thông tin đầy đủ khi đặt lịch (họ tên, số điện thoại, ngày sinh, CCCD, ...).</li>
        <li>Không sử dụng hệ thống để thực hiện hành vi giả mạo, spam hoặc phá hoại.</li>
        <li>Tuân thủ đúng lịch hẹn và các hướng dẫn của bệnh viện.</li>
        <li>Bảo mật thông tin tài khoản và không chia sẻ với người khác.</li>
    </ul>

    <h4 class="mt-4">4. Quyền và trách nhiệm của hệ thống</h4>
    <ul>
        <li>Cung cấp nền tảng đặt lịch khám bệnh tiện lợi và hiệu quả.</li>
        <li>Hỗ trợ người dùng khi có sự cố xảy ra trong quá trình đặt lịch.</li>
        <li>Không chịu trách nhiệm nếu người dùng cung cấp sai thông tin hoặc bỏ lỡ lịch hẹn.</li>
        <li>Có quyền từ chối phục vụ người dùng vi phạm quy định.</li>
    </ul>

    <h4 class="mt-4">5. Hủy và thay đổi lịch hẹn</h4>
    <p>Người dùng có thể hủy hoặc thay đổi lịch hẹn trước thời gian quy định của từng bệnh viện. Một số lịch hẹn không thể thay đổi nếu quá gần thời điểm khám.</p>

    <h4 class="mt-4">6. Bảo mật thông tin</h4>
    <p>Chúng tôi cam kết bảo mật thông tin cá nhân theo <a href="{{ route('home.chinhsach') }}">Chính sách bảo mật</a> của hệ thống.</p>

    <h4 class="mt-4">7. Thay đổi quy định</h4>
    <p>Chúng tôi có thể điều chỉnh các quy định sử dụng bất kỳ lúc nào mà không cần thông báo trước. Các thay đổi sẽ có hiệu lực kể từ khi được cập nhật trên website.</p>

    <h4 class="mt-4">8. Liên hệ</h4>
    <p>Nếu bạn có bất kỳ thắc mắc hoặc phản hồi nào, vui lòng liên hệ:</p>
    <p>Email: <a href="mailto:hotro@hethongkham.vn">hotro@hethongkham.vn</a><br>
       Điện thoại: 1900 9999</p>

    <p class="mt-4"><strong>Xin cảm ơn bạn đã sử dụng hệ thống đặt lịch khám của chúng tôi!</strong></p>
</div>
@endsection
