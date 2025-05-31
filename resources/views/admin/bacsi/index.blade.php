@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<!-- Thêm Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Bác Sĩ</h1>
        <div class="row mb-3 align-items-end">
            <div class="col-9 col-md-6">
                <a href="{{ route('bacsi.create') }}" class="btn btn-info mb-4 rounded">
                    <i class="align-middle me-2" data-feather="plus-square"></i> Thêm bác sĩ</a>
            </div>
            <div class="col-3 col-md-6 text-end">
                <a href="{{ route('bacsi.export') }}" class="btn btn-success mb-3">
                    <i data-feather="download"></i> Xuất Excel
                </a>
            </div>
            <!-- JavaScript để xử lý nút Reset -->
            <script>
                document.getElementById("reset-form").addEventListener("click", function() {
                    let form = document.getElementById("form-chuyenkhoa");

                    // Xóa dữ liệu trong form
                    form.reset();

                    // Xóa lỗi validation nếu có
                    form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
                    form.querySelectorAll(".invalid-feedback").forEach(el => el.innerHTML = "");
                });
            </script>


            <!-- Form tìm kiếm và lọc -->
            <form method="GET" action="{{ route('bacsi.index') }}" class="row g-2 mb-3">
                <div class="card rounded-4 mb-3">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col my-auto d-flex">
                                        <input type="text" name="keyword" class="form-control me-2"
                                            placeholder="Nhập họ tên cần tìm" value="{{ request('keyword') }}">

                                        @if ($user->role != 'hospital')
                                            <div class="col-md-3">

                                                <select name="id_coso" id="coso" class="form-select">
                                                    <option value="">-- Cơ sở --</option>
                                                    @foreach ($lstCS as $coso)
                                                        <option value="{{ $coso->id }}"
                                                            {{ request('id_coso') == $coso->id ? 'selected' : '' }}>
                                                            {{ $coso->tencoso }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @endif

                                        <button type="submit" class="btn btn-primary text-nowrap ms-1">
                                            <i class="align-middle" data-feather="search"></i>

                                        </button>

                                        <a href="{{ route('bacsi.index') }}" class="btn btn-secondary text-nowrap ms-2">
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
                                    @if ($user->role != 'hospital')
                                        <div class="col-6 col-md-4 mb-3 mb-md-0">
                                            <select name="id_chuyenkhoa" id="chuyenkhoa" class="form-select">
                                                <option value="">-- Chuyên khoa --</option>
                                                @foreach ($lstCK as $ck)
                                                    <option value="{{ $ck->id }}"
                                                        {{ request('id_chuyenkhoa') == $ck->id ? 'selected' : '' }}>
                                                        {{ $ck->tenkhoa }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <script>
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
                                                                chuyenkhoaSelect.innerHTML = '<option value="">-- Chuyên khoa --</option>';
                                                                data.forEach(chuyenkhoa => {
                                                                    chuyenkhoaSelect.innerHTML +=
                                                                        `<option value="${chuyenkhoa.id}">${chuyenkhoa.tenkhoa}</option>`;
                                                                });
                                                            } else {
                                                                chuyenkhoaSelect.disabled = false;
                                                                chuyenkhoaSelect.innerHTML = '<option value="">-- Không có chuyên khoa --</option>';
                                                            }
                                                        })
                                                        .catch(error => console.error("Lỗi:", error));
                                                } else {
                                                    // Nếu KHÔNG chọn cơ sở => load lại danh sách tất cả chuyên khoa
                                                    fetch(`/get-all-chuyenkhoa`)
                                                        .then(response => response.json())
                                                        .then(data => {
                                                            console.log("Tất cả chuyên khoa:", data);
                                                            chuyenkhoaSelect.disabled = false;
                                                            chuyenkhoaSelect.innerHTML = '<option value="">-- Chuyên khoa --</option>';
                                                            data.forEach(chuyenkhoa => {
                                                                chuyenkhoaSelect.innerHTML +=
                                                                    `<option value="${chuyenkhoa.id}">${chuyenkhoa.tenkhoa}</option>`;
                                                            });
                                                        })
                                                        .catch(error => console.error("Lỗi:", error));
                                                }
                                            });
                                        </script>
                                    @endif
                                    @if ($user->role === 'hospital')
                                        <div class="col-6 col-md-4 mb-3 mb-md-0">
                                            <select name="id_chuyenkhoa" class="form-select">
                                                <option value="">-- Chuyên khoa --</option>
                                                @foreach ($lstCK as $ck)
                                                    @if ($ck->id_coso === $cs_nv->id)
                                                        <option value="{{ $ck->id }}"
                                                            {{ request('id_chuyenkhoa') == $ck->id ? 'selected' : '' }}>
                                                            {{ $ck->tenkhoa }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    <div class="col-6 col-md-2 mb-3 mb-md-0">
                                        <select name="gioitinh" class="form-select">
                                            <option value="">-- Giới tính --</option>
                                            <option value="Nam" {{ request('gioitinh') == 'Nam' ? 'selected' : '' }}>Nam
                                            </option>
                                            <option value="Nữ" {{ request('gioitinh') == 'Nữ' ? 'selected' : '' }}>Nữ
                                            </option>
                                        </select>
                                    </div>

                                    <div class="col-6 col-md-3 mb-3 mb-md-0">

                                        <select name="hocham" class="form-select" name="hocham"
                                            value="{{ request('hocham') }}">
                                            <option value="">-- Học hàm --</option>
                                            @foreach ($hocHamList as $hocHam)
                                                <option value="{{ $hocHam }}"
                                                    {{ request('hocham') == $hocHam ? 'selected' : '' }}>
                                                    {{ $hocHam }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                                        <select name="trangthai" class="form-select">
                                            <option value="">-- Trạng thái --</option>
                                            <option value="1" {{ request('trangthai') == '1' ? 'selected' : '' }}>Còn
                                                làm
                                            </option>
                                            <option value="0" {{ request('trangthai') == '0' ? 'selected' : '' }}>Nghỉ
                                                việc</option>
                                        </select>
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
                            <h5 class="card-title mb-0">Danh sách các bác sĩ ({{ $lstBS->total() }} hàng)</h5>
                        </div>
                        @if ($lstBS->isEmpty())
                            <div class="alert alert-danger">
                                Không tìm thấy bác sĩ nào!
                            </div>
                        @else
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Họ tên</th>
                                        <th>Giới tính</th>
                                        <th class="d-none d-xl-table-cell">Địa chỉ</th>
                                        @if ($user->role != 'hospital')
                                            <th class="d-none d-xl-table-cell">Cơ sở</th>
                                        @endif
                                        <th class="d-none d-xl-table-cell">Chuyên khoa</th>
                                        <th>Học hàm</th>
                                        <th>Hình Ảnh</th>
                                        <th class="d-none d-xl-table-cell">Trạng thái</th>
                                        @if ($user->role === 'hospital')
                                            <th>Ngày cập nhật</th>
                                        @endif
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstBS as $key => $bs)
                                        <tr>
                                            <td>{{ $lstBS->firstItem() + $key }}</td>
                                            <td>{{ $bs->hoten }}</td>
                                            <td>{{ $bs->gioitinh }}</td>
                                            <td class="d-none d-xl-table-cell">{{ Str::limit($bs->diachi, 20, '...') }}
                                            </td>
                                            @if ($user->role != 'hospital')
                                                <td class="d-none d-xl-table-cell">{{ $bs->coso->tencoso ?? 'N/A' }}</td>
                                            @endif
                                            <td class="d-none d-xl-table-cell">{{ $bs->chuyenkhoa->tenkhoa ?? 'N/A' }}</td>
                                            <td>{{ $bs->hocham }}</td>
                                            <td>
                                                @if ($bs->hinhanh)
                                                    <img src="{{ asset($bs->hinhanh) }}" class="img-thumbnail"
                                                        style="width: 80px; height: 80px; object-fit: cover;">
                                                @else
                                                    <span>Chưa có ảnh</span>
                                                @endif
                                            </td>
                                            <td class="d-none d-xl-table-cell">
                                                @if ($bs->trangthai == 0)
                                                    <span class="badge bg-danger">Nghỉ việc</span>
                                                @else
                                                    <span class="badge bg-success">Còn làm</span>
                                                @endif
                                            </td>
                                            @if ($user->role === 'hospital')
                                                <td> {{ $bs->updated_at }} </td>
                                            @endif
                                            <td class="text-center">
                                                <div class="d-flex gap-2 mt-1">
                                                    <button class="btn btn-success open-status-modal"
                                                        data-id="{{ $bs->id }}"
                                                        data-trangthai="{{ $bs->trangthai }}">
                                                        <i class="fas fa-exchange-alt"></i>
                                                    </button>
                                                    <a href="{{ route('bacsi.lichkham', $bs->id) }}"
                                                        class="btn btn-info"><i class="bi bi-calendar-event"></i></a>
                                                </div>
                                                <div class="d-flex gap-2 mt-1">
                                                    <a class="btn btn-warning"
                                                        href="{{ route('bacsi.edit', ['id' => $bs->id]) }}">
                                                        <i class="align-middle" data-feather="edit"></i>
                                                    </a>
                                                    <a class="btn btn-danger"
                                                        href="{{ route('bacsi.delete', ['id' => $bs->id]) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bác sĩ {{ $bs->id }} không?');">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
            <!-- Phân trang -->
            <div class="d-flex justify-content-center">
                {{ $lstBS->withQueryString()->links() }}
            </div>
        </div>

        <!-- Modal đổi trạng thái -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Đổi trạng thái bác sĩ</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="bacSiId">
                        <select id="newStatus" class="form-select">
                            <option value="0">Nghỉ việc</option>
                            <option value="1">Còn làm</option>
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="button" class="btn btn-primary" id="saveStatus">Lưu</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                let statusModal = new bootstrap.Modal(document.getElementById("statusModal"));
                let selectedBacSiId = null;

                document.querySelectorAll(".open-status-modal").forEach(button => {
                    button.addEventListener("click", function() {
                        selectedBacSiId = this.dataset.id;
                        let trangthai = this.dataset.trangthai;
                        document.getElementById("bacSiId").value = selectedBacSiId;
                        document.getElementById("newStatus").value = trangthai;
                        statusModal.show();
                    });
                });

                document.getElementById("saveStatus").addEventListener("click", function() {
                    let id = document.getElementById("bacSiId").value;
                    let trangthai = document.getElementById("newStatus").value;

                    fetch("{{ route('bacsi.updateStatus') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                id: id,
                                trangthai: trangthai
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                alert("Cập nhật trạng thái thành công!");
                                statusModal.hide();
                                location.reload(); // Cập nhật lại danh sách lịch hẹn
                            } else {
                                alert("Cập nhật thất bại!");
                            }
                        })
                        .catch(error => console.error("Lỗi:", error));
                });
            });
        </script>
    @endsection
