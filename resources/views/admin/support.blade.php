@extends('admin.main')

@section('content')
    <div class="container-fluid p-0">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-center mb-3">
                            <div class="col-12 text-center">
                                <h1><strong>Hỗ trợ</strong></h1>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-12">
                                <p class="">
                                    Bạn cần sự hỗ trợ? Bạn chưa rõ về hệ thống website của chúng tôi? Xuất hiện lỗi khi
                                    dùng? Vui
                                    lòng
                                    bạn để lại các thông tin bên dưới để chúng tôi có thể hỗ trợ bạn.
                                </p>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control" id="hoten" placeholder="" name="HoTen">
                                    <label for="hoten">Họ và tên</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="email" class="form-control" id="email" placeholder="" name="Email">
                                    <label for="email">Email</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="" id="noidung" style="height: 100px"></textarea>
                                    <label for="noidung">Nội dung bạn cần hỗ trợ</label>
                                </div>
                            </div>
                        </div>

                        <div class="row justify-content-center mb-3">
                            <div class="col-12">
                                <input class="btn btn-info" type="submit" value="Gửi">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
