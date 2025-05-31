@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Cơ Sở</h1>
        <div class="row mb-3 align-items-end">
            <div class="col-9 col-md-6">
                <button type="button" id="btn-them-coso" class="btn btn-info mb-4 rounded">
                    <i class="align-middle me-2" data-feather="plus-square"></i>Thêm cơ sở mới
                </button>
            </div>


            <div class="col-3 col-md-6 text-end">
                <a href="{{ route('coso.export') }}" class="btn btn-success mb-3">
                    <i data-feather="download"></i> Xuất Excel
                </a>
            </div>
            <form method="POST" action="{{ route('coso.store') }}" enctype="multipart/form-data" id="form-coso"
                style="display: none;">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-6">
                                <label for="tencoso">Tên cơ sở</label>
                                <input type="text" class="form-control @error('tencoso') is-invalid @enderror"
                                    value="{{ old('tencoso') }}" id="tencs" name="tencoso" placeholder="Nhập tên cơ sở">
                                @error('tencoso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="diachi">Địa chỉ</label>
                                <input type="text" class="form-control @error('diachi') is-invalid @enderror"
                                    value="{{ old('diachi') }}" id="diachi" name="diachi" placeholder="Nhập địa chỉ">
                                @error('diachi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-6">
                                <label for="sodienthoai">Số điện thoại</label>
                                <input type="text" class="form-control @error('sodienthoai') is-invalid @enderror"
                                    value="{{ old('sodienthoai') }}" id="sodienthoai" name="sodienthoai"
                                    placeholder="Nhập số điện thoại">
                                @error('sodienthoai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-6">
                                <label for="email">Email</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email') }}" id="email" name="email" placeholder="Nhập email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12">
                                <label for="hinhanh">Hình ảnh</label>
                                <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                    name="hinhanh">
                                @error('hinhanh')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12">
                                <label for="mota">Mô tả</label>
                                <textarea name="mota" class="form-control @error('mota') is-invalid @enderror" id="mota"
                                    placeholder="Nhập mô tả">{{ old('mota') }}</textarea>
                                @error('mota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


                            <script>
                                ClassicEditor
                                    .create(document.querySelector('#mota'), {
                                        ckfinder: {
                                            uploadUrl: "{{ route('ckeditor.upload') }}?type=coso&_token={{ csrf_token() }}"
                                        }
                                    })
                                    .catch(error => {
                                        console.error(error);
                                    });
                            </script>
                        </div>

                        <div class="row justify-content-center mt-3">
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
                                            uploadUrl: "{{ route('ckeditor.upload') }}?type=coso&_token={{ csrf_token() }}"
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
                                <i class="bi bi-plus-circle me-2"></i>Thêm Cơ Sở
                            </button>

                            <button type="button" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                                <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                            </button>

                        </div>
                    </div>
                </div>
            </form>


            <!-- JavaScript để xử lý nút Reset, Form -->
            <script>
                document.getElementById('btn-them-coso').addEventListener('click', function() {
                    let form = document.getElementById('form-coso');
                    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
                });
                document.getElementById("reset-form").addEventListener("click", function() {
                    let form = document.getElementById("form-coso");

                    // Xóa dữ liệu trong form
                    form.reset();

                    // Xóa lỗi validation nếu có
                    form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
                    form.querySelectorAll(".invalid-feedback").forEach(el => el.innerHTML = "");
                });
            </script>

            <!-- Form tìm kiếm và lọc -->
            <form method="GET" action="{{ route('coso.index') }}" class="row g-2 mb-3">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card rounded-4 mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-auto my-auto">
                                        Tìm kiếm:
                                    </div>

                                    <div class="col my-auto d-flex">
                                        <input type="text" name="keyword" class="form-control me-2"
                                            placeholder="Nhập từ khóa cần tìm kiếm" value="{{ request('keyword') }}">
                                        <button type="submit" class="btn btn-primary text-nowrap">
                                            <i class="align-middle" data-feather="search"></i>

                                        </button>

                                        <a href="{{ route('coso.index') }}" class="btn btn-secondary text-nowrap ms-2">
                                            <i class="align-middle" data-feather="refresh-cw"></i>
                                            Tải lại
                                        </a>
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
                            <h5 class="card-title mb-0">Danh sách các cơ sở ({{ $lstCS->total() }} hàng)</h5>
                        </div>
                        @if ($lstCS->isEmpty())
                            <div class="alert alert-danger">
                                Không tìm thấy cơ sở nào!
                            </div>
                        @else
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Hình ảnh</th>
                                        <th>Tên cơ sở</th>
                                        <th>Địa chỉ</th>
                                        <th class="d-none d-md-table-cell">Số điện thoại</th>
                                        <th class="d-none d-xl-table-cell">Email</th>
                                        <th class="d-none d-xl-table-cell">Mô tả</th>
                                        <th class="d-none d-xl-table-cell">Nội dung</th>
                                        <th class="d-none d-xl-table-cell">Ngày cập nhật</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstCS as $key => $cs)
                                        <tr>
                                            <td>{{ $lstCS->firstItem() + $key }}</td>
                                            <td>
                                                @if ($cs->hinhanh)
                                                    <img src="{{ asset($cs->hinhanh) }}" class="img-thumbnail"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <span>Chưa có ảnh</span>
                                                @endif
                                            </td>
                                            <td>{{ $cs->tencoso }}</td>
                                            <td>{{ $cs->diachi }}</td>
                                            <td class="d-none d-md-table-cell">{{ $cs->sodienthoai }}</td>

                                            <td class="d-none d-xl-table-cell">{{ $cs->email }}</td>

                                            <td class="d-none d-xl-table-cell">{{ Str::limit($cs->mota, 100, '...') }}
                                            </td>

                                            <td class="d-none d-xl-table-cell">{{ Str::limit($cs->noidung, 50, '...') }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $cs->updated_at }}</td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="{{ route('coso.edit', ['id' => $cs->id]) }}">
                                                    <i class="align-middle" data-feather="edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="{{ route('coso.delete', ['id' => $cs->id]) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa cơ sở {{ $cs->id }} không?');">
                                                    <i class="align-middle" data-feather="trash-2"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {{ $lstCS->withQueryString()->links() }}
            </div>
        </div>
    @endsection
