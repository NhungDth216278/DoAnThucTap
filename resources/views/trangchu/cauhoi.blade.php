@extends('trangchu.main')
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
    /* Xóa đường viền mặc định */
    .accordion-item {
        border: none;
        background-color: transparent;
    }

    /* Xóa viền mặc định của nút */
    .accordion-button {
        border: none;
        background-color: #f8f9fa;
        /* Nền nhẹ để phân biệt */
        color: #333;
        font-size: 16px;
        font-weight: bold;
        padding: 15px;
        transition: background-color 0.3s ease;
    }

    /* Khi hover vào nút câu hỏi */
    .accordion-button:hover {
        background-color: #e9ecef;
    }

    /* Khi câu hỏi đang mở */
    .accordion-button:not(.collapsed) {
        background-color: #e9ecef;
        color: #007bff;
    }

    /* Xóa border khi collapse */
    .accordion-collapse {
        border: none;
    }

    /* Nội dung câu trả lời */
    .accordion-body {
        font-size: 16px;
        background-color: white;
        /* Nền trắng giúp phân biệt */
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.1);
    }

    /* Tạo đường viền trắng giữa các câu hỏi */
    .accordion-item:not(:last-child) {
        border-bottom: 2px solid white;
    }
</style>
@section('content')
    <div class="container mt-4">
        <div class="row">
            <!-- Danh sách vấn đề bên trái -->
            <div class="col-md-3">

                <div class="list-group">
                    <h4 class="list-group-item list-group-item-action active">Câu hỏi thường gặp</h4>
                    <a href="#" class="list-group-item list-group-item-action" onclick="showQuestions('general')">
                        Vấn đề chung
                    </a>
                    <a href="#" class="list-group-item list-group-item-action" onclick="showQuestions('process')">
                        Vấn đề về quy trình đặt khám
                    </a>
                </div>
            </div>

            <!-- Nội dung câu hỏi bên phải -->
            <div class="col-md-9">
                <div id="general-questions" class="question-section">
                    <h4 class="fw-bold text-primary">Vấn đề chung</h4>
                    <div class="accordion" id="accordionGeneral">
                        <!-- Câu hỏi 1 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question1">
                                    Lợi ích khi sử dụng ứng dụng đăng ký khám bệnh trực tuyến này là gì?
                                </button>
                            </h2>
                            <div id="question1" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Đặt lịch khám bệnh dễ dàng và thuận tiện, mọi lúc, mọi nơi.</li>
                                        <li>Loại bỏ thời gian đứng xếp hàng chờ đợi.</li>
                                        <li>Giảm thời gian chờ đợi tại bệnh viện.</li>
                                        <li>Tự do lựa chọn lịch khám (ngày, giờ, bác sĩ).</li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 2 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question2">
                                    Đăng ký khám bệnh online có mất phí không?
                                </button>
                            </h2>
                            <div id="question2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Đăng ký khám bệnh trực tuyến qua ứng dụng EbookCare có thu phí tiện ích khi đăng ký thành
                                    công.
                                    Điều này có nghĩa là bạn chỉ cần thanh toán phí khi đi khám tại cơ sở.
                                    Các tính năng khác của ứng dụng, bao gồm việc sử dụng ứng dụng và truy cập vào các thông
                                    tin khác, thì hoàn toàn miễn phí.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 3 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question3">
                                    Ứng dụng có hỗ trợ đăng ký khám 24/7 không?
                                </button>
                            </h2>
                            <div id="question3" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    Có, ứng dụng EbookCare hỗ trợ đăng ký khám bệnh 24/7. Điều này có nghĩa là bạn có thể thực
                                    hiện việc đăng ký khám vào bất kỳ thời điểm nào trong ngày và bất kỳ ngày nào trong
                                    tuần.
                                    Đảm bảo rằng bạn có thể sử dụng ứng dụng để đăng ký khám bệnh mọi lúc mọi nơi, mà không
                                    cần phải đến trực tiếp bệnh viện để thực hiện.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 4 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question4">
                                    Đối tượng bệnh nhân nào có thể sử dụng ứng dụng?
                                </button>
                            </h2>
                            <div id="question4" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    EbookCare cho phép tất cả người bệnh đều có thể sử dụng phần mềm để đăng ký khám bệnh trực
                                    tuyến (có khả năng tiếp cận và sử dụng phần mềm).

                                    Ứng dụng phù hợp cho những người bệnh có kế hoạch khám chữa bệnh chủ động, hoặc tình
                                    trạng bệnh KHÔNG quá khẩn cấp.

                                    Trong trường hợp CẤP CỨU, người nhà nên đưa người bệnh đến cơ sở y tế gần nhất hoặc gọi
                                    số cấp cứu 115 để được hỗ trợ kịp thời.
                                </div>
                            </div>
                        </div>
                        <!-- Câu hỏi 5 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question5">
                                    Sau khi đã đăng ký khám thành công qua ứng dụng, có thể hủy phiếu khám không?

                                </button>
                            </h2>
                            <div id="question5" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Có, bạn có thể chủ động hủy phiếu khám đã đăng ký thành công, nếu kế hoạch khám chữa
                                    bệnh có sự thay đổi. Phí khám sẽ được hoàn trả theo đúng thời gian quy định.

                                    Hoặc trong một số trường hợp, bệnh viện có quyền từ chối phiếu khám, chẳng hạn như: sai
                                    lệch thông tin bệnh nhân, sai thông tin phiếu khám, hay vấn đề phát sinh bất khả kháng
                                    từ phía bệnh viện.

                                    Khi đó, bạn sẽ được hoàn tiền sau khi xác thực tình trạng sử dụng của phiếu khám, đảm
                                    bảo tuân thủ theo quy định của ứng dụng và bệnh viện.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 6 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question6">
                                    Tôi đến bệnh viện trễ hơn so với giờ khám đã đăng ký, vậy tôi có được khám hay không?
                                </button>
                            </h2>
                            <div id="question6" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Có. Trường hợp bạn đến trễ hơn so với giờ hẹn đã đặt khám bạn vẫn có thể được
                                    vào thăm khám tại bệnh viện. Tuy nhiên, mọi sự tiếp nhận và thời gian khám bệnh sẽ nghe
                                    theo sự sắp xếp của bệnh viện, phụ thuộc vào tình hình thực tế của bệnh viện ở thời điểm
                                    đó.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id="process-questions" class="question-section d-none">
                    <h4 class="fw-bold text-primary">Vấn đề về quy trình đặt khám</h4>
                    <div class="accordion" id="accordionProcess">
                        <!-- Câu hỏi 7 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question7">
                                    Quy trình đặt lịch khám bệnh trực tuyến như thế nào?
                                </button>
                            </h2>
                            <div id="question7" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <ul>
                                        <li>Đăng ký hoặc đăng nhập vào ứng dụng.</li>
                                        <li>Chọn cơ sở y tế và bác sĩ mong muốn.</li>
                                        <li>Chọn ngày và giờ khám phù hợp.</li>
                                        <li>Nhập thông tin bệnh nhân.</li>
                                        <li>Thanh toán trực tuyến và nhận xác nhận lịch khám.</li>
                                        <li>Đến bệnh viện đúng giờ để thực hiện khám.</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <!-- Thêm các câu hỏi khác nếu cần -->
                        <!-- Câu hỏi 8 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question8">
                                    Có thể đăng ký khám bệnh trong khoảng thời gian nào?
                                </button>
                            </h2>
                            <div id="question8" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Bạn có thể đăng ký khám bệnh qua phần mềm, mọi lúc mọi nơi. Có thể đặt lịch hẹn khám
                                    bệnh trước ngày khám đến 30 ngày.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 9 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question9">
                                    Tôi có thể thay đổi thông tin khám đã đặt qua phần mềm không?
                                </button>
                            </h2>
                            <div id="question9" class="accordion-collapse collapse">
                                <div class="accordion-body">

                                    Bạn không thể thay đổi thông tin khám trên phiếu khám bệnh đã đặt thành công.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 10 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question10">
                                    Tôi sẽ được khám bệnh vào đúng thời gian đã chọn, sau khi đăng ký khám qua phần mềm đúng
                                    không?
                                </button>
                            </h2>
                            <div id="question10" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Trả lời: Có thể.

                                    Thời gian bạn chọn khi đăng ký khám, được xem là thời gian khám bệnh dự kiến. Do đặc thù
                                    của công tác khám chữa bệnh, sẽ không thể chính xác thời gian khám 100%.
                                </div>
                            </div>
                        </div>

                        <!-- Câu hỏi 11 -->
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#question11">
                                    Tôi đã đăng ký thành công vậy khi đi khám tôi có phải xếp hàng gì không?

                                </button>
                            </h2>
                            <div id="question11" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Không, bạn không còn phải xếp hàng chờ đợi để lấy số khám bệnh,
                                    bạn chỉ cần đến quầy thu ngân để thanh toàn tiền để được hướng dẫn vào phòng khám.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showQuestions(section) {
            document.querySelectorAll('.question-section').forEach(div => div.classList.add('d-none'));
            document.getElementById(section + '-questions').classList.remove('d-none');
        }
    </script>
@endsection
