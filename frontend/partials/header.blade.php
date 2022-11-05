<style>
    .sub-nav-product-list .box-price span{
        padding: 0;
    }
    .sub-nav-product-list .box-price span.old-price{
        display: block;
        width: 100%;
    }
    .sub-nav-product-list .box-price span.new-price{
        font-weight: 500;
        font-size: 16px;
        line-height: 24px;
        height: auto;
        margin-right: 3px;
    }
    .sub-nav-product-list .box-price{
        text-align: left;
        font-size: 14px;
        line-height: 24px;
        padding: 0;
        align-items: unset;
        vertical-align: baseline;
        height: 44px;
    }
</style>

<div class="menu_fix_mobile">
    <div class="close-menu">
        <p><a href="{{ makeLink('home') }}">
             <img src="{{ asset($header['logo']->image_path) }}" alt="Logo">
        </a></p>
        <a href="javascript:;" id="close-menu-button">
            <i class="fa fa-times" aria-hidden="true"></i>
        </a>
    </div>
    <ul class="nav-main">
		<li class="nav-item">
            <a href="{{ makeLink('home') }}">
                <span> Trang chủ</span>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{makeLinkToLanguage('about-us', null, null, App::getLocale())}}">
                <span> Giới thiệu</span>
            </a>
        </li>
        
        @if(isset($header['hangNoiDia']) && $header['hangNoiDia'])
            <li class="nav-item">
                <a href="{{$header['hangNoiDia']->slug_full}}">
                    <span>{{$header['hangNoiDia']->name}}</span>
                    @isset($header['hangNoiDia']->childs)
                        @if (count($header['hangNoiDia']->childs)>0)
                            <i class="fa fa-angle-down mn-icon"></i>
                        @endif
                    @endisset
                </a>
                <ul class="nav-sub">
                    @isset($header['hangNoiDia']->childs)
                        @if (count($header['hangNoiDia']->childs)>0)
                            @foreach($header['hangNoiDia']->childs()->where('active', 1)->orderBy('order')->limit(10)->get() as $value)
                            <li class="">
                                <a href="{{$value->slug_full}}">
                                    <span>{{$value->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    @endisset
                </ul>
            </li>
        @endif

        @if(isset($header['hangNgoaiDia']) && $header['hangNgoaiDia'])
            <li class="nav-item">
                <a href="{{$header['hangNgoaiDia']->slug_full}}">
                    <span>{{$header['hangNgoaiDia']->name}}</span>
                    @isset($header['hangNgoaiDia']->childs)
                        @if (count($header['hangNgoaiDia']->childs)>0)
                            <i class="fa fa-angle-down mn-icon"></i>
                        @endif
                    @endisset
                </a>
                <ul class="nav-sub">
                    @isset($header['hangNgoaiDia']->childs)
                        @if (count($header['hangNgoaiDia']->childs)>0)
                            @foreach($header['hangNgoaiDia']->childs()->where('active', 1)->orderBy('order')->limit(10)->get() as $value)
                            <li class="">
                                <a href="{{$value->slug_full}}">
                                    <span>{{$value->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    @endisset
                </ul>
            </li>
        @endif

        @if(isset($header['meVaBe']) && $header['meVaBe'])
            <li class="nav-item">
                <a href="{{$header['meVaBe']->slug_full}}">
                    <span>{{$header['meVaBe']->name}}</span>
                    @isset($header['meVaBe']->childs)
                        @if (count($header['meVaBe']->childs)>0)
                            <i class="fa fa-angle-down mn-icon"></i>
                        @endif
                    @endisset
                </a>
                <ul class="nav-sub">
                    @isset($header['meVaBe']->childs)
                        @if (count($header['meVaBe']->childs)>0)
                            @foreach($header['meVaBe']->childs()->where('active', 1)->orderBy('order')->limit(10)->get() as $value)
                            <li class="">
                                <a href="{{$value->slug_full}}">
                                    <span>{{$value->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    @endisset
                </ul>
            </li>
        @endif

        @if(isset($header['hangNgoaiDia1']) && $header['hangNgoaiDia1'])
            <li class="nav-item">
                <a href="{{$header['hangNgoaiDia1']->slug_full}}">
                    <span>{{$header['hangNgoaiDia1']->name}}</span>
                    @isset($header['hangNgoaiDia1']->childs)
                        @if (count($header['hangNgoaiDia1']->childs)>0)
                            <i class="fa fa-angle-down mn-icon"></i>
                        @endif
                    @endisset
                </a>
                <ul class="nav-sub">
                    @isset($header['hangNgoaiDia1']->childs)
                        @if (count($header['hangNgoaiDia1']->childs)>0)
                            @foreach($header['hangNgoaiDia1']->childs()->where('active', 1)->orderBy('order')->limit(10)->get() as $value)
                            <li class="">
                                <a href="{{$value->slug_full}}">
                                    <span>{{$value->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    @endisset
                </ul>
            </li>
        @endif

        @if(isset($header['hangNgoaiDia2']) && $header['hangNgoaiDia2'])
            <li class="nav-item">
                <a href="{{$header['hangNgoaiDia2']->slug_full}}">
                    <span>{{$header['hangNgoaiDia2']->name}}</span>
                    @isset($header['hangNgoaiDia2']->childs)
                        @if (count($header['hangNgoaiDia2']->childs)>0)
                            <i class="fa fa-angle-down mn-icon"></i>
                        @endif
                    @endisset
                </a>
                <ul class="nav-sub">
                    @isset($header['hangNgoaiDia2']->childs)
                        @if (count($header['hangNgoaiDia2']->childs)>0)
                            @foreach($header['hangNgoaiDia2']->childs()->where('active', 1)->orderBy('order')->limit(10)->get() as $value)
                            <li class="">
                                <a href="{{$value->slug_full}}">
                                    <span>{{$value->name}}</span>
                                </a>
                            </li>
                            @endforeach
                        @endif
                    @endisset
                </ul>
            </li>
        @endif

        @if(isset($header['menuNew']) && $header['menuNew'])
            @foreach($header['menuNew'] as $value)
                <li class="nav-item">
                    <a href="{{$value->slug_full}}">
                        <span>{{$value->name}}</span>
                    </a>
                </li>
            @endforeach
        @endif
        {{-- <li class="nav-item">
            <a href="{{makeLinkToLanguage('contact', null, null, App::getLocale())}}">
                <span>Liên hệ</span>
            </a>
        </li> --}}
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
                <li><a href="{{ $item->slug }}"><img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}"></a></li>
                @endforeach
            </ul>
        </div>
		<h2>{{ $header['socialParent']->slug }}</h2>
		<p>{{ $header['socialParent']->value }}</p>
    </div>
    @endif
	
</div>

<div class="header2">
    @if(isset($header['header_top']) && $header['header_top'])
        <div class="header-top">
            <div class="header-top-nofication">
                <div class="box-header-top">
                    <nav class="top-nav nofication-block">
                        <div class="nofication-item text-center">
                            <span class="circle-ripple"></span>
                            <span class="nofication-text">{{$header['header_top']->name}}</span>
                            <a href="{{asset($header['header_top']->slug)}}" class="guide-btn">{{$header['header_top']->value}}</a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    @endif
    <div class="header_home">
        <div class="container">
            <div class="row">
                
                <div class="col-12 col-sm-12">
                    <div class="list-bar">
                        <div class="bar1"></div>
                        <div class="bar2"></div>
                        <div class="bar3"></div>
                    </div>
                    <div class="logo-head">
                        <div class="image">
                            <a href="{{ makeLink('home') }}">
                                <img src="{{ asset($header['logo']->image_path) }}" alt="Logo">
                            </a>
                        </div>
                    </div>
                    <div class="search_desktop">
                        <form action="{{ makeLink('search') }}" autocomplete="off" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Nhập tìm thuốc" />
                                <div class="input-group-append">
                                    <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>                
                    <div class="h-cart dropdown show" id="li_desktop_cart">
                        <a class="smooth d-flex" href="{{ route('cart.list') }}">
                            <img src="{{asset('/frontend/images/cart.png')}}" alt="cart" title="cart">
                            <span>Giỏ hàng</span>
                            <strong class="cart-badge-number"
                                id="desktop-quick-cart-badge">{{ $header['totalQuantity'] }}</strong>
                            <label class="d-block d-lg-none cart-badge-number"
                                id="desktop-quick-cart-mobi">{{ $header['totalQuantity'] }}</label>
                        </a>
                    </div>
                    <div class="contact-top">
                        <div class="phone">
                            <a href="tel:{{ $header['tai_sao1']->slug }}">{{ $header['tai_sao1']->slug }}</a>
                            <span>{{ $header['tai_sao1']->value }}</span>
                            <a href="tel:{{ $header['tai_sao1']->slug }}" class="icon-phone"><i
                                    class="fas fa-phone-alt"></i></a>
                        </div>
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

                            <li class="nav-item">
                                <a href="{{makeLinkToLanguage('about-us', null, null, App::getLocale())}}">
                                    <span> Giới thiệu</span>
                                </a>
                            </li>

                            @if(isset($header['hangNoiDia']) && $header['hangNoiDia'])
                                <li class="nav-item">
                                    <a href="{{$header['hangNoiDia']->slug_full}}">
                                        <span> {{$header['hangNoiDia']->name}}</span>
                                        @isset($header['hangNoiDia']->childs)
                                            @if (count($header['hangNoiDia']->childs)>0)
                                            <i class="fa fa-angle-down mn-icon"></i>
                                            @endif
                                        @endisset
                                    </a>
                                    @isset($header['hangNoiDia']->childs)
                                        @if (count($header['hangNoiDia']->childs)>0)
                                            <div class="menu-dropdown">
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <ul class="sub-nav-left p-b-16">
                                                            @foreach ($header['hangNoiDia']->childs()->where('active', 1)->orderby('order')->limit(10)->get() as $key => $childValue)
                                                                <li class="nav-sub-item @if($loop->first) active @endif" data-id="li_hangNoiDia{{$childValue->id}}">
                                                                    <a href="{{$childValue['slug_full']}}">
                                                                        <div class="sub-nav-picture m-r-8">
                                                                            <picture>
                                                                                <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="{{$childValue['icon_path']?asset($childValue['icon_path']):asset('frontend/images/noimage.jpg')}}" />
                                                                            </picture>
                                                                        </div>
                                                                        <div class="sub-nav-name fs-p-14">
                                                                            <span>{{$childValue['name']}} </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($header['hangNoiDia']->childs()->where('active', 1)->orderby('order')->get() as $key => $childValue)
                                                            <div class="sub-nav-right @if($loop->first) active @endif" id="li_hangNoiDia{{$childValue->id}}">
                                                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                                        @foreach ($childValue->childs()->where('active', 1)->orderby('order')->get() as $key => $childValueItem)
                                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                                <a href="{{$childValueItem->slug_full}}" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                                        <picture>
                                                                                            <img alt="{{$childValueItem->name}}" srcset="" class="loaded" src="{{$childValueItem->icon_path?asset($childValueItem->icon_path):asset('frontend/images/noimage.jpg')}}" />
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div class="sub-nav-cate-name">
                                                                                        <span>{{$childValueItem->name}}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $categoryProduct = new \App\Models\CategoryProduct();
                                                                    $product = new  \App\Models\Product();
                                                                    $listIdProductHeader = $categoryProduct->getALlCategoryChildrenAndSelf($childValue->id);

                                                                    $dataProductHeader = $product->whereIn('category_id', $listIdProductHeader)->where('active', 1)->orderBy('order')->limit(4)->get();
                                                                @endphp
                                                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                                    <div class="sub-nav-title m-b-12">
                                                                        <div class="u-flex justify-between align-items-center">
                                                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                                <i class="fab fa-gripfire"></i>
                                                                                Bán chạy nhất
                                                                            </div>
                                                                            <a class="link p-t-2" href="{{$childValue->slug_full}}">Xem tất cả</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sub-nav-product-list">
                                                                        <div class="row row-cols-5">
                                                                            @foreach($dataProductHeader as $product)
                                                                                @php
                                                                                    $tran=$product->translationsLanguage()->first();
                                                                                    $link=$product->slug_full;
                                                                                @endphp
                                                                                <div class="col p-x-8">
                                                                                    <div class="sub-nav-product-item">
                                                                                        <a href="{{$link}}">
                                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                                <picture>
                                                                                                    <img
                                                                                                        alt="{{$tran->name}}"
                                                                                                        class="loaded"
                                                                                                        src="{{$product->avatar_path?asset($product->avatar_path):asset('frontend/images/noimage.jpg')}}"
                                                                                                    />
                                                                                                </picture>
                                                                                            </div>
                                                                                            <div class="sub-nav-product-info">
                                                                                                <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                                    {{$tran->name}}
                                                                                                </div>
                                                                                                <div class="box-price">
                                                                                                    @if ($product->price)
                                                                                                    <span class="new-price">{{ number_format($product->price) }}đ</span>
                                                                                                        @if ($product->size)
                                                                                                        {{ '/ '.$product->size }}
                                                                                                        @endif
                                                                                                    @else
                                                                                                    <span class="new-price">Liên hệ</span>
                                                                                                    @endif
                                                                                                    @if ($product->old_price>0)
                                                                                                    <span class="old-price">{{ number_format($product->old_price) }}đ</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                </li>
                            @endif

                            @if(isset($header['hangNgoaiDia']) && $header['hangNgoaiDia'])
                                <li class="nav-item">
                                    <a href="{{$header['hangNgoaiDia']->slug_full}}">
                                        <span> {{$header['hangNgoaiDia']->name}}</span>
                                        @isset($header['hangNgoaiDia']->childs)
                                            @if (count($header['hangNgoaiDia']->childs)>0)
                                            <i class="fa fa-angle-down mn-icon"></i>
                                            @endif
                                        @endisset
                                    </a>
                                    @isset($header['hangNgoaiDia']->childs)
                                        @if (count($header['hangNgoaiDia']->childs)>0)
                                            <div class="menu-dropdown">
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <ul class="sub-nav-left p-b-16">
                                                            @foreach ($header['hangNgoaiDia']->childs()->where('active', 1)->orderby('order')->limit(10)->get() as $key => $childValue)
                                                                <li class="nav-sub-item @if($loop->first) active @endif" data-id="li_hangNgoaiDia{{$childValue->id}}">
                                                                    <a href="{{$childValue['slug_full']}}">
                                                                        <div class="sub-nav-picture m-r-8">
                                                                            <picture>
                                                                                <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="{{$childValue['icon_path']?asset($childValue['icon_path']):asset('frontend/images/noimage.jpg')}}" />
                                                                            </picture>
                                                                        </div>
                                                                        <div class="sub-nav-name fs-p-14">
                                                                            <span>{{$childValue['name']}} </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($header['hangNgoaiDia']->childs()->where('active', 1)->orderby('order')->get() as $key => $childValue)
                                                            <div class="sub-nav-right @if($loop->first) active @endif" id="li_hangNgoaiDia{{$childValue->id}}">
                                                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                                        @foreach ($childValue->childs()->where('active', 1)->orderby('order')->get() as $key => $childValueItem)
                                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                                <a href="{{$childValueItem->slug_full}}" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                                        <picture>
                                                                                            <img alt="{{$childValueItem->name}}" srcset="" class="loaded" src="{{$childValueItem->icon_path?asset($childValueItem->icon_path):asset('frontend/images/noimage.jpg')}}" />
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div class="sub-nav-cate-name">
                                                                                        <span>{{$childValueItem->name}}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                @php
                                                                    $categoryProduct = new \App\Models\CategoryProduct();
                                                                    $product = new \App\Models\Product();
                                                                    $listIdProductHeader = $categoryProduct->getALlCategoryChildrenAndSelf($childValue->id);

                                                                    $dataProductHeader = $product->whereIn('category_id', $listIdProductHeader)->where('active', 1)->orderBy('order')->limit(4)->get();
                                                                @endphp
                                                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                                    <div class="sub-nav-title m-b-12">
                                                                        <div class="u-flex justify-between align-items-center">
                                                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                                <i class="fab fa-gripfire"></i>
                                                                                Bán chạy nhất
                                                                            </div>
                                                                            <a class="link p-t-2" href="{{$childValue->slug_full}}">Xem tất cả</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sub-nav-product-list">
                                                                        <div class="row row-cols-5">
                                                                            @foreach($dataProductHeader as $product)
                                                                                @php
                                                                                    $tran=$product->translationsLanguage()->first();
                                                                                    $link=$product->slug_full;
                                                                                @endphp
                                                                                <div class="col p-x-8">
                                                                                    <div class="sub-nav-product-item">
                                                                                        <a href="{{$link}}">
                                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                                <picture>
                                                                                                    <img
                                                                                                        alt="{{$tran->name}}"
                                                                                                        class="loaded"
                                                                                                        src="{{$product->avatar_path?asset($product->avatar_path):asset('frontend/images/noimage.jpg')}}"
                                                                                                    />
                                                                                                </picture>
                                                                                            </div>
                                                                                            <div class="sub-nav-product-info">
                                                                                                <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                                    {{$tran->name}}
                                                                                                </div>
                                                                                                <div class="box-price">
                                                                                                    @if($product->size != null)
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ/".$product->size :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }} đ/{{ $product->size   }}</span>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ" :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }}đ</span>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                </li>
                            @endif

                            @if(isset($header['meVaBe']) && $header['meVaBe'])
                                <li class="nav-item">
                                    <a href="{{$header['meVaBe']->slug_full}}">
                                        <span> {{$header['meVaBe']->name}}</span>
                                        @isset($header['meVaBe']->childs)
                                            @if (count($header['meVaBe']->childs)>0)
                                            <i class="fa fa-angle-down mn-icon"></i>
                                            @endif
                                        @endisset
                                    </a>
                                    @isset($header['meVaBe']->childs)
                                        @if (count($header['meVaBe']->childs)>0)
                                            <div class="menu-dropdown">
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <ul class="sub-nav-left p-b-16">
                                                            @foreach ($header['meVaBe']->childs()->where('active', 1)->orderby('order')->limit(10)->get() as $key => $childValue)
                                                                <li class="nav-sub-item @if($loop->first) active @endif" data-id="li_meVaBe{{$childValue->id}}">
                                                                    <a href="{{$childValue['slug_full']}}">
                                                                        <div class="sub-nav-picture m-r-8">
                                                                            <picture>
                                                                                <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="{{$childValue['icon_path']?asset($childValue['icon_path']):asset('frontend/images/noimage.jpg')}}" />
                                                                            </picture>
                                                                        </div>
                                                                        <div class="sub-nav-name fs-p-14">
                                                                            <span>{{$childValue['name']}} </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($header['meVaBe']->childs()->where('active', 1)->orderby('order')->get() as $key => $childValue)
                                                            <div class="sub-nav-right @if($loop->first) active @endif" id="li_meVaBe{{$childValue->id}}">
                                                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                                        @foreach ($childValue->childs()->where('active', 1)->orderby('order')->get() as $key => $childValueItem)
                                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                                <a href="{{$childValueItem->slug_full}}" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                                        <picture>
                                                                                            <img alt="{{$childValueItem->name}}" srcset="" class="loaded" src="{{$childValueItem->icon_path?asset($childValueItem->icon_path):asset('frontend/images/noimage.jpg')}}" />
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div class="sub-nav-cate-name">
                                                                                        <span>{{$childValueItem->name}}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                @php
                                                                    $categoryProduct = new \App\Models\CategoryProduct();
                                                                    $product = new \App\Models\Product();
                                                                    $listIdProductHeader = $categoryProduct->getALlCategoryChildrenAndSelf($childValue->id);

                                                                    $dataProductHeader = $product->whereIn('category_id', $listIdProductHeader)->where('active', 1)->orderBy('order')->limit(4)->get();
                                                                @endphp
                                                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                                    <div class="sub-nav-title m-b-12">
                                                                        <div class="u-flex justify-between align-items-center">
                                                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                                <i class="fab fa-gripfire"></i>
                                                                                Bán chạy nhất
                                                                            </div>
                                                                            <a class="link p-t-2" href="{{$childValue->slug_full}}">Xem tất cả</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sub-nav-product-list">
                                                                        <div class="row row-cols-5">
                                                                            @foreach($dataProductHeader as $product)
                                                                                @php
                                                                                    $tran=$product->translationsLanguage()->first();
                                                                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                                                                @endphp
                                                                                <div class="col p-x-8">
                                                                                    <div class="sub-nav-product-item">
                                                                                        <a href="{{$link}}">
                                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                                <picture>
                                                                                                    <img
                                                                                                        alt="{{$tran->name}}"
                                                                                                        class="loaded"
                                                                                                        src="{{$product->avatar_path?asset($product->avatar_path):asset('frontend/images/noimage.jpg')}}"
                                                                                                    />
                                                                                                </picture>
                                                                                            </div>
                                                                                            <div class="sub-nav-product-info">
                                                                                                <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                                    {{$tran->name}}
                                                                                                </div>
                                                                                                <div class="box-price">
                                                                                                    @if($product->size != null)
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ/".$product->size :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }} đ/{{ $product->size   }}</span>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ" :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }}đ</span>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                </li>
                            @endif

                            @if(isset($header['hangNgoaiDia1']) && $header['hangNgoaiDia1'])
                                <li class="nav-item">
                                    <a href="{{$header['hangNgoaiDia1']->slug_full}}">
                                        <span> {{$header['hangNgoaiDia1']->name}}</span>
                                        @isset($header['hangNgoaiDia1']->childs)
                                            @if (count($header['hangNgoaiDia1']->childs)>0)
                                            <i class="fa fa-angle-down mn-icon"></i>
                                            @endif
                                        @endisset
                                    </a>
                                    @isset($header['hangNgoaiDia1']->childs)
                                        @if (count($header['hangNgoaiDia1']->childs)>0)
                                            <div class="menu-dropdown">
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <ul class="sub-nav-left p-b-16">
                                                            @foreach ($header['hangNgoaiDia1']->childs()->where('active', 1)->orderby('order')->limit(10)->get() as $key => $childValue)
                                                                <li class="nav-sub-item @if($loop->first) active @endif" data-id="li_hangNgoaiDia1_{{$childValue->id}}">
                                                                    <a href="{{$childValue['slug_full']}}">
                                                                        <div class="sub-nav-picture m-r-8">
                                                                            <picture>
                                                                                <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="{{$childValue['icon_path']?asset($childValue['icon_path']):asset('frontend/images/noimage.jpg')}}" />
                                                                            </picture>
                                                                        </div>
                                                                        <div class="sub-nav-name fs-p-14">
                                                                            <span>{{$childValue['name']}} </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($header['hangNgoaiDia1']->childs()->where('active', 1)->orderby('order')->get() as $key => $childValue)
                                                            <div class="sub-nav-right @if($loop->first) active @endif" id="li_hangNgoaiDia1_{{$childValue->id}}">
                                                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                                        @foreach ($childValue->childs()->where('active', 1)->orderby('order')->get() as $key => $childValueItem)
                                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                                <a href="{{$childValueItem->slug_full}}" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                                        <picture>
                                                                                            <img alt="{{$childValueItem->name}}" srcset="" class="loaded" src="{{$childValueItem->icon_path?asset($childValueItem->icon_path):asset('frontend/images/noimage.jpg')}}" />
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div class="sub-nav-cate-name">
                                                                                        <span>{{$childValueItem->name}}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @php
                                                                    $categoryProduct = new \App\Models\CategoryProduct();
                                                                    $product = new  \App\Models\Product();
                                                                    $listIdProductHeader = $categoryProduct->getALlCategoryChildrenAndSelf($childValue->id);

                                                                    $dataProductHeader = $product->whereIn('category_id', $listIdProductHeader)->where('active', 1)->orderBy('order')->limit(4)->get();
                                                                @endphp
                                                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                                    <div class="sub-nav-title m-b-12">
                                                                        <div class="u-flex justify-between align-items-center">
                                                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                                <i class="fab fa-gripfire"></i>
                                                                                Bán chạy nhất
                                                                            </div>
                                                                            <a class="link p-t-2" href="{{$childValue->slug_full}}">Xem tất cả</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sub-nav-product-list">
                                                                        <div class="row row-cols-5">
                                                                            @foreach($dataProductHeader as $product)
                                                                                @php
                                                                                    $tran=$product->translationsLanguage()->first();
                                                                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                                                                @endphp
                                                                                <div class="col p-x-8">
                                                                                    <div class="sub-nav-product-item">
                                                                                        <a href="{{$link}}">
                                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                                <picture>
                                                                                                    <img
                                                                                                        alt="{{$tran->name}}"
                                                                                                        class="loaded"
                                                                                                        src="{{$product->avatar_path?asset($product->avatar_path):asset('frontend/images/noimage.jpg')}}"
                                                                                                    />
                                                                                                </picture>
                                                                                            </div>
                                                                                            <div class="sub-nav-product-info">
                                                                                                <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                                    {{$tran->name}}
                                                                                                </div>
                                                                                                <div class="box-price">
                                                                                                    @if ($product->price)
                                                                                                    <span class="new-price">{{ number_format($product->price) }}đ</span>
                                                                                                        @if ($product->size)
                                                                                                        {{ '/ '.$product->size }}
                                                                                                        @endif
                                                                                                    @else
                                                                                                    <span class="new-price">Liên hệ</span>
                                                                                                    @endif
                                                                                                    @if ($product->old_price>0)
                                                                                                    <span class="old-price">{{ number_format($product->old_price) }}đ</span>
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                </li>
                            @endif

                            @if(isset($header['hangNgoaiDia2']) && $header['hangNgoaiDia2'])
                                <li class="nav-item">
                                    <a href="{{$header['hangNgoaiDia2']->slug_full}}">
                                        <span> {{$header['hangNgoaiDia2']->name}}</span>
                                        @isset($header['hangNgoaiDia2']->childs)
                                            @if (count($header['hangNgoaiDia2']->childs)>0)
                                            <i class="fa fa-angle-down mn-icon"></i>
                                            @endif
                                        @endisset
                                    </a>
                                    @isset($header['hangNgoaiDia2']->childs)
                                        @if (count($header['hangNgoaiDia2']->childs)>0)
                                            <div class="menu-dropdown">
                                                <div class="row no-gutters">
                                                    <div class="col-3">
                                                        <ul class="sub-nav-left p-b-16">
                                                            @foreach ($header['hangNgoaiDia2']->childs()->where('active', 1)->orderby('order')->limit(10)->get() as $key => $childValue)
                                                                <li class="nav-sub-item @if($loop->first) active @endif" data-id="li_hangNgoaiDia2_{{$childValue->id}}">
                                                                    <a href="{{$childValue['slug_full']}}">
                                                                        <div class="sub-nav-picture m-r-8">
                                                                            <picture>
                                                                                <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="{{$childValue['icon_path']?asset($childValue['icon_path']):asset('frontend/images/noimage.jpg')}}" />
                                                                            </picture>
                                                                        </div>
                                                                        <div class="sub-nav-name fs-p-14">
                                                                            <span>{{$childValue['name']}} </span>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                    <div class="col-9">
                                                        @foreach ($header['hangNgoaiDia2']->childs()->where('active', 1)->orderby('order')->get() as $key => $childValue)
                                                            <div class="sub-nav-right @if($loop->first) active @endif" id="li_hangNgoaiDia2_{{$childValue->id}}">
                                                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                                                        @foreach ($childValue->childs()->where('active', 1)->orderby('order')->get() as $key => $childValueItem)
                                                                            <div class="col sub-nav-cate-item p-x-8">
                                                                                <a href="{{$childValueItem->slug_full}}" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                                                    <div class="sub-nav-cate-picture m-r-8">
                                                                                        <picture>
                                                                                            <img alt="{{$childValueItem->name}}" srcset="" class="loaded" src="{{$childValueItem->icon_path?asset($childValueItem->icon_path):asset('frontend/images/noimage.jpg')}}" />
                                                                                        </picture>
                                                                                    </div>
                                                                                    <div class="sub-nav-cate-name">
                                                                                        <span>{{$childValueItem->name}}</span>
                                                                                    </div>
                                                                                </a>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>

                                                                @php
                                                                    $categoryProduct = new \App\Models\CategoryProduct();
                                                                    $product = new \App\Models\Product();
                                                                    $listIdProductHeader = $categoryProduct->getALlCategoryChildrenAndSelf($childValue->id);

                                                                    $dataProductHeader = $product->whereIn('category_id', $listIdProductHeader)->where('active', 1)->orderBy('order')->limit(4)->get();
                                                                @endphp
                                                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                                                    <div class="sub-nav-title m-b-12">
                                                                        <div class="u-flex justify-between align-items-center">
                                                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                                                <i class="fab fa-gripfire"></i>
                                                                                Bán chạy nhất
                                                                            </div>
                                                                            <a class="link p-t-2" href="{{$childValue->slug_full}}">Xem tất cả</a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sub-nav-product-list">
                                                                        <div class="row row-cols-5">
                                                                            @foreach($dataProductHeader as $product)
                                                                                @php
                                                                                    $tran=$product->translationsLanguage()->first();
                                                                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                                                                @endphp
                                                                                <div class="col p-x-8">
                                                                                    <div class="sub-nav-product-item">
                                                                                        <a href="{{$link}}">
                                                                                            <div class="sub-nav-product-picture m-b-12">
                                                                                                <picture>
                                                                                                    <img
                                                                                                        alt="{{$tran->name}}"
                                                                                                        class="loaded"
                                                                                                        src="{{$product->avatar_path?asset($product->avatar_path):asset('frontend/images/noimage.jpg')}}"
                                                                                                    />
                                                                                                </picture>
                                                                                            </div>
                                                                                            <div class="sub-nav-product-info">
                                                                                                <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                                                    {{$tran->name}}
                                                                                                </div>
                                                                                                <div class="box-price">
                                                                                                    @if($product->size != null)
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ/".$product->size :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }} đ/{{ $product->size   }}</span>
                                                                                                        @endif
                                                                                                    @else
                                                                                                        <span class="new-price">{{ $product->price?number_format($product->price)."đ" :"Liên hệ" }}</span>
                                                                                                        @if ($product->old_price>0)
                                                                                                            <span class="old-price">{{ number_format($product->old_price) }}đ</span>
                                                                                                        @endif
                                                                                                    @endif
                                                                                                </div>
                                                                                            </div>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endisset
                                </li>
                            @endif


                            

                            @if(isset($header['menuNew']) && $header['menuNew'])
                                @foreach($header['menuNew'] as $value)
                                    <li class="nav-item">
                                        <a href="{{$value['slug_full']}}">
                                            <span> {{$value['name']}}</span>
                                        </a>
                                    </li>
                                @endforeach
                            @endif

                            @if(isset($header['heThongNhaThuoc']) && $header['heThongNhaThuoc'])
                                <li class="nav-item">
                                    <a href="{{makeLinkToLanguage('drug-store', null, null, App::getLocale())}}">
                                        <span> {{$header['heThongNhaThuoc']->name}}</span>
                                    </a>
                                </li>
                            @endif
                            

                            {{-- <li class="nav-item">
                                <a href="{{makeLinkToLanguage('contact', null, null, App::getLocale())}}">
                                    <span> Liên hệ</span>
                                </a>
                            </li> --}}


                            {{-- @include('frontend.components.menu',[
                                'limit'=>3,
                                'icon_d'=>'<i class="fa fa-angle-down mn-icon"></i>',
                                'icon_r'=>'<i class="fa fa-angle-down mn-icon"></i>',
                                'data'=>$header['menuNew'],
                                'active'=>false
                            ]) --}}
                        </ul>
                    </div>

                    <div class="search" id="search">
                        <div class="form-s-mobile">
                            <form action="{{ makeLink('search') }}" autocomplete="off" method="GET">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="keyword" placeholder="Từ khóa" />
                                    <div class="input-group-append">
                                        <button class="input-group-text" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                            <span class="close-search"><i class="fas fa-times"></i></span>
                        </div>
                    </div>
                </div>
                <div class="hover-menu-mask hover-nav"></div>
            </div>
            <div class="col-lg-12 search_mb1">
                <div class="header-top-right">
                    <ul>
                        <form action="{{ makeLink('search') }}" autocomplete="off" method="GET" class="cart_header">
                            <li>
                                <input type="text" name="keyword" class="header-top-search" placeholder="Tìm kiếm trên Min's Kitchen" />
                                <div class="search_mobile" type="submit"><a>Tìm kiếm</a></div>
                            </li>
                        </form>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>

</div>
