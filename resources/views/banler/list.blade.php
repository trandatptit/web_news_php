@extends('template.master')

@section('title', 'Quản lý banler')

@section('heading', 'Danh sách banler')

@section('banlers', 'active')

@section('all-banlers', 'active')

@section('open-banlers', 'menu-open')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/banlers/add')}}" class="btn btn-block btn-primary ad_add" title="Thêm">
                <i class="fa-solid fa-plus"></i>Thêm banler mới
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th>Tên</th>
                        <th class="text_align_center">Hình ảnh</th>
                        <th class="text_align_center">Nội dung</th>
                        <th style="width: 300px" class="text_align_center">Link</th>
                        <th class="text_align_center"><i class="fa-solid fa-wrench"></i></th>
                </thead>
                <tbody>
                    @if (isset($Banler) && count($Banler) > 0)
                        @foreach ($Banler as $k => $v)
                            <tr class="odd">
                                <td class="text_align_center">{{ $k + 1 }}</td>
                                <td>{{ $v->ten }}</td>
                                <td class="text_align_center">
                                    <img width="300px" src="{{ asset('images/banler/'.$v->hinh) }}" alt="Banler_img">
                                </td>
                                <td>{{ $v->noidung }}</td>
                                <td style="width: 300px" class="text_align_center">{{ $v->link }}</td>
                                <td class="text_align_center">
                                    <a href="{{url('admin/banlers/edit/'.$v->id)}}" title="chỉnh sửa" class="ad_button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{url('admin/banlers/delete/'.$v->id)}}" title="xóa" class="ad_button_delete">
                                        <i class="fa-solid fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop
