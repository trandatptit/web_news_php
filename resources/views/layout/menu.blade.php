<section>
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">
        <nav id="navbar" class="navbar">
            <ul class="menu"> 
                @foreach ($Category as $v)
                @if ($v->id > 1 && count($v->posts) > 0)
                    <li><a href="theloai/{{ $v->id }}/{{ $v->slug }}.html"><b>{{ $v->name }}</b></a></li>
                @endif
                @endforeach
            </ul>
        </nav><!-- .navbar -->
    </div>
</section>