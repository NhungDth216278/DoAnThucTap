@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container">
        <a class="btn btn-info mb-4 rounded-start-5" href="javascript:history.back()">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các hồ sơ bệnh nhân
        </a>
        <h2 class="text-center text-primary"> Sửa Thông Tin Bệnh Nhân</h2>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('benhnhan.update', $benhNhan->id) }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_user" value="{{ $benhNhan->id_user }}">
                    <div class="mb-3">
                        <label for="hoten" class="form-label">Họ tên:</label>
                        <input type="text" class="form-control" name="hoten" value="{{ $benhNhan->hoten }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="sodienthoai" class="form-label">Số điện thoại:</label>
                        <input type="text" class="form-control" name="sodienthoai" value="{{ $benhNhan->sodienthoai }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="diachi" class="form-label">Địa chỉ:</label>
                        <input type="text" class="form-control" name="diachi" value="{{ $benhNhan->diachi }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="ngaysinh" class="form-label">Ngày sinh:</label>
                        <input type="date" class="form-control" name="ngaysinh" value="{{ $benhNhan->ngaysinh }}"
                            required>
                    </div>

                    <div class="mb-3">
                        <label for="cccd" class="form-label">CCCD:</label>
                        <input type="text" class="form-control" name="cccd" value="{{ $benhNhan->cccd }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="gioitinh" class="form-label">Giới tính:</label>
                        <select class="form-control" name="gioitinh" required>
                            <option value="Nam" {{ $benhNhan->gioitinh == 'Nam' ? 'selected' : '' }}>Nam</option>
                            <option value="Nữ" {{ $benhNhan->gioitinh == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                        </select>
                    </div>
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
                            <input type="text" class="form-control" id="tgianthem" placeholder="{{ $benhNhan->created_at }}"
                                disabled>
                        </div>

                        <div class="col-3">
                            <label class="form-label" for="tgiancapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="tgiancapnhat"
                                placeholder="{{ $benhNhan->updated_at }}" disabled>
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
