@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>


@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Chuyên Khoa</h1>
        <div class="row mb-3 align-items-end">
            <div class="col-9 col-md-6">
                <button type="button" id="btn-them-chuyenkhoa" class="btn btn-info mb-4 rounded">
                    <i class="align-middle me-2" data-feather="plus-square"></i>Thêm chuyên khoa mới
                </button>
            </div>

            <div class="col-3 col-md-6 text-end">
                <a href="{{ route('chuyenkhoa.export') }}" class="btn btn-success mb-3">
                    <i data-feather="download"></i> Xuất Excel
                </a>
            </div>


            <script>
                $(document).ready(function() {
                    // Submit form mà không reload trang
                    $('#exportForm').submit(function(e) {
                        e.preventDefault();
                        var cosoId = $('#coso_id').val();
                        var url = "{{ route('chuyenkhoa.export') }}" + (cosoId ? "?coso_id=" + cosoId : "");
                        window.location.href = url; // Tải file Excel về
                        $('#exportModal').modal('hide'); // Ẩn modal
                    });
                });
            </script>
            <form method="POST" action="{{ route('chuyenkhoa.store') }}" enctype="multipart/form-data" id="form-chuyenkhoa"
                style="display: none;">
                @csrf
                @method('POST')
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            @if ($user->role != 'hospital')
                                <div class="col-4">
                                    <label for="id_coso">Chọn cơ sở</label>
                                    <select class="form-control @error('id_coso') is-invalid @enderror" name="id_coso"
                                        required>
                                        <option value="">-- Chọn cơ sở --</option>
                                        @foreach ($dsCoSo as $coso)
                                            <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                        @endforeach
                                    </select>
                                    @error('id_coso')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @else
                                <div class="col-4">
                                    <label for="id_coso">Chọn cơ sở</label>
                                    <select class="form-control @error('id_coso') is-invalid @enderror" name="id_coso"
                                        required>
                                        <option value="">-- Chọn cơ sở --</option>
                                        @foreach ($dsCoSo as $coso)
                                            @if ($cs_nv->id === $coso->id)
                                                <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    @error('id_coso')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            @endif
                            <div class="col-4">
                                <label for="tenkhoa">Tên chuyên khoa</label>
                                <input type="text" class="form-control @error('tenkhoa') is-invalid @enderror"
                                    value="{{ old('tenkhoa') }}" id="tenkhoa" name="tenkhoa"
                                    placeholder="Nhập tên chuyên khoa">
                                @error('tenkhoa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-4">
                                <label for="giakham">Giá khám</label>
                                <input type="number" class="form-control @error('giakham') is-invalid @enderror"
                                    value="{{ old('giakham') }}" id="giakham" name="giakham" placeholder="Nhập giá khám">
                                @error('giakham')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row justify-content-center mt-3">
                            <div class="col-12">
                                <label for="mota">Mô tả</label>
                                <textarea name="mota" class="form-control @error('mota') is-invalid @enderror" id="mota"
                                    placeholder="Nhập mô tả" rows="3">{{ old('mota') }}</textarea>
                                @error('mota')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
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
                        </div>

                        <br>
                        <div class="d-flex gap-2">

                            <button type="submit" class="btn btn-success d-flex align-items-center">
                                <i class="bi bi-plus-circle me-2"></i>Thêm Chuyên Khoa
                            </button>

                            <button type="button" class="btn btn-secondary d-flex align-items-center" id="reset-form">
                                <i class="bi bi-arrow-clockwise me-2"></i>Đặt lại
                            </button>

                        </div>
                    </div>
                </div>
            </form>


            <!-- JavaScript để xử lý nút Reset -->
            <script>
                document.getElementById('btn-them-chuyenkhoa').addEventListener('click', function() {
                    let form = document.getElementById('form-chuyenkhoa');
                    form.style.display = (form.style.display === 'none') ? 'block' : 'none';
                });
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
            <form method="GET" action="{{ route('chuyenkhoa.index') }}" class="row g-2 mb-3">
                <div class="card rounded-4 mb-3">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col my-auto d-flex">
                                        <input type="text" name="keyword" class="form-control me-2"
                                            placeholder="Nhập từ khóa cần tìm kiếm" value="{{ request('keyword') }}">

                                        @if ($user->role != 'hospital')
                                            <select name="id_coso" id="id_coso" class="form-select"
                                                onchange="this.form.submit()">
                                                <option value="">-- Tất cả cơ sở --</option>
                                                @foreach ($dsCoSo as $coso)
                                                    <option value="{{ $coso->id }}"
                                                        {{ request('id_coso') == $coso->id ? 'selected' : '' }}>
                                                        {{ $coso->tencoso }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        @endif

                                        <button type="submit" class="btn btn-primary text-nowrap ms-1">
                                            <i class="align-middle" data-feather="search"></i>
                                        </button>

                                        <a href="{{ route('chuyenkhoa.index') }}"
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
                            <h5 class="card-title mb-0">Danh sách các chuyên khoa ({{ $lstCK->total() }} hàng)</h5>
                        </div>
                        @if ($lstCK->isEmpty())
                            <div class="card-body">
                                <div class="alert alert-danger">
                                    Không tìm thấy chuyên khoa nào!
                                </div>
                            </div>
                        @else
                            <table class="table table-hover my-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Tên khoa</th>
                                        <th>Giá khám</th>
                                        @if ($user->role != 'hospital')
                                            <th>Cơ sở</th>
                                        @endif
                                        <th class="d-none d-xl-table-cell">Mô tả</th>
                                        <th class="d-none d-xl-table-cell">Ngày tạo</th>
                                        <th class="d-none d-xl-table-cell">Ngày cập nhật</th>
                                        <th>Sửa</th>
                                        <th>Xóa</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($lstCK as $key => $ck)
                                        <tr>
                                            <td>{{ $lstCK->firstItem() + $key }}</td>
                                            <td>{{ $ck->tenkhoa }}</td>
                                            <td>{{ $ck->giakham }}</td>
                                            @if ($user->role != 'hospital')
                                                <td class="d-none d-xl-table-cell">{{ $ck->coso->tencoso ?? 'N/A' }}</td>
                                            @endif
                                            <td class="d-none d-xl-table-cell">{{ Str::limit($ck->mota, 50, '...') }}</td>


                                            <td class="d-none d-xl-table-cell">{{ $ck->created_at }}</td>
                                            <td class="d-none d-xl-table-cell">{{ $ck->updated_at }}</td>
                                            <td>
                                                <a class="btn btn-warning"
                                                    href="{{ route('chuyenkhoa.edit', ['id' => $ck->id]) }}">
                                                    <i class="align-middle" data-feather="edit"></i>
                                                </a>
                                            </td>
                                            <td>
                                                <a class="btn btn-danger"
                                                    href="{{ route('chuyenkhoa.delete', ['id' => $ck->id]) }}"
                                                    onclick="return confirm('Bạn có chắc chắn muốn xóa chuyên khoa {{ $ck->id }} không?');">
                                                    <i class="align-middle" data-feather="trash-2"></i>
                                                </a>
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
                {{ $lstCK->withQueryString()->links() }}
            </div>
        </div>
    @endsection
