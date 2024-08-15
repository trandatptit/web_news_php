@extends('layout.index')

@section('content')
    <main id="main" class="d-flex justify-content-center">
        <div class="col-xl-8" style="max-width: 600px">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Thông tin tài khoản</div>
                @if (session('thongbao'))
                    <div class="alert alert-success"> {{ session('thongbao') }} </div>
                @endif
                <div class="card card-primary">
                    <form role="form" action="nguoidung" method="POST">

                        <div class="card-body">
                            {!! csrf_field() !!}

                            <div class="form-group demuc">
                                <label for="exampleInputEmail1"><b>Họ và tên</b><span class="color_red">*</span> </label>

                                <input type="text" class="form-control profile" name="fullname"
                                    value="{{ $nguoidung->fullname }}">

                            </div>
                            <div class="form-group demuc">
                                <label for="exampleInputEmail1"><b>Email</b> <span class="color_red">*</span></label>
                                <input type="email" class="form-control profile" name="email"
                                    value="{{ $nguoidung->email }}" disabled="">
                            </div>
                            <div class="form-group demuc">
                                <label for="exampleInputEmail1"><b>Số điện thoại</b> <span
                                        class="color_red">*</span></label>
                                <input type="text" class="form-control profile" name="phone"
                                    value="{{ $nguoidung->phone }}">
                            </div>
                            <div class="form-group demuc">
                                <label for="exampleInputEmail1"><b>Địa chỉ</b></label>
                                <input type="text" class="form-control profile" name="address"
                                    value="{{ $nguoidung->address }}">
                            </div>
                            <div class="form-group demuc">
                                <label for="exampleInputPassword1"><b>Tài khoản</b> <span class="color_red">*</span></label>
                                <input type="text" class="form-control profile" name="username"
                                    value="{{ $nguoidung->username }}" disabled="">
                            </div>
                            <div class="form-group demuc">
                                <label for="exampleInputPassword1"><b>Mật khẩu</b> <span class="color_red">*</span></label>
                                <input type="password" class="form-control profile" name="password">

                            </div>
                            <p class="ad_note_password">Để trống nếu không đổi mật khẩu!</p>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection
