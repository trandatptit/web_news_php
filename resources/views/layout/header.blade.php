<!-- ======= Header ======= -->
<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

        <a href="/" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.png" alt=""> -->
            <img src="{{ asset('images/logo/' . $logo->Description) }}" alt="Logo" />
            {{-- <h1>{{ $name->Description }}</h1> --}}
        </a>

        @include('layout.menu')



        <div class="position-relative">
            <a href="#" class="mx-2 js-search-open"><span class="bi-search"></span></a>
            <i class="bi bi-list mobile-nav-toggle"></i>
            <div class="search-form-wrap js-search-form-wrap">
                <form action="timkiem" class="search-form" method="POST">
                    {!! csrf_field() !!}
                    <input type="text" name="tukhoa" id="tukhoa" placeholder="Nhập từ khóa..." class="form-control">
                    <input type="submit"  value="Tìm kiếm">
                    <button type="button" class="btn js-search-close"><span class="bi-x"></span></button>
                </form>
            </div>
            <a class="nav-link dropdown-toggle mx-2" data-bs-toggle="dropdown" href="#" role="button"
                aria-expanded="false">
                <i class="fa-solid fa-user"></i>
                @if (isset($nguoidung))
                    {{ $nguoidung->fullname }}
                @endif
                <span id="user-greeting">

                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" id="dropdown-menu">
                @if (!isset($nguoidung))
                    <div class="dropdown-divider"></div>
                    <a href="/dangnhap" class="dropdown-item">Đăng nhập</a>
                @else
                    @if ($nguoidung->level == 1)
                        <div class="dropdown-item"></div>
                        <a href="admin/home" class="dropdown-item">
                            <i class="fa-solid fa-gauge"></i> Trang quan lý
                        </a>
                        <a href="/nguoidung" class="dropdown-item">
                            <i class="fa-solid fa-user-pen"></i> Thông tin tài khoản
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/dangxuat" class="dropdown-item dropdown-footer">Đăng xuất</a>
                    @else
                        <div class="dropdown-item"></div>
                        <a href="/nguoidung" class="dropdown-item">
                            <i class="fa-solid fa-user-pen"></i> Thông tin tài khoản
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="/dangxuat" class="dropdown-item dropdown-footer">Đăng xuất</a>
                    @endif
                @endif
            </div>


        </div>

    </div>

</header>
<!-- End Header -->
