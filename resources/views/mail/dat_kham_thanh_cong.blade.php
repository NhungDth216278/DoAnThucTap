<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <title>Đặt khám thành công</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f9f9f9;
            padding: 20px;
        }

        .container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
            color: #4CAF50;
        }

        .content {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
        }

        .order-info {
            margin-top: 20px;
        }

        .order-info p {
            margin: 5px 0;
        }

        .footer {
            margin-top: 30px;
            font-size: 14px;
            color: #888;
        }

        .order-table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        .order-table th,
        .order-table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }

        .order-table th {
            background-color: #f1f1f1;
        }

        .discount-price {
            text-decoration: line-through;
            color: #6c757d;
            font-size: 0.9em;
        }

        .total-price {
            text-align: right;
        }

        .tfoot-total {
            font-weight: bold;
            color: #4CAF50;
            text-align: right;
        }

        .tfoot-label {
            font-weight: bold;
            color: #4CAF50;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">Cảm ơn bạn đã đặt khám bệnh tại <strong>EbookCare</strong>!</div>
        <div class="content">
            Xin chào người dùng có tài khoản {{ $user->name }},
            <br>
            Chúng tôi rất cảm ơn bạn đã tin tưởng và lựa chọn dịch vụ đặt khám của chúng tôi.
            <br><br>
            Thông tin đặt lịch khám của bạn:
            <p><strong>Thông tin bệnh nhân:</strong></p>
            <ul>
                <li>Họ tên: {{ $benhNhan->hoten }}</li>
                <li>Ngày sinh: {{ \Carbon\Carbon::parse($benhNhan->ngaysinh)->format('d/m/Y') }}</li>

            </ul>

            <p><strong>Thông tin lịch khám:</strong></p>
            <ul>
                <div style="text-align: center;">
                    <img src="{{ $message->embed($imageCoso) }}" alt="Cơ sở" width="150">
                    <h2>{{ $bacSi->coso->tencoso }}</h2>
                </div>

                <li>Tên cơ sở: {{ $bacSi->coSo->tencoso }}</li>
                <li>Chuyên khoa: {{ $bacSi->chuyenKhoa->tenkhoa }}</li>
                <li>Bác sĩ: {{ implode(' ', [$bacSi->hocham, $bacSi->hoten]) }}</li>
                <li>Ngày khám: {{ \Carbon\Carbon::parse($lichHen->ngayhen)->format('d/m/Y') }}</li>
                <li>Buổi: {{ $lichHen->buoi }}</li>
                <li>Thời gian: {{ $lichHen->thoigian }}</li>
            </ul>

            <p> Một lần nữa xin chân thành quý khách đã đặt khám. Vui lòng đến đúng giờ để được phục vụ tốt nhất!</p>
        </div>
        <div class="footer">
            {{ config('app.name') }} - Hotline: 0123 456 789
        </div>
    </div>
</body>

</html>
