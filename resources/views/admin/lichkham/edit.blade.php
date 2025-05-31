@extends('admin.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
@section('content')
    <div class="container">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('lichkham.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các lịch khám
        </a>
        <h2 class="mb-4 text-primary">Sửa Lịch Khám</h2>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('lichkham.update', $lichKham->id) }}" method="POST">
                    @csrf
                    @method('POST')

                    <!-- Hiển thị Cơ sở -->
                    <div class="mb-3">
                        <label class="form-label">Cơ sở</label>
                        <input type="text" class="form-control" value="{{ $lichKham->bacSi->coSo->tencoso }}" readonly>
                        <input type="hidden" name="id_coso" value="{{ $lichKham->bacSi->id_coso }}">
                    </div>

                    <!-- Hiển thị Chuyên khoa -->
                    <div class="mb-3">
                        <label class="form-label">Chuyên khoa</label>
                        <input type="text" class="form-control" value="{{ $lichKham->bacSi->chuyenKhoa->tenkhoa }}"
                            readonly>
                        <input type="hidden" name="id_chuyenkhoa" value="{{ $lichKham->bacSi->id_chuyenkhoa }}">
                    </div>

                    <!-- Chọn Bác sĩ -->
                    <div class="mb-3">
                        <label class="form-label">Bác sĩ</label>
                        <select id="bacSiSelect" name="id_bacsi" class="form-control" required>
                            <option value="">-- Chọn bác sĩ --</option>
                            @foreach ($bacSis as $bacSi)
                                <option value="{{ $bacSi->id }}"
                                    {{ $lichKham->id_bacsi == $bacSi->id ? 'selected' : '' }}>
                                    {{ $bacSi->hoten }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Chọn Ngày khám -->
                    <div class="mb-3">
                        <label class="form-label">Ngày khám</label>
                        <input type="date" name="ngaykham" class="form-control" value="{{ $lichKham->ngaykham }}"
                            required min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                    </div>

                    <!-- Chọn Buổi -->
                    <div class="mb-3">
                        <label class="form-label">Buổi</label>
                        <select name="buoi" class="form-control" required>
                            <option value="Sáng" {{ $lichKham->buoi == 'Sáng' ? 'selected' : '' }}>Sáng</option>
                            <option value="Chiều" {{ $lichKham->buoi == 'Chiều' ? 'selected' : '' }}>Chiều</option>
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
                            <input type="text" class="form-control" id="tgianthem" placeholder="{{ $lichKham->created_at }}"
                                disabled>
                        </div>

                        <div class="col-3">
                            <label class="form-label" for="tgiancapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="tgiancapnhat"
                                placeholder="{{ $lichKham->updated_at }}" disabled>
                        </div>

                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
