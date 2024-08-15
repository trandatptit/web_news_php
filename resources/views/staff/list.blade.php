@extends('template.master')

@section('title', 'Quản lý tài khoản')

@section('heading', 'Danh sách tài khoản')

@section('users', 'active')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{url('admin/staff/add')}}" class="btn btn-block btn-primary ad_add" title="Thêm">Thêm</a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th>Họ và tên</th>
                        <th>Cấp bậc</th>
                        <th>Email</th>
                        <th>Số điện thoại</th>
                        <th class="text_align_center"><i class="fa-solid fa-wrench"></i></th>
                </thead>
                <tbody>
                    @if (isset($User) && count($User) > 0)
                        @foreach ($User as $k => $v)
                            <tr class="odd">
                                <td class="text_align_center">{{ $k + 1 }}</td>
                                <td>{{ $v->fullname }}</td>
                                <td>{{ $v->name }}</td>
                                <td>{{ $v->email }}</td>
                                <td>{{ $v->phone }}</td>
                                <td class="text_align_center">
                                    <a href="{{url('admin/staff/edit/'.$v->id)}}" title="chỉnh sửa" class="ad_button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{url('admin/staff/delete/'.$v->id)}}" title="xóa" class="ad_button_delete">
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
