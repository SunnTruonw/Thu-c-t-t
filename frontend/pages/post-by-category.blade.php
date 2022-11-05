@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('css')
<style type="text/css">
    .wrap-breadcrumbs{
        margin-bottom: 0;
    }
    .title-template-in .title-inner{
        padding-top: 30px;
        display: none;
    }
    .section-btg .post-title{
        font-size: 24px;
        font-weight: 700;
        color: #333;
        padding: 30px 0;
        margin: 0;
    }
    .section-btg .box{
        display:block;
        padding:4px;
    }
    .section-btg .news-image{
        transition:border 0.2s ease-in-out;
    }
    .section-btg .news-image img{
        width: 100%;
        height:auto;
    }
    .section-btg .news-content{
        padding:9px;
        color:#333;

    }
    .section-btg .news-content .news-content-title{
        font-size:17px;
        line-height:24px;
        font-weight:600;
        margin: 15px 0 3px;
        padding: 0;
        color: rgb(65, 65, 65);
        text-transform: uppercase;
    }
    .section-btg .news-content ul>li{
        font-size: 14px;
        line-height: 20px;
        margin-bottom: 12px;
    }
    .section-btg .news-content ul>li a:hover{
            color: #1e9402;
    }
    .container, .container-fluid, .container-lg, .container-md, .container-sm, .container-xl{
        padding-left:12px;
        padding-right:12px;
    }
    .section-btg .col-blog-news{
        padding-left:0;
        padding-right:12px;
    }

    .main .ss-view-body {
        background: linear-gradient(to right,#3a9db8,#1e64a9);
    }

    .main .ss-view-body h2 {
        font-size: 24px;
        font-weight: 700;
        color: #fff;
        padding: 30px 0;
    }

    .main .ss-view-body .btn-main {
        padding-right: 70px;
    }

    .main .ss-view-body .btn-main .btn-bp {
        padding: 0;
    }

    .nut-btn {
        cursor: pointer;
    }

    .main .ss-view-body .btn-main .btn-bp a i {
        position: relative;
        right: -114px;
        top: -35px;
        font-size: 34px;
        width: 20px;
        color: #fff;
        display: none;
    }

    .main .ss-view-body .body-content {
        border-radius: 4px;
        background: #fff;
        width: 750px;
        height: 400px;
        padding: 0 0 12px;
        /* margin-left: 10px; */
    }

    .main .ss-view-body .body-content .tab-content, .main .ss-view-body .body-content .tab-content a.xemthem {
        display: none;
    }

    .main .ss-view-body .body-content .tab-content.current {
        display: block!important;
        overflow: auto;
        height: 400px;
    }

    .main .ss-view-body .btn-main img {
        position: relative;
        bottom: 25px;
    }

    .main .ss-view-body .body-content .tab-content a {
        text-decoration: none;
        float: left;
        color: #414141;
        text-align: left;
        background: 0 0;
        width: 50%;
        height: 10%;
        display: inline-block;
        margin: 0 0 3px;
        padding: 10px 0 0 40px;
    }

    .main .ss-view-body a {
        margin-bottom: 20px;
        padding: 9px 10px;
        border-radius: 4px;
        width: 100px;
        text-align: center;
        height: 40px;
        background-color: #f4f4f4;
        display: block;
        font-size: 16px;
    }

    .row:before {
        display: table;
        content: " ";
    }

    .row:after {
        clear: both;
    }

    .container:after {
        clear: both;
    }

    .main .ss-view-body .btn-main .btn-bp a.active {
        background: #ee8434;
        color: #fff;
    }

    .main .ss-view-body .btn-main .btn-bp a.active i {
        display: block;
    }
</style>
@endsection
@section('content')
    <div class="content-wrapper">
        <div class="main">
            @if ($category->id==13)

            @else
                @isset($breadcrumbs,$typeBreadcrumb)
                    @include('frontend.components.breadcrumbs',[
                        'breadcrumbs'=>$breadcrumbs,
                        'type'=>$typeBreadcrumb,
                    ])
                @endisset
            @endif
            {{-- <div class="ss-view-body">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <h2>
                                Xem theo bộ phận cơ thể
                            </h2>
                        </div>
                        <div class="col-sm-4 col-xs-12 btn-main">
                            <div class="row">
                                <div class="col-sm-9 col-xs-9 xoa"><img src="https://nhathuoclongchau.com/upload/images/benh-category/1/xem-theo-bo-phan-co-the-1-2018-05-16-351276033.png" /></div>
                                <div class="col-sm-3 col-xs-3 btn-bp">
                                    <a class="nut-btn" data-tab="body-content-item1">
                                        Đầu
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn" data-tab="body-content-item2">
                                        Cổ
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn" data-tab="body-content-item3">
                                        Ngực
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn" data-tab="body-content-item4">
                                        Bụng
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn active" data-tab="body-content-item5">
                                        Sinh dục
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn" data-tab="body-content-item6">
                                        Tứ chi
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                    <a class="nut-btn" data-tab="body-content-item7">
                                        Da
                                        <i class="fa fa-caret-left"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
            
                        <div class="col-sm-8 col-xs-7 body-content">

                            <div id="body-content-item1" class="tab-content current">
                                <a href="https://nhathuoclongchau.com/benh/paget-xuong-86.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Paget xương');">Paget xương</a>
                                <a href="https://nhathuoclongchau.com/benh/noi-lap-588.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Nói lắp');">Nói lắp</a>
                                <a href="https://nhathuoclongchau.com/benh/bai-nao-tre-em-6.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Bại não trẻ em');">Bại não trẻ em</a>
                                <a href="https://nhathuoclongchau.com/benh/dau-dau-man-tinh-10.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Đau đầu mạn tính');">Đau đầu mạn tính</a>
                                <a href="https://nhathuoclongchau.com/benh/nhuc-dau-24.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Nhức đầu');">Nhức đầu</a>
                                <a href="https://nhathuoclongchau.com/benh/sa-sut-tri-tue-do-mach-mau-nao-33.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Sa sút trí tuệ do mạch máu não');">Sa sút trí tuệ do mạch máu não</a>
                                <a href="https://nhathuoclongchau.com/benh/quai-bi-94.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Quai bị');">Quai bị</a>
                                <a href="https://nhathuoclongchau.com/benh/ung-thu-tuyen-nuoc-bot-322.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Ung thư tuyến nước bọt');">Ung thư tuyến nước bọt</a>
                                <a href="https://nhathuoclongchau.com/benh/phinh-dong-mach-nao-306.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Phình động mạch não');">Phình động mạch não</a>
                                <a href="https://nhathuoclongchau.com/benh/roi-loan-tuan-hoan-nao-602.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Rối loạn tuần hoàn não');">Rối loạn tuần hoàn não</a>
                                <a href="https://nhathuoclongchau.com/benh/u-nao-285.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'U não');">U não</a>
                                <a href="https://nhathuoclongchau.com/benh/bai-liet-220.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Bại liệt');">Bại liệt</a>
                                <a href="https://nhathuoclongchau.com/benh/liet-nua-nguoi-17.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Liệt nửa người');">Liệt nửa người</a>
                                <a href="https://nhathuoclongchau.com/benh/lu-lan-21.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Lú lẫn');">Lú lẫn</a>
                                <a href="https://nhathuoclongchau.com/benh/moc-rang-324.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Mọc răng');">Mọc răng</a>
                                <a href="https://nhathuoclongchau.com/benh/tut-loi-343.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Tụt lợi');">Tụt lợi</a>
                                <a href="https://nhathuoclongchau.com/benh/dong-kinh-621.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Động kinh');">Động kinh</a>
                                <a href="https://nhathuoclongchau.com/benh/hoi-chung-tang-ap-luc-noi-so-1005.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Hội chứng tăng áp lực nội sọ');">Hội chứng tăng áp lực nội sọ</a>
                                <a href="https://nhathuoclongchau.com/benh/xuat-huyet-duoi-nhen-1038.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Xuất huyết dưới nhện');">Xuất huyết dưới nhện</a>
                                <a href="https://nhathuoclongchau.com/benh/phu-nao-1053.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'phù não');">phù não</a>
                                <a href="https://nhathuoclongchau.com/benh/xuat-huyet-nao-1094.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'xuất huyết não');">xuất huyết não</a>
                                <a href="https://nhathuoclongchau.com/benh/nhoi-mau-nao-1113.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Nhồi máu não');">Nhồi máu não</a>
                                <a href="https://nhathuoclongchau.com/benh/bai-nao-1191.html" onclick="ga('send', 'event', 'Bệnh', 'Click bệnh ở Đầu', 'Bại não');">Bại não</a>
                                <a class="xemthem" data-tab="body-content-item1"> Xem thêm</a>
                            </div>
                            
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div> --}}
            
                @if(isset($category) && $category->childs()->count() > 0)
                <div class="block-news">
                    <div class="section-btg">
                        <div class="container">
                            <h2 class="post-title">{{$category->name}}</h2>
                            <div class="row">
                                @foreach($category->childs()->where('active', 1)->orderBy('order')->limit(12)->get() as $value)
                                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-blog-news">
                                        <div class="box">
                                            <div class="news-image">
                                                <a href="{{$value->slug_full}}">
                                                    <img src="{{asset($value->avatar_path)}}" alt="{{$value->name}}">
                                                </a>
                                            </div>
                                            <div class="news-content">
                                                <div class="news-content-title">
                                                    <a href="{{$value->slug_full}}">{{$value->name}}</a>
                                                </div>
                                                <ul>
                                                    @if($value->childs()->count() > 0)
                                                        @foreach($value->childs()->where('active', 1)->orderBy('order')->limit(5)->get() as $childValue)
                                                            <li>
                                                                <a href="{{$childValue->slug_full}}">
                                                                    <span>{{$childValue->name}}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    @endif
                                                </ul>
                                                
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    {{-- <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-9 col-sm-12  block-content-right1">
								<h1 class="title-template-in">
                                    <span class="title-inner"> {{ $category->name??"" }} </span>
                                </h1>
                                @isset($data)
                                    <div class="wrap-list-news">
                                        <div class="list-card-news-horizontal">
                                            <div class="row">
                                                @foreach($data as $post_item)
                                                @php
                                                    $slug_post1 = explode('tin-tuc/', $post_item->slug);
                                                    $slug_post = implode($slug_post1);
                                                @endphp
                                                <div class="col-card-news-horizontal col-sm-3">
                                                    <div class="card-news-horizontal card-news-horizontal-2">
                                                        <div class="box">
                                                            <div class="image">
                                                                <a href="{{ makeLink('post',$post_item->id, $slug_post) }}">
                                                                    <img src="{{ $post_item->avatar_path != null ? asset($post_item->avatar_path) : '../frontend/images/no-images.jpg' }}" alt="{{$post_item->name}}"></a>
                                                            </div>
                                                            <div class="content">
                                                                <h3><a href="{{ makeLink('post', $post_item->id,$slug_post) }}">{{$post_item->name}}</a></h3>
                                                                
                                                                <div class="desc">
                                                                    {{$post_item->description}}
                                                                </div>
                                                               <div class="text-right">
                                                                <a href="{{ makeLink('post',$post_item->id,$slug_post) }}" class="btn-viewmore btn btn-light"><i class="fas fa-angle-double-right"></i> {{ __('post.xem_them') }}</a>
                                                               </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            @if (count($data))
                                            {{$data->appends(request()->all())->links()}}
                                            @endif
                                        </div>
                                    </div>
                                @endisset
                                @if ($category->content)
                                <div class="content-category" id="wrapSizeChange">
                                    {!! $category->content !!}
                                </div>
                                @endif
                            </div>
							<div class="col-lg-3 col-md-12 col-sm-12 col-12 block-content-left">
								@isset($sidebar)
								@include('frontend.components.sidebar',[
									"categoryProduct"=>$sidebar['categoryProduct'],
									"categoryPost"=>$sidebar['categoryPost'],
									"categoryProductActive"=>$categoryProductActive  ?? null,
									"postsHot"=>$sidebar['postsHot'],
									"support_online"=>$sidebar['support_online'],
									'fill'=>true,
									'product'=>true,
									'post'=>false,
								])
							@endisset
                        	</div>
                        </div>
                    </div> --}}
                </div>
                @else
                    <div class="block-news">
                        <div class="section-btg">
                            <div class="container">
                                <h2 class="post-title">{{$category->name}}</h2>
                                <div class="row">
                                    @foreach($category->posts()->where('active', 1)->orderBy('order')->limit(12)->get() as $value)
                                        <div class="col-12 col-sm-6 col-md-6 col-lg-3 col-blog-news">
                                            <div class="box">
                                                <div class="news-image">
                                                    <a href="{{$value->slug_full}}">
                                                        <img src="{{asset($value->avatar_path)}}" alt="{{$value->name}}">
                                                    </a>
                                                </div>
                                                <div class="news-content">
                                                    <div class="news-content-title">
                                                        <a href="{{$value->slug_full}}">{{$value->name}}</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
        </div>
    </div>
@endsection
@section('js')
<script>
    $(function(){
        $(document).ready(function() {
            handleTabBenh();
        });

        function handleTabBenh(){
            //btn body cho trang benh-info
            $(".btn-bp a").click(function () {
                var tab_id = $(this).attr('data-tab');
                var el = $("#" + tab_id);
                // tao bien cho tab
                $('a').removeClass('active');
                $(this).addClass("active");

                // $(".btn-bp a svg").show("svg");
                // cho the a
                $('.tab-content').removeClass('current');
                $("#" + tab_id).addClass('current');

                // if ($(window).innerWidth() <= 767) {
                //     $('.btn-bp').addClass("wrapping");
                //     $(".btn-main .xoa").addClass('delete');
                //     $(".btn-main").addClass('them');
                //     $(".btn-bp a ").removeClass("active1");
                //     $(this).addClass("active1");
                //     $(".body-content").fadeIn('them');
                //     $(".body-content").css("display", "inline-table");
                //     $(".ss-view-body h2 span").show();
                // } else {
                //     return false;
                // }
                if (el.children("a").length > 12) {
                    $(el.children(".xemthem")).css("display", "block");
                }
                // click nut xem them show full tag a

                var e = $(".xemthem").click(function () {
                    var tab_id = $(this).attr('data-tab');
                    $("#" + tab_id).addClass('full row');
                    $(this).fadeOut();
                });

                // click ra ngoai remove class full
                $(document).on('click', function (event) {
                    if (!$(event.target).closest('.tab-content').length) {
                        $(".tab-content").removeClass("full row");

                        // check laij xem them
                        if (el.children("a").length > 12) {
                            $(el.children(".xemthem")).fadeIn();
                        }
                    }

                });
            });
        }
    })
</script>
@endsection
