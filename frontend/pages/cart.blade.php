@extends('frontend.layouts.main')
@section('title', __('contact.gio_hang'))
@section('css')

@endsection
@section('content')
    <div class="content-wrapper">
        <div class="main">
            <div class="text-left wrap-breadcrumbs">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <ul class="breadcrumb">
                                <li class="breadcrumbs-item">
                                    <a href="{{ makeLink('home') }}">{{ __('home.home') }}</a>
                                </li>
                                <li class="breadcrumbs-item active"><a href="#" class="currentcat">{{ __('contact.gio_hang') }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
			<div class="box_cart">
				<div class="container container-cart">
					<div class="row">
						<div class="col-sm-12 col-12">
                            {{-- @if(!empty($data)) --}}
                                <div class="row cart-wrapper">
                                        @include('frontend.components.cart-component',[
                                            'data' => $data,
                                            'cities' => $cities,
                                    ])
                                </div>
                            {{-- @else
                                <div class="col-12">
                                    <div class="cart-cta__btn txt-center">
                                        <a href="title-status">Chưa có sản phẩm nào trong giỏ hàng</a>
                                        <a href="{{makeLink('home')}}" class="btn btn-md btn-primary txt-red"><span>Tiếp tục mua sắm</span></button>
                                    </div>
                                </div>
                            @endif --}}
						</div>
					</div>
				</div>
			</div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('frontend/js/load-address.js') }}"></script>
<script>
    $(document).on('click','.btn-colsap',function(){
        $('#list-thanhtoan').find('.active').removeClass('active');
        $(this).addClass('active');
        $(this).parent('.colsap').addClass('active');
        let value= $(this).parent('.colsap.active').data('value');
        $('#hinhthuc').val(value);
        console.log(value);
        $('#list-thanhtoan').find('.colsap:not(".active") .content-colsap').slideUp();
            $(this).parent('.colsap.active').find('.content-colsap').slideDown();
    });
    $("#chinhanh").change(function () {
        var id = $(this).val();
        if (id != "0") {
            $(".list-chinhanh #cn_" + id).addClass("active").siblings().removeClass("active");
        }
        else
            $(".list-chinhanh .item").removeClass("active");
    });
</script>


<script type="text/javascript">
    $(document).ready(function() {
        $("#buynow").submit(function() {

            var msg = "";

            if (buynow.email.value == '') {
                msg += "+ Vui lòng nhập tên của bạn \n";
            }

            if (buynow.phone.value == '') {
                msg += "+ Vui lòng nhập số điện thoại của bạn \n";
            }

            if (buynow.email.value == '') {
                msg += "+ Vui lòng nhập email của bạn \n";
            }


            if (buynow.city_id.value == '') {
                msg += "+ Vui lòng chọn tỉnh/thành phố \n";
            }

            if (buynow.district_id.value == '') {
                msg += "+ Vui lòng chọn quận huyện \n";
            }

            if (buynow.commune_id.value == '') {
                msg += "+ Vui lòng chọn phường xã \n";
            }


            if (buynow.address_detail.value == '') {
                msg += "+ Vui lòng nhập địa chỉ của bạn \n";
            }

           


            if (msg != "") {
                alert("Vui lòng nhập đầy đủ thông tin các thông tin sau:\n" + msg);
                return false;
            } else {
                return true;
            }



            return false;
        });

        // het 
        $("#tax").click(function() {
			if($(this).is(":checked")) {
				$('#bill').show();
			}else{
				$('#bill').hide();
			}
        });

    });


    


</script>
@endsection
