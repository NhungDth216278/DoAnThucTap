@extends('admin.main')

<!-- Bootstrap hiển thị modal bệnh nhân, bác sĩ -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .map-and-description {
        display: flex;
        gap: 30px;
        /* tăng khoảng cách giữa mô tả và nội dung */
        flex-wrap: wrap;
        margin-top: 20px;

    }

    .description-box {
        flex: 1;
        min-width: 300px;
    }

    .info-box,
    .content-box {
        border: 2px solid #007bff;
        padding: 15px;
        border-radius: 10px;
        background-color: #f7fcff;
        flex: 2;

    }

    /* Hoặc nếu bạn muốn dùng margin trên cho iframe: */
    .description-box iframe {
        margin-top: 20px;
    }

    iframe {
        width: 100%;
        height: 400px;
        border-radius: 10px;
        /* Bo góc bản đồ */
    }

    .info-box h2,
    .content-box h2 {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
        margin-bottom: 10px;
    }

    .header-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-actions h3 {
        margin: 0;
    }

    .btn-warning:hover {
        opacity: 0.9;
    }
</style>


@section('content')
    <div class="container-fluid p-0">
        @if ($user->role === 'hospital')
            <h3 class="mb-4 text-center text-bold">Thông tin cơ sở của bạn</h3>
            <div class="header-actions mb-3">
                <div></div> <!-- khoảng trắng bên trái -->
                <a href="{{ route('coso.edit', $cs->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil-square"></i> Cập nhật thông tin
                </a>
            </div>
            <div class="row">

                <!-- Cột thông tin cơ sở -->
                <div class="col-12">
                    <div class="card p-2">
                        <img src="{{ asset($cs->hinhanh) }}" class="img-fluid mx-auto" style="max-width: 150px;"
                            alt="Logo">

                        <h4 class="mt-2 text-primary text-center">
                            {{ $cs->tencoso && trim($cs->tencoso) != '' ? $cs->tencoso : 'Chưa có thông tin' }}
                        </h4>
                        <p><i class="bi bi-geo-alt"></i>
                            {{ $cs->diachi && trim($cs->diachi) != '' ? $cs->diachi : 'Chưa có thông tin' }}
                        </p>

                        <p><i class="bi bi-telephone"></i> Số điện thoại:
                            {{ $cs->tencoso && trim($cs->sodienthoai) != '' ? $cs->sodienthoai : 'Chưa có thông tin' }}
                        </p>
                    </div>
                </div>

            </div>

            <div class="map-and-description">
                <!-- Mô tả + bản đồ -->
                <div class="description-box">
                    <div class="info-box">
                        <h2>Mô tả</h2>
                        <div class="formatted-content">
                            @if (!empty($cs->mota))
                                {!! $cs->mota !!}
                            @else
                                <span class="text-muted">Chưa có thông tin</span>
                            @endif
                        </div>
                    </div>

                    <iframe width="100%" height="300" style="border:0;" loading="lazy" allowfullscreen
                        src="https://www.google.com/maps?q={{ urlencode($cs->diachi) }}&output=embed">
                    </iframe>
                </div>

                <!-- Nội dung -->
                <div class="content-box">
                    <h2>Nội dung</h2>
                    <div class="formatted-content">
                        @if (!empty($cs->noidung))
                            {!! $cs->noidung !!}
                        @else
                            <span class="text-muted">Chưa có thông tin</span>
                        @endif
                    </div>
                </div>
            </div>
        @elseif($user->role === 'manage')
            <h1 class="h3 mb-3"><strong>Thống kê</strong> <span class="text-muted" id="text_tg"> {{ $khoang_tg }}
                </span> </h1>
            <div class="row mb-3 align-items-end">
                <div class="col-md-9">
                    <div class="row">
                        <div class="col-md-4">
                            <select id="timeFilter" class="form-select" onchange="fetchLichHenList()">
                                <option value="day">Theo ngày</option>
                                <option value="week">Theo tuần</option>
                                <option value="month">Theo tháng</option>
                            </select>
                        </div>

                        {{-- Bộ lọc ngày cụ thể --}}
                        <div class="col-md-4" id="dateInput">
                            <input type="date" id="dateValue" class="form-control" onchange="fetchLichHenList()"
                                value="{{ \Carbon\Carbon::yesterday()->toDateString() }}">
                        </div>

                        {{-- Bộ lọc tuần cụ thể --}}
                        <div class="col-md-4 d-none" id="weekInput">
                            <input type="week" id="weekValue" class="form-control" onchange="fetchLichHenList()">
                        </div>

                        {{-- Bộ lọc tháng cụ thể --}}
                        <div class="col-md-4 d-none" id="monthInput">
                            <input type="month" id="monthValue" class="form-control" onchange="fetchLichHenList()">
                        </div>

                        <div class="col-md-4">
                            <select id="cosoFilter" class="form-select" onchange="fetchLichHenList()">
                                <option value="all">Tất cả cơ sở</option>
                                @foreach ($dsCoSo as $coso)
                                    <option value="{{ $coso->id }}">{{ $coso->tencoso }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>


                <div class="col-md-3 text-end">

                    <a href="{{ route('lichhen.index') }}" class="btn btn-primary">
                        <i class="align-middle" data-feather="package"></i> Quản lý lịch hẹn
                    </a>
                </div>

            </div>

            <div class="row">
                <div class="col-xl-6 col-xxl-5 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-6">
                                <!-- Đã đặt -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đã đặt</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="calendar"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3" id="tong_lich">{{ $tong_lich }}</h1>
                                        <div class="mb-0">
                                            <span class="text-muted" id="text_tg">Trong
                                                {{ $khoang_tg }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Bệnh nhân mới -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Bệnh nhân mới</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3" id="benhnhan_moi">{{ $benhnhan_moi }}</h1>
                                        <div class="mb-0">
                                            <span class="text-muted" id="text_tg">Trong
                                                {{ $khoang_tg }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <!-- Đã khám -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đã khám</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="check-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3" id="da_kham">{{ $da_kham }}</h1>
                                        <div class="mb-0">
                                            <span class="text-muted" id="text_tg">Trong
                                                {{ $khoang_tg }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Đã huỷ -->
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Đã huỷ</h5>
                                            </div>
                                            <div class="col-auto">
                                                <div class="stat text-primary">
                                                    <i class="align-middle" data-feather="x-circle"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="mt-1 mb-3" id="da_huy">{{ $da_huy }}</h1>
                                        <div class="mb-0">
                                            <span class="text-muted" id="text_tg">Trong
                                                {{ $khoang_tg }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Biểu đồ -->
                <div class="col-xl-6 col-xxl-7">
                    <div class="card flex-fill w-100">
                        <div class="card-header rounded-top-4 d-flex align-items-center pb-0">
                            <h5 class="card-title my-auto">
                                Biểu đồ theo tháng
                            </h5>

                            <div class="ms-auto my-auto d-flex align-items-center gap-2">
                                <label for="selectYear" class="form-label my-0 text-nowrap">Chọn năm:</label>
                                <select id="selectYear" class="form-select">
                                    @for ($year = now()->year; $year >= 2000; $year--)
                                        <option value="{{ $year }}"
                                            {{ $year == $currentYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>

                        <div class="card-body py-3">
                            <div class="chart chart-sm">
                                <canvas id="chartjs-dashboard-line"></canvas>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex">
                    <div class="card flex-fill">
                        <div class="card-header">

                            <h5 class="card-title mb-0">Các lịch hẹn <span class="text-muted" id="text_tg">
                                    {{ $khoang_tg }}
                                </span></h5>
                        </div>
                        <table class="table table-hover my-0">
                            <thead>
                                <tr>
                                    <th>Họ tên</th>
                                    <th>Bác sĩ</th>
                                    <th class="d-none d-xl-table-cell">Ngày hẹn</th>
                                    <th class="d-none d-xl-table-cell">Thời gian</th>
                                    <th class="d-none d-md-table-cell">Giá khám</th>
                                    <th>Trạng thái</th>
                                </tr>
                            </thead>
                            <tbody id="lichHenTbody">

                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center mt-3" id="paginationWrapper"></div>
                    </div>
                </div>
                <div class="col-12 d-flex">
                    <div class="card flex-fill w-100">
                        <div class="card-header rounded-top-4 d-flex align-items-center pb-0">

                            <h5 class="card-title mb-0">Doanh thu theo tháng</h5>
                            <div class="ms-auto my-auto d-flex align-items-center gap-2">
                                <label for="selectYearOrder" class="form-label my-0 text-nowrap">Chọn năm:</label>
                                <select id="selectYearOrder" class="form-select">
                                    @for ($year = now()->year; $year >= 2000; $year--)
                                        <option value="{{ $year }}"
                                            {{ $year == $currentYear ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="card-body d-flex w-100">
                            <div class="align-self-center chart chart-lg">
                                <canvas id="chartjs-dashboard-bar"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <script src="js/app.js"></script>

            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <script>
                let chartInstance = null;

                function loadChartData(selectedCosoId = 'all', selectedYear = new Date().getFullYear()) {
                    const ctx = document.getElementById("chartjs-dashboard-line").getContext("2d");

                    axios.post("{{ route('thongke.chartData') }}", {
                            coso_id: selectedCosoId,
                            year: selectedYear
                        })
                        .then(function(response) {
                            const data = response.data;

                            // Xoá biểu đồ cũ nếu có
                            if (chartInstance) {
                                chartInstance.destroy();
                            }

                            const gradientBlue = ctx.createLinearGradient(0, 0, 0, 225);
                            gradientBlue.addColorStop(0, "rgba(0, 123, 255, 0.5)");
                            gradientBlue.addColorStop(1, "rgba(0, 123, 255, 0.05)");

                            const gradientGreen = ctx.createLinearGradient(0, 0, 0, 225);
                            gradientGreen.addColorStop(0, "rgba(40, 167, 69, 0.5)");
                            gradientGreen.addColorStop(1, "rgba(40, 167, 69, 0.05)");

                            const gradientRed = ctx.createLinearGradient(0, 0, 0, 225);
                            gradientRed.addColorStop(0, "rgba(220, 53, 69, 0.5)");
                            gradientRed.addColorStop(1, "rgba(220, 53, 69, 0.05)");

                            chartInstance = new Chart(ctx, {
                                type: "line",
                                data: {
                                    labels: data.months,
                                    datasets: [{
                                            label: "Đã đặt",
                                            fill: true,
                                            backgroundColor: gradientBlue,
                                            borderColor: "rgba(0, 123, 255, 1)",
                                            data: data.placed
                                        },
                                        {
                                            label: "Đã khám",
                                            fill: true,
                                            backgroundColor: gradientGreen,
                                            borderColor: "rgba(40, 167, 69, 1)",
                                            data: data.completed
                                        },
                                        {
                                            label: "Đã hủy",
                                            fill: true,
                                            backgroundColor: gradientRed,
                                            borderColor: "rgba(220, 53, 69, 1)",
                                            data: data.cancelled
                                        },
                                        {
                                            label: "Bệnh nhân mới",
                                            fill: true,
                                            backgroundColor: "rgba(255, 193, 7, 0.3)",
                                            borderColor: "rgba(255, 193, 7, 1)",
                                            data: data.new_patients
                                        }
                                    ]
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    legend: {
                                        display: true
                                    },
                                    tooltips: {
                                        intersect: false
                                    },
                                    hover: {
                                        intersect: true
                                    },
                                    plugins: {
                                        filler: {
                                            propagate: false
                                        }
                                    },
                                    scales: {
                                        xAxes: [{
                                            gridLines: {
                                                color: "rgba(0,0,0,0.05)"
                                            }
                                        }],
                                        yAxes: [{
                                            ticks: {
                                                stepSize: 10
                                            },
                                            gridLines: {
                                                color: "rgba(0,0,0,0.05)"
                                            }
                                        }]
                                    }
                                }
                            });
                        })
                        .catch(function(error) {
                            console.error("Lỗi khi lấy dữ liệu biểu đồ:", error);
                        });
                }

                document.addEventListener("DOMContentLoaded", function() {
                    const yearSelect = document.getElementById("selectYear");
                    const cosoSelect = document.getElementById("cosoFilter");

                    function getSelectedFilters() {
                        const selectedYear = yearSelect.value;
                        const selectedCosoId = cosoSelect ? cosoSelect.value : 'all';
                        return {
                            selectedYear,
                            selectedCosoId
                        };
                    }

                    // Load biểu đồ ban đầu
                    const {
                        selectedYear,
                        selectedCosoId
                    } = getSelectedFilters();
                    loadChartData(selectedCosoId, selectedYear);

                    // Lắng nghe sự kiện chọn cơ sở
                    if (cosoSelect) {
                        cosoSelect.addEventListener("change", function() {
                            const {
                                selectedYear,
                                selectedCosoId
                            } = getSelectedFilters();
                            loadChartData(selectedCosoId, selectedYear);
                        });
                    }

                    // Lắng nghe sự kiện chọn năm
                    yearSelect.addEventListener("change", function() {
                        const {
                            selectedYear,
                            selectedCosoId
                        } = getSelectedFilters();
                        loadChartData(selectedCosoId, selectedYear);
                    });
                });
            </script>

            <script>
                document.getElementById('timeFilter').addEventListener('change', function() {
                    const time = this.value;
                    toggleFilterInputs(time);
                    fetchThongKe();
                });

                document.getElementById('cosoFilter').addEventListener('change', function() {
                    fetchThongKe();
                });

                document.getElementById('dateValue').addEventListener('change', function() {
                    fetchThongKe();
                });

                document.getElementById('weekValue').addEventListener('change', function() {
                    fetchThongKe();
                });

                document.getElementById('monthValue').addEventListener('change', function() {
                    fetchThongKe();
                });

                function toggleFilterInputs(time) {
                    const dateInput = document.getElementById('dateInput');
                    const weekInput = document.getElementById('weekInput');
                    const monthInput = document.getElementById('monthInput');

                    // Ẩn tất cả bộ lọc trước khi hiển thị theo thời gian được chọn
                    dateInput.classList.add('d-none');
                    weekInput.classList.add('d-none');
                    monthInput.classList.add('d-none');

                    if (time === 'day') {
                        dateInput.classList.remove('d-none');
                    } else if (time === 'week') {
                        weekInput.classList.remove('d-none');
                    } else if (time === 'month') {
                        monthInput.classList.remove('d-none');
                    }
                }

                function fetchThongKe() {
                    let time = document.getElementById('timeFilter').value;
                    let cosoId = document.getElementById('cosoFilter').value;

                    let dateValue = document.getElementById('dateValue').value;
                    let weekValue = document.getElementById('weekValue').value;
                    let monthValue = document.getElementById('monthValue').value;

                    fetch("{{ route('thongke.ajax') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                time: time,
                                coso_id: cosoId,
                                date_value: dateValue,
                                week_value: weekValue,
                                month_value: monthValue
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            // Cập nhật thống kê
                            document.getElementById("tong_lich").innerText = data.total;
                            document.getElementById("da_kham").innerText = data.completed;
                            document.getElementById("da_huy").innerText = data.cancelled;
                            document.getElementById("benhnhan_moi").innerText = data.new_patients;
                            document.querySelectorAll("#text_tg").forEach(el => el.innerText = `Trong ${data.range_text}`);
                            fetchLichHenList(); // chỉ gọi lại bảng lịch hẹn

                        });
                }

                // Khi trang được tải, mặc định sẽ hiển thị các bộ lọc theo ngày
                document.addEventListener('DOMContentLoaded', function() {
                    toggleFilterInputs(document.getElementById('timeFilter').value);
                });


                function fetchLichHenList(url = "{{ route('thongke.ajax') }}") {
                    let time = document.getElementById('timeFilter').value;
                    let cosoId = document.getElementById('cosoFilter').value;
                    let dateValue = document.getElementById('dateValue').value;
                    let weekValue = document.getElementById('weekValue').value;
                    let monthValue = document.getElementById('monthValue').value;

                    fetch(url, {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                time: time,
                                coso_id: cosoId,
                                date_value: dateValue,
                                week_value: weekValue,
                                month_value: monthValue
                            })
                        })
                        .then(res => res.json())
                        .then(data => {
                            const tbody = document.getElementById("lichHenTbody");
                            tbody.innerHTML = "";
                            if (data.lichHenList && data.lichHenList.length > 0) {
                                data.lichHenList.forEach(lichHen => {
                                    const row = `
                                            <tr>
                                                <td>
                                                    <a href="#" class="text-primary fw-bold" data-bs-toggle="modal"
                                                        data-bs-target="#modalBenhNhan"
                                                        onclick="fetchBenhNhan(${lichHen.id_benhnhan || ''})">
                                                        ${lichHen.benhnhan?.hoten || ''}
                                                    </a>
                                            </td>
                                                <td >
                                                     <a href="#" class="text-primary fw-bold" data-bs-toggle="modal"
                                                        data-bs-target="#modalBacSi"
                                                        onclick="fetchBacSi(${lichHen.id_bacsi || ''})">
                                                        ${lichHen.bacsi?.hoten || ''}
                                                    </a>
                                                </td>
                                                <td class="d-none d-xl-table-cell">${lichHen.ngayhen}</td>
                                                <td class="d-none d-xl-table-cell">${lichHen.thoigian}</td>
                                                <td class="d-none d-md-table-cell">${lichHen.giakham}</td>
                                                <td>
                                                    ${lichHen.trangthai == 0
                                                        ? '<span class="badge bg-danger">Đã hủy</span>'
                                                        : (lichHen.trangthai == 1
                                                            ? '<span class="badge bg-primary">Thành công</span>'
                                                            : '<span class="badge bg-success">Đã khám</span>')}
                                                </td>
                                            </tr>
                                             `;
                                    tbody.insertAdjacentHTML('beforeend', row);

                                });

                                renderPagination(data.pagination);
                            } else {
                                tbody.innerHTML = `<tr><td colspan="6" class="text-center">Không có dữ liệu</td></tr>`;
                                let html = '';
                                document.getElementById("paginationWrapper").innerHTML = html;
                            }
                        });
                }

                function renderPagination(pagination) {
                    let html = '';
                    if (pagination.prev_page_url) {
                        html += `<a href="${pagination.prev_page_url}" class="btn btn-outline-primary btn-sm me-2">← Trước</a>`;
                    }

                    // Hiển thị số trang hiện tại / tổng số trang
                    html +=
                        `<span class="me-2 align-middle">Trang <strong>${pagination.current_page}</strong> / ${pagination.last_page}</span>`;

                    if (pagination.next_page_url) {
                        html += `<a href="${pagination.next_page_url}" class="btn btn-outline-primary btn-sm">Tiếp →</a>`;
                    }
                    document.getElementById("paginationWrapper").innerHTML = html;

                }

                document.addEventListener('click', function(e) {
                    const paginationLink = e.target.closest('#paginationWrapper a');
                    if (paginationLink) {
                        e.preventDefault();
                        const url = paginationLink.getAttribute('href');
                        fetchLichHenList(url); // gọi AJAX cho trang được chọn
                    }
                });

                document.addEventListener('DOMContentLoaded', function() {
                    fetchLichHenList(); // load mặc định lần đầu
                });
            </script>
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

                function fetchBacSi(id_bacsi) {
                    fetch(`/admin/thongke/bacsi/${id_bacsi}/`)
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                const bacsi = data.bacsi;

                                document.getElementById("bacsi_hoten").innerText = bacsi.hoten || '';
                                document.getElementById("bacsi_gioitinh").innerText = bacsi.gioitinh || '';
                                document.getElementById("bacsi_hocham").innerText = bacsi.hocham || '';
                                document.getElementById("bacsi_coso").innerText = bacsi.coso?.tencoso || '';
                                document.getElementById("bacsi_chuyenkhoa").innerText = bacsi.chuyenkhoa?.tenkhoa || '';

                                // Hiển thị avatar nếu có
                                if (bacsi.hinhanh) {
                                    document.getElementById("bacsi_hinhanh").innerHTML =
                                        `<img src="${window.location.origin}/${bacsi.hinhanh}" alt="Avatar" width="100" height="100" class="img-thumbnail">`;
                                } else {
                                    document.getElementById("bacsi_hinhanh").innerHTML = '';
                                }
                            } else {
                                alert("Không tìm thấy thông tin bác sĩ.");
                            }
                        })
                        .catch(error => console.error("Lỗi khi lấy dữ liệu:", error));
                }
            </script>
            <!-- Modal Hiển Thị Thông Tin Bệnh Nhân -->
            <div class="modal fade" id="modalBenhNhan" tabindex="-1" aria-labelledby="modalBenhNhanLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalBenhNhanLabel">Thông Tin Bệnh Nhân</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
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

            <!-- Modal Hiển Thị Thông Tin Bác Sĩ -->
            <div class="modal fade" id="modalBacSi" tabindex="-1" aria-labelledby="modalBacSiLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalBacSiLabel">Thông Tin Bác Sĩ</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <table class="table table-bordered">
                                <tr>
                                    <th>Hình ảnh:</th>
                                    <td id="bacsi_hinhanh"></td> <!-- Mặc định là "Chưa có avatar" -->
                                </tr>

                                <tr>
                                    <th>Họ Tên:</th>
                                    <td id="bacsi_hoten"></td>
                                </tr>
                                <tr>
                                    <th>Giới Tính:</th>
                                    <td id="bacsi_gioitinh"></td>
                                </tr>
                                <tr>
                                    <th>Học hàm:</th>
                                    <td id="bacsi_hocham"></td>
                                </tr>

                                <tr>
                                    <th>Cơ sở:</th>
                                    <td id="bacsi_coso"></td>
                                </tr>
                                <tr>
                                    <th>Chuyên khoa:</th>
                                    <td id="bacsi_chuyenkhoa"></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                function loadDoanhThuTheoCoso(cosoId = 'all', selectedYear = new Date().getFullYear()) {
                    fetch("{{ route('thongke.doanhthu') }}", {
                            method: "POST",
                            headers: {
                                "Content-Type": "application/json",
                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                            },
                            body: JSON.stringify({
                                coso_id: cosoId,
                                year: selectedYear
                            })
                        })
                        .then(res => res.json())
                        .then(res => {
                            const doanhThuData = res.data;
                            const labels = res.labels;

                            // Nếu đã có chart, hủy chart cũ để vẽ lại
                            if (window.barChartInstance) {
                                window.barChartInstance.destroy();
                            }

                            // Vẽ biểu đồ mới
                            window.barChartInstance = new Chart(document.getElementById("chartjs-dashboard-bar"), {
                                type: "bar",
                                data: {
                                    labels: labels,
                                    datasets: [{
                                        label: "Doanh thu (VNĐ)",
                                        backgroundColor: window.theme.primary,
                                        borderColor: window.theme.primary,
                                        hoverBackgroundColor: window.theme.primary,
                                        hoverBorderColor: window.theme.primary,
                                        data: doanhThuData,
                                        barPercentage: 0.75,
                                        categoryPercentage: 0.5
                                    }]
                                },
                                options: {
                                    maintainAspectRatio: false,
                                    legend: {
                                        display: false
                                    },
                                    scales: {
                                        yAxes: [{
                                            gridLines: {
                                                display: false
                                            },
                                            stacked: false,
                                            ticks: {
                                                beginAtZero: true,
                                                callback: function(value) {
                                                    return value.toLocaleString("vi-VN") + " đ";
                                                }
                                            }
                                        }],
                                        xAxes: [{
                                            stacked: false,
                                            gridLines: {
                                                color: "transparent"
                                            }
                                        }]
                                    },
                                    tooltips: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.yLabel.toLocaleString("vi-VN") + " đ";
                                            }
                                        }
                                    }
                                }
                            });
                        });
                }
                document.addEventListener("DOMContentLoaded", function() {
                    const yearSelect = document.getElementById("selectYearOrder");
                    const cosoSelect = document.getElementById("cosoFilter");

                    function getSelectedFilters() {
                        const selectedYear = yearSelect.value;
                        const selectedCosoId = cosoSelect ? cosoSelect.value : 'all';
                        return {
                            selectedYear,
                            selectedCosoId
                        };
                    }

                    // Load biểu đồ ban đầu
                    const {
                        selectedYear,
                        selectedCosoId
                    } = getSelectedFilters();
                    loadDoanhThuTheoCoso(selectedCosoId, selectedYear);

                    // Lắng nghe sự kiện chọn cơ sở
                    if (cosoSelect) {
                        cosoSelect.addEventListener("change", function() {
                            const {
                                selectedYear,
                                selectedCosoId
                            } = getSelectedFilters();
                            loadDoanhThuTheoCoso(selectedCosoId, selectedYear);
                        });
                    }

                    // Lắng nghe sự kiện chọn năm
                    yearSelect.addEventListener("change", function() {
                        const {
                            selectedYear,
                            selectedCosoId
                        } = getSelectedFilters();
                        loadDoanhThuTheoCoso(selectedCosoId, selectedYear);
                    });
                });
            </script>
        @endif
    </div>
@endsection
