@extends('admin.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

@section('content')
    <div class="container-fluid p-0">
        <h1 class="h3 mb-3"><strong>Quản lý</strong> Lịch khám</h1>
        <div class="row mb-3 align-items-end">
            <div class="col-9 col-md-6">
                <!-- Nút mở modal thêm lịch khám -->
                <button class="btn btn-info mb-4 rounded" data-bs-toggle="modal" data-bs-target="#addLichKhamModal">
                    <i class="align-middle me-2" data-feather="plus-square"></i> Thêm Lịch Khám mới
                </button>
            </div>

            <div class="col-3 col-md-6 text-end">
                <a href="{{ route('lichkham.export') }}" class="btn btn-success mb-3">
                    <i data-feather="download"></i> Xuất Excel
                </a>
            </div>
            <!-- Bộ lọc -->
            <form action="{{ route('lichkham.index') }}" method="GET" class="row g-3 mb-3 mt-3">
                <div class="card rounded-4 mb-3">
                    <div class="card-body">

                        <div class="row justify-content-center">
                            <div class="col-12">

                                <div class="row">
                                    <div class="col my-auto d-flex">

                                        @if ($user->role != 'hospital')
                                            <select name="id_bacsi" id="bacsi_timkiem" class="form-select">
                                                <option value="">-- Bác sĩ --</option>
                                                @foreach ($bacSiList as $bacSi)
                                                    <option value="{{ $bacSi->id }}"
                                                        {{ request('id_bacsi') == $bacSi->id ? 'selected' : '' }}>
                                                        {{ $bacSi->hoten }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            <input type="date" name="ngaykham" class="form-control ms-2"
                                                value="{{ request('ngaykham') }}">

                                            <select name="buoi" class="form-select ms-2">
                                                <option value="">-- Buổi --</option>
                                                <option value="Sáng" {{ request('buoi') == 'Sáng' ? 'selected' : '' }}>
                                                    Sáng
                                                </option>
                                                <option value="Chiều" {{ request('buoi') == 'Chiều' ? 'selected' : '' }}>
                                                    Chiều
                                                </option>
                                            </select>
                                        @endif

                                        @if ($user->role === 'hospital')
                                            <select name="id_bacsi" id="bacsi_timkiem1" class="form-select">
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

                                            <input type="date" name="ngaykham" class="form-control ms-2"
                                                value="{{ request('ngaykham') }}">


                                            <select name="buoi" class="form-select ms-2">
                                                <option value="">-- Buổi --</option>
                                                <option value="Sáng" {{ request('buoi') == 'Sáng' ? 'selected' : '' }}>
                                                    Sáng
                                                </option>
                                                <option value="Chiều" {{ request('buoi') == 'Chiều' ? 'selected' : '' }}>
                                                    Chiều
                                                </option>
                                            </select>

                                            <select name="id_chuyenkhoa" id="chuyenkhoa_timkiem1" class="form-select ms-2">
                                                <option value="">-- Chuyên khoa --</option>
                                                @foreach ($chuyenKhoaList as $chuyenKhoa)
                                                    @if ($chuyenKhoa->id_coso === $cs_nv->id)
                                                        <option value="{{ $chuyenKhoa->id }}"
                                                            {{ request('id_chuyenkhoa') == $chuyenKhoa->id ? 'selected' : '' }}>
                                                            {{ $chuyenKhoa->tenkhoa }}
                                                        </option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <script>
                                                document.getElementById('chuyenkhoa_timkiem1').addEventListener('change', function() {
                                                    let chuyenkhoaId = this.value;
                                                    let bacsiSelect = document.getElementById('bacsi_timkiem1');

                                                    if (chuyenkhoaId) {
                                                        // Nếu chọn chuyên khoa => lấy bác sĩ theo chuyên khoa
                                                        fetch(`/get-bacsi/${chuyenkhoaId}`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                console.log("Bác sĩ nhận được:", data);
                                                                if (data.length > 0) {
                                                                    bacsiSelect.disabled = false;
                                                                    bacsiSelect.innerHTML = '<option value="">-- Bác sĩ --</option>';
                                                                    data.forEach(bacsi => {
                                                                        bacsiSelect.innerHTML +=
                                                                            `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                                                    });
                                                                } else {
                                                                    bacsiSelect.disabled = false;
                                                                    bacsiSelect.innerHTML = '<option value="">-- Không có bác sĩ --</option>';
                                                                }
                                                            })
                                                            .catch(error => console.error("Lỗi khi lấy bác sĩ:", error));
                                                    } else {
                                                        // Nếu KHÔNG chọn chuyên khoa => load TẤT CẢ bác sĩ
                                                        fetch(`/get-all-bacsi`)
                                                            .then(response => response.json())
                                                            .then(data => {
                                                                console.log("Tất cả bác sĩ:", data);
                                                                bacsiSelect.disabled = false;
                                                                bacsiSelect.innerHTML = '<option value="">-- Bác sĩ --</option>';
                                                                data.forEach(bacsi => {
                                                                    bacsiSelect.innerHTML +=
                                                                        `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                                                });
                                                            })
                                                            .catch(error => console.error("Lỗi khi lấy tất cả bác sĩ:", error));
                                                    }
                                                });
                                            </script>
                                        @endif
                                        <button type="submit" class="btn btn-primary text-nowrap ms-2">
                                            <i class="align-middle" data-feather="search"></i>

                                        </button>

                                        <a href="{{ route('lichkham.index') }}" class="btn btn-secondary text-nowrap ms-2">
                                            <i class="align-middle" data-feather="refresh-cw"></i>
                                            Tải lại
                                        </a>
                                    </div>
                                </div>

                            </div>
                        </div>
                        @if ($user->role != 'hospital')
                            <div class="row justify-content-center mt-3">
                                <div class="col-6 col-md-6 mb-3 mb-md-0">
                                    <select name="id_chuyenkhoa" id="chuyenkhoa_timkiem" class="form-select">
                                        <option value="">-- Chuyên khoa --</option>
                                        @foreach ($chuyenKhoaList as $chuyenKhoa)
                                            <option value="{{ $chuyenKhoa->id }}"
                                                {{ request('id_chuyenkhoa') == $chuyenKhoa->id ? 'selected' : '' }}>
                                                {{ $chuyenKhoa->tenkhoa }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-6 col-md-6 mb-3 mb-md-0">
                                    <select name="id_coso" id="coso_timkiem" class="form-select">
                                        <option value="">-- Cơ sở --</option>
                                        @foreach ($coSoList as $coSo)
                                            <option value="{{ $coSo->id }}"
                                                {{ request('id_coso') == $coSo->id ? 'selected' : '' }}>
                                                {{ $coSo->tencoso }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </form>
            <!-- JavaScript xử lý chọn Cơ sở -> Chuyên khoa -> Bác sĩ khi tìm kiếm-->
            <script>
                document.getElementById('coso_timkiem').addEventListener('change', function() {
                    let cosoId = this.value;
                    let chuyenkhoaSelect = document.getElementById('chuyenkhoa_timkiem');
                    let bacsiSelect = document.getElementById('bacsi_timkiem');

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

                                    bacsiSelect.disabled = false;
                                    bacsiSelect.innerHTML = '<option value="">-- Không có bác sĩ --</option>';
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

                        // Nếu KHÔNG chọn chuyên khoa => load TẤT CẢ bác sĩ
                        fetch(`/get-all-bacsi`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Tất cả bác sĩ:", data);
                                bacsiSelect.disabled = false;
                                bacsiSelect.innerHTML = '<option value="">-- Bác sĩ --</option>';
                                data.forEach(bacsi => {
                                    bacsiSelect.innerHTML +=
                                        `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                });
                            })
                            .catch(error => console.error("Lỗi khi lấy tất cả bác sĩ:", error));
                    }

                });

                document.getElementById('chuyenkhoa_timkiem').addEventListener('change', function() {
                    let chuyenkhoaId = this.value;
                    let bacsiSelect = document.getElementById('bacsi_timkiem');

                    if (chuyenkhoaId) {
                        // Nếu chọn chuyên khoa => lấy bác sĩ theo chuyên khoa
                        fetch(`/get-bacsi/${chuyenkhoaId}`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Bác sĩ nhận được:", data);
                                if (data.length > 0) {
                                    bacsiSelect.disabled = false;
                                    bacsiSelect.innerHTML = '<option value="">-- Bác sĩ --</option>';
                                    data.forEach(bacsi => {
                                        bacsiSelect.innerHTML +=
                                            `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                    });
                                } else {
                                    bacsiSelect.disabled = false;
                                    bacsiSelect.innerHTML = '<option value="">-- Không có bác sĩ --</option>';
                                }
                            })
                            .catch(error => console.error("Lỗi khi lấy bác sĩ:", error));
                    } else {
                        // Nếu KHÔNG chọn chuyên khoa => load TẤT CẢ bác sĩ
                        fetch(`/get-all-bacsi`)
                            .then(response => response.json())
                            .then(data => {
                                console.log("Tất cả bác sĩ:", data);
                                bacsiSelect.disabled = false;
                                bacsiSelect.innerHTML = '<option value="">-- Bác sĩ --</option>';
                                data.forEach(bacsi => {
                                    bacsiSelect.innerHTML +=
                                        `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                });
                            })
                            .catch(error => console.error("Lỗi khi lấy tất cả bác sĩ:", error));
                    }
                });
            </script>
            <div class="col-12 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Danh sách các lịch khám ({{ $lichKhamList->total() }} hàng)</h5>
                    </div>
                    @if ($lichKhamList->isEmpty())
                        <div class="alert alert-danger">
                            Không tìm thấy lịch khám nào!
                        </div>
                    @else
                        <!-- Bảng danh sách lịch khám -->
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Bác Sĩ</th>
                                    <th>Chuyên Khoa</th>
                                    @if ($user->role != 'hospital')
                                        <th>Cơ Sở</th>
                                    @endif
                                    <th>Ngày Khám</th>
                                    <th>Buổi</th>
                                    <th>Ngày cập nhật</th>
                                    <th>Hành Động</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($lichKhamList as $key => $lichKham)
                                    @php
                                        // Kiểm tra nếu lịch khám này đã có người đặt
                                        $lichDaDuocDat = $lichKham
                                            ->LichKhamKhungGio()
                                            ->where('soluongdadat', '>', 0)
                                            ->exists();
                                    @endphp
                                    <tr>
                                        <td>{{ $lichKhamList->firstItem() + $key }}</td>
                                        <td>{{ $lichKham->bacsi->hoten }}</td>
                                        <td>{{ $lichKham->bacsi->chuyenkhoa->tenkhoa }}</td>
                                        @if ($user->role != 'hospital')
                                            <td>{{ $lichKham->bacsi->coso->tencoso }}</td>
                                        @endif
                                        <td>{{ $lichKham->ngaykham }}</td>
                                        <td>{{ $lichKham->buoi }}</td>

                                        <td>{{ $lichKham->updated_at }}</td>
                                        <td class="text-center">
                                            <div class="d-flex gap-2 mt-1">
                                                <a href="{{ route('lichkham.show', $lichKham->id) }}"
                                                    class="btn btn-success btn-sm"><i data-feather="eye"></i>
                                                </a>
                                                @if ($lichKham->ngaykham >= now()->toDateString() && !$lichDaDuocDat)
                                                    <a href="{{ route('lichkham.edit', $lichKham->id) }}"
                                                        class="btn btn-warning btn-sm ">
                                                        <i class="align-middle" data-feather="edit"></i>
                                                    </a>
                                                @endif
                                            </div>
                                            <div class="mt-2">
                                                @if ($lichKham->ngaykham >= now()->toDateString() && !$lichDaDuocDat)
                                                    <a class="btn btn-danger btn-sm"
                                                        href="{{ route('lichkham.delete', ['id' => $lichKham->id]) }}"
                                                        onclick="return confirm('Bạn có chắc chắn muốn xóa lịch khám {{ $lichKham->id }} của bac sĩ {{ $lichKham->bacsi->hoten }}  không?');">
                                                        <i class="align-middle" data-feather="trash-2"></i></a>
                                                @endif
                                            </div>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Không có lịch khám nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    @endif
                    <!-- Phân trang -->
                    <div class="d-flex justify-content-center">
                        {{ $lichKhamList->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Thêm Lịch Khám -->
        <div class="modal fade" id="addLichKhamModal" tabindex="-1" aria-labelledby="addLichKhamLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-primary">Thêm Lịch Khám</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addLichKhamForm" method="POST" action="{{ route('lichkham.store') }}"
                            enctype="multipart/form-data">
                            @csrf
                            @if ($user->role != 'hospital')
                                <!-- Chọn Cơ sở -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cơ sở</label>
                                    <select name="coso_id" id="coso" class="form-control" required>
                                        <option value="">-- Chọn cơ sở --</option>
                                        @foreach ($coSoList as $coso)
                                            <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <!-- Chọn Cơ sở -->
                                <div class="mb-3">
                                    <label class="form-label fw-bold">Cơ sở</label>
                                    <select name="coso_id" id="coso" class="form-control" required>
                                        <option value="">-- Chọn cơ sở --</option>
                                        @foreach ($coSoList as $coso)
                                            @if ($coso->id === $cs_nv->id)
                                                <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <!-- Chọn Chuyên khoa -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Chuyên khoa</label>
                                <select name="chuyenkhoa_id" id="chuyenkhoa" class="form-control" required disabled>
                                    <option value="">-- Chọn chuyên khoa --</option>
                                </select>
                            </div>

                            <!-- Chọn Bác sĩ -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Bác sĩ</label>
                                <select name="bacsi_id" id="bacsi" class="form-control" required disabled>
                                    <option value="">-- Chọn bác sĩ --</option>
                                </select>
                            </div>

                            <!-- Ngày khám -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Ngày khám</label>
                                <input type="date" name="ngaykham" id="ngaykham" class="form-control" required
                                    min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
                            </div>

                            <!-- Chọn Buổi -->
                            <div class="mb-3">
                                <label class="form-label fw-bold">Buổi</label>
                                <select name="buoi" class="form-control" required>
                                    <option value="Sáng">Sáng</option>
                                    <option value="Chiều">Chiều</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-success">Thêm</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- JavaScript xử lý chọn Cơ sở -> Chuyên khoa -> Bác sĩ và thêm lịch khám -->
        <script>
            document.getElementById('coso').addEventListener('change', function() {
                let cosoId = this.value;

                let chuyenkhoaSelect = document.getElementById('chuyenkhoa');
                let bacsiSelect = document.getElementById('bacsi');

                // Reset dropdown Chuyên khoa
                chuyenkhoaSelect.innerHTML = '<option value="">-- Chọn chuyên khoa --</option>';
                chuyenkhoaSelect.disabled = true;

                // Reset dropdown Bác sĩ
                bacsiSelect.innerHTML = '<option value="">-- Chọn bác sĩ --</option>';
                bacsiSelect.disabled = true;

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


            document.getElementById('chuyenkhoa').addEventListener('change', function() {
                let chuyenkhoaId = this.value;
                let bacsiSelect = document.getElementById('bacsi');

                // Reset dropdown Bác sĩ
                bacsiSelect.innerHTML = '<option value="">-- Chọn bác sĩ --</option>';
                bacsiSelect.disabled = true;

                if (chuyenkhoaId) {
                    fetch(`/get-bacsi/${chuyenkhoaId}`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.length > 0) {
                                bacsiSelect.disabled = false;
                                data.forEach(bacsi => {
                                    bacsiSelect.innerHTML +=
                                        `<option value="${bacsi.id}">${bacsi.hoten}</option>`;
                                });
                            } else {
                                alert("Không có bác sĩ nào cho chuyên khoa này!");
                            }
                        })
                        .catch(error => console.error("Lỗi khi lấy bác sĩ:", error));
                }
            });
        </script>
    @endsection
