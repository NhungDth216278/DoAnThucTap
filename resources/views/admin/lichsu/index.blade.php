@extends('admin.main')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Lịch sử tác vụ</strong></h1>

        <form action="{{ route('lichsu.index') }}" method="GET">
            <div class="card rounded-4 mb-3">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="row">
                                <div class="col my-auto d-flex">

                                    <input type="text" name="keyword" class="form-control me-2"
                                        placeholder="Nhập tên người dùng hoặc từ khóa thao tác"
                                        value="{{ request('keyword') }}">


                                    <button type="submit" class="btn btn-primary text-nowrap">
                                        <i class="align-middle" data-feather="search"></i>

                                    </button>

                                    <a href="{{ route('lichsu.index') }}" class="btn btn-secondary text-nowrap ms-2">
                                        <i class="align-middle" data-feather="refresh-cw"></i>
                                        Tải lại
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="row justify-content-center mt-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 col-md-4 mb-3 mb-md-0">
                                    <label for="date">Lọc theo ngày</label>
                                    <input type="date" id="date" name="date" value="{{ request('date') }}"
                                        class="form-control">
                                </div>
                                <div class="col-6 col-md-4 mb-3 mb-md-0">
                                    <label for="month">Lọc theo tháng</label>
                                    <input type="month" id="month" name="month" value="{{ request('month') }}"
                                        class="form-control">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row justify-content-center">
            <div class="col-12 d-flex">
                <div class="card rounded-4 flex-fill {{ $lstLS->total() != 0 && $lstLS->total() <= 10 ? 'pb-5' : '' }}">

                    <div class="card-header">
                        <h5 class="card-title mb-0">Nhật ký thao tác của mọi người trên hệ thống ({{ $lstLS->total() }}
                            hàng)</h5>
                    </div>
                    @if ($lstLS->isEmpty())
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Không tìm thấy lịch sử tác vụ nào!
                            </div>
                        </div>
                    @else
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Thời gian</th>
                                    <th>Nội dung thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lstLS as $ls)
                                    <tr>
                                        <td>{{ $ls->thoigian }}</td>
                                        <td>{{ $ls->noidung }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="d-flex justify-content-center mt-3">
                        {{ $lstLS->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
