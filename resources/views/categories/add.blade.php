@extends('template.master')

@section('title', 'Thêm danh mục')

@section('heading', 'Thêm danh mục')

@section('categories', 'active')

@section('add-categories', 'active')

@section('open-categories', 'menu-open')

@section('content')
    <div class="card card-primary">
        <form role="form" action="{{url('admin/categories/add')}}" method="POST">
            
            <div class="card-body">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="exampleInputEmail1">Tên danh mục <span class="color_red">*</span></label>
                    <input type="text" class="form-control" name="name" value="">
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Thêm</button>
            </div>
        </form>
    </div>
@stop
