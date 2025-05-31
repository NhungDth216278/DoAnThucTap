@extends('trangchu.main')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css">

<style>
    .disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>

@section('content')
    <div class="container mt-4">
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded">
                    <div class="card-header text-white text-uppercase fw-bold"
                        style="background: linear-gradient(to right, #00c6ff, #0072ff) !important;">
                        Thông tin cơ sở y tế
                    </div>
                    <div class="card-body">
                        <h6 class="fw-bold">
                            <i class="bi bi-hospital me-1"></i> {{ $coSo->tencoso }}
                        </h6>
                        <p class="text-muted">
                            {{ $coSo->diachi }}
                        </p>

                        <h6 class="fw-bold">
                            <i class="bi bi-heart-pulse"></i> Chuyên khoa:
                            {{ mb_strtoupper($chuyenKhoa->tenkhoa, 'UTF-8') }}
                        </h6>

                        <h6 class="fw-bold">
                            <i class="bi bi-file-earmark-medical"></i> Bác sĩ: {{ $bacSi->hocham }} {{ $bacSi->hoten }}
                        </h6>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header text-white text-uppercase fw-bold text-center"
                        style="background: linear-gradient(to right, #00c6ff, #0072ff) !important;">
                        Vui lòng chọn thời gian
                    </div>

                    <div class="d-flex justify-content-center">
                        <button id="prevMonth" class="btn btn-outline-primary mx-2"><i
                                class="bi bi-arrow-left-circle-fill"></i></button>
                        <h4 id="currentMonth" class="text-primary"></h4>
                        <button id="nextMonth" class="btn btn-outline-primary mx-2"><i
                                class="bi bi-arrow-right-circle-fill"></i></button>
                    </div>

                    <div id="calendar" class="border rounded p-3 mt-3" data-bacsi-id="{{ $bacSi->id }}">
                    </div>

                </div>
                <div id="timeSlots" class="mt-3"></div>

                <input type="hidden" id="id_bacsi" value="{{ $bacSi->id }}">
                <a href="javascript:history.back()" class="text-primary"><i class="bi bi-arrow-left"></i> Quay lại</a>
                <br>
            </div>
        </div>
    </div>
    <br>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let currentMonth = new Date().getMonth();
            let currentYear = new Date().getFullYear();
            let today = new Date();
            let availableDates = @json($ngayKham);

            function renderCalendar(month, year) {
                document.getElementById("currentMonth").innerText = `Tháng ${month + 1} - ${year}`;
                let calendar = document.getElementById("calendar");
                calendar.innerHTML = "";

                let firstDay = new Date(year, month, 1).getDay(); // Ngày bắt đầu của tháng (0 = CN, 6 = Thứ Bảy)
                let daysInMonth = new Date(year, month + 1, 0).getDate(); // Số ngày trong tháng
                let daysInNextMonth = new Date(year, month + 2, 0).getDate(); // Số ngày trong tháng tiếp theo
                let weekdays = ["CN", "Hai", "Ba", "Tư", "Năm", "Sáu", "Bảy"];

                let headerRow = document.createElement("div");
                headerRow.className = "d-flex text-center fw-bold border-bottom";
                weekdays.forEach(day => {
                    let dayCell = document.createElement("div");
                    dayCell.className = "flex-fill p-2";
                    dayCell.innerText = day;
                    headerRow.appendChild(dayCell);
                });
                calendar.appendChild(headerRow);

                let dateRow = document.createElement("div");
                dateRow.className = "d-flex flex-wrap";

                // Thêm các ô trống trước ngày 1 của tháng
                for (let i = 0; i < firstDay; i++) {
                    let emptyCell = document.createElement("div");
                    emptyCell.className = "flex-fill p-3";
                    dateRow.appendChild(emptyCell);
                }

                let countDays = firstDay; // Đếm số ô trong hàng

                // In các ngày trong tháng hiện tại
                for (let date = 1; date <= daysInMonth; date++) {
                    let dayCell = createDayCell(year, month, date);
                    dateRow.appendChild(dayCell);
                    countDays++;

                    if (countDays % 7 === 0) {
                        calendar.appendChild(dateRow);
                        dateRow = document.createElement("div");
                        dateRow.className = "d-flex flex-wrap";
                        countDays = 0;
                    }
                }

                // Nếu hàng cuối chưa đủ 7 ngày, thêm ngày từ tháng tiếp theo
                let nextMonthDays = [];
                let nextMonth = month + 1;
                let nextYear = year;

                if (nextMonth > 11) { // Nếu là tháng 12, chuyển sang tháng 1 năm sau
                    nextMonth = 0;
                    nextYear += 1;
                }

                let daysToAdd = 7 - countDays; // Số ngày cần thêm vào hàng cuối
                for (let i = 1; i <= daysToAdd; i++) {
                    let dayCell = createDayCell(nextYear, nextMonth, i);
                    dayCell.classList.add("text-muted"); // Đánh dấu ngày thuộc tháng sau
                    dateRow.appendChild(dayCell);
                    nextMonthDays.push({
                        year: nextYear,
                        month: nextMonth,
                        day: i
                    }); // Lưu để không in lại ở tháng sau
                }

                calendar.appendChild(dateRow);

                // Lưu các ngày tháng sau để loại bỏ khi chuyển sang tháng mới
                localStorage.setItem("carryOverDays", JSON.stringify(nextMonthDays));

                // BỔ SUNG KIỂM TRA NGÀY MAI
                checkAvailableDates();
            }

            function checkAvailableDates() {
                const tomorrow = new Date();
                tomorrow.setDate(tomorrow.getDate() + 1);

                // Chuyển định dạng ngày mai thành yyyy-mm-dd
                const tomorrowFormatted =
                    `${tomorrow.getFullYear()}-${(tomorrow.getMonth() + 1).toString().padStart(2, '0')}-${tomorrow.getDate().toString().padStart(2, '0')}`;

                // Kiểm tra có ngày nào >= ngày mai không
                let hasFutureDates = availableDates.some(date => date >= tomorrowFormatted);

                if (!hasFutureDates) {
                    let calendar = document.getElementById("calendar");
                    calendar.innerHTML = `
                    <div class="text-center text-danger fw-bold p-4">
                        <i class="bi bi-bell"></i> Bác sĩ hiện chưa có lịch khám nào từ ngày mai trở đi.
                    </div>
        `;
                }
            }
            let selectedDateGlobal = ""; // Biến toàn cục lưu ngày được chọn

            function createDayCell(year, month, date) {
                let dayCell = document.createElement("div");
                let fullDate =
                    `${year}-${(month + 1).toString().padStart(2, '0')}-${date.toString().padStart(2, '0')}`;
                let checkDate = new Date(fullDate);
                let today = new Date();
                let todayFormatted =
                    `${today.getFullYear()}-${(today.getMonth() + 1).toString().padStart(2, '0')}-${today.getDate().toString().padStart(2, '0')}`;

                let bacSiId = document.getElementById("calendar").dataset.bacsiId;

                dayCell.className = "flex-fill p-3 text-center rounded fw-bold";
                dayCell.innerText = date;

                if (fullDate === todayFormatted) {
                    dayCell.classList.add("text-danger", "border", "border-danger");
                }
                if (checkDate < today) {
                    dayCell.classList.add("text-muted", "disabled");
                } else if (availableDates.includes(fullDate)) {
                    dayCell.classList.add("bg-primary", "text-white", "clickable");
                    dayCell.dataset.date = fullDate;

                    dayCell.addEventListener("click", function() {
                        selectedDateGlobal = fullDate; // Lưu ngày chọn vào biến toàn cục
                        fetchKhungGio(fullDate, bacSiId);
                    });
                } else {
                    dayCell.classList.add("text-muted", "disabled");
                }

                return dayCell;
            }


            function fetchKhungGio(selectedDate, bacSiId) {
                fetch(`/booking/get-khung-gio?date=${selectedDate}&id_bacsi=${bacSiId}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayKhungGio(data.khungGio, data.id_lichkham);
                        } else {
                            alert(data.message);
                        }
                    })
                    .catch(error => console.error("Lỗi khi lấy khung giờ:", error));
            }

            function displayKhungGio(khungGioList, id_lichkham) {
                let timeSlotsDiv = document.getElementById("timeSlots");
                timeSlotsDiv.innerHTML = `<h4 class="text-primary mt-3">Chọn khung giờ</h4>`;

                khungGioList.forEach(khungGio => {
                    let khungGioBtn = document.createElement("button");
                    khungGioBtn.innerText = `${khungGio.thoigianbatdau} - ${khungGio.thoigianketthuc}`;
                    khungGioBtn.className = "btn m-2";

                    if (khungGio.trangthai === 0) { // Nếu đã đầy
                        khungGioBtn.classList.add("btn-secondary", "disabled");
                    } else {
                        khungGioBtn.classList.add("btn-outline-success");
                        khungGioBtn.onclick = function() {
                            confirmBooking(khungGio.id, id_lichkham);
                        };
                    }

                    timeSlotsDiv.appendChild(khungGioBtn);
                });
            }

            function confirmBooking(khungGioId, id_lichkham) {
                let idBacSi = document.getElementById("id_bacsi").value;

                if (!selectedDateGlobal) {
                    alert("Vui lòng chọn ngày hẹn!");
                    return;
                }

                let url =
                    `/dat-lich/booking/thong-tin?id_bacsi=${idBacSi}&ngayhen=${selectedDateGlobal}&id_khunggio=${khungGioId}&id_lichkham=${id_lichkham}`;
                window.location.href = url;
            }

            // Khi chuyển sang tháng mới, loại bỏ các ngày đã được hiển thị ở cuối tháng trước
            function adjustPreviousMonthDays(month, year) {
                let carryOverDays = JSON.parse(localStorage.getItem("carryOverDays")) || [];
                return carryOverDays.filter(day => day.month !== month || day.year !== year);
            }

            document.getElementById("prevMonth").addEventListener("click", function() {
                if (currentMonth === 0) {
                    currentMonth = 11;
                    currentYear--;
                } else {
                    currentMonth--;
                }
                renderCalendar(currentMonth, currentYear);
            });

            document.getElementById("nextMonth").addEventListener("click", function() {
                if (currentMonth === 11) {
                    currentMonth = 0;
                    currentYear++;
                } else {
                    currentMonth++;
                }
                renderCalendar(currentMonth, currentYear);
            });

            renderCalendar(currentMonth, currentYear);
        });
    </script>
@endsection
