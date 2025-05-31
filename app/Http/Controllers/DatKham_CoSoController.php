<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LichSu;
use App\Models\LichKham;
use App\Models\BenhNhan;
use App\Models\ChuyenKhoa;
use App\Models\KhungGio;
use App\Models\CoSo;
use App\Models\BacSi;
use App\Models\LichKhamKhungGio;
use App\Models\LichHen;
use Illuminate\Support\Facades\Mail;
use App\Mail\DatKhamThanhCong;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class DatKham_CoSoController extends Controller
{
    // Hiển thị danh sách lịch khám theo cơ sở
    public function index()
    {
        $title = 'Đặt khám tại cơ sở - EbookCare';
        $cosos = CoSo::paginate(10);
        //$chuyenkhoas= ChuyenKhoa::all();
        return view('trangchu.datkham_coso.index', compact('title', 'cosos'));
    }

    public function chitiet($id)
    {
        $coso = CoSo::findOrFail($id);
        $title = $coso->tencoso;
        return view('trangchu.datkham_coso.chitiet', compact('coso', 'title'));
    }

    public function hinhthucdat($id)
    {
        $coSo = CoSo::findOrFail($id); // Lấy thông tin cơ sở từ ID
        $title = $coSo->tencoso; // Giả sử cột tên trong bảng là 'ten'

        return view('trangchu.datkham_coso.hinhthucdat', compact('title', 'id'));
    }

    //Hình thức theo chuyên khoa
    public function chonChuyenKhoa($coSoId)
    {
        $title = 'Chọn chuyên khoa - EbookCare';
        $coSo = CoSo::findOrFail($coSoId);
        $chuyenKhoas = ChuyenKhoa::where('id_coso', $coSoId)->get();
        return view('trangchu.datkham_coso.booking.chon_chuyen_khoa', compact('title', 'coSo', 'chuyenKhoas'));
    }


    public function chonBacSi($coSoId, $chuyenKhoaId)
    {
        $title = 'Chọn bác sĩ - EbookCare';
        $coSo = CoSo::findOrFail($coSoId);
        $chuyenKhoa = ChuyenKhoa::findOrFail($chuyenKhoaId);
        $bacSis = BacSi::where('id_chuyenkhoa', $chuyenKhoaId)->where('id_coso', $coSoId)->get();
        return view('trangchu.datkham_coso.booking.chon_bac_si', compact('title', 'coSo', 'chuyenKhoa', 'bacSis'));
    }

    public function chonThoiGian($coSoId, $chuyenKhoaId, $bacSiId)
    {
        $title = 'Chọn ngày khám - EbookCare';
        $bacSi = BacSi::findOrFail($bacSiId);
        $chuyenKhoa = $bacSi->chuyenKhoa;
        $coSo = $bacSi->coSo;
        $ngayKham = LichKham::where('id_bacsi', $bacSiId)
            ->pluck('ngaykham')
            ->toArray();

        return view('trangchu.datkham_coso.chon_thoi_gian', compact('bacSi', 'chuyenKhoa', 'coSo', 'ngayKham', 'title'));
    }

    public function getKhungGioTheoNgay(Request $request)
    {
        $ngayChon = $request->date;
        $bacSiId = $request->id_bacsi;

        // 1. Tìm `id_lich_kham` của bác sĩ vào ngày đã chọn
        $lichKham = LichKham::where('id_bacsi', $bacSiId)
            ->where('ngaykham', $ngayChon)
            ->first();

        if (!$lichKham) {
            return response()->json(['success' => false, 'message' => 'Không có lịch khám']);
        }
        $id_lichkham = $lichKham->id;

        // 2. Lấy danh sách `lichkham_khunggio`
        $lichKhamKhungGios = LichKhamKhungGio::where('id_lichkham', $lichKham->id)->get();

        // 3. Cập nhật trạng thái nếu số lượng tối đa = số lượng đã đặt
        foreach ($lichKhamKhungGios as $lichKhamKhungGio) {
            if ($lichKhamKhungGio->soluongdadat >= $lichKhamKhungGio->soluongtoida) {
                $lichKhamKhungGio->trangthai = 0; // Đã đầy
                $lichKhamKhungGio->save();
            }
        }

        // 4. Lấy danh sách khung giờ kèm trạng thái
        $khungGioList = $lichKhamKhungGios->map(function ($lichKhamKhungGio) {
            $khungGio = KhungGio::find($lichKhamKhungGio->id_khunggio);
            return [
                'id' => $khungGio->id,
                'buoi' => $khungGio->buoi,
                'thoigianbatdau' => $khungGio->thoigianbatdau,
                'thoigianketthuc' => $khungGio->thoigianketthuc,
                'trangthai' => $lichKhamKhungGio->trangthai, // 0: Đang nhận, 1: Đã đầy
            ];
        });

        return response()->json(['success' => true, 'khungGio' => $khungGioList, 'id_lichkham' => $id_lichkham]);
    }

    public function hienThiForm(Request $request)
    {

        $title = 'Thông tin bệnh nhân - EbookCare';
        $id_bacsi = $request->id_bacsi;
        $ngayhen = $request->ngayhen;
        $id_khunggio = $request->id_khunggio;
        $giakham = ChuyenKhoa::whereHas('bacSi', function ($query) use ($id_bacsi) {
            $query->where('id', $id_bacsi);
        })->value('giakham');

        if (!Auth::check()) {
            return redirect()->route('login', ['redirect_to' => url('/dat-lich/booking/thong-tin')]);
        }

        // Lấy danh sách hồ sơ bệnh nhân của người dùng đang đăng nhập
        $benhnhans = BenhNhan::where('id_user', Auth::id())->get();

        // Nếu có id_benhnhan trong request, lấy thông tin hồ sơ đó
        $benhNhanSelected = null;
        if ($request->has('id_benhnhan')) {
            $benhNhanSelected = BenhNhan::find($request->id_benhnhan);
        }

        return view('trangchu.datkham_coso.thongtin', compact('title', 'id_bacsi', 'ngayhen', 'id_khunggio', 'giakham', 'benhnhans', 'benhNhanSelected'));
    }

    public function luuThongTin(Request $request)
    {
        try {
            Log::info('Dữ liệu hợp lệ, tiếp tục xử lý');

            // Bắt đầu transaction
            DB::beginTransaction();

            // Kiểm tra trước khi tạo bệnh nhân
            Log::info('Tạo mới bệnh nhân', ['data' => $request->all()]);

            // Lấy thông tin bệnh nhân từ request
            $data = $request->all();

            // Kiểm tra xem bệnh nhân đã tồn tại trong cơ sở dữ liệu chưa (dựa trên CCCD hoặc các thông tin khác)
            $benhnhan = BenhNhan::where('id', $data['id_benhnhan'])->first();

            // Nếu bệnh nhân chưa tồn tại, thêm mới vào bảng bệnh nhân
            if (!$benhnhan) {
                $request->validate([
                    'hoten' => 'required|string|max:255',
                    'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
                    'diachi' => 'required|string|max:255',
                    'ngaysinh' => 'required|date|before:today',
                    'cccd' => 'required|digits:12|unique:benhnhan,cccd',
                    'gioitinh' => 'required|in:Nam,Nữ',
                ], [
                    'hoten.required' => 'Vui lòng nhập họ và tên.',
                    'hoten.string' => 'Họ tên phải là chuỗi ký tự.',
                    'hoten.max' => 'Họ tên không được quá 255 ký tự.',
                    'sodienthoai.required' => 'Vui lòng nhập số điện thoại.',
                    'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng số 0 và có 10 hoặc 11 chữ số.',
                    'diachi.required' => 'Vui lòng nhập địa chỉ.',
                    'diachi.string' => 'Địa chỉ phải là chuỗi ký tự.',
                    'diachi.max' => 'Địa chỉ không được quá 255 ký tự.',
                    'ngaysinh.required' => 'Vui lòng nhập ngày sinh.',
                    'ngaysinh.date' => 'Ngày sinh không hợp lệ.',
                    'ngaysinh.before' => 'Ngày sinh phải trước ngày hiện tại.',
                    'cccd.required' => 'Vui lòng nhập số CCCD.',
                    'cccd.digits' => 'CCCD phải có đúng 12 chữ số.',
                    'cccd.unique' => 'Số CCCD này đã được sử dụng.',
                    'gioitinh.required' => 'Vui lòng chọn giới tính.',
                    'gioitinh.in' => 'Giới tính không hợp lệ.',
                ]);

                $benhnhan = new BenhNhan();
                $benhnhan->hoten = $data['hoten'];
                $benhnhan->cccd = $data['cccd'];
                $benhnhan->ngaysinh = $data['ngaysinh'];
                $benhnhan->sodienthoai = $data['sodienthoai'];
                $benhnhan->gioitinh = $data['gioitinh'];
                $benhnhan->diachi = $data['diachi'];
                $benhnhan->id_user = Auth::user()->id; // Gắn id của người dùng hiện tại
                $benhnhan->save(); // Lưu bệnh nhân vào cơ sở dữ liệu

                Log::info('Bệnh nhân đã được tạo mới', ['id_benhnhan' => $benhnhan->id]);
            } else {
                Log::info('Bệnh nhân đã tồn tại', ['id_benhnhan' => $benhnhan->id]);
            }

            // Kiểm tra khung giờ có tồn tại không
            $khungGio = KhungGio::find($request->id_khunggio);
            if (!$khungGio) {
                Log::error('Khung giờ không tồn tại', ['id_khunggio' => $request->id_khunggio]);
                return back()->with('error', 'Khung giờ không tồn tại.');
            }
            Log::info('Khung giờ hợp lệ', ['id_khunggio' => $request->id_khunggio]);

            $giakham = $request->giakham ?? ChuyenKhoa::whereHas('bacsi', function ($query) use ($request) {
                $query->where('id', $request->id_bacsi);
            })->value('giakham');

            if (!$giakham) {
                Log::error('Không tìm thấy giá khám', ['id_bacsi' => $request->id_bacsi]);
                return back()->with('error', 'Không tìm thấy giá khám.');
            }

            // Tạo lịch hẹn
            Log::info('Tạo lịch hẹn');

            $lichKhamKhungGio = LichKhamKhungGio::where('id_lichkham', $data['id_lichkham'])
                ->where('id_khunggio', $data['id_khunggio'])
                ->first();

            if (!$lichKhamKhungGio) {
                Log::error('Không tìm thấy khung giờ cho lịch khám', [
                    'id_lichkham' => $data['id_lichkham'],
                    'id_khunggio' => $data['id_khunggio']
                ]);
                throw new \Exception('Không tìm thấy khung giờ cho lịch khám');
            }

            // Tạo lịch hẹn
            $lichHen = new LichHen();
            $lichHen->id_benhnhan = $benhnhan->id; // Lấy id bệnh nhân đã tồn tại hoặc mới tạo
            $lichHen->id_bacsi = $data['id_bacsi'];
            $lichHen->id_lichkhamkhunggio = $lichKhamKhungGio->id;
            $lichHen->giakham = $giakham;
            $lichHen->ngayhen = $data['ngayhen'];
            $lichHen->buoi = $khungGio->buoi;
            $lichHen->thoigian = $khungGio->thoigianbatdau . ' - ' . $khungGio->thoigianketthuc;
            $lichHen->save(); // Lưu thông tin lịch khám vào cơ sở dữ liệu

            Log::info('Tạo lịch hẹn thành công', ['id_lichhen' => $lichHen->id]);

            // Cập nhật soluongdadat trong bảng lichkham_khunggio
            Log::info('Cập nhật soluongdadat trong lichkham_khunggio', [
                'id_lichkham' => $request->id_lichkham,
                'id_khunggio' => $request->id_khunggio
            ]);

            if ($lichKhamKhungGio) {
                $lichKhamKhungGio->increment('soluongdadat');
                Log::info('Cập nhật soluongdadat thành công', [
                    'soluongdadat_moi' => $lichKhamKhungGio->soluongdadat
                ]);

                // Nếu đã đạt số lượng tối đa, cập nhật trạng thái về "đã đầy"
                if ($lichKhamKhungGio->soluongdadat >= $lichKhamKhungGio->soluongtoida) {
                    $lichKhamKhungGio->update(['trangthai' => 2]); // 2 = Đã đầy
                    Log::info('Cập nhật trạng thái khung giờ: Đã đầy');
                }
            } else {
                Log::error('Không tìm thấy bản ghi trong lichkham_khunggio');
            }

            // Hoàn tất transaction
            DB::commit();
            Log::info('Đặt lịch thành công');

            $id_bacsi = $lichHen->id_bacsi; // hoặc $id_bacsi = 123;

            $bacsi = BacSi::with(['chuyenkhoa', 'coso'])->find($id_bacsi);
            // Ghi nhận lịch sử
            $user = Auth::user();
            // Gửi mail
            if (!empty($user->email)) {
                try {
                    Mail::to($user->email)->send(new DatKhamThanhCong($user, $benhnhan, $bacsi, $lichHen));
                    if (count(Mail::failures()) > 0) {
                        dd('Mail gửi thất bại', Mail::failures());
                    }
                } catch (\Exception $e) {
                    // Log lỗi
                    Log::error('Không thể gửi email cảm ơn: ' . $e->getMessage());
                }
            }

            $message = 'Bạn đã đặt lịch thành công!';
            if (!empty($user->email)) {
                $message .= 'Chúng tôi đã gửi thông báo đặt khám đến địa chỉ email của bạn. Vui lòng kiểm tra hộp thư!';
            }

            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') có hồ sơ Bệnh nhân "' . $benhnhan->hoten .
                '" đã đặt lịch khám của Bác sĩ "' . $bacsi->hocham . $bacsi->hoten . '(' . $bacsi->chuyenkhoa->tenkhoa . ' - ' . $bacsi->coso->tencoso . ')"';
            $ls->save;

            return redirect()->route('home.index')->with('success', $message);
        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Lỗi khi lưu dữ liệu', ['error' => $e->getMessage()]);
            return back()->with('error', $e->getMessage());
        }
    }

    //hình thức theo bác sĩ
    public function chonBacSi_chuyenKhoa($coSoId)
    {
        $title = 'Chọn bác sĩ - EbookCare';
        $coSo = CoSo::findOrFail($coSoId);

        $bacSis = BacSi::where('id_coso', $coSoId)->get();
        return view('trangchu.datkham_coso.cs_bacsi.chon_bac_si', compact('title', 'coSo', 'bacSis'));
    }
}
