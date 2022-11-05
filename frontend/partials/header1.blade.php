    <div class="menu_fix_mobile">
        <div class="close-menu">
            <p>Danh mục Menu</p>
            <a href="javascript:;" id="close-menu-button">
                <i class="fa fa-times" aria-hidden="true"></i>
            </a>
        </div>
        <ul class="nav-main">
            <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
                <a href="{{makeLink('home')}}"><span>Trang chủ</span></a>
            </li>
            {{-- 
            @if(isset($header['menuNew3']))
                @foreach ($header['menuNew3'] as $value)
                    <li class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }}">
            <a href="{{ $value['slug_full'] }}"><span>{!! $value['name'] !!}</span>
                @isset($value['childs'])
                <i class="fa fa-angle-down"></i>
                @endisset
            </a>
            </li>
            @endforeach
            @endif --}}

            @include('frontend.components.menu',[
            'limit'=>3,
            'icon_d'=>'<i class="fa fa-angle-down mn-icon"></i>',
            'icon_r'=>'<i class="fa fa-angle-down mn-icon"></i>',
            'data'=>$header['menu_mobile'],
            'active'=>false
            ])

            {{-- @include('frontend.components.menu',[
            'limit'=>3,
            'icon_d'=>'<i class="fa fa-angle-down mn-icon"></i>',
            'icon_r'=>'<i class="fa fa-angle-down mn-icon"></i>',
            'data'=>$header['menu-mega'],
            'active'=>false
        ]) --}}

        </ul>
        @if (isset($header['socialParent']) && $header['socialParent'])
        <div class="social-menu-mb">
            <div class="title">
                {{ $header['socialParent']->name }}
            </div>
            <div class="social-menu-main">
                <ul class="social">
                    @foreach ($header['socialParent']->childs()->where('active',1)->orderby('order')->latest()->get() as
                    $item)
                    <li><a href="{{ $item->slug }}"><img src="{{ $item->image_path }}" alt="{{ $item->name }}"></a></li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif
    </div>

    <div class="header2">
        <div class="header-top">
            <div class="container">
                <div class="box-header-top">
                    <nav class="top-nav top-nav-left">
                        <ul>
                            <li><a class="smooth">
                                    <img src="/frontend/images/icon-store.png" style="vertical-align: text-bottom">
                                    {{ $header['tai_sao']->value }}</a>
                            </li>
                            <li class="mobile_mb"><a class="smooth" href="/danh-muc-tin-tuc/he-thong-cua-hang"
                                    fixed-sn="" title="">
                                    <img src="/frontend/images/icon-store.png" style="vertical-align: text-bottom">
                                    Hệ thống cửa hàng</a>
                            </li>
                        </ul>
                    </nav>
                    <nav class="top-nav">
                        <ul>
                            <li><a class="smooth" href="/danh-muc-tin-tuc/gioi-thieu">Về chúng tôi</a>
                                {{--<div class="sub_page">
                                    <ul>
                                        <li><a href="#">#</a></li>
                                    </ul>
                                </div>--}}
                            </li>
                            <li><a class="smooth" href="/danh-muc-tin-tuc/phuong-thuc-thanh-toan" title="">Phương thức
                                    thanh toán</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <div class="header_home">
            <div class="container">
                <div class="row">
                    <div class="list-bar">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                    <div class="col-lg-7 col-auto col-log-mobi pl-0">
                        <div class="logo-head">
                            <div class="image">
                                <a href="{{ makeLink('home') }}"><img src="{{ $header['logo']->image_path }}"
                                        alt="Logo"></a>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-5 d-none d-lg-block">
                        <div class="header-top-right">
							<ul>
								<form action="{{ makeLink('search') }}" method="GET" class="cart_header">
                    <li>
                        <input type="text" name="keyword" class="header-top-search"
                            placeholder="Tìm kiếm trên Min's Kitchen">
                        <div class="search_mobile" type="submit"><a>Tìm kiếm</a></div>
                    </li>
                    </form>
                    </ul>
                </div>
            </div> --}}
            <div class="col-auto col-lg-5">
                <div class="row align-items-center">
                    <div class="col-lg-8 contact-top text-center position-relative d-none d-lg-block">
                        <div class="phone">
                            <a href="tel:{{ $header['tai_sao1']->slug }}">{{ $header['tai_sao1']->slug }}</a>
                            <span>{{ $header['tai_sao1']->value }}</span>
                            <a href="tel:{{ $header['tai_sao1']->slug }}" class="icon-phone"><i
                                    class="fas fa-phone-alt"></i></a>
                        </div>
                    </div>
                    <div class="col-12 col-lg-4 col-auto cart d-flex justify-content-end pr-1">
                        <div class="d-flex justify-content-between top-account-wrap">
                            <div class="h-cart dropdown show" id="li_desktop_cart">
                                <a class="smooth d-flex" href="{{ route('cart.list') }}">
                                    <img src="/frontend/images/cart.png" alt="cart" title="cart">
                                    <span>Giỏ hàng</span>
                                    <strong class="cart-badge-number"
                                        id="desktop-quick-cart-badge">{{ $header['totalQuantity'] }}</strong>
                                    <label class="d-block d-lg-none cart-badge-number"
                                        id="desktop-quick-cart-mobi">{{ $header['totalQuantity'] }}</label>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    <div id="header" class="header">
        <div class="container">
            <div class="row">
                <div class="box-header-main">
                    <div class="box_padding">
                        <div class="menu menu-desktop">
                            <ul class="nav-main">
                                <li class="nav-item active_menu" style="background: #fbb03b">
                                    <a href="{{ makeLink('home') }}"><span><i class="fas fa-home"></i></span></a>
                                </li>
                                {{-- @include('frontend.components.menu-2',[
										'limit'=>3,//list ra 3 cap con
										'icon_d'=>'<i class="fa fa-angle-down"></i>',
										'icon_r'=>"<i class='fa fa-angle-right'></i>",
										'data'=>$header['menuM'],
										'active'=>false
									]) --}}

                                {{-- {{dd($header)}} --}}

                                {{-- <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
                                <a href="{{makeLink('home')}}"><span>Trang chủ</span></a>
                                </li>
                                <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
                                    <a href="{{makeLink('home')}}"><span>Hàng mới</span></a>
                                </li>
                                <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
                                    <a href="{{makeLink('home')}}"><span>Bán chạy</span></a>
                                </li> --}}

                                {{-- @if(isset($header['menuNew3']))
										@foreach ($header['menuNew3'] as $value)
											<li class="nav-item {{ Request::url() == url($value['slug_full']) ? 'active_menu' : '' }}">
                                <a href="{{ $value['slug_full'] }}"><span>{!! $value['name'] !!}</span>
                                    @isset($value['childs'])
                                    <i class="fa fa-angle-down"></i>
                                    @endisset
                                </a>
                                @isset($value['childs'])
                                @if (count($value['childs'])>0)
                                <ul class="nav-sub">
                                    @foreach ($value['childs'] as $childValue)
                                    <li class="nav-sub-item">
                                        <a href="{{ $childValue['slug_full'] }}"><span>{{ $childValue['name'] }}</span>
                                        </a>
                                    </li>
                                    @endforeach
                                </ul>
                                @endif
                                @endisset
                                </li>
                                @endforeach
                                @endif --}}

                                {{-- <li class="nav-item {{ Request::url() == url('/') ? 'active_menu' : '' }}">
                                <a href="{{makeLink('home')}}"><span>Bộ sưu tập</span></a>
                                </li> --}}
                                @include('frontend.components.menu',[
                                'limit'=>3,
                                'icon_d'=>'<i class="fa fa-angle-down"></i>',
                                'icon_r'=>"<i class='fa fa-angle-right'></i>",
                                'data'=>$header['menu_mobile'],
                                'active'=>false
                                ])

                                {{-- @include('frontend.components.menu',[
										'limit'=>3,
										'icon_d'=>'<i class="fa fa-angle-down"></i>',
										'icon_r'=>"<i class='fa fa-angle-right'></i>",
										'data'=>$header['menuNew2'],
										'active'=>false
									]) --}}
                            </ul>
                        </div>
                        {{--
							<div class="box-header-main-right box-header-main-right-mobile">
								<ul>
									<div class="search_mobile" type="submit"><a><i class="fas fa-search"></i></a></div>
								</ul>
							</div>
							<div class="search_mobile"><a><i class="fas fa-search"></i></a></div>
							--}}
                        <div class="search" id="search">
                            <div class="form-s-mobile">
                                <form action="{{ makeLink('search') }}" method="GET">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="keyword" placeholder="Từ khóa">
                                        <div class="input-group-append">
                                            <button class="input-group-text" type="submit"><i
                                                    class="fas fa-search"></i></button>
                                        </div>
                                    </div>
                                </form>
                                <span class="close-search"><i class="fas fa-times"></i></span>
                            </div>
                        </div>
                        @php
                        $listCategoryId = \App\Models\CategoryProduct::getALlCategoryChildrenAndSelf(185);
                        // dd($listCategoryId);
                        $categoryProducts = \App\Models\CategoryProduct::whereIn('id' , $listCategoryId)->where([
                        ["id", "<>", 185],
                            ])->get();
                            // dd($data);
                            @endphp

                    </div>
                </div>
                <div class="col-lg-12 search_mb1">
                    <div class="header-top-right">
                        <ul>
                            <form action="{{ makeLink('search') }}" method="GET" class="cart_header">
                                <li>
                                    <input type="text" name="keyword" class="header-top-search"
                                        placeholder="Tìm kiếm trên Min's Kitchen">
                                    <div class="search_mobile" type="submit"><a>Tìm kiếm</a></div>
                                </li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="header3" class="header3">
        <div class="container">
            <div class="row">
                <div class="box-header-main">
                    <div class="box_padding">
                        <div class="menu menu-desktop">
                            <ul class="nav-main">
                                <li class="nav-item active_menu" style="background: #fbb03b">
                                    <a href="https://cus05.largevendor.com"><span><i class="fas fa-home"></i></span></a>
                                </li>
                                <li class="nav-item   ">
                                    <a href="https://cus05.largevendor.com/danh-muc/hang-nhap-khau"><span> Hàng nhập
                                            khẩu</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="menu-dropdown">
                                        <div class="row no-gutters">
                                            <div class="col-3">
                                                <ul class="sub-nav-left p-b-16">
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                </picture>
                                                            </div>
                                                            <div class="sub-nav-name fs-p-14">
                                                                <span>Sinh
                                                                    lý - Nội tiết tố
                                                                </span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </div>
                                                        </a>
                                                        {{--
                                                        <ul class="nav-sub-c2">
                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nam</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nữ</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Hỗ
                                                                        trợ mãn kinh</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Cân
                                                                        bằng nội tiết tố</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sức
                                                                        khỏe tình dục</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                        --}}
                                                    </li>
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                </picture>
                                                            </div>
                                                            <div class="sub-nav-name fs-p-14">
                                                                <span>Sinh
                                                                    lý - Nội tiết tố
                                                                </span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </div>
                                                        </a>
                                                        {{--
                                                        <ul class="nav-sub-c2">
                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nam</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nữ</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Hỗ
                                                                        trợ mãn kinh</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Cân
                                                                        bằng nội tiết tố</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sức
                                                                        khỏe tình dục</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                        --}}
                                                    </li>
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                </picture>
                                                            </div>
                                                            <div class="sub-nav-name fs-p-14">
                                                                <span>Sinh
                                                                    lý - Nội tiết tố
                                                                </span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </div>
                                                        </a>
                                                        {{--
                                                        <ul class="nav-sub-c2">
                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nam</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nữ</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Hỗ
                                                                        trợ mãn kinh</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Cân
                                                                        bằng nội tiết tố</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sức
                                                                        khỏe tình dục</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                        --}}
                                                    </li>
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                </picture>
                                                            </div>
                                                            <div class="sub-nav-name fs-p-14">
                                                                <span>Sinh
                                                                    lý - Nội tiết tố
                                                                </span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </div>
                                                        </a>
                                                        {{--
                                                        <ul class="nav-sub-c2">
                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nam</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nữ</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Hỗ
                                                                        trợ mãn kinh</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Cân
                                                                        bằng nội tiết tố</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sức
                                                                        khỏe tình dục</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                        --}}
                                                    </li>
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                </picture>
                                                            </div>
                                                            <div class="sub-nav-name fs-p-14">
                                                                <span>Sinh
                                                                    lý - Nội tiết tố
                                                                </span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </div>
                                                        </a>
                                                        {{--
                                                        <ul class="nav-sub-c2">
                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nam</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sinh
                                                                        lý nữ</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Hỗ
                                                                        trợ mãn kinh</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Cân
                                                                        bằng nội tiết tố</span>
                                                                </a>
                                                            </li>


                                                            <li class="">
                                                                <a href=""><span>Sức
                                                                        khỏe tình dục</span>
                                                                </a>
                                                            </li>


                                                        </ul>
                                                        --}}
                                                    </li>

                                                </ul>
                                            </div>
                                            <div class="col-9" style="background-color: #edf2f8">
                                                <div class="nav-sub-right">
                                                    <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                        <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                <a href=""
                                                                    class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                        <picture>
                                                                            <img alt="Huyết áp" srcset="" class="loaded"
                                                                                src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                        </picture>
                                                                    </div>
                                                                    <div class="sub-nav-cate-name">
                                                                        <span>Huyết áp</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                <a href=""
                                                                    class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                        <picture>
                                                                            <img alt="Huyết áp" srcset="" class="loaded"
                                                                                src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                        </picture>
                                                                    </div>
                                                                    <div class="sub-nav-cate-name">
                                                                        <span>Huyết áp</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                <a href=""
                                                                    class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                        <picture>
                                                                            <img alt="Huyết áp" srcset="" class="loaded"
                                                                                src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                        </picture>
                                                                    </div>
                                                                    <div class="sub-nav-cate-name">
                                                                        <span>Huyết áp</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                <a href=""
                                                                    class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                        <picture>
                                                                            <img alt="Huyết áp" srcset="" class="loaded"
                                                                                src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                        </picture>
                                                                    </div>
                                                                    <div class="sub-nav-cate-name">
                                                                        <span>Huyết áp</span>
                                                                    </div>
                                                                </a>
                                                            </div>
                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                <a href=""
                                                                    class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                        <picture>
                                                                            <img alt="Huyết áp" srcset="" class="loaded"
                                                                                src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                                                        </picture>
                                                                    </div>
                                                                    <div class="sub-nav-cate-name">
                                                                        <span>Huyết áp</span>
                                                                    </div>
                                                                </a>
                                                            </div>

                                                        </div>
                                                    </div>
                                                    <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                        <div class="sub-nav-title m-b-12">
                                                            <div class="u-flex justify-between align-items-center">
                                                                <div
                                                                    class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                    <i class="fab fa-gripfire"></i>
                                                                    Bán chạy nhất
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="sub-nav-product-list">
                                                            <div class="row row-cols-5">
                                                                <div class="col p-x-8">
                                                                    <div class="sub-nav-product-item">
                                                                        <a href="">
                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                <picture>
                                                                                    <img alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)"
                                                                                        class="loaded"
                                                                                        src="{{asset('frontend/images/product-test.webp')}}">
                                                                                </picture>
                                                                            </div>
                                                                            <div class="sub-nav-product-info">
                                                                                <div
                                                                                    class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                    Viên Uống Sâm Nhung Bổ Thận Nv
                                                                                    Dolexphar Giúp Tráng Dương, Mạnh Gân
                                                                                    Cốt (30 Viên)
                                                                                </div>
                                                                                <div
                                                                                    class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                                    <span
                                                                                        class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                                    / Hộp
                                                                                </div>
                                                                            </div>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </li>


                                {{--
                                <li class="nav-item   ">
                                    <a href="https://cus05.largevendor.com/danh-muc/hang-nhap-khau"><span> Hàng nhập
                                            khẩu</span>
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <div class="menu-dropdown">
                                        <div class="row no-gutters">
                                            <div class="col-3">
                                                <ul class="sub-nav-left p-b-16">
                                                    <li class="">
                                                        <a href="">
                                                            <div class="sub-nav-picture m-r-8">
                                                                <picture>
                                                                    <img alt="Sinh lý - Nội tiết tố" srcset=""
                                                                        class="loaded"
                                                                        src="{{asset('frontend/images/icon-test-menu.webp')}}">
                                </picture>
                        </div>
                        <div class="sub-nav-name fs-p-14">
                            <span>Sinh
                                lý - Nội tiết tố
                            </span>
                            <i class="fa fa-angle-right"></i>
                        </div>
                        </a>

                        <ul class="nav-sub-c2">
                            <li class="">
                                <a href=""><span>Sinh
                                        lý nam</span>
                                </a>
                            </li>


                            <li class="">
                                <a href=""><span>Sinh
                                        lý nữ</span>
                                </a>
                            </li>


                            <li class="">
                                <a href=""><span>Hỗ
                                        trợ mãn kinh</span>
                                </a>
                            </li>


                            <li class="">
                                <a href=""><span>Cân
                                        bằng nội tiết tố</span>
                                </a>
                            </li>


                            <li class="">
                                <a href=""><span>Sức
                                        khỏe tình dục</span>
                                </a>
                            </li>


                        </ul>

                        </li>
                        <li class="">
                            <a href=""><span>Sức
                                    khỏe tim mạch</span>
                                <i class="fa fa-angle-right"></i>
                            </a>

                            <ul class="nav-sub-c2">
                                <li class="">
                                    <a href=""><span>Huyết
                                            áp</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Cholesterol</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Suy
                                            giãn tĩnh mạch</span>
                                    </a>
                                </li>


                            </ul>

                        </li>
                        <li class="">
                            <a href=""><span>Hỗ
                                    trợ tiêu hóa</span>
                                <i class="fa fa-angle-right"></i>
                            </a>

                            <ul class="nav-sub-c2">
                                <li class="">
                                    <a href=""><span>Dạ
                                            dày, tá tràng</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Nhuận
                                            tràng</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Khó
                                            tiêu</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Táo
                                            bón</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Đại
                                            tràng</span>
                                    </a>
                                </li>


                            </ul>

                        </li>
                        <li class="">
                            <a href=""><span>Thần
                                    kinh não</span>
                                <i class="fa fa-angle-right"></i>
                            </a>

                            <ul class="nav-sub-c2">
                                <li class="">
                                    <a href=""><span>Bổ
                                            não - cải thiện trí nhớ</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Kiểm
                                            soát căng thẳng</span>
                                    </a>
                                </li>


                                <li class="">
                                    <a href=""><span>Hỗ
                                            trợ giấc ngủ ngon</span>
                                    </a>
                                </li>


                            </ul>

                        </li>

                        </ul>
                    </div>
                </div>
            </div>

            </li>
            --}}

            </ul>
        </div>

        <div class="search" id="search">
            <div class="form-s-mobile">
                <form action="https://cus05.largevendor.com/search" method="GET">
                    <div class="input-group">
                        <input type="text" class="form-control" name="keyword" placeholder="Từ khóa">
                        <div class="input-group-append">
                            <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                </form>
                <span class="close-search"><i class="fas fa-times"></i></span>
            </div>
        </div>

    </div>
    </div>
    <div class="col-lg-12 search_mb1">
        <div class="header-top-right">
            <ul>
                <form action="https://cus05.largevendor.com/search" method="GET" class="cart_header">
                    <li>
                        <input type="text" name="keyword" class="header-top-search"
                            placeholder="Tìm kiếm trên Min's Kitchen">
                        <div class="search_mobile" type="submit"><a>Tìm kiếm</a></div>
                    </li>
                </form>
            </ul>
        </div>
    </div>
    </div>
    </div>
    </div>
    {{--<div id="search">
            <div class="wrap-search-header-main  search-mobile" >
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="box-search-header-main">
                                <div class="search-header">
                                    <form id="formSearchMb" name="formSearchMb" method="GET" action="{{ makeLink('search') }}">
    <div class="input-group">
        <input type="text" class="form-control" name="keyword" placeholder="Nhập từ khóa tìm kiếm...">
        <div class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fas fa-search"></i></button>
        </div>
    </div>
    </form>
    </div>

    </div>
    </div>
    </div>
    </div>
    <button class="form-control close-search" type="button"><i class="fa fa-times" aria-hidden="true"></i></button>
    </div>
    </div>--}}
    </div>