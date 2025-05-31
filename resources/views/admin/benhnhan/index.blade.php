@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>


@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý Tài Khoản</strong> Bệnh nhân</h1>

        <!-- Form tìm kiếm và lọc -->
        <form method="GET" action="{{ route('taikhoanbenhnhan.index') }}" class="row g-2 mb-3">
            <div class="card rounded-4 mb-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col my-auto d-flex">
                                    <input type="text" name="keyword" class="form-control me-2"
                                        placeholder="Nhập email hoặc tên tài khoản" value="{{ request('keyword') }}">

                                    <select name="status" class="form-select ms-2">
                                        <option value="">-- Trạng thái --</option>
                                        <option value="1" {{ request('status') == '1' ? 'selected' : '' }}>Đã kích hoạt
                                        </option>
                                        <option value="0" {{ request('status') == '0' ? 'selected' : '' }}>Đã khóa
                                        </option>
                                    </select>

                                    <button type="submit" class="btn btn-primary text-nowrap ms-2">
                                        <i class="align-middle" data-feather="search"></i>
                                    </button>

                                    <a href="{{ route('taikhoanbenhnhan.index') }}"
                                        class="btn btn-secondary text-nowrap ms-2">
                                        <i class="align-middle" data-feather="refresh-cw"></i>
                                        Tải lại
                                    </a>
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
                        <h5 class="card-title mb-0">Danh sách các tài khoản ({{ $users->total() }} hàng)</h5>
                    </div>
                    @if ($users->isEmpty())
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Không tìm thấy tài khoản nào!
                            </div>
                        </div>
                    @else
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Tên tài khoản</th>
                                    <th>Email</th>
                                    <th>Số hồ sơ</th>
                                    <th>Trạng thái</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $i => $user)
                                    <tr>
                                        <td>{{ $users->firstItem() + $i }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->benhnhan->count() }}</td>

                                        <td>
                                            @if ($user->status == 0)
                                                <span class="badge bg-danger">Đã khóa</span>
                                            @else
                                                <span class="badge bg-success">Đã kích hoạt</span>
                                            @endif
                                        </td>
                                        <td class="text-center">

                                            @if (in_array(Auth::user()->role, ['manage', 'hospital']))
                                                <div class="d-flex gap-3 mt-1">
                                                    <button class="btn btn-success g btn-sm open-status-modal"
                                                        data-id="{{ $user->id }}"
                                                        data-trangthai="{{ $user->status }}">
                                                        <i class="align-middle" data-feather="refresh-ccw"></i>
                                                    </button>
                                                    <a href="{{ route('taikhoanbenhnhan.deleteXoaTK', ['id' => $user->id]) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản có id {{ $user->id }} không?');"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </a>
                                                    <a href="{{ route('taikhoanbenhnhan.xemhoso', $user->id) }}"
                                                        class="btn btn-warning btn-sm"><i data-feather="eye"></i>
                                                    </a>
                                                </div>
                                            @endif

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            {{ $users->withQueryString()->links() }}
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

                fetch("{{ route('taikhoanbenhnhan.updateStatus') }}", {
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
