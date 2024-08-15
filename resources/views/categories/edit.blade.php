@extends('template.master')

@section('title', 'Quản lý nhân viên')

@section('heading', 'Chỉnh sửa nhân viên')

@section('categories', 'active')

@section('content')
    <div class="card card-primary">
        <form role="form" action="{{url('admin/categories/edit/'. $Category->id)}}" method="POST">
            
            <div class="card-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục<span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{$Category->name}}">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <a href="{{url('admin/categories/list')}}" class="btn btn-primary">Trở về</a>
                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
            </div>
        </form>
    </div>
@stop
