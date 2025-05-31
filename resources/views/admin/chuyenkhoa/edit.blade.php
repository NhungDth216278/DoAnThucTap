@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('chuyenkhoa.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các chuyên khoa
        </a>
        <h1 class="h3 mb-3">Chỉnh sửa thông tin của <strong>{{ $ck->tenkhoa }}</strong></h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('chuyenkhoa.update', ['id' => $ck->id]) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center">
                     @if ($user->role != 'hospital')
                        <div class="mb-3">
                            <label for="id_coso" class="form-label">Cơ Sở</label>
                            <select name="id_coso" class="form-control" required>
                                <option value="">-- Chọn Cơ Sở --</option>
                                @foreach ($lstCS as $coso)
                                    <option value="{{ $coso->id }}" {{ $ck->id_coso == $coso->id ? 'selected' : '' }}>
                                        {{ $coso->tencoso }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    @endif
                        <div class="mb-3">
                            <label for="tenkhoa" class="form-label">Tên Chuyên Khoa</label>
                            <input type="text" name="tenkhoa" class="form-control" value="{{ $ck->tenkhoa }}" >
                        </div>

                        <div class="mb-3">
                            <label for="giakham" class="form-label">Giá Khám</label>
                            <input type="number" name="giakham" class="form-control" value="{{ $ck->giakham }}" >
                        </div>

                        <div class="mb-3">
                            <label for="mota" class="form-label">Mô Tả</label>
                            <textarea name="mota" id="mota" class="form-control">{{ $ck->mota }}</textarea>
                        </div>
                        <script>
                            ClassicEditor
                                .create(document.querySelector('#mota'), {
                                    ckfinder: {
                                        uploadUrl: "{{ route('ckeditor.upload') }}?type=chuyenkhoa&_token={{ csrf_token() }}"
                                    }
                                })
                                .catch(error => {
                                    console.error(error);
                                });
                        </script>

                    <br>
                    <div class="row justify-content-center mt-1">
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
                            <input type="text" class="form-control" id="tgianthem" placeholder="{{ $ck->created_at }}"
                                disabled>
                        </div>

                        <div class="col-3">
                            <label class="form-label" for="tgiancapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="tgiancapnhat"
                                placeholder="{{ $ck->updated_at }}" disabled>
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
