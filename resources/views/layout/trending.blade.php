<div class="trending">
    <?php
    $topFivePosts = collect(); // Khởi tạo một Collection để lưu trữ top 5 bài viết
    
    foreach ($Category as $category) {
        $latestPosts = $category->posts()->orderBy('views', 'desc')->take(4)->get();
        $topFivePosts = $topFivePosts->merge($latestPosts); // Gộp các bài viết vào Collection topFivePosts
    }
    
    // Sắp xếp lại Collection topFivePosts theo số lượt xem giảm dần
    $topFivePosts = $topFivePosts->sortByDesc('views')->take(4);
    ?>
    <ul class="trending-post">
        @foreach ($topFivePosts as $post)
            <li>
                <a href="baiviet/{{ $post->id }}/{{ $post->slug }}.html">
                    
                    <p>
                        <img width="200px" src="{{ asset('images/avatar_post/' . $post->avatar) }}" alt="avatar_post">
                    </p>
                     <h3><span>#{{ $loop->index + 1 }}/</span>{{ $post->title }}</h3>
                    <p>Lượt đọc: {{ $post->views }}</p>
                </a>
            </li>
        @endforeach
    </ul>
</div>
