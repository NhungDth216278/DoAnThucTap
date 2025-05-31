@extends('admin.main')
<!-- Thêm Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->


@section('content')
    <div class="container-fluid p-0">
        <div class="row mb-3 align-items-end">
            <div class="col-9 col-md-6">
                <h1 class="h3 mb-3"><strong>Quản lý</strong> Lịch hẹn</h1>
            </div>
            <div class="col-3 col-md-6 text-end">
                <a href="{{ route('lichhen.export') }}" class="btn btn-success mb-3">
                    <i data-feather="download"></i> Xuất Excel
                </a>
            </div>
            <!-- Form tìm kiếm và lọc -->
            <form method="GET" action="{{ route('lichhen.index') }}" class="row g-2 mb-3">
                <div class="card rounded-4 mb-3">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col my-auto d-flex">
                                        <input type="text" name="search" class="form-control me-2"
                                            placeholder="Nhập họ tên bệnh nhân, cơ sở hoặc chuyên khoa"
                                            value="{{ request('search') }}">

                                        @if ($user->role != 'hospital')
                                            <select name="id_bacsi" class="form-select">
                                                <option value="">-- Bác sĩ --</option>
                                                @foreach ($bacSiList as $bacSi)
                                                    <option value="{{ $bacSi->id }}"
                                                        {{ request('id_bacsi') == $bacSi->id ? 'selected' : '' }}>
                                                        {{ $bacSi->hoten }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @else
                                            <select name="id_bacsi" class="form-select">
                                                <option value="">-- Bác sĩ --</option>
                                                @foreach ($bacSiList as $bacSi)
                                                    @if ($bacSi->id_coso === $cs_nv->id)
                                                        <option value="{{ $bacSi->id }}"
                                                            {{ request('id_bacsi') == $bacSi->id ? 'selected' : '' }}>
                                                            {{ $bacSi->hoten }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        @endif

                                        <button type="submit" class="btn btn-primary text-nowrap ms-1">
                                            <i class="align-middle" data-feather="search"></i>

                                        </button>

                                        <a href="{{ route('lichhen.index') }}" class="btn btn-secondary text-nowrap ms-2">
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
                                        <label>Lọc theo trạng thái</label>
                                        <select name="trangthai" class="form-select">

                                            <option value="">-- Trạng thái --</option>
                                            <option value="0" {{ request('trangthai') === '0' ? 'selected' : '' }}>Đã
                                                hủy
                                            </option>
                                            <option value="1" {{ request('trangthai') === '1' ? 'selected' : '' }}>Đặt
                                                lịch thành công
                                            </option>
                                            <option value="2" {{ request('trangthai') === '2' ? 'selected' : '' }}>Đã
                                                khám
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-6 col-md-3 mb-3 mb-md-0">
                                        <label>Lọc theo buổi</label>
                                        <select name="buoi" class="form-select">
                                            <option value="">-- Buổi --</option>
                                            <option value="Sáng" {{ request('buoi') === 'Sáng' ? 'selected' : '' }}>Sáng
                                            </option>
                                            <option value="Chiều" {{ request('buoi') === 'Chiều' ? 'selected' : '' }}>
                                                Chiều
                                            </option>
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
                            <h5 class="card-title mb-0">Danh sách các lịch hẹn ({{ $lichHenList->total() }} hàng)</h5>
                        </div>
                        @if ($lichHenList->isEmpty())
                            <div class="card-body">
                                <div class="alert alert-danger">
                                    Không tìm thấy lịch hẹn nào!
                                </div>
                            </div>
                        @else
                            <!-- Bảng danh sách lịch hẹn -->
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Bệnh nhân</th>
                                        <th>Bác sĩ</th>
                                        @if ($user->role != 'hospital')
                                            <th>Cơ sở</th>
                                        @endif
                                        <th>Chuyên khoa</th>
                                        <th>Ngày hẹn</th>
                                        <th>Buổi</th>
                                        <th>Giờ</th>
                                        <th>Ngày đặt</th>
                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lichHenList as $key => $lichHen)
                                        <tr>
                                            <td>{{ $lichHenList->firstItem() + $key }}</td>
                                            <td>
                                                <a href="#" class="text-primary fw-bold" data-bs-toggle="modal"
                                                    data-bs-target="#modalBenhNhan"
                                                    onclick="fetchBenhNhan({{ $lichHen->id_benhnhan }})">
                                                    {{ $lichHen->benhNhan->hoten }}
                                                </a>

                                            </td>
                                            <td>{{ $lichHen->bacSi->hoten }}</td>
                                            @if ($user->role != 'hospital')
                                                <td>{{ $lichHen->bacSi->coSo->tencoso }}</td>
                                            @endif
                                            <td>{{ $lichHen->bacSi->chuyenKhoa->tenkhoa }}</td>
                                            <td>{{ $lichHen->ngayhen }}</td>
                                            <td>{{ $lichHen->buoi }}</td>
                                            <td>{{ $lichHen->thoigian }}</td>
                                            <td>{{ $lichHen->created_at }}</td>
                                            <td>
                                                @if ($lichHen->trangthai == 0)
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                @elseif($lichHen->trangthai == 1)
                                                    <span class="badge bg-primary">Thành công</span>
                                                @else
                                                    <span class="badge bg-success">Đã khám</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <div class="d-flex gap-2">
                                                    @if ($lichHen->trangthai != 0)
                                                        <button class="btn btn-warning btn-sm open-status-modal"
                                                            data-id="{{ $lichHen->id }}"
                                                            data-trangthai="{{ $lichHen->trangthai }}">
                                                            <i class="fas fa-exchange-alt"></i>
                                                        </button>
                                                    @endif
                                                    <!--<a href="#" class="btn btn-info btn-sm"><i class="fas fa-sync-alt fa-spin"></i></a>-->
                                                    @if ($lichHen->trangthai == 0)
                                                        <a href="{{ route('lichhen.delete', ['id' => $lichHen->id]) }}"
                                                            onclick="return confirm('Bạn có chắc chắn muốn xóa lich hẹn có id {{ $lichHen->id }} của bệnh nhân {{ $lichHen->benhNhan->hoten }} không?');"
                                                            class="btn btn-danger btn-sm">
                                                            <i class="align-middle" data-feather="trash-2"></i>
                                                        </a>
                                                    @endif
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
                {{ $lichHenList->withQueryString()->links() }}
            </div>
        </div>
        <!-- Modal đổi trạng thái -->
        <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="statusModalLabel">Đổi trạng thái lịch hẹn</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="lichHenId">
                        <select id="newStatus" class="form-select">
                            <option value="0">Đã hủy</option>
                            <option value="1">Thành công</option>
                            <option value="2">Đã khám</option>
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
            function fetchBenhNhan(id_benhnhan) {
                fetch(`/admin/qllichhen/benhnhan/${id_benhnhan}/`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            document.getElementById("user_name").innerText = data.user.name;
                            document.getElementById("user_email").innerText = data.user.email;
                            document.getElementById("benhnhan_hoten").innerText = data.benhnhan.hoten;
                            document.getElementById("benhnhan_sodienthoai").innerText = data.benhnhan.sodienthoai;
                            document.getElementById("benhnhan_diachi").innerText = data.benhnhan.diachi;
                            document.getElementById("benhnhan_ngaysinh").innerText = data.benhnhan.ngaysinh;
                            document.getElementById("benhnhan_cccd").innerText = data.benhnhan.cccd;
                            document.getElementById("benhnhan_gioitinh").innerText = data.benhnhan.gioitinh;
                        } else {
                            alert("Không tìm thấy thông tin bệnh nhân.");
                        }
                    })
                    .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
            }

            document.addEventListener("DOMContentLoaded", function() {
                let statusModal = new bootstrap.Modal(document.getElementById("statusModal"));
                let selectedLichHenId = null;

                document.querySelectorAll(".open-status-modal").forEach(button => {
                    button.addEventListener("click", function() {
                        selectedLichHenId = this.dataset.id;
                        let trangthai = this.dataset.trangthai;
                        document.getElementById("lichHenId").value = selectedLichHenId;
                        document.getElementById("newStatus").value = trangthai;
                        statusModal.show();
                    });
                });

                document.getElementById("saveStatus").addEventListener("click", function() {
                    let id = document.getElementById("lichHenId").value;
                    let trangthai = document.getElementById("newStatus").value;

                    fetch("{{ route('lichhen.updateStatus') }}", {
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

        <!-- Modal Hiển Thị Thông Tin Bệnh Nhân -->
        <div class="modal fade" id="modalBenhNhan" tabindex="-1" aria-labelledby="modalBenhNhanLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalBenhNhanLabel">Thông Tin Bệnh Nhân</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-bordered">
                            <tr>
                                <th>Tên tài khoản:</th>
                                <td id="user_name"></td>
                            </tr>
                            <tr>
                                <th>Email:</th>
                                <td id="user_email"></td>
                            </tr>
                            <tr>
                                <th>Họ Tên:</th>
                                <td id="benhnhan_hoten"></td>
                            </tr>
                            <tr>
                                <th>Số Điện Thoại:</th>
                                <td id="benhnhan_sodienthoai"></td>
                            </tr>
                            <tr>
                                <th>Địa Chỉ:</th>
                                <td id="benhnhan_diachi"></td>
                            </tr>
                            <tr>
                                <th>Ngày Sinh:</th>
                                <td id="benhnhan_ngaysinh"></td>
                            </tr>
                            <tr>
                                <th>CCCD:</th>
                                <td id="benhnhan_cccd"></td>
                            </tr>
                            <tr>
                                <th>Giới Tính:</th>
                                <td id="benhnhan_gioitinh"></td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
