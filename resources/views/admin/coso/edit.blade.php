@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        @if ($user->role === 'hospital')
            <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('admin.index') }}">
                <i class="align-middle me-2" data-feather="chevron-left"></i>
                Xem thông tin của cơ sở
            </a>
        @else
            <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('coso.index') }}">
                <i class="align-middle me-2" data-feather="chevron-left"></i>
                Xem danh sách các cơ sở
            </a>
        @endif

        <h1 class="h3 mb-3">Chỉnh sửa thông tin của <strong>{{ $cs->tencoso }}</strong></h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('coso.update', ['id' => $cs->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center mt-3">

                        <div class="col-6">
                            <label for="tencoso">Tên cơ sở</label>
                            <input type="text" class="form-control" id="tencs" name="tencoso"
                                placeholder="Nhập cơ sở" value="{{ $cs->tencoso }}">
                        </div>

                        <div class="col-6">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" class="form-control" id="diachi" name="diachi"
                                placeholder="Nhập địa chỉ" value="{{ $cs->diachi }}">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-6">
                            <label for="sodienthoai">Số điện thoại</label>
                            <input class="form-control" type="number" id="sodienthoai" name="sodienthoai"
                                placeholder="Nhập số điện thoại" value="{{ $cs->sodienthoai }}">
                        </div>

                        <div class="col-6">
                            <label>Email</label><br>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Nhập email" value="{{ $cs->email }}">
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-12">
                            <label for="hinhanh">Hình ảnh</label>
                            <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                name="hinhanh">
                            @if ($cs->hinhanh)
                                <img src="{{ asset($cs->hinhanh) }}" class="img-thumbnail" style="width: 15%;">
                            @endif
                            @error('hinhanh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mt-3">
                        <div class="col-12">
                            <label for="mota">Mô tả</label>
                            <textarea name="mota" id="mota" class="form-control">{{ $cs->mota }}</textarea>
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
                            <textarea name="noidung" id="noidung" class="form-control">{{ $cs->noidung }}</textarea>

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
                    <div class="row justify-content-center mt-3">
                        <div class="col-6">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary">
                                    <i class="bi bi-arrow-repeat"></i> Cập nhật
                                </button>
                                <button type="reset" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                                </button>
                            </div>
                        </div>
                        <div class="col-3">

                            <label class="form-label" for="tgianthem">Ngày thêm</label>
                            <input type="text" class="form-control" id="tgianthem" placeholder="{{ $cs->created_at }}"
                                disabled>
                        </div>

                        <div class="col-3">
                            <label class="form-label" for="tgiancapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="tgiancapnhat"
                                placeholder="{{ $cs->updated_at }}" disabled>
                        </div>

                    </div>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>Lỗi !
                            <div>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </form>

            </div>
        </div>

    </div>
@endsection
