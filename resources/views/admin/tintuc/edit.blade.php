@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3">Chỉnh sửa thông tin của bài viết<strong>
                <h2 class="text-danger">{!! $tintuc->tieude !!}</h2>

            </strong></h1>
        <div class="card">
            <div class="card-body">

                <form method="POST" action="{{ route('tintuc.update', ['id' => $tintuc->id]) }}"
                    enctype="multipart/form-data" id="form-tintuc">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <label for="tieude">Tên tiêu đề</label>
                            <textarea type="text" class="form-control @error('tieude') is-invalid @enderror" value="{{ old('tieude') }}"
                                id="tieude" name="tieude" placeholder="Nhập tiêu đề của tin tức">{{ $tintuc->tieude }}</textarea>
                            @error('tieude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <div class="col-6">
                            <label class="form-label">Loại Tin Tức</label>
                            <select name="loai" class="form-control @error('loai') is-invalid @enderror">
                                <option value="1" {{ $tintuc->loai == 1 ? 'selected' : '' }}>Tin dịch vụ</option>
                                <option value="2" {{ $tintuc->loai == 2 ? 'selected' : '' }}>Tin y tế</option>
                                <option value="3" {{ $tintuc->loai == 3 ? 'selected' : '' }}>Y tế thường thức</option>

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
                            @if ($tintuc->hinhanh)
                                <img src="{{ asset($tintuc->hinhanh) }}" class="img-thumbnail" style="width: 20%;">
                            @endif
                            @error('hinhanh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="mota">Mô tả</label>
                            <textarea name="mota" class="form-control @error('mota') is-invalid @enderror" id="mota"
                                placeholder="Nhập mô tả">{{ $tintuc->mota }}</textarea>
                            @error('mota')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="noidung">Nội dung</label>
                            <textarea name="noidung" class="form-control @error('noidung') is-invalid @enderror" id="noidung"
                                placeholder="Nhập nội dung">{{ $tintuc->noidung }}</textarea>
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

                    <div class="row">
                        <div class="d-flex gap-2">
                            <button class="btn btn-primary">
                                <i class="bi bi-arrow-repeat"></i> Cập nhật
                            </button>
                            <button type="reset" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                                <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        @if (session('error'))
            <div class="alert alert-danger d-flex align-items-center" role="alert" id="error-alert">
                <svg class="bi flex-shrink-0 me-2" width="24" height="24" role="img" aria-label="Danger:">
                    <use xlink:href="#exclamation-triangle-fill" />
                </svg>
                <div>
                    {{ session('error') }}
                </div>
            </div>

            <script>
                setTimeout(function() {
                    let alert = document.getElementById('error-alert');
                    if (alert) {
                        alert.style.transition = "opacity 0.5s";
                        alert.style.opacity = "0";
                        setTimeout(() => alert.remove(), 500); // Xoá khỏi DOM sau khi ẩn
                    }
                }, 2000); // 5 giây
            </script>
        @endif
        <hr>

        <div class="col-6">
            <div class="row-12 mt-3">
                <label class="form-label" for="tgiancapnhat">Ngày cập nhật: {{ $tintuc->updated_at }}</label>
            </div>
        </div>
        <a href="{{ url()->previous() }}" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
    @endsection
