@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Danh sách</strong> Tin Tức</h1>
        <button type="button" id="btn-them-tintuc" class="btn btn-info mb-4 rounded">
            <i class="align-middle me-2" data-feather="plus-square"></i>Thêm tin tức mới
        </button>

        <form method="POST" action="{{ route('dstintuc.store') }}" enctype="multipart/form-data" id="form-tintuc"
            style="display: none;">
            @csrf
            @method('POST')
            <div class="card">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label for="tieude">Tên tiêu đề</label>
                            <textarea type="text" class="form-control @error('tieude') is-invalid @enderror" value="{{ old('tieude') }}"
                                id="tieude" name="tieude" placeholder="Nhập tiêu đề của tin tức">{{ old('tieude') }}</textarea>
                            @error('tieude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-6">
                            <label class="form-label">Loại Tin Tức</label>
                            <select name="loai" class="form-control @error('loai') is-invalid @enderror">
                                <option value="">-- Chọn loại tin --</option>
                                <option value="1" {{ old('loai') == 1 ? 'selected' : '' }}>Tin dịch vụ</option>
                                <option value="2" {{ old('loai') == 2 ? 'selected' : '' }}>Tin y tế</option>
                                <option value="3" {{ old('loai') == 3 ? 'selected' : '' }}>Y tế thường thức</option>
                            </select>
                            @error('loai')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="hinhanh">Hình ảnh</label>
                            <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                name="hinhanh">
                            @error('hinhanh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="mota">Mô tả</label>
                            <textarea name="mota" class="form-control @error('mota') is-invalid @enderror" id="mota"
                                placeholder="Nhập mô tả">{{ old('mota') }}</textarea>
                            @error('mota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="noidung">Nội dung</label>
                            <textarea name="noidung" class="form-control @error('noidung') is-invalid @enderror" id="noidung"
                                placeholder="Nhập nội dung">{{ old('noidung') }}</textarea>
                            @error('noidung')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <script>
                            ClassicEditor
                                .create(document.querySelector('#noidung'), {
                                    ckfinder: {
                                        uploadUrl: "{{ route('ckeditor.upload') }}?type=tintuc&_token={{ csrf_token() }}"
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>
                    </div>

                    <br>
                    <div class="d-flex gap-2">

                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i>Thêm tin tức
                        </button>

                        <button type="button" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                            <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                        </button>

                    </div>
                </div>
            </div>
        </form>


    <!-- JavaScript để xử lý nút Reset, MỞ FORM THÊM -->
    <script>
        document.getElementById('btn-them-tintuc').addEventListener('click', function() {
            let form = document.getElementById('form-tintuc');
            form.style.display = (form.style.display === 'none') ? 'block' : 'none';
        });

        document.getElementById("reset-form").addEventListener("click", function() {
            let form = document.getElementById("form-tintuc");

            // Xóa dữ liệu trong form
            form.reset();

            // Xóa lỗi validation nếu có
            form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
            form.querySelectorAll(".invalid-feedback").forEach(el => el.innerHTML = "");
        });
    </script>

<form method="GET" action="{{ route('dstintuc.index') }}" class="row g-2 mb-3">
    <div class="card rounded-4 mb-3">
        <div class="card-body">

            <div class="row justify-content-center">
                <div class="col-12">
                    <div class="row">
                        <div class="col my-auto d-flex">

                            <input type="text" name="keyword" class="form-control me-2"
                                placeholder="Nhập tiêu đề, mô tả hoặc nội dung" value="{{ request('keyword') }}">


                            <button type="submit" class="btn btn-primary text-nowrap">
                                <i class="align-middle" data-feather="search"></i>

                            </button>

                            <a href="{{ route('dstintuc.index') }}" class="btn btn-secondary text-nowrap ms-2">
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
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <label>Lọc theo loại tin</label>
                            <select name="loai" class="form-select">
                                <option value="">-- Loại tin --</option>
                                <option value="1" {{ request('loai') === '1' ? 'selected' : '' }}>Tin dịch vụ
                                </option>
                                <option value="2" {{ request('loai') === '2' ? 'selected' : '' }}>Tin y tế
                                </option>
                                <option value="3" {{ request('loai') === '3' ? 'selected' : '' }}>Y tế thường
                                    thức</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <label>Lọc theo trạng thái</label>
                            <select name="trangthai" class="form-select">
                                <option value="">-- Trạng thái --</option>
                                <option value="1" {{ request('trangthai') == '1' ? 'selected' : '' }}>Đã duyệt
                                </option>
                                <option value="0" {{ request('trangthai') == '0' ? 'selected' : '' }}>Chưa
                                    duyệt</option>
                            </select>
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <label>Từ ngày</label>
                            <input type="date" name="from_date" class="form-control"
                                value="{{ request('from_date') }}">
                        </div>
                        <div class="col-6 col-md-3 mb-3 mb-md-0">
                            <label>Đến ngày</label>
                            <input type="date" name="to_date" class="form-control"
                                value="{{ request('to_date') }}">
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <div class="row justify-content-center">
        <div class="col-12 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="card-title mb-0">Danh sách các tin tức ({{ $lstTintuc->total() }} hàng)</h5>
                </div>

                <table class="table table-hover my-0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Hình ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Mô tả</th>
                            <th class="d-none d-md-table-cell">Nội dung</th>
                            <th class="d-none d-xl-table-cell">Loại tin tức</th>
                            <th class="d-none d-xl-table-cell">Trạng thái</th>
                            <th class="d-none d-xl-table-cell">Ngày tạo</th>
                            <th class="d-none d-xl-table-cell">Ngày cập nhật</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($lstTintuc as $key => $tt)
                            <tr>
                                <td>{{ $lstTintuc->firstItem() + $key }}</td>
                                <td>
                                    @if ($tt->hinhanh)
                                        <img src="{{ asset($tt->hinhanh) }}" class="img-thumbnail"
                                            style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                        <span>Chưa có ảnh</span>
                                    @endif
                                </td>
                                <td>{{ $tt->tieude }}</td>
                                <td>{{ Str::limit($tt->mota, 50, '...') }}</td>
                                <td class="d-none d-md-table-cell">{{ Str::limit($tt->noidung, 100, '...') }}</td>

                                <td class="d-none d-xl-table-cell">
                                    @if ($tt->loai == 1)
                                        <span class="badge bg-primary">Tin dịch vụ</span>
                                    @elseif ($tt->loai == 2)
                                        <span class="badge bg-success">Tin y tế</span>
                                    @else
                                        <span class="badge bg-info">Y tế thường thức</span>
                                    @endif
                                </td>

                                <td class="d-none d-xl-table-cell">
                                    @if ($tt->trangthai == 0)
                                        <span class="badge bg-info">Chưa được duyệt</span>
                                    @else
                                        <span class="badge bg-success">Đã duyệt</span>
                                    @endif

                                </td>

                                <td class="d-none d-xl-table-cell">{{ $tt->created_at }}</td>
                                <td class="d-none d-xl-table-cell">{{ $tt->updated_at }}</td>
                                @php
                                    $nv = Auth::user()->nhanvien;
                                @endphp

                                <td class="text-center">
                                    <div class="d-flex gap-2 mt-1">
                                        <a class="btn btn-warning btn-sm"
                                            href="{{ route('dstintuc.edit', ['id' => $tt->id]) }}">
                                            <i class="align-middle" data-feather="edit"></i>
                                        </a>

                                        <a href="{{ route('dstintuc.delete', ['id' => $tt->id]) }}"
                                            onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết có id {{ $tt->id }} không?');"
                                            class="btn btn-danger btn-sm">
                                            <i class="align-middle" data-feather="trash-2"></i>
                                        </a>
                                    </div>
                                    <div class="mt-1">
                                        <a href="{{ route('tintuc.xem', $tt->id) }}" class="btn btn-info btn-sm"><i
                                                data-feather="eye"></i>
                                        </a>
                                    </div>

                                </td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{ $lstTintuc->withQueryString()->links() }}
    </div>
    </div>
@endsection
