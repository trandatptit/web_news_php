@extends('layout.index')

@section('content')
    <main id="main">
        <section>
            <div class="container">
                <div class="row">

                    <div class="col-md-9" data-aos="fade-up">
                        <h3 class="category-title">{{ $Category_id->name }}</h3>
                        @foreach ($Post_cate as $post)
                            <div class="d-md-flex post-entry-2 half">
                                <a href="baiviet/{{ $post->id }}/{{ $post->slug }}.html" class="me-4 thumbnail">
                                    <img src="{{ asset('images/avatar_post/' . $post->avatar) }}" alt=""
                                        class="img-fluid">
                                </a>
                                <div>
                                    <div class="post-meta"><span class="date">{{ $Category_id->name }}</span> <span
                                            class="mx-1">&bullet;</span>
                                        <span>
                                            @if (now()->diffInDays($post->created_at) < 2)
                                                {{ \Carbon\Carbon::parse($post->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                            @else
                                                {{ $post->created_at }}
                                            @endif
                                        </span>
                                    </div>
                                    <h3><a
                                            href="baiviet/{{ $post->id }}/{{ $post->slug }}.html">{{ $post->title }}</a>
                                    </h3>
                                    <p>{{ $post->excerpt }}</p>
                                </div>
                            </div>
                        @endforeach

                        <div class="pagination-wrapper">
                            {{ $Post_cate->links() }}
                        </div>
                    </div>

                    <div class="col-md-3">
                        <!-- ======= Sidebar ======= -->
                        <div class="aside-block">

                            <ul class="nav nav-pills custom-tab-nav mb-4" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="pills-popular-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-popular" type="button" role="tab"
                                        aria-controls="pills-popular" aria-selected="true">Nổi bật</button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="pills-latest-tab" data-bs-toggle="pill"
                                        data-bs-target="#pills-latest" type="button" role="tab"
                                        aria-controls="pills-latest" aria-selected="false">Mới nhất</button>
                                </li>
                            </ul>

                            <div class="tab-content" id="pills-tabContent">

                                <!-- Trending -->
                                <div class="tab-pane fade show active" id="pills-popular" role="tabpanel"
                                    aria-labelledby="pills-popular-tab">
                                    <div class="post-entry-1 border-bottom">
                                        @include('layout.trending')
                                    </div>
                                </div>
                                <!-- End Trending -->

                                <!-- Mới nhất -->
                                <div class="tab-pane fade" id="pills-latest" role="tabpanel"
                                    aria-labelledby="pills-latest-tab">
                                    <div class="post-entry-1 border-bottom">
                                        @include('layout.newest')
                                    </div>
                                </div> <!-- End Mới nhất -->

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
    </main>
@endsection
