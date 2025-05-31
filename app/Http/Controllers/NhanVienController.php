<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LichSu;
use App\Models\User;
use App\Models\CoSo;
use App\Models\NhanVien;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;

class NhanVienController extends Controller
{
    public function index(Request $request)
    {
        $title = 'Quản lý nhân viên';
        $query = User::query()
            ->whereNotIn('role', ['user', 'admin']) // Loại bỏ 'user' và 'admin'
            ->where('id', '!=', Auth::id()); // Loại trừ tài khoản đang đăng nhập

        // Lọc theo email
        if ($request->filled('keyword')) {
            $query->where(function ($q) use ($request) {
            $q->where('email', 'like', '%' .  $request->keyword . '%')
            ->orWhere('name', 'like', '%' .  $request->keyword . '%' );
        });
        }

        // Lọc theo quyền
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        // Lọc theo trạng thái
        if ($request->filled('status')) {
            $query->where('status', $request->status); // giả sử status = 0, 1
        }

        $danhSachTaiKhoan = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('admin.nhanvien.index', compact('title', 'danhSachTaiKhoan'));
    }

    public function shownhanvien($id)
    {
        $nhanVien = NhanVien::with('coso')->where('id_user', $id)->first();

        if (!$nhanVien) {
            return response()->json(['success' => false, 'message' => 'Không tìm thấy nhân viên']);
        }

        return response()->json([
            'success' => true,
            'nhanvien' => $nhanVien,

        ]);
    }

    public function updateStatus(Request $request)
    {

        $user_nv = User::find($request->id);

        if (!$user_nv) {
            return response()->json(['success' => false, 'message' => 'Tài khoản không tồn tại!']);
        }

        // Cập nhật trạng thái
        $user_nv->status = $request->trangthai;
        $user_nv->save();

        $trangThaiMap = [
            0 => 'Đã khóa',
            1 => 'Đã kích hoạt',
        ];

        $trangThaiText = $trangThaiMap[$user_nv->status] ?? 'Không xác định';
        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật trạng thái "'
            . $trangThaiText . '" cho tài khoản "'  . $user_nv->name . ' (' . $user_nv->email . ')" vào CSDL!';
        $ls->save();

        return response()->json(['success' => true, 'message' => 'Cập nhật trạng thái thành công!']);
    }



    public function create()
    {
        $title = 'Thêm thông tin nhân viên';
        $lstCS = CoSo::all();
        return view('admin.nhanvien.create', ['title' => $title, 'lstCS' => $lstCS]);
    }

    public function store(Request $request)
    {
        $rules =
            [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:25',
                    'unique:users',
                    'regex:/^[a-zA-Z0-9]+$/',
                ],
                'email' => 'required|email|unique:users,email',
                'matkhau' => [
                    'required',
                    'string',
                    'min:5',
                    'max:25',
                    'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{5,25}$/',
                ],
                'role' => 'required|in:manage,news,hospital',
                'hoten' => 'required|string|max:255',
                'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
                'diachi' => 'required|string|max:255',
                'gioitinh' => 'required|in:Nam,Nữ',
            ];


        // Nếu là hospital thì bắt buộc chọn id_coso
        if ($request->role === 'hospital') {
            $rules['id_coso'] = 'required|exists:coso,id';
        }
        $messages = [
            'name.required' => 'Vui lòng nhập tên tài khoản!',
            'name.min' => 'Tên tài khoản phải có ít nhất 5 ký tự!',
            'name.max' => 'Tên tài khoản không được vượt quá 25 ký tự!',
            'name.regex' => 'Tên tài khoản chỉ được chứa chữ cái và số!',
            'name.unique' => 'Tên tài khoản đã tồn tại trong hệ thống!',

            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại trong hệ thống!',

            'matkhau.required' => 'Vui lòng nhập mật khẩu!',
            'matkhau.min' => 'Mật khẩu phải có ít nhất 5 ký tự!',
            'matkhau.max' => 'Mật khẩu không được vượt quá 25 ký tự!',
            'matkhau.regex' => 'Mật khẩu phải bao gồm chữ thường, chữ hoa, chữ số và ký tự đặc biệt!',

            'role.required' => 'Vui lòng chọn quyền tài khoản!',
            'role.in' => 'Quyền tài khoản không hợp lệ!',

            'hoten.required' => 'Vui lòng nhập họ tên!',
            'hoten.string' => 'Họ tên không hợp lệ!',
            'hoten.max' => 'Họ tên không được vượt quá 255 ký tự!',

            'sodienthoai.required' => 'Vui lòng nhập số điện thoại!',
            'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng 0 và có 10–11 chữ số!',

            'diachi.required' => 'Vui lòng nhập địa chỉ!',
            'diachi.string' => 'Địa chỉ không hợp lệ!',
            'diachi.max' => 'Địa chỉ không được vượt quá 255 ký tự!',

            'gioitinh.required' => 'Vui lòng chọn giới tính!',
            'gioitinh.in' => 'Giới tính không hợp lệ!',
            'id_coso.required' => 'Vui lòng chọn cơ sở cho tài khoản bệnh viện.',
            'id_coso.exists'   => 'Cơ sở đã chọn không hợp lệ.',
        ];

        $request->validate($rules, $messages);
        $data = $request->all();
        // Tạo tài khoản user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->matkhau),
            'role' => $request->role,
           'status' => $request->trangthai,

        ]);

        $avatarPath = null;
        // Xử lý ảnh tải lên
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $extension = $file->getClientOriginalExtension();

            $fileName = 'nv_' . time() . '.' . $extension;
            $path = 'upload/avatars/nhanvien';
            $file->move($path, $fileName);

            $avatarPath = $path . $fileName;
        }

        $id_coso = null;
        if ($request->role === 'hospital') {
            $id_coso = $request->id_coso;
        }

        // Tạo thông tin nhân viên
        $nhanvien = NhanVien::create([
            'id_user' => $user->id,
            'id_coso' => $id_coso,
            'hoten' => $request->hoten,
            'gioitinh' => $request->gioitinh,
            'sodienthoai' => $request->sodienthoai,
            'diachi' => $request->diachi,
            'avatar' => $avatarPath,
        ]);

        // Ghi nhận lịch sử
        $user_admin = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user_admin->name . ' (' . $user_admin->email . ') đã thêm Nhân Viên "'  . $nhanvien->hoten . '('
            . $user->name . ' - ' . $user->email . ')" vào CSDL!';
        $ls->save();

        return redirect(route('nhanvien.index'))->with('success', 'Thông tin Nhân viên "' . $nhanvien->hoten . '('
            . $user->name . ' - ' . $user->email . '" đã được thêm thành công!');
    }

    public function edit($id)
    {
        // Lấy thông tin nhân viên theo ID
        $nhanvien = NhanVien::with('user')->where('id_user', $id)->firstOrFail();
        $title = 'Cập nhật thông tin nhân viên ' . $nhanvien->hoten;
        $lstCS = CoSo::all();
        // Trả về view edit.blade.php và truyền dữ liệu
        return view('admin.nhanvien.edit', compact('nhanvien', 'title', 'lstCS'));
    }
    public function update(Request $request, $id)
    {
        $rules =
            [
                'name' => [
                    'required',
                    'string',
                    'min:5',
                    'max:25',
                    'unique:users,name,' . $request["id_user"],
                    'regex:/^[a-zA-Z0-9]+$/', // Chỉ cho phép chữ cái và số
                ],
                'email' => 'required|email|unique:users,email,' . $request["id_user"],
                'matkhau' => [
                    'nullable',
                    'string',
                    'min:5',
                    'max:25',
                    'regex:/^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])(?=.*\W)(?!.* ).{5,25}$/',
                ],
                'role' => 'required|in:manage,news,hospital',
                'hoten' => 'required|string|max:255',
                'sodienthoai' => 'required|regex:/^0[0-9]{9,10}$/',
                'diachi' => 'required|string|max:255',
                'gioitinh' => 'required|in:Nam,Nữ',
            ];


        // Nếu là hospital thì bắt buộc chọn id_coso
        if ($request->role === 'hospital') {
            $rules['id_coso'] = 'required|exists:coso,id';
        }
        $messages = [
            'name.required' => 'Vui lòng nhập tên tài khoản!',
            'name.min' => 'Tên tài khoản phải có ít nhất 5 ký tự!',
            'name.max' => 'Tên tài khoản không được vượt quá 25 ký tự!',
            'name.regex' => 'Tên tài khoản chỉ được chứa chữ cái và số!',
            'name.unique' => 'Tên tài khoản đã tồn tại trong hệ thống!',

            'email.required' => 'Vui lòng nhập email!',
            'email.email' => 'Email không đúng định dạng!',
            'email.unique' => 'Email đã tồn tại trong hệ thống!',

            'matkhau.required' => 'Vui lòng nhập mật khẩu!',
            'matkhau.min' => 'Mật khẩu phải có ít nhất 5 ký tự!',
            'matkhau.max' => 'Mật khẩu không được vượt quá 25 ký tự!',
            'matkhau.regex' => 'Mật khẩu phải bao gồm chữ thường, chữ hoa, chữ số và ký tự đặc biệt!',

            'role.required' => 'Vui lòng chọn quyền tài khoản!',
            'role.in' => 'Quyền tài khoản không hợp lệ!',

            'hoten.required' => 'Vui lòng nhập họ tên!',
            'hoten.string' => 'Họ tên không hợp lệ!',
            'hoten.max' => 'Họ tên không được vượt quá 255 ký tự!',

            'sodienthoai.required' => 'Vui lòng nhập số điện thoại!',
            'sodienthoai.regex' => 'Số điện thoại phải bắt đầu bằng 0 và có 10–11 chữ số!',

            'diachi.required' => 'Vui lòng nhập địa chỉ!',
            'diachi.string' => 'Địa chỉ không hợp lệ!',
            'diachi.max' => 'Địa chỉ không được vượt quá 255 ký tự!',

            'gioitinh.required' => 'Vui lòng chọn giới tính!',
            'gioitinh.in' => 'Giới tính không hợp lệ!',
            'id_coso.required' => 'Vui lòng chọn cơ sở cho tài khoản bệnh viện.',
            'id_coso.exists'   => 'Cơ sở đã chọn không hợp lệ.',
        ];
        $request->validate($rules, $messages);

        $id_coso = null;
        if ($request->role === 'hospital') {
            $id_coso = $request->id_coso;
        }

        $data = $request->all();

        $nv = NhanVien::findOrFail($id);
        $nv->id_coso = $id_coso;
        $nv->hoten = $data["hoten"];
        $nv->gioitinh = $data["gioitinh"];
        $nv->sodienthoai = $data["sodienthoai"];
        $nv->diachi = $data["diachi"];

        // Xử lý ảnh tải lên
        if (
            $request->has('Avatar') && $data["Avatar"] != $data["AvatarCu"] &&
            !isset($data["XoaAnh"])
        ) {
            $file = $request->file('Avatar');
            $extension = $file->getClientOriginalExtension();

            $fileName = 'nv_' . time() . '.' . $extension;
            $path = 'imgs/avatars/';
            $file->move($path, $fileName);

            $nv->Avatar = $path . $fileName;

            // Xóa hình cũ (nếu có)
            if ($data["AvatarCu"])
                File::delete($data["AvatarCu"]);
        }

        if (isset($data["XoaAnh"]) && $data["XoaAnh"] == 1 && !is_null($data["AvatarCu"])) {
            File::delete($data["AvatarCu"]);
            $nv->Avatar = null;
        }

        $nv->update();

        // Cập nhật role tài khoản user
        $user_nv = User::findOrFail($nv->id_user);
        $user_nv->name = $data["name"];
        $user_nv->email = $data["email"];
        $user_nv->role = $data["role"];
        $user_nv->status = $data["trangthai"];
        if (!is_null($data["matkhau"]))
            $user_nv->password = Hash::make($data["matkhau"]);
        $user_nv->save();

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã cập nhật thông tin Nhân Viên "'  . $nv->hoten . '('
            . $user_nv->name . ' - ' . $user_nv->email . ')" vào CSDL!';
        $ls->save();

        return redirect(route('nhanvien.index'))->with('success', 'Thông tin Nhân viên "'  . $nv->hoten . '('
            . $user_nv->name . ' - ' . $user_nv->email . '" đã được cập nhật!');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $nhanvien = $user->nhanvien;

        $hotennv = $nhanvien->hoten;
        $name = $user->name;
        $email = $user->email;

        // Kiểm tra: không cho xóa chính mình
        if (Auth::id() == $user->id) {
            return redirect()->back()->with('error', 'Bạn không thể xóa chính tài khoản của mình!');
        }

        // Kiểm tra nếu nhân viên không tồn tại
        if (!$nhanvien) {
            return redirect()->back()->with('error', 'Không tìm thấy thông tin nhân viên liên kết!');
        }

        // Xóa ảnh minh họa (nếu có)
        if (!is_null($nhanvien->avatar))
            File::delete($nhanvien->avatar);

        // Xoá ảnh nếu có
        //if ($nhanvien->avatar && file_exists(public_path($nhanvien->avatar))) {
        // unlink(public_path($nhanvien->avatar));
        //}

        // Xoá dữ liệu
        $nhanvien->delete();    // Xoá trong bảng nhân viên
        $user->delete();        // Xoá trong bảng users

        // Ghi nhận lịch sử
        $user = Auth::user();
        $ls = new LichSu();
        $ls->noidung = 'Người dùng ' . $user->name . ' (' . $user->email . ') đã xóa Nhân Viên "'  . $hotennv . '('
            . $name . ' - ' . $email . ')" khỏi CSDL!';
        $ls->save();

        return redirect()->route('nhanvien.index')->with('success', 'Xóa thành côngNhân viên "'  . $hotennv . '('
            . $name . ' - ' . $email . '" !');
    }
}
