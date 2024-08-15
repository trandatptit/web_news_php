<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập</title>
    <link rel="stylesheet" href="{{asset('auth')}}/css/login.css">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    
    
    <div class="wrapper fadeInDown">
        <div id="formContent">
          <!-- Tabs Titles -->
      
          <!-- Icon -->
          <div class="fadeIn first">
            <h3>Đăng nhập hệ thống</h3>
          </div>
      
          <!-- Login Form -->
          <form action="{{url('login')}}" method="POST">
            {!! csrf_field() !!}
            <input type="text" id="login" class="fadeIn second" name="username" placeholder="Nhập tài khoản...">
            <input type="password" id="password" class="fadeIn third" name="password" placeholder="Nhập mật khẩu...">
            <input type="submit" class="fadeIn fourth btnSubmit" value="Đăng nhập">
            @if(session('notice'))
                <div class="alert alert-danger">
                    {{session('notice')}}
                </div>
            @endif
          </form>
        </div>
    </div>

  
</body>
</html>

