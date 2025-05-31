@extends('admin.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@section('content')
    <div class="container">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('lichkham.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các lịch khám
        </a>
        <h2>Chi Tiết Lịch Khám</h2>

        <div class="card">
            <div class="card-body">
                <h4>Bác Sĩ: {{ $lichKham->bacsi->hoten }}</h4>
                <p><strong>Chuyên Khoa:</strong> {{ $lichKham->bacsi->chuyenkhoa->tenkhoa }}</p>
                <p><strong>Cơ Sở:</strong> {{ $lichKham->bacsi->coso->tencoso }}</p>
                <p><strong>Ngày Khám:</strong> {{ $lichKham->ngaykham }}</p>
                <p><strong>Buổi:</strong> {{ $lichKham->buoi }}</p>

                <h4 class="mt-4">Danh Sách Khung Giờ</h4>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Thời Gian Bắt Đầu</th>
                            <th>Thời Gian Kết Thúc</th>
                            <th>Số Lượng Tối Đa</th>
                            <th>Số Lượng Đã Đặt</th>
                            <th>Trạng Thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lichKham->khungGios as $khungGio)
                            <tr>
                                <td>{{ $khungGio->thoigianbatdau }}</td>
                                <td>{{ $khungGio->thoigianketthuc }}</td>
                                <td>{{ $khungGio->pivot->soluongtoida }}</td>
                                <td>{{ $khungGio->pivot->soluongdadat }}</td>
                                <td>
                                    @if ($khungGio->pivot->trangthai == 1)
                                        <span class="badge bg-success">Đang Nhận Đặt</span>
                                    @elseif($khungGio->pivot->trangthai == 0)
                                        <span class="badge bg-danger">Đã Đầy</span>
                                    @elseif($khungGio->pivot->trangthai == 2)
                                        <span class="badge bg-secondary">Không thể đặt</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
