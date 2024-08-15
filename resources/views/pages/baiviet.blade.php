@extends('layout.index')

@section('content')
    <main id="main">

        <section class="single-post-content">
            <div class="container">
                <div class="row">
                    <div class="col-md-9 post-content" data-aos="fade-up">

                        <!-- ======= Single Post Content ======= -->
                        <div class="single-post">
                            <div class="post-meta"><span class="date">{{ $Post_id->category->name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>
                                    @if (now()->diffInDays($Post_id->created_at) < 2)
                                        {{ \Carbon\Carbon::parse($Post_id->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                    @else
                                        {{ $Post_id->created_at }}
                                    @endif
                                </span>
                            </div>
                            <p>
                                {!! $Post_id->body !!}
                            </p>
                        </div>
                        <!-- End Single Post Content -->

                        <!-- ======= Comments ======= -->
                        <div class="comments">
                            <h5 class="comment-title py-4"><i class="fa-solid fa-comments"></i> {{ count($Post_id->comments) }} Bình luận</h5>

                            @foreach ($Post_id->comments as $cm)
                                <div class="comment d-flex">
                                    <div class="flex-shrink-1 ms-2 ms-sm-3">
                                        <div class="comment-meta d-flex">
                                            <h6 class="me-2"><b>{{ $cm->user->fullname }}</b></h6>
                                            <span class="text-muted">
                                                @if (now()->diffInDays($cm->created_at) < 2)
                                                    {{ \Carbon\Carbon::parse($cm->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                @else
                                                    {{ $cm->created_at }}
                                                @endif
                                            </span>
                                        </div>
                                        <div class="comment-body">
                                            {{ $cm->the_comment }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div><!-- End Comments -->

                        <!-- ======= Comments Form ======= -->
                        @if (isset($nguoidung))
                            <div class="row justify-content-center mt-5">
                                <div class="col-lg-12">
                                    @if (@session('thongbao'))
                                        {{ session('thongbao') }}
                                    @endif
                                    <h5 class="comment-title">Viết bình luận...<i class="fa-solid fa-pen"></i></h5>
                                    <div class="row">
                                        <form action="comment/{{ $Post_id->id }}" method="POST">
                                            {!! csrf_field() !!}
                                            <div class="col-12 mb-3">
                                                <textarea class="form-control" name="the_comment" id="comment-message" placeholder="Nhập tại đây..." cols="20" rows="5"></textarea>
                                            </div>
                                            <div class="col-12">
                                                <input type="submit" class="btn btn-primary" value="Gửi">
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div><!-- End Comments Form -->
                        @else
                            <div class="row justify-content-center mt-5">
                                <div class="col-lg-12">
                                    <h6 style="color: red; font-style: italic;">Đăng nhập để viết bình luận</h6>
                                </div>
                            </div>
                        @endif


                    </div>
                    <div class="col-md-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">

                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-popular" type="button" role="tab"
                                        aria-controls="pills-popular" aria-selected="true">Liên quan</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-trending-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-trending" type="button" role="tab"
                                        aria-controls="pills-trending" aria-selected="false">Nổi bật</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">Mới nhất</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <!-- Lien quan -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                    aria-labelledby="pills-popular-tab">
                                    <div class="post-entry-1 border-bottom">
                                        <div class="trending">
                                            <ul class="trending-post">
                                                <script>
                                                    console.log('tinlienquan', @json($tinlienquan));
                                                </script>
                                                @foreach ($tinlienquan as $post)
                                                    <li>
                                                        <a href="baiviet/{{ $post->id }}/{{ $post->slug }}.html">
                                                            <p>
                                                                <img width="200px"
                                                                    src="{{ asset('images/avatar_post/' . $post->avatar) }}"
                                                                    alt="avatar_post">
                                                            </p>
                                                            <h3><span>#{{ $loop->index + 1 }}/</span>{{ $post->title }}
                                                            </h3>
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div> <!-- End Popular -->

                                <!-- noi bat -->
                                <div class="tab-pane fade" id="pills-trending" role="tabpanel"
                                    aria-labelledby="pills-trending-tab">
                                    <div class="post-entry-1 border-bottom">
                                        @include('layout.trending')
                                    </div>
                                </div> <!-- End noi bat -->

                                <!-- moi nhat -->
                                <div class="tab-pane fade" id="pills-latest" role="tabpanel"
                                    aria-labelledby="pills-latest-tab">
                                    <div class="post-entry-1 border-bottom">
                                        @include('layout.newest')
                                    </div>
                                </div> <!-- End moi nhat -->

                            </div>
                        </div>

                        <div class="aside-block">
                            <h3 class="aside-title">Categories</h3>
                            <ul class="aside-links list-unstyled">
                                @foreach ($Category as $v)
                                    @if ($v->id > 1 && count($v->posts) > 0)
                                        <li><a
                                                href="theloai/{{ $v->id }}/{{ $v->slug }}.html"><b>{{ $v->name }}</b></a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div><!-- End Categories -->

                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->
@endsection
