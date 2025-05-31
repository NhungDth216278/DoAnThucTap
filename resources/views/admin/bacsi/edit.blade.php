@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@section('content')
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
    <div class="container-fluid p-0">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('bacsi.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các bác sĩ
        </a>
        <h1 class="h3 mb-3">Chỉnh sửa thông tin của <strong>{{ $bs->hoten }}</strong></h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('bacsi.update', ['id' => $bs->id]) }}" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <label for="hoten">Họ tên</label>
                            <input type="text" class="form-control @error('hoten') is-invalid @enderror" name="hoten"
                                value="{{ old('hoten', $bs->hoten) }}">
                            @error('hoten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="gioitinh">Giới tính</label>
                            <select class="form-control @error('gioitinh') is-invalid @enderror" name="gioitinh">
                                <option value="Nam" {{ old('gioitinh', $bs->gioitinh) == 'Nam' ? 'selected' : '' }}>Nam
                                </option>
                                <option value="Nữ" {{ old('gioitinh', $bs->gioitinh) == 'Nữ' ? 'selected' : '' }}>Nữ
                                </option>
                            </select>
                            @error('gioitinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">

                            <label for="hocham">Học hàm</label>
                            <select name="hocham" class="form-control @error('hocham') is-invalid @enderror" name="hocham"
                                value="{{ old('hocham', $bs->hocham) }}">
                                @foreach ($hocHamList as $hocHam)
                                    <option value="{{ $hocHam }}" {{ $bs->hocham == $hocHam ? 'selected' : '' }}>
                                        {{ $hocHam }}
                                    </option>
                                @endforeach
                                @error('hocham')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="diachi">Địa chỉ</label>
                            <input type="text" class="form-control @error('diachi') is-invalid @enderror" name="diachi"
                                value="{{ old('diachi', $bs->diachi) }}">
                            @error('diachi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row justify-content-center mt-1">
                        @if ($user->role != 'hospital')
                            <div class="col-6">
                                <label class="form-label fw-bold">Cơ sở</label>
                                <select name="id_coso" id="coso"
                                    class="form-control @error('id_coso') is-invalid @enderror" required>
                                    <option value="">-- Chọn cơ sở --</option>
                                    @foreach ($lstCS as $coso)
                                        <option value="{{ $coso->id }}"
                                            {{ old('id_coso', $bs->id_coso) == $coso->id ? 'selected' : '' }}>
                                            {{ $coso->tencoso }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('id_coso')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Chọn Chuyên khoa -->
                            <div class="col-6">
                                <label class="form-label fw-bold">Chuyên khoa</label>
                                <select name="id_chuyenkhoa" id="chuyenkhoa"
                                    class="form-control @error('id_chuyenkhoa') is-invalid @enderror" required>
                                    @foreach ($lstCK as $chuyenkhoa)
                                    @if ($chuyenkhoa->id_coso === $bs->id_coso)
                                        <option value="{{ $chuyenkhoa->id }}"
                                            {{ old('id_chuyenkhoa', $bs->id_chuyenkhoa) == $chuyenkhoa->id ? 'selected' : '' }}>
                                            {{ $chuyenkhoa->tenkhoa }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_chuyenkhoa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @else
                        <input type="hidden" name="id_coso" value="{{ $cs_nv->id }}">
                            <!-- Chọn Chuyên khoa -->
                            <div class="col-12">
                                <label class="form-label fw-bold">Chuyên khoa</label>
                                <select name="id_chuyenkhoa" id="chuyenkhoa"
                                    class="form-control @error('id_chuyenkhoa') is-invalid @enderror">
                                    @foreach ($lstCK as $chuyenkhoa)
                                        @if ($chuyenkhoa->id_coso === $cs_nv->id)
                                            <option value="{{ $chuyenkhoa->id }}"
                                                {{ old('id_chuyenkhoa', $bs->id_chuyenkhoa) == $chuyenkhoa->id ? 'selected' : '' }}>
                                                {{ $chuyenkhoa->tenkhoa }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('id_chuyenkhoa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif

                    </div>


                    <div class="row justify-content-center mt-1">
                        <div class="col-12">
                            <label for="hinhanh">Hình ảnh</label>
                            <input type="file" class="form-control @error('hinhanh') is-invalid @enderror"
                                name="hinhanh">
                            @if ($bs->hinhanh)
                                <img src="{{ asset($bs->hinhanh) }}" class="img-thumbnail" style="width: 15%;">
                            @endif
                            @error('hinhanh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <br> <label class="form-label">Lịch khám</label>
                    <table class="table" id="lich-kham-table">
                        <thead>
                            <tr>
                                <th>Ngày khám</th>
                                <th>Buổi khám</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lichKham as $index => $lich)
                                <tr>
                                    <td>
                                        @if (\Carbon\Carbon::parse($lich->ngaykham)->isFuture() || \Carbon\Carbon::parse($lich->ngaykham)->isToday())
                                            <input type="date" name="lich_kham[{{ $index }}][ngay]"
                                                class="form-control" value="{{ $lich->ngaykham }}"
                                                min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                                        @else
                                            <input type="date" class="form-control" value="{{ $lich->ngaykham }}"
                                                disabled>
                                            <input type="hidden" name="lich_kham[{{ $index }}][ngay]"
                                                value="{{ $lich->ngaykham }}">
                                        @endif
                                    </td>
                                    <td>
                                        <select name="lich_kham[{{ $index }}][buoi]" class="form-control"
                                            {{ \Carbon\Carbon::parse($lich->ngaykham)->isPast() ? 'disabled' : '' }}>
                                            <option value="Sáng" {{ $lich->buoi == 'Sáng' ? 'selected' : '' }}>Sáng
                                            </option>
                                            <option value="Chiều" {{ $lich->buoi == 'Chiều' ? 'selected' : '' }}>Chiều
                                            </option>
                                        </select>
                                    </td>
                                    <td>
                                        @if (\Carbon\Carbon::parse($lich->ngaykham)->isFuture() || \Carbon\Carbon::parse($lich->ngaykham)->isToday())
                                            <button type="button" class="btn btn-danger remove-row">Xóa</button>
                                        @else
                                            <button type="button" class="btn btn-secondary" disabled>Không thể
                                                xóa</button>
                                        @endif
                                    </td>
                                    <input type="hidden" name="lich_kham[{{ $index }}][id_lich]"
                                        value="{{ $lich->id }}">
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" class="btn btn-success" id="add-row"><i class="bi bi-plus-square"></i>
                            Thêm lịch khám</button>
                    </div>


                    <div class="row justify-content-center mt-3">
                        <div class="col-6">
                            <div class="d-flex gap-2">
                                <button class="btn btn-primary">
                                    <i class="bi bi-arrow-repeat"></i> Cập nhật
                                </button>
                                <button type="reset" class="btn btn-secondary d-flex align-items-center"
                                    id="reset-form">
                                    <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                                </button>
                            </div>
                        </div>
                        <div class="col-3">

                            <label class="form-label" for="tgianthem">Ngày thêm</label>
                            <input type="text" class="form-control" id="tgianthem"
                                placeholder="{{ $bs->created_at }}" disabled>
                        </div>

                        <div class="col-3">
                            <label class="form-label" for="tgiancapnhat">Ngày cập nhật</label>
                            <input type="text" class="form-control" id="tgiancapnhat"
                                placeholder="{{ $bs->updated_at }}" disabled>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            let index = 1;
            let today = new Date();
            today.setDate(today.getDate() + 1); // Cộng thêm 1 ngày để lấy ngày mai
            let tomorrow = today.toISOString().split("T")[0]; // Định dạng YYYY-MM-DD

            document.getElementById("add-row").addEventListener("click", function() {
                let table = document.getElementById("lich-kham-table").getElementsByTagName('tbody')[0];
                let newRow = document.createElement("tr");
                newRow.innerHTML = `
                    <td><input type="date" name="lich_kham[${index}][ngay]" class="form-control" min="${tomorrow}" required></td>
                    <td>
                        <select name="lich_kham[${index}][buoi]" class="form-control" required>
                            <option value="Sáng">Sáng</option>
                            <option value="Chiều">Chiều</option>
                        </select>
                    </td>
                    <td><button type="button" class="btn btn-danger remove-row">Xóa</button></td>
                `;
                table.appendChild(newRow);
                index++;
            });

            document.getElementById("lich-kham-table").addEventListener("click", function(e) {
                if (e.target.classList.contains("remove-row")) {
                    e.target.closest("tr").remove();
                }
            });
        });


        //
        document.getElementById('coso').addEventListener('change', function() {
            let cosoId = this.value;
            let chuyenkhoaSelect = document.getElementById('chuyenkhoa');

            console.log("Cơ sở ID:", cosoId);

            if (cosoId) {
                fetch(`/get-chuyenkhoa/${cosoId}`)
                    .then(response => response.json())
                    .then(data => {
                        console.log("Chuyên khoa nhận được:", data); // Kiểm tra dữ liệu trả về
                        if (data.length > 0) {
                            chuyenkhoaSelect.disabled = false;
                            chuyenkhoaSelect.innerHTML = '<option value="">-- Chọn chuyên khoa --</option>';
                            data.forEach(chuyenkhoa => {
                                chuyenkhoaSelect.innerHTML +=
                                    `<option value="${chuyenkhoa.id}">${chuyenkhoa.tenkhoa}</option>`;
                            });
                        } else {
                            alert("Không có chuyên khoa nào!");
                        }
                    })
                    .catch(error => console.error("Lỗi:", error));
            }
        });
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".remove-row").forEach(button => {
                button.addEventListener("click", function() {
                    this.closest("tr").remove();
                });
            });
        });
    </script>
@endsection
