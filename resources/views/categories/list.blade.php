@extends('template.master')

@section('title', 'Quản lý danh mục')

@section('heading', 'Danh sách danh mục')

@section('categories', 'active')

@section('all-categories', 'active')

@section('open-categories', 'menu-open')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/categories/add')}}" class="btn btn-block btn-primary ad_add" title="Thêm">
                <i class="fa-solid fa-plus"></i>Thêm danh mục mới
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th>Tên danh mục</th>
                        <th class="text_align_center">Tên không dấu</th>
                        <th class="text_align_center">Số lượng tin</th>
                        <th class="text_align_center"><i class="fa-solid fa-wrench"></i></th>
                </thead>
                <tbody>
                    @if (isset($Category) && count($Category) > 0)
                        @foreach ($Category as $k => $v)
                            <tr class="odd">
                                <td class="text_align_center">{{ $k + 1 }}</td>
                                <td>{{ $v->name }}</td>
                                <td class="text_align_center">{{ $v->slug}}</td>
                                <td class="text_align_center">
                                    {{ count($v->posts) }}
                                </td>
                                
                                <td class="text_align_center">
                                    <a href="{{url('admin/categories/edit/'.$v->id)}}" title="chỉnh sửa" class="ad_button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{url('admin/categories/delete/'.$v->id)}}" title="xóa" class="ad_button_delete">
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
