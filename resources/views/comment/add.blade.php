@extends('template.master')

@section('title', 'Thêm tài khoản')

@section('heading', 'Thêm tài khoản')

@section('users', 'active')

@section('content')
    <div class="card card-primary">
        <form role="form" action="{{url('admin/staff/add')}}" method="POST">
            
            <div class="card-body">
                {!! csrf_field() !!}

                <div class="form-group">
                    <select class="form-control" name="level" id="">
                        @if(@isset($UserLevel) && count($UserLevel) > 0)
                        @foreach ($UserLevel as $k => $v)
                             <option value="{{$v->id}}">Cấp bậc: {{$v->name}}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ và tên <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="fullname" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="color_red">*</span></label>
                    <input type="email" class="form-control" name="email" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="phone" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Tài khoản <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="username" value="" >
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Mật khẩu <span class="color_red">*</span></label>
                    <input type="password" class="form-control" name="password">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
@stop
