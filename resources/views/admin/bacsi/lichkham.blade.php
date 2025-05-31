@extends('admin.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@section('content')
    <div class="container"> <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('bacsi.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các bác sĩ
        </a>
        <h2>Lịch khám của bác sĩ: {{ $bacsi->hoten }}</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Ngày khám</th>
                    <th>Buổi khám</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lichKhams as $lich)
                    <tr>
                        <td>{{ date('d/m/Y', strtotime($lich->ngaykham)) }}</td>
                        <td>{{ $lich->buoi }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection
