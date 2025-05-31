<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: #f4f4f7;
            padding: 30px;
            margin: 0;
        }

        .email-container {
            max-width: 600px;
            margin: auto;
            background: white;
            border-radius: 12px;
            border: 1px solid #ddd;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .email-header {
            background: linear-gradient(to right, #00c6ff, #0072ff);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            border-bottom: 1px solid #ddd;
        }

        .email-header a {
            color: white;
            /* Đặt màu chữ trắng */
            text-decoration: none;
            /* Xóa gạch chân */
        }

        .email-header h3 {
            text-align: center;
            font-size: 24px;
            margin: 0;
            /* Loại bỏ khoảng cách mặc định quanh h3 */
        }

        .email-body {
            padding: 30px;
        }

        .password-box {
            background: #f1f1f1;
            padding: 20px;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            border-radius: 8px;
            margin: 20px 0;
        }

        .btn {
            display: inline-block;
            background: #198754;
            color: white;
            padding: 12px 25px;
            text-decoration: none;
            border-radius: 6px;
            margin-top: 20px;
        }

        .btn-wrapper {
            text-align: center;
            margin-bottom: 30px;
        }

        .footer {
            padding-top: 20px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <a href="{{ route('home.index') }}">
                <h3>Đặt lịch khám - EbookCare</h3>
            </a>
        </div>

        <div class="email-body">
            <p><strong>Xin chào</strong>,</p>
            <p>Bạn nhận được email này vì đã yêu cầu EbookCare khôi phục mật khẩu cho tài khoản của mình.</p>

            <p>Liên kết khôi phục mật khẩu này sẽ hết hạn sau 5 phút.</p>

            <p>Xin vui lòng nhấn vào nút <strong>"Khôi phục mật khẩu"</strong> bên dưới để tiến hành cấp mật khẩu mới.
            </p>

            <div class="btn-wrapper mt-3">
                <a href="{{ $link }}"
                    style="background-color: #1d72b8; color: white; padding: 10px 20px; text-decoration: none;">
                    Khôi phục mật khẩu
                </a>
            </div>

            <div class="footer">
                Nếu bạn không yêu cầu đặt lại mật khẩu, xin vui lòng không làm gì thêm và báo lại cho quản trị hệ thống
                về vấn đề này.<br>
                Cảm ơn bạn đã sử dụng hệ thống của chúng tôi.<br>
                Trân trọng, <br>
                {{ config('app.name') }}
            </div>
        </div>
    </div>
</body>

</html>
