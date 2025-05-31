@extends('trangchu.main')
<!-- Thêm Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Thêm Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
@section('content')
    <div class="container">
        <a class="btn btn-info mb-4 rounded-start-5 mt-4" href="{{ route('home.hosobenhnhan') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các bệnh nhân
        </a>
        <h4>Danh sách lịch hẹn của: {{ $benhnhan->hoten }}</h4>

        @if ($benhnhan->lichhen->isEmpty())
            <div class="alert alert-info">Bệnh nhân chưa có lịch hẹn nào.</div>
        @else
            <table class="table table-bordered mt-3">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">STT</th>
                        <th>Bác sĩ</th>
                        <th class="d-none d-lg-table-cell">Cơ sở</th>
                        <th class="d-none d-md-table-cell">Chuyên khoa</th>
                        <th>Ngày hẹn</th>
                        <th>Buổi</th>
                        <th>Thời gian</th>
                        <th>Giá khám</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($benhnhan->lichhen as $key => $hen)
                        <tr>
                            <td class="d-none d-md-table-cell">{{ $key + 1 }}</td>
                            <td>{{ $hen->bacsi->hoten ?? 'Không có' }}</td>
                            <td class="d-none d-lg-table-cell">{{ $hen->bacsi->coso->tencoso ?? 'Không có' }}</td>
                            <td class="d-none d-md-table-cell">{{ $hen->bacsi->chuyenkhoa->tenkhoa ?? 'Không có' }}</td>
                            <td>{{ $hen->ngayhen }}</td>
                            <td>{{ $hen->buoi }}</td>
                            <td>{{ $hen->thoigian }}</td>
                            <td>{{ number_format($hen->giakham) }} đ</td>
                            <td>
                                @if ($hen->trangthai == 0)
                                    <span class="badge bg-danger">Đã hủy</span>
                                @elseif($hen->trangthai == 1)
                                    <span class="badge bg-primary">Thành công</span>
                                @else
                                    <span class="badge bg-success">Đã khám</span>
                                @endif
                            </td>
                            <td class="text-center">
                                @php
                                $thoiGianConLai = \Carbon\Carbon::parse($hen->ngayhen)->diffInHours(now(), false);
                            @endphp
                                @if ($hen->trangthai == 1 && $thoiGianConLai <= -12)
                                    <form action="{{ route('lichhen.huy', $hen->id) }}" method="POST"
                                        onsubmit="return confirm('Bạn có chắc chắn muốn hủy lich hẹn có id {{ $hen->id }} của bệnh nhân {{ $benhnhan->hoten }} không?');">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="bi bi-x-circle"></i> Hủy
                                        </button>
                                    </form>
                                @endif

                                @if ($hen->trangthai == 0)

                                    <a href="{{ route('lichhen.xoa', ['id' => $hen->id]) }}"
                                        onclick="return confirm('Bạn có chắc chắn muốn xóa lich hẹn có id {{ $hen->id }} của bệnh nhân {{ $benhnhan->hoten }} không?');"
                                        class="btn btn-danger btn-sm">
                                        <i class="align-middle" data-feather="trash-2"></i>
                                    </a>

                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9" class="text-center">Chưa có lịch hẹn nào</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        @endif
    </div>


@endsection
