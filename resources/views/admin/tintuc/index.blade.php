@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Tin Tức</h1>
        <form method="GET" action="{{ route('qltintuc.index') }}" class="row g-2 mb-3">
            <div class="card rounded-4 mb-3">
                <div class="card-body">

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="row">
                                <div class="col my-auto d-flex">

                                    <input type="text" name="keyword" class="form-control me-2"
                                        placeholder="Nhập tiêu đề, mô tả hoặc nội dung" value="{{ request('keyword') }}">


                                    <button type="submit" class="btn btn-primary text-nowrap">
                                        <i class="align-middle" data-feather="search"></i>

                                    </button>

                                    <a href="{{ route('qltintuc.index') }}" class="btn btn-secondary text-nowrap ms-2">
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
                                    <label>Lọc theo loại tin</label>
                                    <select name="loai" class="form-select">
                                        <option value="">-- Loại tin --</option>
                                        <option value="1" {{ request('loai') === '1' ? 'selected' : '' }}>Tin dịch vụ
                                        </option>
                                        <option value="2" {{ request('loai') === '2' ? 'selected' : '' }}>Tin y tế
                                        </option>
                                        <option value="3" {{ request('loai') === '3' ? 'selected' : '' }}>Y tế thường
                                            thức</option>
                                    </select>
                                </div>
                                <div class="col-6 col-md-3 mb-3 mb-md-0">
                                    <label>Lọc theo trạng thái</label>
                                    <select name="trangthai" class="form-select">
                                        <option value="">-- Trạng thái --</option>
                                        <option value="1" {{ request('trangthai') == '1' ? 'selected' : '' }}>Đã duyệt
                                        </option>
                                        <option value="0" {{ request('trangthai') == '0' ? 'selected' : '' }}>Chưa
                                            duyệt</option>
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


        <!-- JavaScript để xử lý nút Reset -->
        <script>
            document.getElementById("reset-form").addEventListener("click", function() {
                let form = document.getElementById("form-coso");

                // Xóa dữ liệu trong form
                form.reset();

                // Xóa lỗi validation nếu có
                form.querySelectorAll(".is-invalid").forEach(el => el.classList.remove("is-invalid"));
                form.querySelectorAll(".invalid-feedback").forEach(el => el.innerHTML = "");
            });
        </script>


        <div class="row justify-content-center">
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh sách các tin tức ({{ $lstTintuc->total() }} hàng)</h5>
                    </div>
                    @if ($lstTintuc->isEmpty())
                        <div class="card-body">
                            <div class="alert alert-danger">
                                Không tìm thấy tin tức nào!
                            </div>
                        </div>
                    @else
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Người viết</th>
                                    <th>Hình ảnh</th>
                                    <th>Tiêu đề</th>
                                    <th>Mô tả</th>
                                    <th class="d-none d-md-table-cell">Nội dung</th>
                                    <th class="d-none d-xl-table-cell">Loại tin tức</th>
                                    <th class="d-none d-xl-table-cell">Trạng thái</th>
                                    <th class="d-none d-xl-table-cell">Ngày tạo</th>
                                    <th class="d-none d-xl-table-cell">Ngày cập nhật</th>
                                    <th>Hành động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lstTintuc as $key => $tt)
                                    <tr>
                                        <td>{{ $lstTintuc->firstItem() + $key }}</td>
                                        <td>{{ $tt->nhanvien->hoten ?? 'Không rõ' }}</td>
                                        <td>
                                            @if ($tt->hinhanh)
                                                <img src="{{ asset($tt->hinhanh) }}" class="img-thumbnail"
                                                    style="width: 80px; height: 80px; object-fit: cover;">
                                            @else
                                                <span>Chưa có ảnh</span>
                                            @endif
                                        </td>
                                        <td>{{ Str::limit($tt->tieude, 10, '...') }}</td>
                                        <td>{{ Str::limit($tt->mota, 20, '...') }}</td>
                                        <td class="d-none d-md-table-cell">{{ Str::limit($tt->noidung, 50, '...') }}</td>

                                        <td class="d-none d-xl-table-cell">
                                            @if ($tt->loai == 1)
                                                <span class="badge bg-primary">Tin dịch vụ</span>
                                            @elseif ($tt->loai == 2)
                                                <span class="badge bg-success">Tin y tế</span>
                                            @else
                                                <span class="badge bg-info">Y tế thường thức</span>
                                            @endif
                                        </td>

                                        <td class="d-none d-xl-table-cell">
                                            @if ($tt->trangthai == 0)
                                                <span class="badge bg-info">Chưa được duyệt</span>
                                            @else
                                                <span class="badge bg-success">Đã duyệt</span>
                                            @endif

                                        </td>

                                        <td class="d-none d-xl-table-cell">{{ $tt->created_at }}</td>
                                        <td class="d-none d-xl-table-cell">{{ $tt->updated_at }}</td>
                                        @php
                                            $nv = Auth::user()->nhanvien;
                                        @endphp

                                        <td class="text-center">
                                            @if (Auth::user()->role == 'manage')
                                                <div class="d-flex gap-2 mt-1">
                                                    <button class="btn btn-success g btn-sm open-status-modal"
                                                        data-id="{{ $tt->id }}"
                                                        data-trangthai="{{ $tt->trangthai }}">
                                                        <i class="align-middle" data-feather="refresh-ccw"></i>

                                                    </button>
                                                    <a href="{{ route('qltintuc.delete', ['id' => $tt->id]) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết có id {{ $tt->id }} không?');"
                                                        class="btn btn-danger btn-sm">
                                                        <i class="align-middle" data-feather="trash-2"></i>
                                                    </a>

                                                </div>
                                                <div class="mt-1">
                                                    <a href="{{ route('tintuc.xem', $tt->id) }}"
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
            {{ $lstTintuc->withQueryString()->links() }}
        </div>
    </div>
    <!-- Modal đổi trạng thái -->
    <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="statusModalLabel">Đổi trạng thái tin tức</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="tinTucId">
                    <select id="newStatus" class="form-select">
                        <option value="0">Chưa duyệt</option>
                        <option value="1">Đã duyệt</option>
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
            let selectedTinTucId = null;

            document.querySelectorAll(".open-status-modal").forEach(button => {
                button.addEventListener("click", function() {
                    selectedTinTucId = this.dataset.id;
                    let trangthai = this.dataset.trangthai;
                    document.getElementById("tinTucId").value = selectedTinTucId;
                    document.getElementById("newStatus").value = trangthai;
                    statusModal.show();
                });
            });

            document.getElementById("saveStatus").addEventListener("click", function() {
                let id = document.getElementById("tinTucId").value;
                let trangthai = document.getElementById("newStatus").value;

                fetch("{{ route('qltintuc.updateStatus') }}", {
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
