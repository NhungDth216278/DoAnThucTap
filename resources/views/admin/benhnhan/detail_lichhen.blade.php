@extends('admin.main')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

<script src="https://cdn.ckeditor.com/ckeditor5/40.1.0/classic/ckeditor.js"></script>


@section('content')
    <div class="container">
        <a class="btn btn-info mb-4 rounded-start-5" href="javascript:history.back()">
            <i class="align-middle me-2" data-feather="chevron-left"></i>
            Xem danh sách các hồ sơ bệnh nhân
        </a>

        <div class="d-flex align-items-center mb-3">
            <h1 class="h3 my-auto"><strong>Thông tin Bệnh Nhân</strong> {{ $benhNhan->hoten }}</h1>

        </div>

        <div class="card rounded-4">
            <div class="card-body">
                <div class="row g-4 align-items-center">
                    <div class="col-md-auto text-center">
                        <img src="{{ $benhNhan->avatar ? asset($benhNhan->avatar) : asset('upload/avatars/avatar.png') }}"
                            alt="Avatar" class="rounded-circle border shadow"
                            style="width: 150px; height: 150px; object-fit: cover;">
                    </div>

                    <div class="col">
                        <h3 class="fw-bold mb-3">{{ $benhNhan->hoten }}</h3>
                        <p class="mb-2">
                            <span class="me-3">
                                <strong>Giới tính:</strong>
                                {{ $benhNhan->gioitinh }}
                            </span>
                            <span><strong>Số điện thoại:</strong> {{ $benhNhan->sodienthoai }}</span>
                        </p>
                        <p class="mb-2"><strong>Email:</strong> {{ $benhNhan->user->email ?? 'Không có' }}</p>

                        <p class="mb-2"><strong>CCCD:</strong> {{ $benhNhan->cccd }}</p>
                        <p class="mb-2"><strong>Địa chỉ:</strong> {{ $benhNhan->diachi ?? 'Không có' }}</p>
                        <p class="text-muted mb-0"><small>Đã tạo hồ sơ
                                {{ \Carbon\Carbon::parse($benhNhan->created_at)->diffForHumans() }}</small></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bộ lọc -->
        <form action="{{ route('benhnhan.detail_lichhen', $benhNhan->id) }}" method="GET" class="row g-3 mb-3 mt-3">
            <div class="card rounded-4 mb-3">
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12">

                            <div class="row">
                                <div class="col my-auto d-flex">

                                    @if ($user->role != 'hospital')
                                        <select name="id_coso" id="coso_timkiem" class="form-select">
                                            <option value="">-- Cơ sở --</option>
                                            @foreach ($coSoList as $coSo)
                                                <option value="{{ $coSo->id }}"
                                                    {{ request('id_coso') == $coSo->id ? 'selected' : '' }}>
                                                    {{ $coSo->tencoso }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="id_chuyenkhoa" id="chuyenkhoa_timkiem" class="form-select ms-1">
                                            <option value="">-- Chuyên khoa --</option>
                                            @foreach ($chuyenKhoaList as $chuyenKhoa)
                                                <option value="{{ $chuyenKhoa->id }}"
                                                    {{ request('id_chuyenkhoa') == $chuyenKhoa->id ? 'selected' : '' }}>
                                                    {{ $chuyenKhoa->tenkhoa }}
                                                </option>
                                            @endforeach
                                        </select>

                                        <select name="id_bacsi" id="bacsi_timkiem" class="form-select ms-1">
                                            <option value="">-- Bác sĩ --</option>
                                            @foreach ($bacSiList as $bacSi)
                                                <option value="{{ $bacSi->id }}"
                                                    {{ request('id_bacsi') == $bacSi->id ? 'selected' : '' }}>
                                                    {{ $bacSi->hoten }}
                                                </option>
                                            @endforeach
                                        </select>
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
                                    @endif

                                    @if ($user->role === 'hospital')
                                        <select name="id_chuyenkhoa" id="chuyenkhoa_timkiem1" class="form-select">
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

                                        <select name="id_bacsi" id="bacsi_timkiem1" class="form-select ms-2">
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

                                    <a href="{{ route('benhnhan.detail_lichhen', ['id' => $benhNhan->id]) }}"
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
                        <h5 class="card-title mb-0">Danh sách lịch hẹn ({{ $lichHenList->total() }} hàng)</h5>
                    </div>
                    <div class="card-header">
                        <table class="table table-hover ">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Buổi</th>
                                    <th>Ngày Hẹn</th>
                                    <th>Giờ Hẹn</th>
                                    @if ($user->role != 'hospital')
                                        <th>Cơ sở</th>
                                    @endif
                                    <th>Chuyên khoa</th>
                                    <th>Bác Sĩ</th>
                                    <th>Giá Khám</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày đặt</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lichHenList as $index => $lichHen)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>

                                        <td>{{ mb_strtoupper(mb_substr($lichHen->buoi, 0, 1), 'UTF-8') . mb_substr($lichHen->buoi, 1) }}
                                        </td>
                                        <td>{{ date('d/m/Y', strtotime($lichHen->ngayhen)) }}</td>
                                        <td>{{ $lichHen->thoigian }}</td>

                                        @if ($user->role != 'hospital')
                                            <td>
                                                {{ $lichHen->bacsi->coso->tencoso }}
                                            </td>
                                        @endif
                                        <td>{{ $lichHen->bacsi->chuyenkhoa->tenkhoa }}</td>
                                        <td>{{ $lichHen->bacSi->hoten }}</td>
                                        <td>{{ number_format($lichHen->giakham, 0, ',', '.') }} VNĐ</td>
                                        <td>
                                            @if ($lichHen->trangthai == 0)
                                                <span class="badge bg-danger">Thất bại</span>
                                            @elseif ($lichHen->trangthai == 1)
                                                <span class="badge bg-success">Đặt thành công</span>
                                            @elseif ($lichHen->trangthai == 2)
                                                <span class="badge bg-primary">Đã khám</span>
                                            @endif
                                        </td>
                                        <td> {{ $lichHen->created_at }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="10" class="text-center text-danger">Chưa có lịch hẹn nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    @endsection
