@extends('template.master')

@section('title', 'Cấu hình hệ thống')

@section('heading', 'Cấu hình hệ thống')

@section('system', 'active')

@section('content')
    <div class="card card-primary">
        <form role="form" action="{{url('admin/system')}}" method="POST" enctype="multipart/form-data">
            
            <div class="card-body">
                {!! csrf_field() !!}

                <div class="form-group">
                    <label for="exampleInputEmail1">Tên trang tin tức<span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{$name->Description}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Logo<span class="color_red">*</span></label><br/>
                    <img src="{{ asset('images/logo/'.$logo->Description) }}" alt="Logo"/>
                    <input type="file" class="form-control" name="logo" value="">{{$logo->Description}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Favicon<span class="color_red">*</span></label><br/>
                    <img src="{{ asset('images/favicon/'.$favicon->Description) }}" alt="Favicon"/>
                    <input type="file" class="form-control" name="favicon" value="">{{$favicon->Description}}
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email <span class="color_red">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{$email->Description}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Số điện thoại <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="phone" value="{{$phone->Description}}">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" value="{{$address->Description}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </form>
    </div>
@stop
