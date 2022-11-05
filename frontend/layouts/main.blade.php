<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> @yield('title') </title>
    {{-- @section('google-anlytic', $header['google-anlytic']->description)
	@section('code-top', $header['code-top']->description)
	@section('code-home', $header['code-home']->description)
	@section('code-bottom', $header['code-bottom']->description) --}}
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="Content-Language" content="vi" />
    <meta name="keywords" content="@yield('keywords')" />
    <meta name="description" content="@yield('description')" />
    <meta name="abstract" content="@yield('abstract')" />
    <meta name="ROBOTS" content="Metaflow" />
    <meta name="ROBOTS" content="index, follow, all" />
    <meta name="AUTHOR" content="@yield('title')" />
    <meta name="revisit-after" content="1 days" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="og:image" content="@yield('image')" />
    <meta property="og:image:alt" content="@yield('image')" />
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta property="og:url" content="{{ makeLink('home') }}" />
    <meta property="og:type" content="article">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <link rel="canonical" href="{{ makeLink('home') }}" />
    <link rel="shortcut icon" href="{{URL::to('/favicon.ico')}}" />
    <script type="text/javascript" src="{{ asset('lib/jquery/jquery-3.2.1.min.js') }} "></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/bootstrap-4.5.3-dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('font/fontawesome-5.15.4/css/all.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ asset('lib/wow/css/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/slick-1.8.1/css/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('lib/lightbox-plus/css/lightbox.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/reset.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/jquery.fancybox.min.css') }}">
     {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet.css') }}"> --}}

     {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" /> --}}

    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/stylesheet-2.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/header.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/footer.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/cart.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/star.css') }}">



    @yield('css')
	{{-- google anlytic--}}
    {{-- @yield('google-anlytic') --}}
	{{-- code top--}}
    {{-- @yield('code-top') --}}
	
	<!-- Đánh dấu được tạo bởi Trình trợ giúp đánh dấu dữ liệu có cấu trúc của Google. -->


<script type="application/ld+json">
{
  "@context" : "http://schema.org",
  "@type" : "Product",
  "name" : "@yield('title')",
  "description" : "@yield('description')",
  "sku": "0446310786",
  "mpn": "925872",
  "image": [
    "@yield('image')"
   ],
  "url" : "{{request()->url()}}",
  "brand" : {
    "@type" : "Brand",
    "name" : "@yield('title')",
    "logo" : "@yield('image')"
  },
  
   "aggregateRating": {
    "@type": "AggregateRating",
    "ratingValue": "4.4",
    "reviewCount": "89"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{request()->url()}}",
    "priceCurrency": "VND",
    "price": "0",
    "priceValidUntil": "2020-11-05",
    "itemCondition": "https://schema.org/UsedCondition",
    "availability": "https://schema.org/InStock",
    "seller": {
      "@type": "Organization",
      "name": "Executive Objects"
    }
    },
  "review" : {
    "@type" : "Review",
    "author" : {
      "@type" : "Person",
      "name" : "@yield('title')"
    },
    "datePublished" : "2019-12-06",
    "reviewRating" : {
      "@type" : "Rating",
      "ratingValue" : "4.8"
    },
    "reviewBody" : "@yield('description')"
  }
}
</script>	

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-H3HXBQNC5S"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-H3HXBQNC5S');
</script>

</head>

<body class="template-search">
	{{-- code home--}}
    {{-- @yield('code-home') --}}

    <div class="wrapper home">
        {{-- <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">

                    <ul class="navbar-nav mr-auto">

                    </ul>
                    <ul class="navbar-nav ml-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>

                                    {{-- @if (Auth::guard('admin')->check())
                                    {{ Auth::guard('admin')->user()->name }}
                                    @else --}}
                                    {{-- @if(Auth::guard('web')->check())
                                    {{ Auth::guard()->user()->name }}
                                    @endif
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                    {{-- @if (Auth::guard('admin')->check())
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                     </a>
                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="d-none"> --}}
                                    {{-- @if(Auth::guard('web')->check())
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                  document.getElementById('logout-form').submit();">
                                     {{ __('Logout') }}
                                     </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @endif
                                        @csrf
                                    </form>
                                    <a class="dropdown-item" href="{{ route('profile.index') }}">Profile</a>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav> --}}
        <!-- Navbar -->
        @include('frontend.partials.header')
        <!-- /.navbar -->

        @yield('content')

        @include('frontend.partials.footer')


    </div>
    <script type="text/javascript" src="{{ asset('lib/lightbox-plus/js/lightbox-plus-jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script type="text/javascript" src="{{ asset('lib/bootstrap-4.5.3-dist/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/wow/js/wow.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('lib/slick-1.8.1/js/slick.min.js') }}"></script>
	<script type="text/javascript" src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script src="{{asset('lib/sweetalert2/js/sweetalert2.all.min.js')}}"></script>
    {{-- <script type="text/javascript" src="{{ asset('frontend/js/handleCate.js') }}"></script> --}}
    <script type="text/javascript" src="{{ asset('frontend/js/showMoreItems.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/main.js') }}"></script>
    <script src="{{ asset('lib/components/js/Cart.js') }}"></script>
    <script src="{{ asset('lib/components/js/Compare.js') }}"></script>
    <script type="text/javascript" src="{{ asset('frontend/js/_v2_comment.js') }}"></script>
    <script>
        new WOW().init();
        $(function() {
            $(document).on('click','.pt_icon_right',function(){
                event.preventDefault();
                $(this).parent('a').parent('li').children("ul").slideToggle();
                $(this).parent('a').parent('li').toggleClass('active');
            });
            $(document).on('click','.btn-sb-toogle',function(){
                $(this).parents('.box-list-fill').find('.fill-list-item').slideToggle();
                $(this).toggleClass('active');
            });
        })
    </script>

    <script>
        $(function(){
            // Sản phẩm vừa xem
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            let route = '{{route('home.renderProductView')}}';
            isCheckScroll = false;
            $(document).on('scroll',function(){
                if($(window).scrollTop() > 400 && isCheckScroll == false){
                    console.log('log');
                    isCheckScroll = true;
                    let products = localStorage.getItem("products");
                    products = $.parseJSON(products);

                    if(products.length > 0){
                        $.ajax({
                            url : route,
                            data : {id : products},
                            method : 'POST',
                            success : function(data){
                                $('#product-view').html('').append(data.data);
                            }
                        })
                    }
                }
            });
            //End sản phẩm vừa xem
            $(document).on('click', '.item-filter-desc',function(){
                $('.item-filter-desc').removeClass('active');
                $(this).addClass('active');

                let contentWrap = $('#dataProductSearch');
                let urlRequest = '{{ url()->current() }}';

                let idAttribute = $(this).attr('data-id');
                $.ajax({
                    type: "GET",
                    url: urlRequest,
                    data:{idAttribute : idAttribute},
                    success: function(data) {
                        if (data.code == 200) {
                            let html = data.html;
                            contentWrap.html(html);
                        }
                    }
                });
            });
        })
    </script>
    
    @yield('js')
    {{-- code footer--}}
    {{-- @yield('code-bottom') --}}

</body>
</html>
