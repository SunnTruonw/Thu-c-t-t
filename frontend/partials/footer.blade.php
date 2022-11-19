@if(isset($header['search_top']) && $header['search_top'])
    <div class="section-keywords p-t-32 m-b-40 m-b-md-16 p-t-md-16 m-t-md-8 bg-while">
        <div class="container p-x-md-0">
            <div class="box-title text-center p-l-md-10 m-b-16 m-b-md-12">
                <div class="u-flex justify-between align-items-center">
                    <h2 class="u-flex align-items-center fs-p-20 fs-p-md-16 txt-gray-900">
                        <i class="fas fa-poll m-r-8"></i>
                        {{$header['search_top']->name}}
                    </h2>
                </div>
            </div>
            <div class="section-keywords-body p-l-md-10">
                <div class="keywords-group block-none">
                    <div class="swiper-container slide-wrapper label-group-slide">
                        <div class="label-group swiper-wrapper">
                            @foreach($header['search_top']->childs()->where('active', 1)->orderBy('order')->get() as $value)
                                <div class="label-group-item">
                                    <a href="{{makeLink('search')}}?keyword={{$value->name}}">
                                        <label class="circle label fs-p-16">{{$value->name}}</label>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
<!--Sản phẩm đã xem-->
<div id="product-view"></div>
<!--End Sản phẩm đã xem-->
@if(isset($footer['gutters']) && $footer['gutters'])
    <div class="section-group-footer bg-gray p-t-40 p-t-md-16">
        <div class="section-method p-b-40">
            <div class="container p-x-md-10">
                <div class="group-footer-body">
                    <div class="row no-gutters justify-between body-list">
                        @foreach($footer['gutters']->childs()->where('active', 1)->orderBy('order')->get() as $value)
                            <div class="body-list-item col-auto col-12 col-sm-12 col-md-6 col-lg-6 col-xl-3 relative m-b-md-20">
                                <div class="u-flex no-gutters align-items-center flex-wrap">
                                    <div class="col-auto col-md-12 m-r-16 m-b-md-8">
                                        <div class="body-list-icon">
                                            <div class="image">
                                                <img src="{{asset($value->image_path)}}" alt="{{$value->name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col col-md-12">
                                        <div class="body-list-content">
                                            <div
                                                class="body-list-tit txt-primary-700 f-w-500 fs-p-18 txt-uppercase fs-p-lg-16 fs-p-md-14  fs-p-xxs-13">
                                               {{$value->name}}
                                            </div>
                                            <div class="body-list-typo fs-p-16 fs-p-lg-14 txt-gray-700 fs-p-xxs-12 ">
                                                {{$value->value}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        @if(isset($footer['banner_bottom']) && $footer['banner_bottom'])
            <div class="banner-group-footer">
                <div class="container">
                    <a>
                        <img src="{{asset($footer['banner_bottom']->image_path)}}" alt="{{$footer['banner_bottom']->name}}">
                    </a>
                </div>
            </div>
        @endif
    </div>
@endif
@if(isset($footer['drugStore']) && $footer['drugStore'])
    <div class="hethongnhathuoc">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="title_hethong">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>Xem hệ thống nhà thuốc toàn quốc</p>
                    </div>	
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12">
                    <div class="danhsach_nhathuoc">
                        <a href="{{route('home.drugStore')}}">Xem danh sách nhà thuốc</a>
                    </div>	
                </div>
            </div>
        </div>
    </div>	
@endif
<div class="footer">
    <div class="footer-main">
        <div class="container">
            <div class="row">
				<div class="col-lg-5 col-md-12 col-sm-12">
                    <div class="row">
						<div class="box_right_footer">
							<div class="col-lg-12 col-md-12 col-sm-12 col-item-footer">
								<div class="box-footer-main-info">
									@if (isset($footer['dataAddress']) && $footer['dataAddress'])
									<div class="content-address-footer">
										{!! $footer['dataAddress']->description !!}
									</div>
									@endif 
								</div>
							</div>
							<div class="col-lg-12 col-md-12 col-sm-12 col-item-footer">
								<div class="title-footer">
									{{ __('footer.dangky_nhanbantin') }}
								</div>
								<div class="box_form_dky">
									<p>{{ __('footer.duoc_giam_gia') }}!</p>
									<form action="{{ route('contact.storeAjax') }}" data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert"
										data-href="#modalAjax" data-content="#content" data-method="POST" method="POST">
										@csrf
										<input class="form-control" type="email" name="email" placeholder="{{ __('footer.nhap_mail') }}" required>
										<button name="submit"> <i class="fas fa-paper-plane"></i></button>
									</form>
								</div>
								<ul class="pt_social">
									<p>Kết nối tới chúng tôi</p>
									@if (isset($footer['socialParent']) && $footer['socialParent'])
                                        @foreach($footer['socialParent']->childs()->where('active',1)->orderby('order')->latest()->get() as $social)
                                        <li>
                                            <a href="{{ $social->slug }}" target="blank" rel="noopener noreferrer">
                                                @if($social->value != null)
                                                    {!! $social->value !!}
                                                @else
                                                    <img src="{{ asset($social->image_path) }}" alt="{{ $social->name }}">
                                                @endif
                                            </a>
                                        </li>
                                        @endforeach
									@endif
								</ul>
							</div>
						</div>
                    </div>
                </div>
				<div class="col-lg-7 col-md-12 col-sm-12">
					<div class="row">
				<div class="col-lg-4 col-md-12 col-sm-12 col-item-footer">
                    @if(isset($footer['linklienket']) && $footer['linklienket']->count()>0 )
					<div class="box_link_foot">
                        <div class="title">
                            <span>{{ $footer['linklienket']->name }}</span>
                            <img class="show_mb" src="{{ asset('frontend/images/arrow-right2.png') }}" alt="Arrows">
                        </div>
                        <ul>
                            @foreach($footer['linklienket']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                            <li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
				<div class="col-lg-4 col-md-12 col-sm-12 col-item-footer">
					@if(isset($footer['linklienket1']) && $footer['linklienket1']->count()>0 )
					<div class="box_link_foot">
                        <div class="title">
                            <span>{{ $footer['linklienket1']->name }}</span>
                            <img class="show_mb" src="{{ asset('frontend/images/arrow-right2.png') }}" alt="Arrows">
                        </div>
                        <ul>
                            @foreach($footer['linklienket1']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                            <li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
				<div class="col-lg-4 col-md-12 col-sm-12 col-item-footer">
					@if(isset($footer['linklienket2']) && $footer['linklienket2']->count()>0 )
					<div class="box_link_foot">
                        <div class="title">
                            <span>{{ $footer['linklienket2']->name }}</span>
                            <img class="show_mb" src="{{ asset('frontend/images/arrow-right2.png') }}" alt="Arrows">
                        </div>
                        <ul>
                            @foreach($footer['linklienket2']->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                            <li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
                
               </div>
                </div> 

                
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row line_bottom">
                <div class="col-md-12 col-sm-12">
                    <div class="coppy-right">
                        @if (isset($footer['coppy_right'])&&$footer['coppy_right'])
                        {{ $footer['coppy_right']->value }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<div class="modal fade form-tv" id="modal-form-dky" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            {{-- <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div> --}}
            <div class="modal-body">
                <form action="{{ route('contact.storeAjax') }}" data-url="{{ route('contact.storeAjax') }}"
                    data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content"
                    data-method="POST" method="POST">
                    @csrf
                    <input type="hidden" name="title" value="Đăng ký tư vấn">
                    <div class="box-content-form">
                        <h4 class="modal-title">
                            <a href=""><img src="{{ asset(optional($header['logo'])->image_path) }}"></a>
                        </h4>
                        <div class="title-form-m">
                            Đăng ký tư vấn
                        </div>
                        <div class="title-form-sm">
                            Liên hệ với chúng tôi để được hỗ trợ
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Họ tên">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="phone" placeholder="Số điện thoại">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="email" placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" name="content" placeholder="Nội dung tư vấn">
                        </div>
                        <button type="submit">Gửi đi</button>
                        <div class="text-center">
                            <a class="close-form-modal" data-dismiss="modal" aria-label="Close">Đóng lại X</a>
                        </div>
                        {{-- <div class="text">
                        Chúng tôi sẽ gọi lại cho quý khách hàng ngay khi nhận được thông tin quý khách hàng gửi.
                    </div> --}}
                    </div>
                </form>
            </div>
            {{-- <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div> --}}
        </div>
    </div>
</div>


<div class="pt_contact_vertical">
    <div class="contact-mobile">
        @if (isset($footer['zalo'])&&$footer['zalo'])
        <div class="contact-item">
            <a class="contact-icon zalo" title="zalo" href="https://zalo.me/{{ $footer['zalo']->slug }}" target="_blank"
                rel="noopener noreferrer">
                <img src="{{ asset('frontend/images/zalo-icon.png') }}" alt="icon">
            </a>
        </div>
        @endif

        @if (isset($footer['messenger'])&&$footer['messenger'])
        <div class="contact-item">
            <a class="contact-icon fb-mess" title="facebook" href="https://m.me/{{ $footer['messenger']->slug }}"
                target="_blank" rel="noopener noreferrer">
                <img src="{{ asset('frontend/images/facebook-icon.png') }}" alt="icon">
            </a>
        </div>
        @endif
        <div class="clearfix"></div>
    </div>
</div>

<div class="quick-alo-phone quick-alo-green quick-alo-show" id="quick-alo-phoneIcon">
    <div class="tel_phone">
        <a href="tel:{{ optional($footer['hotline'])->value }}">{{ optional($footer['hotline'])->value }}</a>
    </div>

    <a href="tel:{{ optional($footer['hotline'])->value }}">
        <div class="quick-alo-ph-circle"></div>
        <div class="quick-alo-ph-circle-fill"></div>
        <div class="quick-alo-ph-img-circle"></div>
    </a>


</div>


<div id="quick-view-modal" class="wrapper-quickview" style="display:none;">
    <div class="quickviewOverlay"></div>
    <div class="jsQuickview">
        <div class="modal-header clearfix" style="width:100%">
            <h4 id="product_quickview_title" class="p-title modal-title"></h4>
            <div class="quickview-close">
                <a href="javascript:void(0);"><i class="fas fa-times"></i></a>
            </div>
        </div>
        <div class="col-md-12 col-12">
            <div class="row">
                <div class="col-md-5">
                    <div id="product_quickview_image" class="quickview-image image-zoom">
                    </div>
                    <div id="quickview-sliderproduct">
                        <div class="quickview-slider">
                            <ul class="slides"></ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <form id="form-quickview" method="post" action="/cart/add">
                        <div class="quickview-information">
                            <div class="form-input">
                                <div class="quickview-price product-price">
                                    <span id="product_quickview_price"></span>
                                    <del id="product_quickview_price_old"></del>
                                </div>
                            </div>
                            <div id="product_quickview_quantity" class="form-input">

                            </div>

                            <div id="dat_mua" class="form-input" style="width: 100%">

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
{{--
<div class="bottom-contact">
    <ul>
        <li>
            <a id="chatfb" href="tel:0986.356.663">
                <img data-lazyloaded="1" src="{{asset('frontend/images/call.png')}}">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Gọi Ngay</span>
            </a>
        </li>
        <li>
            <a id="chatfb" href="">
                <img src="{{asset('frontend/images/gmail.png')}}" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Gửi Email</span>
            </a>
        </li>
        <li>
            <a id="chatfb" href="">
                <img  src="{{asset('frontend/images/facebook.png')}}" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Chat Facebook</span>
            </a>
        </li>
        <li>
            <a id="chatfb" href="https://zalo.me/0986356663">
                <img  src="{{asset('frontend/images/zalo.png')}}" class="entered litespeed-loaded">
                <br>
                <span style="font-weight: 500;font-size: 13px;">Chat Zalo</span>
            </a>
        </li>
    </ul>
</div>
--}}



{{-- <div class="back_to_top hidden-xs" id="back-to-top">
    <a onclick="topFunction();">
        <span>Về đầu trang</span>
        <img src="{{ asset('frontend/images/icon_back_to_top.png') }}">
</a>
</div>
<div class="contact_fixed">
    <li><a href="tel:"><i class="fa fa-phone"></i></a></li>
    <li>
        <a href="https://zalo.me/{{ $footer['hotline']->value }}"><img src="{{ asset('frontend/images/zalo2.png') }}"
                alt="Zalo"></a>
    </li>
    <li>
        <a href="https://m.me/"><img src="{{ asset('frontend/images/messenger2.png') }}" alt="Messenger"></a>
    </li>
    <li>
        <a onclick="topFunction();" href="javascript:;"><img src="{{ asset('frontend/images/icon_back_to_top.png') }}"
                alt="Back to top"></a>
    </li>
</div> --}}



<script>
//quickview

$(document).ready(function() {
    $('.quickview').click(function() {

        var product_id = $(this).data('id_product');
        var _token = $('input[name="_token"]').val();
        $('.wrapper-quickview').fadeIn(500);
        $('.jsQuickview').fadeIn(500);
        $.ajax({
            url: "{{url('/quickview')}}",
            method: "POST",
            dataType: "JSON",
            data: {
                product_id: product_id,
                _token: _token
            },
            success: function(data) {
                $('#product_quickview_title').html(data.product_name);
                $('#product_quickview_id').html(data.product_id);
                $('#product_quickview_image').html(data.product_image);
                $('#product_quickview_price').html(data.product_price);
                $('#product_quickview_quantity').html(data.product_quantity);
                $('#product_quickview_price_old').html(data.product_price_old);
                $('#dat_mua').html(data.dat_mua);
                /*
                
                $('#product_quickview_gallery').html(data.product_gallery);
                $('#product_quickview_desc').html(data.product_desc);
                $('#product_quickview_content').html(data.product_content);*/
            }
        });
    });
});

$(document).on('click', '.quickview-close, .quickviewOverlay', function(e) {
    $(".wrapper-quickview").fadeOut(500);
    $('.jsQuickview').fadeOut(500);
});

$(document).on('change', '#quantity-quickview', function() {
    if ($(this).val() > 1) {
        var a = $(this).val();
        //   $(".optionChange").trigger('change');

        let url2 = $('#buyCartQuickView').attr('href');
        url2 += "?quantity=" + $('#quantity-quickview').val();
        $('#buyCartQuickView').attr('href', url2);
    }
});

$('.nav-item').hover(function() {
    $('.nav-item').removeClass('active_menu');
    $(this).addClass('active_menu');
    $('.box-form-slide').css('z-index', 0);
})

$('.nav-sub-item').hover(function() {
    let id = $(this).attr('data-id');

    $('.nav-sub-item').removeClass('active');
    $(this).parents('.menu-dropdown').find('.sub-nav-right').removeClass('active');
    $(this).addClass('active');
    $('#' + id).addClass('active');
})



// $('.nav-hover').each(function () {
//     $(this).mouseenter(function () {
//         $(this).find('.lc__dropdown-menu').addClass('lc__block');
//         $('.lc__dropdown-menu').is('.lc__block') && $('.lc__mask').addClass('lc__block').css('z-index', '1060');
//         $('.lc__header-searchbar .lc__suggestion,.lc__header-searchbar .lc__history').hide();
//     }).mouseleave(function () {
//         $('.lc__mask, .lc__dropdown-menu').removeClass('lc__block').css('z-index', '1059');
//     });
// });

// ajax load form
$(document).on('submit', "[data-ajax='submit']", function() {
    let myThis = $(this);
    let formValues = $(this).serialize();
    let dataInput = $(this).data();
    // dataInput= {content: "#content", href: "#modalAjax", target: "modal", ajax: "submit", url: "http://127.0.0.1:8000/contact/store-ajax"}

    $.ajax({
        type: dataInput.method,
        url: dataInput.url,
        data: formValues,
        dataType: "json",
        success: function(response) {
            if (response.code == 200) {
                myThis.find('input:not([type="hidden"]), textarea:not([type="hidden"])').val('');
                if (dataInput.content) {
                    $(dataInput.content).html(response.html);
                }
                if (dataInput.target) {
                    switch (dataInput.target) {
                        case 'modal':
                            $(dataInput.href).modal();
                            break;
                        case 'alert':
                            Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: response.html,
                                showConfirmButton: false,
                                timer: 1500
                            });
                        default:
                            break;
                    }
                }
            } else {
                Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: response.html,
                    showConfirmButton: false,
                    timer: 1500
                });
            }

            // console.log( response.html);
        },
        error: function(response) {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Your work has been saved',
                showConfirmButton: false,
                timer: 1500
            });
        }
    });
    return false;
});
</script>