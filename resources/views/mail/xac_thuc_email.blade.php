<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Xác thực Email</title>
    <style>
        body {
            background-color: #f2f6fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
        }

        .email-container {
            max-width: 600px;
            margin: 40px auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        h2 {
            color: #0d6efd;
        }

        p {
            font-size: 16px;
            color: #333333;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 14px 28px;
            background-color: #0d6efd;
            color: #ffffff !important;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0b5ed7;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #777777;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <h2>Xác thực Email của bạn</h2>
        <p>Chào {{ $user->name }},</p>
        <p>Chúng tôi cần xác nhận rằng bạn là chủ sở hữu của địa chỉ email này.</p>
        <p>Vui lòng nhấn vào nút bên dưới để hoàn tất quá trình xác thực.</p>
        <a href="{{ $url }}" class="btn">Xác thực Email</a>
        <p class="footer">Lưu ý: Liên kết này sẽ hết hạn sau <strong>3 phút</strong> kể từ thời điểm bạn nhận được email.
        </p>
    </div>
</body>

</html>
