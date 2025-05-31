@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

@section('content')
    <div class="container-fluid p-0">
        <a class="btn btn-info mb-4 rounded-start-5" href="{{ route('bacsi.index') }}">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các bác sĩ
        </a>
        <h1 class="h3 mb-3"><strong>Thêm bác sĩ</strong></h1>

        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('bacsi.store') }}" enctype="multipart/form-data" id="form-bacsi">
                    @csrf
                    @method('POST')
                    <div class="row justify-content-center">
                        <div class="col-4">
                            <label for="hoten">Họ tên</label>
                            <input type="text" class="form-control @error('hoten') is-invalid @enderror" name="hoten"
                                value="{{ old('hoten') }}">
                            @error('hoten')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="gioitinh">Giới tính</label>
                            <select class="form-control @error('gioitinh') is-invalid @enderror" name="gioitinh">
                                <option value="">-- Chọn giới tính --</option>
                                <option value="Nam"
                                    {{ old('gioitinh', $bacsi->gioitinh ?? '') == 'Nam' ? 'selected' : '' }}>Nam</option>
                                <option value="Nữ"
                                    {{ old('gioitinh', $bacsi->gioitinh ?? '') == 'Nữ' ? 'selected' : '' }}>Nữ</option>
                            </select>
                            @error('gioitinh')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-4">
                            <label for="hocham">Học hàm</label>
                            <select name="hocham" class="form-control" @error('hocham') is-invalid @enderror"
                                name="hocham" value="{{ old('hocham') }}" required>
                                @foreach ($hocHamList as $hocHam)
                                    <option value="{{ $hocHam }}">{{ $hocHam }}</option>
                                @endforeach
                                @error('hocham')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </select>
                        </div>
                    </div>

                    <div class="row justify-content-center mt-1">
                        <label for="diachi">Địa chỉ</label>
                        <input type="text" class="form-control @error('diachi') is-invalid @enderror" name="diachi"
                            value="{{ old('diachi', $bacsi->diachi ?? '') }}">
                        @error('diachi')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if ($user->role != 'hospital')
                        <div class="row justify-content-center mt-1">
                            <label class="form-label fw-bold">Cơ sở</label>
                            <select name="id_coso" id="coso"
                                class="form-control @error('id_coso') is-invalid @enderror" required>
                                <option value="">-- Chọn cơ sở --</option>
                                @foreach ($lstCS as $coso)
                                    <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                @endforeach
                            </select>

                            @error('id_coso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @else
                        <div class="row justify-content-center mt-1">
                            <label class="form-label fw-bold">Cơ sở</label>
                            <select name="id_coso" id="coso"
                                class="form-control @error('id_coso') is-invalid @enderror" required>
                                <option value="">-- Chọn cơ sở --</option>
                                @foreach ($lstCS as $coso)
                                    @if ($coso->id === $cs_nv->id)
                                        <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                    @endif
                                @endforeach
                            </select>

                            @error('id_coso')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    @endif
                    <div class="row justify-content-center mt-1">
                        <!-- Chọn Chuyên khoa -->
                        <div class="mb-3">
                            <label class="form-label fw-bold">Chuyên khoa</label>
                            <select name="id_chuyenkhoa" id="chuyenkhoa"
                                class="form-control @error('id_chuyenkhoa') is-invalid @enderror" required disabled>
                                <option value="">-- Chọn chuyên khoa --</option>
                            </select>
                        </div>
                        @error('id_chuyenkhoa')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row justify-content-center mt-1">
                        <label for="hinhanh">Hình ảnh</label>
                        <input type="file" class="form-control @error('hinhanh') is-invalid @enderror" name="hinhanh">
                        @error('hinhanh')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <br>
                    <label class="form-label">Tạo lịch khám</label>
                    <table class="table" id="lich-kham-table">
                        <thead>
                            <tr>
                                <th>Ngày khám</th>
                                <th>Buổi khám</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>

                                <td><input type="date" name="lich_kham[0][ngay]" class="form-control" required
                                        min="<?= date('Y-m-d', strtotime('+1 day')) ?>"></td>

                                <td>
                                    <select name="lich_kham[0][buoi]" class="form-control" required>
                                        <option value="Sáng">Sáng</option>
                                        <option value="Chiều">Chiều</option>
                                    </select>
                                </td>
                                <td><button type="button" class="btn btn-danger remove-row"><i class="bi bi-x-circle"></i>
                                        Xóa</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center mb-3">
                        <button type="button" class="btn btn-primary" id="add-row"><i class="bi bi-plus-square"></i>
                            Thêm
                            lịch khám</button>
                    </div>
                    <script>
                        document.addEventListener("DOMContentLoaded", function() {

                            let index = 1;
                            let today = new Date();
                            today.setDate(today.getDate() + 1); // Cộng thêm 1 ngày để lấy ngày mai
                            let tomorrow = today.toISOString().split("T")[0]; // Định dạng YYYY-MM-DD

                            // Cập nhật min cho input đầu tiên
                            document.querySelector('input[type="date"]').setAttribute("min", tomorrow);

                            document.getElementById("add-row").addEventListener("click", function() {
                                let table = document.getElementById("lich-kham-table").getElementsByTagName('tbody')[0];
                                let newRow = document.createElement("tr");
                                newRow.innerHTML = `
                                    <td><input type="date" name="lich_kham[${index}][ngay]" class="form-control" required min="${tomorrow}"></td>
                                    <td>
                                        <select name="lich_kham[${index}][buoi]" class="form-control" required>
                                            <option value="Sáng">Sáng</option>
                                            <option value="Chiều">Chiều</option>
                                        </select>
                                    </td>
                                    <td><button type="button" class="btn btn-danger remove-row"><i class="bi bi-x-circle"></i> Xóa</button></td>
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
                            // Reset dropdown chuyên khoa
                            chuyenkhoaSelect.innerHTML = '<option value="">-- Chọn chuyên khoa --</option>';
                            chuyenkhoaSelect.disabled = true;

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

                    <div class="d-flex gap-2 mt-4">

                        <button type="submit" class="btn btn-success d-flex align-items-center">
                            <i class="bi bi-plus-circle me-2"></i>Thêm Bác Sĩ
                        </button>

                        <button type="reset" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                            <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                        </button>

                    </div>
                </form>
            </div>
        </div>
    </div>
    <a href="{{ url()->previous() }}" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
@endsection
