@extends('layout.index')

@section('title', $name->Description)

@section('content')
    <main id="main">
        <!-- ======= Hero Slider Section ======= -->
        @include('layout.banler')
        <!-- End Hero Slider Section -->

        <!-- ======= Post Grid Section ======= -->
        <section id="posts" class="posts">
            <div class="container" data-aos="fade-up">
                <div class="row g-5">

                    <div class="col-lg-4">
                        <div class="post-entry-1 lg">
                            <a href="baiviet/{{ $Post_VH->id }}/{{ $Post_VH->slug }}.html"><img
                                    src="{{ asset('images/avatar_post/' . $Post_VH->avatar) }}" class="img-fluid"></a>
                            <div class="post-meta"><span class="date">{{ $Post_VH->category->name }}</span> <span
                                    class="mx-1">&bullet;</span>
                                <span>
                                    @if (now()->diffInDays($Post_VH->created_at) < 2)
                                        {{ \Carbon\Carbon::parse($Post_VH->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                    @else
                                        {{ $Post_VH->created_at }}
                                    @endif
                                </span>
                            </div>
                            <h2><a href="baiviet/{{ $Post_VH->id }}/{{ $Post_VH->slug }}.html">{{ $Post_VH->title }}</a>
                            </h2>
                            <p class="mb-4 d-block">{{ $Post_VH->excerpt }}</p>
                        </div>

                    </div>

                    <div class="col-lg-8">
                        <div class="row g-5">
                            @php
                                // Tính toán chỉ số để chia mảng thành hai phần
                                $halfIndex = ceil(count($Category) / 2);

                                // Chia mảng thành hai nửa
                                $firstHalf = $Category->take($halfIndex);
                                $secondHalf = $Category->slice($halfIndex);
                            @endphp

                            <div class="col-lg-4 border-start custom-border">

                                @foreach ($firstHalf as $category)
                                    <?php
                                    $latestPost = $category->posts()->latest()->first();
                                    ?>
                                    @if (count($category->posts) > 0 && $category->id != 17)
                                        <div class="post-entry-1">
                                            <a href="baiviet/{{ $latestPost->id }}/{{ $latestPost->slug }}.html"><img
                                                    src="{{ asset('images/avatar_post/' . $latestPost->avatar) }}"
                                                    alt="" class="img-fluid"></a>
                                            <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                    class="mx-1">&bullet;</span>
                                                <span>
                                                    @if (now()->diffInDays($latestPost->created_at) < 2)
                                                        {{ \Carbon\Carbon::parse($latestPost->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                    @else
                                                        {{ $latestPost->created_at }}
                                                    @endif
                                                </span>
                                            </div>
                                            <h2><a
                                                    href="baiviet/{{ $latestPost->id }}/{{ $latestPost->slug }}.html">{{ $latestPost->title }}</a>
                                            </h2>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <div class="col-lg-4 border-start custom-border">

                                @foreach ($secondHalf as $category)
                                    <?php
                                    $latestPost = $category->posts()->latest()->first();
                                    ?>
                                    @if (count($category->posts) > 0 && $category->id != 17)
                                        <div class="post-entry-1">
                                            <a href="baiviet/{{ $latestPost->id }}/{{ $latestPost->slug }}.html"><img
                                                    src="{{ asset('images/avatar_post/' . $latestPost->avatar) }}"
                                                    alt="" class="img-fluid"></a>
                                            <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                    class="mx-1">&bullet;</span>
                                                <span>
                                                    @if (now()->diffInDays($latestPost->created_at) < 2)
                                                        {{ \Carbon\Carbon::parse($latestPost->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                    @else
                                                        {{ $latestPost->created_at }}
                                                    @endif
                                                </span>
                                            </div>
                                            <h2><a
                                                    href="baiviet/{{ $latestPost->id }}/{{ $latestPost->slug }}.html">{{ $latestPost->title }}</a>
                                            </h2>
                                        </div>
                                    @endif
                                @endforeach
                            </div>

                            <!-- Trending Section -->
                            <div class="col-lg-4 trending">
                                <h3>Nổi bật</h3>
                                @include('layout.trending')
                            </div>
                            <!-- End Trending Section -->
                        </div>
                    </div>

                </div> <!-- End .row -->
            </div>
        </section> <!-- End Post Grid Section -->

        <!-- ======= Culture Category Section ======= -->
        @foreach ($Category as $k => $category)
            @if (count($category->posts) > 2)
                <section class="category-section">

                    <div class="container" data-aos="fade-up">
                        <?php
                        $data = $category->posts()->latest()->take(3)->get();
                        $tin1 = $data->shift();
                        $tin2 = $data->shift();
                        $tin3 = $data->shift();
                        $tinconlai = $category
                            ->posts()
                            ->latest() // Sắp xếp giảm dần theo created_at
                            ->skip(3) // Bỏ qua 3 bài viết đầu tiên
                            ->take(PHP_INT_MAX) // Lấy tất cả các bài viết còn lại
                            ->get();
                        ?>

                        <script>
                            console.log('data', @json($data));
                            console.log('tin1', @json($tin1));
                            console.log('tin2', @json($tin2));
                            console.log('tin3', @json($tin3));
                        </script>
                        <div class="section-header d-flex justify-content-between align-items-center mb-5">
                            <h2>{{ $category->name }}</h2>
                            <div><a href="theloai/{{ $category->id }}/{{ $category->slug }}.html" class="more">See All
                                    {{ $category->name }}</a></div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">

                                <div class="d-lg-flex post-entry-2">
                                    <a href="baiviet/{{ $tin1->id }}/{{ $tin1->slug }}.html"
                                        class="me-4 thumbnail mb-4 mb-lg-0 d-inline-block">
                                        <img width="100%" src="{{ asset('images/avatar_post/' . $tin1->avatar) }}"
                                            alt="" class="img-fluid">
                                    </a>
                                    <div>
                                        <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                class="mx-1">&bullet;</span>
                                            <span>
                                                @if (now()->diffInDays($tin1->created_at) < 2)
                                                    {{ \Carbon\Carbon::parse($tin1->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                @else
                                                    {{ $tin1->created_at }}
                                                @endif
                                            </span>
                                        </div>
                                        <h3><a
                                                href="baiviet/{{ $tin1->id }}/{{ $tin1->slug }}.html">{{ $tin1->title }}</a>
                                        </h3>
                                        <p>{{ $tin1->excerpt }}</p>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="post-entry-1 border-bottom">
                                            <a href="baiviet/{{ $tin2->id }}/{{ $tin2->slug }}.html">
                                                <img width="100%"
                                                    src="{{ asset('images/avatar_post/' . $tin2->avatar) }}" alt=""
                                                    class="img-fluid"></a>
                                            <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                    class="mx-1">&bullet;</span>
                                                <span>
                                                    @if (now()->diffInDays($tin2->created_at) < 2)
                                                        {{ \Carbon\Carbon::parse($tin2->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                    @else
                                                        {{ $tin2->created_at }}
                                                    @endif
                                                </span>
                                            </div>
                                            <h2 class="mb-2"><a
                                                    href="baiviet/{{ $tin2->id }}/{{ $tin2->slug }}.html">{{ $tin2->title }}</a>
                                            </h2>
                                            <p class="mb-4 d-block">{{ $tin2->excerpt }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="post-entry-1">
                                            <a href="baiviet/{{ $tin3->id }}/{{ $tin3->slug }}.html">
                                                <img width="100%"
                                                    src="{{ asset('images/avatar_post/' . $tin3->avatar) }}" alt=""
                                                    class="img-fluid"></a>
                                            <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                    class="mx-1">&bullet;</span>
                                                <span>
                                                    @if (now()->diffInDays($tin3->created_at) < 2)
                                                        {{ \Carbon\Carbon::parse($tin3->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                    @else
                                                        {{ $tin3->created_at }}
                                                    @endif
                                                </span>
                                            </div>
                                            <h2 class="mb-2"><a
                                                    href="baiviet/{{ $tin3->id }}/{{ $tin3->slug }}.html">{{ $tin3->title }}</a>
                                            </h2>
                                            <p class="mb-4 d-block">{{ $tin3->excerpt }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3">
                                @foreach ($tinconlai as $post)
                                    <div class="post-entry-1 border-bottom">
                                        <div class="post-meta"><span class="date">{{ $category->name }}</span> <span
                                                class="mx-1">&bullet;</span>
                                            <span>
                                                @if (now()->diffInDays($post->created_at) < 2)
                                                        {{ \Carbon\Carbon::parse($post->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                                                    @else
                                                        {{ $post->created_at }}
                                                    @endif
                                            </span>
                                        </div>
                                        <h2 class="mb-2"><a
                                                href="baiviet/{{ $post->id }}/{{ $post->slug }}.html">{{ $post->title }}</a>
                                        </h2>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>
            @endif
        @endforeach
        <!-- End Culture Category Section -->
    </main><!-- End #main -->
@endsection
