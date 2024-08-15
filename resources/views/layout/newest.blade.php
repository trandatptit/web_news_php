<div class="trending">
    <ul class="trending-post">
        @foreach ($Post_newest as $post)
            <li>
                <a href="baiviet/{{ $post->id }}/{{ $post->slug }}.html">
                    <p>
                        <img width="200px" src="{{ asset('images/avatar_post/' . $post->avatar) }}" alt="avatar_post">
                    </p>
                    <h3><span>#{{ $loop->index + 1 }}/</span>{{ $post->title }}</h3>
                    <p>
                        @if (now()->diffInDays($post->created_at) < 2)
                            {{ \Carbon\Carbon::parse($post->created_at)->setTimezone('Asia/Ho_Chi_Minh')->locale('vi')->diffForHumans() }}
                        @else
                            {{ $post->created_at }}
                        @endif
                    </p>
                </a>
            </li>
        @endforeach
    </ul>
</div>
