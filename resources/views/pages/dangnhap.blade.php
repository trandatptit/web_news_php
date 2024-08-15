<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập user</title>
    <link rel="stylesheet" href="{{ asset('user') }}/css/dangnhap.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>

    <div class="login-reg-panel">
        <div class="login-info-box">
            <h2>Đã có tài khoản?</h2>
            <p>Đăng nhập tại đây</p>
            <label id="label-register" for="log-reg-show">Đăng nhập</label>
            <input type="radio" name="active-log-panel" id="log-reg-show" checked="checked">
        </div>

        <div class="register-info-box">
            <h2>Chưa có tài khoản?</h2>
            <p>Đăng ký tại đây</p>
            <label id="label-login" for="log-login-show">Đăng ký</label>
            <input type="radio" name="active-log-panel" id="log-login-show">
        </div>

        <div class="white-panel">
            @if (session('notice'))
                <div class="alert alert-danger">
                    {{ session('notice') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session('thongbao'))
                <div class="alert alert-success">
                    {{ session('thongbao') }}
                </div>
            @endif
            <form action="{{ url('dangnhap') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="form_type" value="dangnhap">
                <div class="login-show">
                    <h2>Đăng nhập</h2>
                    <input type="text" name="username" placeholder="Tài khoản">
                    <input type="password" name="password" placeholder="Mật khẩu">
                    <input type="submit" value="Đăng nhập">
                    <a href="/login">Tôi là ADMIN</a>

                </div>
            </form>
            @if (session('notice'))
                <div class="alert alert-danger">
                    {{ session('notice') }}
                </div>
            @endif
            <form action="{{ url('dangnhap') }}" method="POST">
                {!! csrf_field() !!}
                <input type="hidden" name="form_type" value="dangky">
                <div class="register-show">
                    <h2>Đăng ký</h2>
                    <input type="text" name="fullname" placeholder="Họ và tên">
                    <input type="email" name="email" placeholder="Email">
                    <input type="text" name="phone" placeholder="Số điện thoại">
                    <input type="text" name="address" placeholder="Địa chỉ">
                    <input type="text" name="username" placeholder="Tên đăng nhập">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="Đăng ký">

                </div>
            </form>

        </div>
        <script src="{{ asset('user') }}/js/dangnhap.js"></script>
</body>

</html>
