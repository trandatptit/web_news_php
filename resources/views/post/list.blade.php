@extends('template.master')

@section('title', 'Quản lý bài viết')

@section('heading', 'Danh sách bài viết')

@section('posts', 'active')

@section('all-posts', 'active')

@section('open-posts', 'menu-open')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ url('admin/posts/add') }}" class="btn btn-block btn-primary ad_add" title="Thêm">
                <i class="fa-solid fa-plus"></i>Thêm bài viết mới
            </a>
        </div>
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th class="th_excerpt">Tên bài viết</th>
                        <th class="th_excerpt">Mô tả</th>
                        <th>Danh mục</th>
                        <th>Ngày tạo</th>
                        <th>Trạng thái</th>
                        <th>Lượt xem</th>
                        <th class="text_align_center"><i class="fa-solid fa-wrench"></i></th>
                </thead>
                <tbody>
                    @if (isset($Post) && count($Post) > 0)
                        @foreach ($Post as $k => $v)
                            <tr class="odd">
                                <td class="text_align_center">{{ $k + 1 }}</td>
                                <td class="th_excerpt">
                                    <p>{{ $v->title }}</p>
                                    <img width="100px" src="{{ asset('images/avatar_post/'.$v->avatar) }}" alt="avatar">
                                </td>
                                <td class="th_excerpt">{{ $v->excerpt }}</td>
                                <td>{{$v->category->name }}</td>
                                <td>{{ \Carbon\Carbon::parse($v->created_at)->format('d/m/Y') }}</td>
                                <td>
                                    <div class="badge rounded-pill @if($v->approved === 1)  {{'text-success bg-light-success' }} @else {{'text-danger bg-light-danger' }} @endif p-2 text-uppercase px-3">
                                        <i class='bx bxs-circle me-1'></i>{{ $v->approved  === 1 ? 'Đã phê duyệt' : 'Chưa phê duyệt'  }}
                                    </div>
                                </td>
                                <td>{{ $v->views }}</td>
                                <td class="text_align_center">
                                    <a href="{{ url('admin/posts/edit/' . $v->id) }}" title="chỉnh sửa"
                                        class="ad_button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <a href="{{ url('admin/posts/delete/' . $v->id) }}" title="xóa"
                                        class="ad_button_delete">
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
