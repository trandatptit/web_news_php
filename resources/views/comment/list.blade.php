@extends('template.master')

@section('title', 'Quản bình luận')

@section('heading', 'Danh sách bình luận')

@section('comments', 'active')

@section('content')
    <div class="card">
        {{-- <div class="card-header">
            <a href="{{url('admin/staff/add')}}" class="btn btn-block btn-primary ad_add" title="Thêm">Thêm</a>
        </div> --}}
        <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
                <thead>
                    <tr>
                        <th class="text_align_center">STT</th>
                        <th>Bình luận</th>
                        <th>Tài khoản</th>
                        <th class="th_post-title">Tên bài viết</th>
                        <th class="text_align_center">Xem trong bài viết</th>
                        <th class="text_align_center"><i class="fa-solid fa-wrench"></i></th>
                </thead>
                <tbody>
                    @if (isset($Comment) && count($Comment) > 0)
                        @foreach ($Comment as $k => $v)
                            <tr class="odd">
                                <td class="text_align_center">{{ $k + 1 }}</td>
                                <td>{{ $v->the_comment }}</td>
                                <td>{{ $v->user->username }}</td>
                                <td class="th_post-title">{{ $v->post->title }}</td>
                                <td class="text_align_center">
                                    <a href="{{url('admin/posts/edit/'.$v->post->id)}}" class="text_align_center btn btn-primary" title="bài viết">
                                        Đi đến bài viết
                                    </a>
                                </td>
                                <td class="text_align_center">
                                    <a href="{{url('admin/comments/delete/'.$v->id)}}" title="xóa" class="ad_button_delete">
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
