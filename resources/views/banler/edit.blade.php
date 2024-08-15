@extends('template.master')

@section('title', 'Sửa banler')

@section('banlers', 'active')

@section('content')
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Banler</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ url('admin/banlers/list') }}">
                            <i class="fa-regular fa-circle-left"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Sửa banler</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="card">
        <div class="card-body p-4">
            <form role="form" action="{{ url('admin/banlers/edit/'. $Banler->id) }}" method="POST" enctype="multipart/form-data">

                <div class="form-body mt-4">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="border border-3 p-4 rounded">
                                {!! csrf_field() !!}
                                <div class="mb-3">
                                    <label for="exampleInputEmail1">Tên<span class="color_red">*</span></label>
                                    <input type="text" class="form-control" name="ten" value="{{ $Banler->ten }}">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1">Hình<span class="color_red">*</span></label>
                                    <p>
                                        <img width="300px" src="{{ asset('images/banler/'.$Banler->hinh) }} " alt="Banler_img">
                                    </p>
                                    <input type="file" class="form-control" name="hinh">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1">Nội dung<span class="color_red">*</span></label>
                                    <input type="text" class="form-control" name="noidung" value="{{ $Banler->noidung }}">
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1">Link<span class="color_red">*</span></label>
                                    <input type="text" class="form-control" name="link" value="{{ $Banler->link }}">
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                    <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                </div>
            </form>
        </div>
    </div>
@stop
