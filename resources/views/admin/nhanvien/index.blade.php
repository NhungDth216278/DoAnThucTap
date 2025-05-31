@extends('admin.main')
<!-- Thêm Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Bootstrap JS -->

@section('content')
    <div class="container mt-4">
        <h1 class="h3 mb-3"><strong>Quản lý Tài Khoản</strong> Nhân viên</h1>
        <a class="btn btn-info mb-4 rounded" href="{{ route('nhanvien.create') }}">
            <i class="align-middle me-2" data-feather="plus-square"></i>
            Thêm Thông tin nhân viên mới
        </a>

        <!-- Form tìm kiếm và lọc -->
        <form method="GET" action="{{ route('nhanvien.index') }}" class="row g-2 mb-3">
            <div class="card rounded-4 mb-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="row">
                                <div class="col-auto my-auto">
                                    Tìm kiếm:
                                </div>

                                <div class="col my-auto d-flex">
                                    <input type="text" name="keyword" class="form-control me-2"
                                        placeholder="Nhập tên tài khoản hoặc email" value="{{ request('keyword') }}">
                                    <button type="submit" class="btn btn-primary text-nowrap">
                                        <i class="align-middle" data-feather="search"></i>

                                    </button>

                                    <a href="{{ route('nhanvien.index') }}" class="btn btn-secondary text-nowrap ms-2">
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

                                <div class="col-6 col-md-4 mb-3 mb-md-0">
                                    <label for="date">Lọc theo quyền</label>
                                    <select name="role" class="form-select">
                                        <option value="">-- Quyền --</option>
                                        <option value="manage" {{ request('role') == 'manage' ? 'selected' : '' }}>Nhân viên
                                            Quản lý</option>
                                        <option value="hospital" {{ request('role') == 'hospital' ? 'selected' : '' }}>Nhân
                                            viên bệnh viện</option>
                                        <option value="news" {{ request('role') == 'news' ? 'selected' : '' }}>Nhân viên
                                            đăng tin</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-4 mb-3 mb-md-0">
                                    <label for="date">Lọc theo trạng thái</label>
                                    <select name="status" class="form-select">
                                        <option value="">-- Trạng thái --</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã kích hoạt
                                        </option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã khóa
                                        </option>
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
                        <h5 class="card-title mb-0">Danh sách các nhân viên ({{ $danhSachTaiKhoan->total() }} hàng)</h5>
                    </div>
                    @if ($danhSachTaiKhoan->isEmpty())
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Không tìm thấy nhân viên nào!
                            </div>
                        </div>
                    @else
                        <!-- Bảng danh sách lịch hẹn -->
                        <table class="table  table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th class="d-none d-md-table-cell">Tên tài khoản</th>
                                    <th>Quyền</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($danhSachTaiKhoan as $index => $user)
                                    <tr>
                                        <td>{{ $danhSachTaiKhoan->firstItem() + $index }}</td>
                                        <td>
                                            {{ $user->email }}
                                        </td>
                                        <td class="d-none d-md-table-cell">
                                            <a href="#" class="text-primary fw-bold" data-bs-toggle="modal"
                                                data-bs-target="#modalNhanVien"
                                                onclick="fetchNhanVien({{ $user->id }})">
                                                {{ $user->name }}
                                            </a>
                                        </td>
                                        <td>{{ $user->role }}</td>
                                        <td>
                                            @if ($user->status == 0)
                                                <span class="badge bg-danger">Đã khóa</span>
                                            @else
                                                <span class="badge bg-success">Đã kích hoạt</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-3 mt-1">
                                                <button class="btn btn-success btn-sm open-status-modal"
                                                    data-id="{{ $user->id }}" data-trangthai="{{ $user->status }}">
                                                    <i class="fas fa-exchange-alt"></i>
                                                </button>
                                                <a class="btn btn-warning btn-sm"
                                                    href="{{ route('nhanvien.edit', ['id' => $user->id]) }}">
                                                    <i class="align-middle" data-feather="edit"></i>
                                                </a>
                                                <a href="{{ route('nhanvien.delete', ['id' => $user->id]) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản có id {{ $user->id }} không?');"
                                                    class="btn btn-danger btn-sm">
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
            {{ $danhSachTaiKhoan->withQueryString()->links() }}
        </div>
    </div>
    <!-- Modal đổi trạng thái -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Đổi trạng thái tài khoản người dùng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="userId">
                    <select id="newStatus" class="form-select">
                        <option value="0">Khóa tài khoản</option>
                        <option value="1">Mở tài khoản</option>
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
        function fetchNhanVien(id_user) {
            fetch(`/admin/nhan-vien/thongtinnhanvien/${id_user}/`)
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        const nv = data.nhanvien;

                        document.getElementById("nhanvien_hoten").innerText = nv.hoten;
                        document.getElementById("nhanvien_sodienthoai").innerText = nv.sodienthoai;
                        document.getElementById("nhanvien_diachi").innerText = nv.diachi;
                        document.getElementById("nhanvien_gioitinh").innerText = nv.gioitinh;

                        // Hiển thị avatar
                        let avatar = nv.avatar;
                        if (avatar) {
                            document.getElementById("nhanvien_avatar").innerHTML =
                                `<img src="${window.location.origin}/${avatar}" alt="Avatar" width="100" height="100" class="img-thumbnail">`;
                        } else {
                            let defaultAvatar = "{{ asset('upload/avatars/avatar.png') }}";
                            document.getElementById("nhanvien_avatar").innerHTML =
                                `<img src="${defaultAvatar}" alt="Avatar" width="100" height="100" class="img-thumbnail">`;
                        }

                        // Hiển thị tên cơ sở
                        if (nv.coso && nv.coso.tencoso) {
                            document.getElementById("nhanvien_coso").innerText = nv.coso.tencoso;
                        } else {
                            document.getElementById("nhanvien_coso").innerText = "Không rõ cơ sở";
                        }

                        $('#modalNhanVien').modal('show');
                    } else {
                        alert("Không tìm thấy thông tin nhân viên.");
                    }
                })
                .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
        }



        document.addEventListener("DOMContentLoaded", function() {
            let statusModal = new bootstrap.Modal(document.getElementById("statusModal"));
            let selectedUserId = null;

            document.querySelectorAll(".open-status-modal").forEach(button => {
                button.addEventListener("click", function() {
                    selectedUserId = this.dataset.id;
                    let trangthai = this.dataset.trangthai;
                    document.getElementById("userId").value = selectedUserId;
                    document.getElementById("newStatus").value = trangthai;
                    statusModal.show();
                });
            });

            document.getElementById("saveStatus").addEventListener("click", function() {
                let id = document.getElementById("userId").value;
                let trangthai = document.getElementById("newStatus").value;

                fetch("{{ route('nhanvien.updateStatus') }}", {
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

    <!-- Modal Hiển Thị Thông Tin Nhân Viên -->
    <div class="modal fade" id="modalNhanVien" tabindex="-1" aria-labelledby="modalNhanVienLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalNhanVienLabel">Thông Tin Nhân Viên</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Avatar:</th>
                            <td id="nhanvien_avatar">Chưa có avatar</td> <!-- Mặc định là "Chưa có avatar" -->
                        </tr>
                        <tr>
                            <th>Cơ sở:</th>
                            <td id="nhanvien_coso">...</td>
                        </tr>
                        <tr>
                            <th>Họ Tên:</th>
                            <td id="nhanvien_hoten">...</td>
                        </tr>
                        <tr>
                            <th>Số Điện Thoại:</th>
                            <td id="nhanvien_sodienthoai">...</td>
                        </tr>
                        <tr>
                            <th>Địa Chỉ:</th>
                            <td id="nhanvien_diachi">...</td>
                        </tr>

                        <tr>
                            <th>Giới Tính:</th>
                            <td id="nhanvien_gioitinh">...</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
