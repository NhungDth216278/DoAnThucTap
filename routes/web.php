<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoSoController;
use App\Http\Controllers\ChuyenKhoaController;
use App\Http\Controllers\TrangAdminController;
use App\Http\Controllers\TrangChuController;
use App\Http\Controllers\NhanVienController;
use App\Http\Controllers\BacSiController;
use App\Http\Controllers\BenhNhanController;
use App\Http\Controllers\DatKham_BacSiController;
use App\Http\Controllers\LichKhamController;
use App\Http\Controllers\DatKham_CoSoController;
use App\Http\Controllers\LichHenController;
use App\Http\Controllers\TinTucController;
use App\Http\Controllers\DatKham_ChuyenKhoaController;
use App\Http\Controllers\LichSuController;
use App\Http\Controllers\AIChatBotController;
use App\Http\Controllers\VietTinTuc;
use App\Http\Controllers\ThongKe;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthManager;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Str;

// Trang chủ - đăng nhập
Route::get('/login', [AuthManager::class, 'showLogin'])->name('home.login')->middleware('hadLogin');
Route::post('login/xu-ly', [AuthManager::class, 'login'])->name('home.login.proc');

// Trang chủ - đăng ký
Route::get('/register', [AuthManager::class, 'showRegistration'])->name('home.register')->middleware('hadLogin');;
Route::post('register', [AuthManager::class, 'register'])->name('home.register.proc');

//Đăng xuất
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

// Trang Admin - đăng nhập
Route::get('/admin/login', [AuthManager::class, 'showLoginAdmin'])->name('admin.login')->middleware('hadLogin');
Route::post('/admin/login/xu-ly', [AuthManager::class, 'login'])->name('admin.login.proc');

//Đăng xuất
Route::post('/logout', [AuthManager::class, 'logout'])->name('logout');

// Quên mật khẩu
Route::get('/quen-mat-khau',  [AuthManager::class, 'forgotPass'])->name('password.forgot')->middleware('hadLogin');
Route::post('/quen-mat-khau/gui-link-khoi-phuc-mat-khau-qua-email',  [AuthManager::class, 'guiLinkReset'])->name('forgotPass.proc')->middleware('hadLogin');
Route::get('/khoi-phuc-mat-khau', [AuthManager::class, 'showResetForm'])->name('password.reset');
Route::post('/khoi-phuc-mat-khau/xu-ly', [AuthManager::class, 'reset'])->name('password.update');

// Xác thực email dành cho trang Quản trị
Route::post('/admin/profile/send-verify-admin', [AuthManager::class, 'sendVerifyAdmin'])->name('admin.profile.sendVerifyAdmin');
Route::get('/email/verify-admin/{id}',  [AuthManager::class,'verifyEmailAdmin'])->name('email.verifyAdmin');

// Xác thực email cho Khách hàng
Route::post('/admin/profile/send-verify-user', [AuthManager::class,'sendVerifyUser'])->name('user.profile.sendVerifyUser');
Route::get('/email/verify-user/{id}', [AuthManager::class, 'verifyEmailUser'])->name('email.verifyUser');

Route::middleware('hadLogin')->controller(GoogleController::class)->group(function () {
    Route::get('/login/google', 'redirect')->name('auth.google.redirect');
    Route::get('/login/google/callback', 'callback')->name('auth.google.callback');
});

// Chat Box AI
Route::post('/chat-ai', [AIChatBotController::class, 'chat'])->name('home.chatbox');

// Trang chủ
Route::middleware('onlyUser')->controller(TrangChuController::class)->group(function () {
    Route::get('/', 'index')->name('home.index');
    Route::get('/search', 'search')->name('home.search');
    Route::get('/gioi-thieu', 'gioithieu')->name('home.gioithieu');
    Route::get('/dieu-khoan-dich-vu', 'dieukhoan')->name('home.dieukhoan');
    Route::get('/quy-dinh-su-dung', 'quydinh')->name('home.quydinh');
    // web.php
    Route::get('/chinh-sach-bao-mat', 'chinhsach')->name('home.chinhsach');

    Route::get('/huong-dan/dat-lich-kham', function () {
        $title = 'Hướng dẫn đặt lịch khám';
        return view('trangchu.huongdan', compact('title'));
    })->name('huongdan');

    Route::get('/huong-dan/cau-hoi', function () {
        $title = 'Câu hỏi thường gặp';
        return view('trangchu.cauhoi', compact('title'));
    })->name('cauhoi');

    Route::post('/profile/doi-mat-khau',  'changePassword')->name('home.profile.password');
    Route::get('/profile', 'profile')->name('home.profile');
    Route::post('/profile/cap-nhat', 'updateProfile')->name('home.profile.update');

    Route::get('/ho-so-benh-nhan', 'getHoSoBenhNhan')->name("home.hosobenhnhan");
    Route::post('/ho-so-benh-nhan/them', 'storeBenhNhan')->name('hosobenhnhan.store');
    Route::post('/ho-so-benh-nhan/update/{id}', 'updateBenhNhan')->name('hosobenhnhan.update');
    Route::delete('/ho-so-benh-nhan/delete/{id}', 'deleteBenhNhan')->name('hosobenhnhan.delete');
    Route::get('/ho-so-benh-nhan/{id}/lich-hen', 'lichHenBenhNhan')->name('hosobenhnhan.lichhen');
    Route::post('/ho-so-benh-nhan/lichhen/huy/{id}', 'huyLichHen')->name('lichhen.huy');
    Route::get('/ho-so-benh-nhan/lichhen/delete/{id}', 'deleteLichHen')->name('lichhen.xoa');
});

Route::middleware('onlyUser')->group(function () {
    //Dùng chung cho tất cả
    Route::get('/dat-kham/{coSo}/{chuyenKhoa}/{bacSi}', [DatKham_CoSoController::class, 'chonThoiGian'])->name('datkham.thoi-gian');
    Route::get('/booking/get-khung-gio', [DatKham_CoSoController::class, 'getKhungGioTheoNgay']);

    Route::get('/dat-lich/booking/thong-tin', function () {
        if (!Auth::check()) {
            return redirect()->route('home.login', ['redirect_to' => request()->fullUrl()]);
        }
        return app(DatKham_CoSoController::class)->hienThiForm(request());
    })->name('datkham.thongtin');

    Route::post('/dat-kham/booking/luu-thong-tin', [DatKham_CoSoController::class, 'luuThongTin'])->name('datkham.luuThongTin');

    //{ Đặt khám theo cơ sở
    Route::get('/dat-kham-co-so', [DatKham_CoSoController::class, 'index'])->name('datkham_coso.index');
    Route::get('/chi-tiet-co-so/{id}', [DatKham_CoSoController::class, 'chitiet'])->name('coso.chitiet');

    Route::get('/dat-kham-co-so/hinh-thuc-dat/{id}', [DatKham_CoSoController::class, 'hinhthucdat'])->name('datkham_coso.hinhthucdat');

    //Hình thức theo chuyên khoa
    Route::get('/dat-kham-co-so/{coSo}/chuyen-khoa', [DatKham_CoSoController::class, 'chonChuyenKhoa'])->name('booking.chuyen-khoa');
    Route::get('/datkham-coso/{coSo}/{chuyenKhoa}/bacsi', [DatKham_CoSoController::class, 'chonBacSi'])->name('datkhamcoso.bacsi');

    //Hình thức theo bác sĩ
    Route::get('/dat-kham-co-so/{coSo}/bac-si', [DatKham_CoSoController::class, 'chonBacSi_chuyenKhoa'])->name('cs_bacsi.bac-si');
    //}

    //{Đặt khám theo chuyên khoa
    Route::get('/dat-kham-chuyen-khoa', [DatKham_ChuyenKhoaController::class, 'index'])->name('datkham_chuyenkhoa.index');
    Route::get('/dat-kham-chuyen-khoa/{coSo}/{chuyenKhoa}/bac-si', [DatKham_ChuyenKhoaController::class, 'chonBacSi'])->name('datkham_chuyenkhoa.chon-bac-si');
    //}

    //{Đặt khám theo bác sĩ
    Route::get('/dat-kham-bac-si', [DatKham_BacSiController::class, 'index'])->name('datkham_bacsi.index');

    //}
    //hướng trang chủ- trang tin
    Route::get('/tintuc/{loai}/{id}/chitiet', [TinTucController::class, 'detail'])->name('tintuc.detail');
    Route::get('/tintuc/{loai}/', [TinTucController::class, 'showTrangTin'])->name('tintuc.show');
});



// Trang Admin
Route::middleware('adminLogin')->controller(TrangAdminController::class)->group(function () {
    Route::get('/admin', 'index')->name('admin.index');

    Route::post('/thongke/doanh-thu', 'getDoanhThuTheoThang')->name('thongke.doanhthu');
    Route::post('/thongke/chartData', 'getChartData')->name('thongke.chartData');

    Route::post('/thongke/ajax', 'ajaxThongKe')->name('thongke.ajax');

    Route::get('/admin/thongke/bacsi/{id}',  'showbacsi')->name('bacsi.show');

    Route::get('/admin/ho-tro', 'support')->name('admin.support');
    Route::get('/admin/trung-tam-tro-giup', 'helpcenter')->name('admin.helpcenter');
    Route::get('/admin/quyen-rieng-tu', 'privacy')->name('admin.privacy');
    Route::get('/admin/dieu-khoan', 'terms')->name('admin.terms');

    Route::get('/admin/profile', 'profile')->name('admin.profile');
    Route::post('/admin/profile/cap-nhat', 'updateProfile')->name('admin.profile.update');
    Route::post('/admin/profile/doi-mat-khau', 'changePassword')->name('admin.profile.password');
});

// Người dùng - Nhân viên
Route::middleware('adminLogin', 'checkroleaccess')->controller(NhanVienController::class)->group(function () {
    Route::get('/admin/nhan-vien', 'index')->name('nhanvien.index');
    Route::get('/admin/nhan-vien/thongtinnhanvien/{id_user}',  'shownhanvien')->name('nhanvien.show');
    Route::post('/admin/qlnhanvien/update-status', 'updateStatus')->name('nhanvien.updateStatus');
    Route::post('/admin/nhan-vien', 'store')->name('nhanvien.store');
    Route::get('/admin/nhan-vien/them', 'create')->name('nhanvien.create');

    Route::get('/admin/nhan-vien/{id}/chinh_sua', 'edit')->name('nhanvien.edit');
    Route::post('/admin/nhan-vien/{id}/cap-nhat', 'update')->name('nhanvien.update');
    Route::get('/admin/nhan-vien/{id}/xoa', 'delete')->name('nhanvien.delete');
});

// Lịch sử tác vụ
Route::middleware('adminLogin', 'checkroleaccess')->controller(LichSuController::class)->group(function () {
    Route::get('/admin/lich-su', 'index')->name('lichsu.index');
});

// Cơ sở
Route::middleware('adminLogin', 'checkroleaccess')->controller(CoSoController::class)->group(function () {
    Route::get('/admin/qlcoso', 'index')->name('coso.index');
    Route::post('/admin/qlcoso', 'store')->name('coso.store');
    Route::get('/admin/qlcoso/{id}/chinh_sua', 'edit')->name('coso.edit');
    Route::post('/admin/qlcoso/{id}/cap_nhat', 'update')->name('coso.update');
    Route::get('/admin/qlcoso/{id}/xoa', 'delete')->name('coso.delete');

    Route::get('/export-coso', 'export')->name('coso.export');
});

// Chuyên khoa
Route::middleware('adminLogin', 'checkroleaccess')->controller(ChuyenKhoaController::class)->group(function () {
    Route::get('/admin/qlchuyenkhoa', 'index')->name('chuyenkhoa.index');
    Route::post('/admin/qlchuyenkhoa', 'store')->name('chuyenkhoa.store');
    Route::get('/admin/qlchuyenkhoa/{id}/chinh_sua', 'edit')->name('chuyenkhoa.edit');
    Route::post('/admin/qlchuyenkhoa/{id}/cap_nhat', 'update')->name('chuyenkhoa.update');
    Route::get('/admin/qlchuyenkhoa/{id}/xoa', 'delete')->name('chuyenkhoa.delete');

    Route::get('/export-chuyenkhoa', 'export')->name('chuyenkhoa.export');
});

use Illuminate\Http\Request;

Route::post('/ckeditor/upload', function (Request $request) {
    if ($request->hasFile('upload')) {
        $type = $request->query('type', 'default'); // lấy theo type gửi từ query string

        // Đảm bảo tên thư mục an toàn
        $type = Str::slug($type);

        $file = $request->file('upload');
        $fileName = time() . '_' . $file->getClientOriginalName();

        // Tạo thư mục theo type: ví dụ public/upload/baiviet hoặc upload/gioithieu
        $uploadPath = public_path("upload/{$type}");
        if (!file_exists($uploadPath)) {
            mkdir($uploadPath, 0755, true); // tạo thư mục nếu chưa tồn tại
        }

        $file->move($uploadPath, $fileName);

        $url = asset("upload/{$type}/" . $fileName);
        return response()->json(['fileName' => $fileName, 'uploaded' => 1, 'url' => $url]);
    }

    return response()->json(['uploaded' => 0, 'error' => ['message' => 'Upload failed']]);
})->name('ckeditor.upload');

// Bác Sĩ
Route::middleware('adminLogin', 'checkroleaccess')->controller(BacSiController::class)->group(function () {
    Route::get('/admin/qlbacsi', 'index')->name('bacsi.index');
    Route::get('/admin/qlbacsi/them', 'create')->name('bacsi.create');
    Route::post('/admin/qlbacsi', 'store')->name('bacsi.store');
    Route::get('/admin/qlbacsi/{id}/chinh_sua', 'edit')->name('bacsi.edit');
    Route::post('/admin/qlbacsi/{id}/cap_nhat', 'update')->name('bacsi.update');
    Route::get('/admin/qlbacsi/{id}/xoa', 'delete')->name('bacsi.delete');
    Route::post('/admin/qlbacsi/update-status', 'updateStatus')->name('bacsi.updateStatus');
    Route::get('/admin/qlbacsi/{id}/lich_kham', [BacSiController::class, 'showLichKham'])->name('bacsi.lichkham');

    Route::get('/export-bacsi', 'export')->name('bacsi.export');
});

//  Lịch Khám
Route::middleware('adminLogin', 'checkroleaccess')->controller(LichKhamController::class)->group(function () {
    Route::get('/admin/qllichkham', 'index')->name('lichkham.index');
    Route::get('/admin/qllichkham/show/{id}', 'show')->name('lichkham.show');

    Route::get('/get-chuyenkhoa/{coso_id}', 'getChuyenKhoa')->name('getChuyenKhoa');
    Route::get('/get-all-chuyenkhoa', 'getAllChuyenKhoa')->name('getAllChuyenKhoa');

    Route::get('/get-bacsi/{chuyenkhoa_id}',  'getBacSi')->name('getBacSi');
    Route::get('/get-all-bacsi', 'getAllBacSi')->name('getAllBacSi');

    Route::post('/admin/lichkham/store', 'store')->name('lichkham.store');
    Route::get('/admin/qllichkham/edit/{id}', 'edit')->name('lichkham.edit');
    Route::post('/admin/qllichkham/update/{id}', 'update')->name('lichkham.update');
    Route::get('/admin/qllichkham/xoa/{id}', 'delete')->name('lichkham.delete');

    Route::get('/export-lichkham', 'export')->name('lichkham.export');
});


// Bệnh nhân
Route::middleware('adminLogin', 'checkroleaccess')->controller(BenhNhanController::class)->group(function () {
    Route::get('/admin/qlbenhnhan', 'index')->name('taikhoanbenhnhan.index');
    Route::post('/admin/qlbenhnhan/update-status', 'updateStatus')->name('taikhoanbenhnhan.updateStatus');
    Route::get('/admin/qlbenhnhan/{id}/xem-ho-so', 'danhSachBenhNhan')->name('taikhoanbenhnhan.xemhoso');
    Route::get('/admin/qlbenhnhan/{id}/xoa-tai-khoan', 'xoaTaiKhoan')->name('taikhoanbenhnhan.deleteXoaTK');

    Route::get('/admin/qlbenhnhan/{id}/chi-tiet-lich-hen', 'detailLichHen')->name('benhnhan.detail_lichhen');
    Route::get('/admin/qlbenhnhan/{id}/chinh_sua', 'edit')->name('benhnhan.edit');
    Route::post('/admin/qlbenhnhan/{id}/cap_nhat', 'update')->name('benhnhan.update');
    Route::get('/admin/qlbenhnhan/{id}/xoa', 'delete')->name('benhnhan.delete');
});

// Lịch hẹn
Route::middleware('adminLogin', 'checkroleaccess')->controller(LichHenController::class)->group(function () {
    Route::get('/admin/qllichhen', 'index')->name('lichhen.index');
    Route::get('/admin/qllichhen/{id}', 'delete')->name('lichhen.delete');
    Route::post('/admin/qllichhen/update-status', 'updateStatus')->name('lichhen.updateStatus');
    Route::get('/admin/qllichhen/benhnhan/{id}',  'showbenhnhan')->name('benhnhan.show');

    Route::get('/export-lichhen', 'export')->name('lichhen.export');
});

//Tin tức
Route::middleware('adminLogin', 'checkroleaccess')->controller(TinTucController::class)->group(function () {
    Route::get('/admin/qltintuc', 'index')->name('qltintuc.index');
    //Route::get('/admin/qltintuc/edit/{id}', 'edit')->name('qltintuc.edit');
    //Route::post('/admin/qlltintuc/update/{id}', 'update')->name('qltintuc.update');
    Route::post('/admin/qltintuc/update-status', 'updateStatus')->name('qltintuc.updateStatus');
    Route::get('/admin/qltintuc/xoa/{id}', 'delete')->name('qltintuc.delete');
    //Route::post('/admin/qltintuc/store', 'store')->name('qltintuc.store');
    Route::get('/admin/tintuc/show/{id}', 'xemTinTuc')->name('tintuc.xem');
});

// viết Tin tức
Route::middleware('adminLogin', 'checkroleaccess')->controller(VietTinTuc::class)->group(function () {
    Route::get('/admin/dstintuc', 'index')->name('dstintuc.index');
    Route::get('/admin/dstintuc/edit/{id}', 'edit')->name('dstintuc.edit');
    Route::post('/admin/dstintuc/update/{id}', 'update')->name('dstintuc.update');

    Route::get('/admin/dstintuc/xoa/{id}', 'delete')->name('dstintuc.delete');
    Route::post('/admin/dstintuc/store', 'store')->name('dstintuc.store');
    Route::get('/admin/dstintuc/themtin', 'create')->name('dstintuc.formtin');
});

Route::middleware('adminLogin', 'checkroleaccess')->controller(ThongKe::class)->group(function () {
    Route::get('/admin/thongke', 'index')->name('thongkecoso.index');

    Route::post('/admin/thongke/doanh-thu', 'getDoanhThuTheoThang')->name('thongkecoso.doanhthu');
    Route::post('/admin/thongke/chartData', 'getChartData')->name('thongkecoso.chartData');

    Route::post('/admin/thongke/ajax', 'ajaxThongKe')->name('thongkecoso.ajax');
});
