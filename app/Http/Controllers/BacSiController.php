<?php

namespace App\Http\Controllers;

use App\Models\ChuyenKhoa;
use App\Models\CoSo;
use App\Models\BacSi;
use App\Models\LichKham;
use App\Models\KhungGio;
use App\Models\NhanVien;
use App\Models\LichKhamKhungGio;
use App\Models\LichSu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon; // Import Carbon để xử lý ngày
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BacSiController extends Controller
{
    public function index(Request $request)
    {

        $query = BacSi::with(['coso', 'chuyenkhoa']);
        // Lấy user đang đăng nhập
        $user = Auth::user();

        if ($user->role === 'hospital') {
            // Nếu là nhân viên cơ sở
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {

                // Thêm điều kiện lọc bác sĩ theo cơ sở của nhân viên
                $query->where('id_coso', $nhanvien->id_coso);

                $coso = Coso::find($nhanvien->id_coso);
                // Tìm kiếm theo họ tên, địa chỉ
                if ($request->filled('keyword')) {
                    $query->where(function ($q) use ($request) {
                        $q->where('hoten', 'like', '%' . $request->keyword . '%')
                            ->orWhere('diachi', 'like', '%' . $request->keyword . '%');
                    });
                }
                // Lọc theo id_chuyenkhoa
                if ($request->filled('id_chuyenkhoa')) {
                    $query->where('id_chuyenkhoa', $request->id_chuyenkhoa);
                }

                // Lọc theo giới tính
                if ($request->filled('gioitinh')) {
                    $query->where('gioitinh', $request->gioitinh);
                }

                // Lọc theo học hàm
                if ($request->filled('hocham')) {
                    $query->where('hocham', $request->hocham);
                }

                // Lọc theo trạng thái
                if ($request->filled('trangthai')) {
                    $query->where('trangthai', $request->trangthai);
                }

                $hocHamList = [
                    'BS CKI.',
                    'BS CKII.',
                    'ThS BS.',
                    'TS BS.',
                    'PGS TS BS.',
                    'GS TS BS.'
                ];

                $lstBS = $query->paginate(10);

                $lstCS = CoSo::all();
                $lstCK = ChuyenKhoa::all();
                $title = 'Trang quản trị của ' . $coso->tencoso . ' - EbookCare';
                return view('admin.bacsi.index', [
                    'title' => $title,
                    'lstBS' => $lstBS,
                    'lstCK' => $lstCK,
                    'lstCS' => $lstCS,
                    'hocHamList' => $hocHamList,
                    'cs_nv' => $coso
                ]);
            }
        } else {
            $query = BacSi::with(['coso', 'chuyenkhoa']);

            // Tìm kiếm theo họ tên, địa chỉ
            if ($request->filled('keyword')) {
                $query->where(function ($q) use ($request) {
                    $q->where('hoten', 'like', '%' . $request->keyword . '%')
                        ->orWhere('diachi', 'like', '%' . $request->keyword . '%');
                });
            }

            // Lọc theo id_coso
            if ($request->filled('id_coso')) {
                $query->where('id_coso', $request->id_coso);
            }

            // Lọc theo id_chuyenkhoa
            if ($request->filled('id_chuyenkhoa')) {
                $query->where('id_chuyenkhoa', $request->id_chuyenkhoa);
            }

            // Lọc theo giới tính
            if ($request->filled('gioitinh')) {
                $query->where('gioitinh', $request->gioitinh);
            }

            // Lọc theo học hàm
            if ($request->filled('hocham')) {
                $query->where('hocham', $request->hocham);
            }

            // Lọc theo trạng thái
            if ($request->filled('trangthai')) {
                $query->where('trangthai', $request->trangthai);
            }

            $hocHamList = [
                'BS CKI.',
                'BS CKII.',
                'ThS BS.',
                'TS BS.',
                'PGS TS BS.',
                'GS TS BS.'
            ];
            $title = 'Quản lý bác sĩ';
            $lstBS = $query->paginate(10);

            $lstCS = CoSo::all();
            $lstCK = ChuyenKhoa::all();

            return view('admin.bacsi.index', [
                'title' => $title,
                'lstBS' => $lstBS,
                'lstCK' => $lstCK,
                'lstCS' => $lstCS,
                'hocHamList' => $hocHamList
            ]);
        }
    }

    public function updateStatus(Request $request)
    {

        $bs = BacSi::find($request->id);

        if (!$bs) {
            return response()->json(['success' => false, 'message' => 'Bác sĩ không tồn tại!']);
        }

        // Cập nhật trạng thái
        $bs->trangthai = $request->trangthai;
        $bs->save();

        $trangthai = null;
        if ($bs->trangthai == 0)
            $trangthai = 'Nghỉ làm';
        else
            $trangthai = 'Còn làm';
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật trạng thái "' . $trangthai . '" cho Bác Sĩ "'  . $bs->hoten . '" vào CSDL!';
        $ls->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }

    // Hiển thị form thêm bác sĩ
    public function create()
    {
        $title = 'Thêm bác sĩ chuyên khoa';
        $lstCK = ChuyenKhoa::all();

        $lstCS = CoSo::all();
        // Lấy user đang đăng nhập
        $user = Auth::user();

        $hocHamList = [
            'BS CKI.',
            'BS CKII.',
            'ThS BS.',
            'TS BS.',
            'PGS TS BS.',
            'GS TS BS.'
        ];

        if ($user->role === 'hospital') {
            // Nếu là nhân viên cơ sở
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $coso = Coso::find($nhanvien->id_coso);
                return view('admin.bacsi.create', [
                    'title' => $title,
                    'lstCK' => $lstCK,
                    'lstCS' => $lstCS,
                    'hocHamList' => $hocHamList,
                    'cs_nv' => $coso
                ]);
            }
        }
        return view('admin.bacsi.create', ['title' => $title, 'lstCK' => $lstCK, 'lstCS' => $lstCS, 'hocHamList' => $hocHamList]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'hoten' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'diachi' => 'required|string',
            'id_coso' => 'required|exists:coso,id', // Đảm bảo tên bảng đúng
            'id_chuyenkhoa' => 'required|exists:chuyenkhoa,id', // Đảm bảo tên bảng đúng
            'hocham' => 'required|string',
            'hinhanh' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'lich_kham' => 'required|array|min:1', // Ít nhất phải có 1 ngày khám
            'lich_kham.*.ngay' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(date('Y-m-d'))) {
                        $fail('Ngày khám không được ở trong quá khứ.');
                    }
                }
            ],
            'lich_kham.*.buoi' => 'required|in:Sáng,Chiều',
        ], [
            'hoten.required' => 'Vui lòng nhập họ tên bác sĩ.',
            'hoten.max' => 'Tên không được vượt quá 255 ký tự.',
            'gioitinh.required' => 'Vui lòng chọn giới tính.',
            'gioitinh.in' => 'Giới tính không hợp lệ.',
            'diachi.required' => 'Vui lòng nhập địa chỉ.',
            'id_coso.required' => 'Vui lòng chọn cơ sở.',
            'id_coso.exists' => 'Cơ sở không tồn tại.',
            'id_chuyenkhoa.required' => 'Vui lòng chọn chuyên khoa.',
            'id_chuyenkhoa.exists' => 'Chuyên khoa không tồn tại.',
            'hocham.required' => 'Vui lòng nhập học hàm.',
            'hinhanh.image' => 'File tải lên phải là hình ảnh.',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng JPG, PNG, JPEG.',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB.',
            'lich_kham.required' => 'Vui lòng chọn lịch khám.',
            'lich_kham.min' => 'Phải có ít nhất 1 lịch khám.',
            'lich_kham.*.ngay.required' => 'Vui lòng chọn ngày khám.',
            'lich_kham.*.ngay.date' => 'Ngày khám phải là định dạng ngày hợp lệ.',
            'lich_kham.*.buoi.required' => 'Vui lòng chọn buổi khám.',
            'lich_kham.*.buoi.in' => 'Buổi khám phải là Sáng hoặc Chiều.',
        ]);

        if ($request->hasFile('hinhanh')) {
            $file = $request->file('hinhanh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/bacsi'), $fileName);
            $hinhanhPath = 'upload/bacsi/' . $fileName;
        } elseif ($request->gioitinh == 'Nữ') {
            $hinhanhPath = 'upload/bacsi/default-avatar-nu.png'; // Ảnh mặc định
        } else {
            $hinhanhPath = 'upload/bacsi/default-avatar-nam.png';
        }
        $bacSi = BacSi::create([
            'hoten' => $request->hoten,
            'gioitinh' => $request->gioitinh,
            'diachi' => $request->diachi,
            'id_coso' => $request->id_coso,
            'id_chuyenkhoa' => $request->id_chuyenkhoa,
            'hocham' => $request->hocham,
            'hinhanh' => $hinhanhPath, // Đường dẫn lưu trong database
        ]);

        // Thêm lịch khám cho bác sĩ
        foreach ($request->lich_kham as $lich) {
            // Kiểm tra nếu ngày đã ở đúng định dạng Y-m-d thì không cần chuyển đổi
            $ngayKham = Carbon::hasFormat($lich['ngay'], 'Y-m-d')
                ? $lich['ngay']
                : Carbon::createFromFormat('d/m/Y', $lich['ngay'])->format('Y-m-d');


            // Tạo lịch khám
            $lichKham = LichKham::create([
                'id_bacsi' => $bacSi->id,
                'ngaykham' => $ngayKham,
                'buoi' => $lich['buoi']
            ]);

            // Lấy danh sách khung giờ phù hợp với buổi của lịch khám
            $khungGios = DB::table('khunggio')
                ->where('buoi', $lichKham->buoi)
                ->get();

            // Thêm khung giờ mặc định vào lịch khám
            foreach ($khungGios as $khungGio) {
                $soluongtoida = ($khungGio->thoigianbatdau == '15:30') ? 3 : 6;
                LichKhamKhungGio::create([
                    'id_lichkham' => $lichKham->id,
                    'id_khunggio' => $khungGio->id,
                    'soluongtoida' => $soluongtoida,
                    'soluongdadat' => 0
                ]);
            }
        }
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã thêm Bác Sĩ "' . $bacSi->hoten . '" vào CSDL!';
        $ls->save();

        return redirect()->route('bacsi.index')->with('success', 'Thêm bác sĩ và lịch khám thành công!');
    }

    public function edit($id)
    {
        $hocHamList = [
            'BS CKI.',
            'BS CKII.',
            'ThS BS.',
            'TS BS.',
            'PGS TS BS.',
            'GS TS BS.'
        ];
        $lichKham = LichKham::where('id_bacsi', $id)
            ->whereDate('ngaykham', '>=', Carbon::today()) // Chỉ lấy lịch từ hôm nay trở đi
            ->whereDoesntHave('LichKhamKhungGio', function ($query) {
                $query->where('soluongdadat', '>', 0);
            }) // Chỉ lấy lịch chưa có người đặt
            ->orderBy('ngaykham', 'asc')
            ->get();

        $lstCK = ChuyenKhoa::all();
        $bs = BacSi::with('lichKham')->findOrFail($id);
        $lstCS = CoSo::all(); // Lấy danh sách cơ sở
        $title = 'Cập nhật bác sĩ ' . $bs->hoten;
        // Lấy user đang đăng nhập
        $user = Auth::user();
        if ($user->role === 'hospital') {
            // Nếu là nhân viên cơ sở
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {
                $coso = Coso::find($nhanvien->id_coso);
                return view('admin.bacsi.edit', [
                    'hocHamList' => $hocHamList,
                    'lichKham' => $lichKham,
                    'title' => $title,
                    'lstCK' => $lstCK,
                    'bs' => $bs,
                    'lstCS' => $lstCS,
                    'cs_nv' => $coso
                ]);
            }
        }
        return view('admin.bacsi.edit', [
            'hocHamList' => $hocHamList,
            'lichKham' => $lichKham,
            'title' => $title,
            'lstCK' => $lstCK,
            'bs' => $bs,
            'lstCS' => $lstCS
        ]);
    }

    public function update(Request $request, $id)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'hoten' => 'required|string|max:255',
            'gioitinh' => 'required|in:Nam,Nữ',
            'diachi' => 'required|string',
            'id_coso' => 'required|exists:coso,id', // Đảm bảo tên bảng đúng
            'id_chuyenkhoa' => 'required|exists:chuyenkhoa,id', // Đảm bảo tên bảng đúng
            'hocham' => 'required|string',
            'hinhanh' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'lich_kham' => 'nullable|array',
            'lich_kham.*.ngay' => [
                'required',
                'date',
                function ($attribute, $value, $fail) {
                    if (strtotime($value) < strtotime(date('Y-m-d'))) {
                        $fail('Ngày khám không được ở trong quá khứ.');
                    }
                }
            ],
        ], [
            'hoten.required' => 'Vui lòng nhập họ tên bác sĩ.',
            'hoten.max' => 'Tên không được vượt quá 255 ký tự.',
            'gioitinh.required' => 'Vui lòng chọn giới tính.',
            'gioitinh.in' => 'Giới tính không hợp lệ.',
            'diachi.required' => 'Vui lòng nhập địa chỉ.',
            'id_coso.required' => 'Vui lòng chọn cơ sở.',
            'id_coso.exists' => 'Cơ sở không tồn tại.',
            'id_chuyenkhoa.required' => 'Vui lòng chọn chuyên khoa.',
            'id_chuyenkhoa.exists' => 'Chuyên khoa không tồn tại.',
            'hocham.required' => 'Vui lòng nhập học hàm.',
            'hinhanh.image' => 'File tải lên phải là hình ảnh.',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng JPG, PNG, JPEG.',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB.',

            'lich_kham.*.ngay.date' => 'Ngày khám phải là định dạng ngày hợp lệ.',
            'lich_kham.*.buoi.required' => 'Vui lòng chọn buổi khám.',
            'lich_kham.*.buoi.in' => 'Buổi khám phải là Sáng hoặc Chiều.',
        ]);

        $bacsi = BacSi::findOrFail($id);
        $data = $request->except(['lich_kham']);

        if ($request->hasFile('hinhanh')) {
            if ($bacsi->hinhanh && file_exists(public_path($bacsi->hinhanh))) {
                unlink(public_path($bacsi->hinhanh));
            }
            $file = $request->file('hinhanh');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('upload/bacsi'), $fileName);
            $data['hinhanh'] = 'upload/bacsi/' . $fileName;
        }

        $bacsi->update($data);

        if ($request->has('lich_kham')) {
            foreach ($request->lich_kham as $lich) {
                $ngayKham = Carbon::hasFormat($lich['ngay'], 'Y-m-d') ? $lich['ngay']
                    : Carbon::createFromFormat('d/m/Y', $lich['ngay'])->format('Y-m-d');

                // Không cho phép cập nhật lịch khám trong quá khứ
                if (Carbon::parse($ngayKham)->isPast()) {
                    continue;
                }

                // Nếu lịch đã tồn tại, cập nhật thông tin buổi khám
                if (!empty($lich['id_lich'])) {
                    $lichKham = LichKham::find($lich['id_lich']);
                    if ($lichKham) {
                        // Kiểm tra nếu lịch khám đã có đặt trước đó
                        $lichCoDat = LichKhamKhungGio::where('id_lichkham', $lichKham->id)
                            ->where('soluongdadat', '>', 0)
                            ->exists();

                        if ($lichCoDat) {
                            return redirect()->route('bacsi.index')->with('error', 'Lịch khám đã có người đặt, không thể thay đổi ngày.');
                        }
                        $lichKham->update([
                            'ngaykham' => $ngayKham,
                            'buoi' => $lich['buoi'],
                        ]);
                        if ($lich['buoi'] !== $lichKham->buoi) {
                            // Xóa các khung giờ cũ của lịch khám này
                            LichKhamKhungGio::where('id_lichkham', $lichKham->id)->delete();

                            // Lấy danh sách khung giờ mới phù hợp với buổi khám
                            $khungGios = DB::table('khunggio')
                                ->where('buoi', $lichKham->buoi)
                                ->get();

                            foreach ($khungGios as $khungGio) {
                                $soluongtoida = ($khungGio->thoigianbatdau == '15:30') ? 3 : 6;

                                LichKhamKhungGio::create([
                                    'id_lichkham' => $lichKham->id,
                                    'id_khunggio' => $khungGio->id,
                                    'soluongtoida' => $soluongtoida,
                                    'soluongdadat' => 0
                                ]);
                            }
                        }
                    }
                } else {
                    // Nếu không có id thì thêm mới
                    $lichKham = LichKham::create([
                        'id_bacsi' => $id,
                        'ngaykham' => $ngayKham,
                        'buoi' => $lich['buoi'],
                    ]);

                    // Sau khi tạo lịch khám thành công
                    $khungGios = DB::table('khunggio')
                        ->where('buoi', $lichKham->buoi)
                        ->get();

                    foreach ($khungGios as $khungGio) {
                        $soluongtoida = ($khungGio->thoigianbatdau == '15:30') ? 3 : 6;

                        LichKhamKhungGio::create([
                            'id_lichkham' => $lichKham->id,
                            'id_khunggio' => $khungGio->id,
                            'soluongtoida' => $soluongtoida,
                            'soluongdadat' => 0,
                        ]);
                    }
                }
            }
        }

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin của Bác Sĩ "' . $bacsi->hoten . '"!';
        $ls->save();
        return redirect()->route('bacsi.index')->with('success', 'Cập nhật dữ liệu thành công!');
    }

    public function delete($id)
    {
        try {
            // Tìm bác sĩ theo ID
            $bacsi = BacSi::findOrFail($id);
            $hotenbs = $bacsi->hoten;
            // Xóa bác sĩ
            $bacsi->delete();
            // Ghi nhận lịch sử
            $user = Auth::user();
            $ls = new LichSu();
            $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Bác Sĩ "' . $hotenbs . '" khỏi CSDL!';
            $ls->save();

            return redirect()->route('bacsi.index')->with('success', 'Xóa dữ liệu thành công!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Kiểm tra lỗi ràng buộc khóa ngoại
            if ($e->getCode() == 23000) {
                return redirect()->route('bacsi.index')->with('error', 'Không thể xóa bác sĩ vì có dữ liệu liên quan.');
            }
            return redirect()->route('bacsi.index')->with('error', 'Có lỗi xảy ra khi xóa bác sĩ.');
        }
    }

    public function showLichKham($id)
    {
        $title = 'Quản lý bác sĩ';
        $bacsi = BacSi::findOrFail($id);
        $lichKhams = LichKham::where('id_bacsi', $id)->orderBy('ngaykham', 'asc')->get();

        return view('admin.bacsi.lichkham', compact('title', 'bacsi', 'lichKhams'));
    }

    public function export()
    {
        // Lấy user đang đăng nhập
        $user = Auth::user();
        $spreadsheet = new Spreadsheet();

        if ($user->role === 'hospital') {
            $nhanvien = NhanVien::where('id_user', $user->id)->first();

            if ($nhanvien && $nhanvien->id_coso) {

                $sheet = $spreadsheet->getActiveSheet();

                // Lấy danh sách bác sĩ theo id_coso
                $bacSiList = BacSi::where('id_coso', $nhanvien->id_coso)
                    ->with('chuyenKhoa') // load luôn chuyên khoa
                    ->orderBy('id_chuyenkhoa') // sắp xếp theo chuyên khoa
                    ->get();

                // Ghi tiêu đề cột
                $sheet->setCellValue('A1', 'Họ tên bác sĩ');
                $sheet->setCellValue('B1', 'Chuyên khoa');
                $sheet->setCellValue('C1', 'Giới tính');
                $sheet->setCellValue('D1', 'Địa chỉ');
                $sheet->setCellValue('E1', 'Học hàm');
                $sheet->setCellValue('F1', 'Hình ảnh');

                $row = 2;
                $currentChuyenKhoa = null;
                $startRow = 2;

                foreach ($bacSiList as $bacSi) {
                    $tenChuyenKhoa = $bacSi->chuyenKhoa->tenkhoa ?? 'Chưa có chuyên khoa';

                    $sheet->setCellValue('A' . $row, $bacSi->hoten);

                    // Nếu chuyên khoa thay đổi hoặc lần đầu
                    if ($currentChuyenKhoa !== $tenChuyenKhoa) {
                        if ($row > $startRow) {
                            // Gộp ô chuyên khoa từ startRow tới row-1
                            if ($startRow < $row - 1) {
                                $sheet->mergeCells('B' . $startRow . ':B' . ($row - 1));
                            }
                        }
                        // Đặt lại giá trị chuyên khoa
                        $sheet->setCellValue('B' . $row, $tenChuyenKhoa);
                        $currentChuyenKhoa = $tenChuyenKhoa;
                        $startRow = $row;
                    }

                    $sheet->setCellValue('C' . $row, $bacSi->gioitinh ?? '');
                    $sheet->setCellValue('D' . $row, $bacSi->diachi ?? '');
                    $sheet->setCellValue('E' . $row, $bacSi->hocham ?? '');
                    $sheet->setCellValue('F' . $row, $bacSi->hinhanh ?? '');
                    $row++;
                }
                // Gộp nốt chuyên khoa cuối cùng
                if ($startRow < $row - 1) {
                    $sheet->mergeCells('B' . $startRow . ':B' . ($row - 1));
                }

                // Style: căn giữa cột Chuyên khoa
                $sheet->getStyle('B1:B' . ($row - 1))->getAlignment()->setVertical('center')->setHorizontal('center');

                // Tự động căn độ rộng
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Kẻ viền đẹp
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ];
                $sheet->getStyle('A1:F' . ($row - 1))->applyFromArray($styleArray);
            }
        } else {
            $coSoList = CoSo::with(['bacSi.chuyenKhoa'])->get();

            $sheetIndex = 0;

            foreach ($coSoList as $coSo) {
                // Nếu không phải sheet đầu tiên, tạo sheet mới
                if ($sheetIndex > 0) {
                    $spreadsheet->createSheet();
                }

                $spreadsheet->setActiveSheetIndex($sheetIndex);
                $sheet = $spreadsheet->getActiveSheet();
                $sheet->setTitle(substr($coSo->tencoso, 0, 30)); // Giới hạn 30 ký tự để tránh lỗi Excel

                // Ghi tiêu đề cột
                $sheet->setCellValue('A1', 'Họ tên bác sĩ');
                $sheet->setCellValue('B1', 'Chuyên khoa');
                $sheet->setCellValue('C1', 'Giới tính');
                $sheet->setCellValue('D1', 'Địa chỉ');
                $sheet->setCellValue('E1', 'Học hàm');
                $sheet->setCellValue('F1', 'Hình ảnh');

                // Lấy danh sách bác sĩ và sắp xếp theo chuyên khoa
                $bacSiList = $coSo->bacSi->sortBy(function ($bacSi) {
                    return $bacSi->chuyenKhoa->tenkhoa ?? '';
                });

                $row = 2;
                $currentChuyenKhoa = null;
                $startRow = 2;
                foreach ($bacSiList as $bacSi) {
                    $sheet->setCellValue('A' . $row, $bacSi->hoten);

                    $tenChuyenKhoa = $bacSi->chuyenKhoa->tenkhoa ?? 'Chưa có chuyên khoa';
                    // Nếu chuyên khoa thay đổi hoặc lần đầu
                    if ($currentChuyenKhoa !== $tenChuyenKhoa) {
                        if ($row > $startRow) {
                            // Gộp ô chuyên khoa từ startRow tới row-1
                            if ($startRow < $row - 1) {
                                $sheet->mergeCells('B' . $startRow . ':B' . ($row - 1));
                            }
                        }
                        // Đặt lại giá trị chuyên khoa
                        $sheet->setCellValue('B' . $row, $tenChuyenKhoa);
                        $currentChuyenKhoa = $tenChuyenKhoa;
                        $startRow = $row;
                    }

                    $sheet->setCellValue('C' . $row, $bacSi->gioitinh ?? '');
                    $sheet->setCellValue('D' . $row, $bacSi->diachi ?? '');
                    $sheet->setCellValue('E' . $row, $bacSi->hocham ?? '');
                    $sheet->setCellValue('F' . $row, $bacSi->hinhanh ?? '');
                    $row++;
                }

                // Gộp nốt chuyên khoa cuối cùng
                if ($startRow < $row - 1) {
                    $sheet->mergeCells('B' . $startRow . ':B' . ($row - 1));
                }

                // Style: căn giữa cột Chuyên khoa
                $sheet->getStyle('B1:B' . ($row - 1))->getAlignment()->setVertical('center')->setHorizontal('center');

                // Tự động căn độ rộng
                foreach (range('A', 'F') as $col) {
                    $sheet->getColumnDimension($col)->setAutoSize(true);
                }

                // Kẻ viền đẹp
                $styleArray = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['argb' => '00000000'],
                        ],
                    ],
                ];
                $sheet->getStyle('A1:F' . ($row - 1))->applyFromArray($styleArray);

                $sheetIndex++;
            }

            // Set active sheet lại sheet đầu tiên
            $spreadsheet->setActiveSheetIndex(0);
        }
        // Xuất file ra trình duyệt
        $fileName = 'danh_sach_bac_si.xlsx';
        $writer = new Xlsx($spreadsheet);

        // Trả về file Excel
        return response()->streamDownload(function () use ($writer) {
            $writer->save('php://output');
        }, $fileName, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }
}
