<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

    <div class="footer-content">
        <div class="container">

            <div class="row g-5">
                <div class="col-lg-4">
                    <h3 class="footer-heading">{{ $name->Description }}</h3>
                    <p>Email: {{ $email->Description }}</p>
                    <p>Số điện thoại: {{ $phone->Description }}</p>
                    <p>Địa chỉ: {{ $address->Description }}</p>

                </div>
                <div class="col-6 col-lg-2">
                    <h3 class="footer-heading">Thể loại</h3>
                    <ul class="footer-links list-unstyled">
                        @foreach ($Category as $v)
                            @if ($v->id > 1 && count($v->posts) > 0)
                            <li><a href="theloai/{{ $v->id }}/{{ $v->slug }}.html"><b>{{ $v->name }}</b></a></li>
                            @endif
                        @endforeach

                    </ul>
                </div>

                <div class="col-lg-4">
                    <h3 class="footer-heading">Bài viết gần đây</h3>

                    <ul class="footer-links footer-blog-entry list-unstyled">
                        @foreach ($Post_newest as $post)
                            <li>
                                <a href="single-post.html">
                                    <div style="display:flex">
                                        <img style="width:100px; margin-right:10px;"  src="{{ asset('images/avatar_post/' . $post->avatar) }}"
                                            alt="avatar_post">
                                        <h5>{{ $post->title }}</h5>
                                    </div>
                                </a>
                            </li>
                        @endforeach

                    </ul>

                </div>
            </div>
        </div>
    </div>



</footer>
