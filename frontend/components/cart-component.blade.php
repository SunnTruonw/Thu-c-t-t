@if(!empty($data) && $totalQuantity > 0)

<div class="col-lg-8 col-sm-12 col-12">
{{-- @foreach($data as $cartItem) --}}
<div class="cart-bottom cart-bottom-v3">
    <div class="cart-bottom__title bg-white">
        <h3 class="ttile">CÓ {{ $totalQuantity }} SẢN PHẨM TRONG GIỎ HÀNG</h3></div>
    <div class="cart-bottom__product">
        @foreach($data as $cartItem)
            <div class="cart-product">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <div class="u-flex no-gutters">
                            <div class="cart-img m-r-8">
                                <a href="{{$cartItem['slug_full'] ?? ''}}">
                                    <img
                                        src="{{ $cartItem['avatar_path'] }}"
                                        alt="{{$cartItem['name'] ?? ''}}"
                                    />
                                </a>
                            </div>
                            <div class="col cart-info">
                                <h3 class="cart-tit truncate2 m-b-8 m-b-md-0">
                                    <a href="{{$cartItem['slug_full'] ?? ''}}" class="txt-primary-700">{{$cartItem['name'] ?? ''}}</a>
                                </h3>
                                <div class="none-block m-t-8 m-b-12">
                                    <div class="u-flex no-gutters justify-content-between">
                                        <div class="col">
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-select cart-spon-md js-select">
                                    <div class="row align-items-center no-gutters">
                                        <div class="col-auto"><span class="txt-gray-600 fs-p-16">Đơn vị bán:</span></div>
                                        <div class="col">
                                            <div class="u-flex flex-wrap align-items-center no-gutters">
                                                <div class="col-auto"><p class="f-w-500 fs-p-16 txt-gray-600">{{ isset($cartItem['size'])?$cartItem['size']:'' }}</p></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-12">
                        <div class="col-right block-none cart-item">
                            <div class="wrapper-cart-mobile">
                                <div class="quantity-cart">
                                    <div class="box-quantity text-center">
                                        <span class="prev-cart">-</span>
                                        <input class="number-cart" data-url="{{ route('cart.update',[
                                            'id'=> $cartItem['id'],
                                            'option'=>$cartItem['option_id'],
                                            ]) }}" value="{{ $cartItem['quantity']}}" type="number" id="" name="quantity" disabled="disabled">
                                        <span class="next-cart">+</span>
                                    </div>
                                </div>
                                <div class="cart-prices txt-right new-price-cart">{{ number_format($cartItem['totalPriceOneItem']) }}đ</div>
                            </div>
                            <div class="link-group m-t-6">
                                <div class="u-flex no-gutters justify-end">
                                    {{-- <div class="col-auto"><span class="link"><i class="fa fa-bookmark"></i> Mua sau </span></div> --}}
                                    {{-- <div class="col-auto"><span class="txt-gray-400">|</span></div> --}}
                                    <div class="col-auto"><span class="link js-remove"> 
                                        <a data-url="{{ route('cart.remove',[
                                        'id'=> $cartItem['id'],
                                        'option'=>$cartItem['option_id'],
                                        ]) }}" class="remove-cart"><i class="fa fa-trash"></i> Xóa</a> 
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <div class="cart-bottom__form bg-white">
        <form action="" id="shoppingCart">
            <div class="row">
    
                <div class="col-12">
                    <div class="u-flex flex-wrap no-gutters check-form-create-comment">
                        <div class="radio radio-sm danh-xung-comment danh-xung-gender">
                            <label class="d-flex align-items-center">
                                <input type="radio" name="gender" value="1">
                                Anh
                            </label>
                        </div>
                        <div class="radio radio-sm danh-xung-comment danh-xung-gender" data-id="2">
                            <label class="d-flex align-items-center">
                                <input type="radio" name="gender" value="2">
                                Chị
                            </label>
                        </div>
                    </div>
                    <div class="form-err txt-left" id="errorGender" style="display: none;">
                        <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                             <i class="fas fa-minus alert-ic bg-danger"></i>
                            <span class="">Thông tin bắt buộc</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <input type="text" name="nameCart" class="form-control radius-8-mb" placeholder="Nhập họ và tên" id="nameCart" maxlength="50">
                    </div>
                    <div class="form-err txt-left" id="errorNameCart" style="display: none;">
                        <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                             <i class="fas fa-minus alert-ic bg-danger"></i>
                            <span class="">Thông tin bắt buộc</span>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <input type="tel" maxlength="10" name="phoneCart" class="form-control radius-8-mb" placeholder="Nhập số điện thoại" id="phoneCart">
                    </div>
                    <div class="form-err txt-left" id="errorPhoneCart" style="display: none;">
                        <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                             <i class="fas fa-minus alert-ic bg-danger"></i>
                            <span class="error-phone-cart--text">Thông tin bắt buộc</span>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-group">
                        <input type="email" name="emailCart" id="emailCart" class="form-control" placeholder="Nhập email (Không bắt buộc)">
                    </div>
                    <div class="form-err txt-left email-error" id="errorEmailCart" style="display: none;">
                        <div class="alert alert-md alert-danger alert-des alert-sm-md " style="display: inline;">
                             <i class="fas fa-minus alert-ic bg-danger"></i>
                            <span class="">Email không hợp lệ</span>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="cart-tax m-t-16">
                <div class="form-groups">
                    <div class="checkbox checkbox-sm form-check-error align-items-center check-tax js-check-tax">
                        <input type="checkbox" name="tax" id="tax" /><label for="tax">Yêu cầu xuất hoá đơn công ty</label>
                    </div>
                </div>
            </div>
    
            <div id="bill" style="display :none;">
                <div class="row">
                    <div class="col-12">
                        <div class="u-flex flex-wrap no-gutters check-form-create-comment">
                            <div class="radio radio-sm danh-xung-comment danh-xung-eInvoiceType">
                                <label class="d-flex align-items-center">
                                    <input type="radio" name="eInvoiceType" value="1">
                                    Công ty
                                </label>
                            </div>
                            <div class="radio radio-sm danh-xung-comment danh-xung-eInvoiceType" data-id="2">
                                <label class="d-flex align-items-center">
                                    <input type="radio" name="eInvoiceType" value="2">
                                    Cá nhân
                                </label>
                            </div>
                        </div>
                        <div class="form-err txt-left" id="erroreInvoiceType" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="text" name="companyName" class="form-control radius-8-mb" placeholder="Nhập tên công ty" id="companyName" maxlength="50">
                        </div>
                        <div class="form-err txt-left" id="errorCompanyName" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="form-group">
                            <input type="tel" maxlength="10" name="companyTax" class="form-control radius-8-mb" placeholder="Nhập mã số thuế" id="companyTax">
                        </div>
                        <div class="form-err txt-left" id="errorCompanyTax" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="text-phone-error-comment">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" name="companyAddress" id="companyAddress" class="form-control" placeholder="Nhập địa chỉ công ty">
                        </div>
                        <div class="form-err txt-left email-error" id="errorCompanyAddress" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md " style="display: inline;">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="hinhthuc_thanhtoan">
                    <div class="col-12">
                        <div class="ttile">Chọn hình thức nhận hàng</div>
                        <div class="u-flex flex-wrap no-gutters check-form-create-comment">
                            <div class="radio radio-sm danh-xung-comment danh-xung-hiddenLocation">
                                <label class="d-flex align-items-center">
                                    <input type="radio" name="hiddenLocation" value="1">
                                    Nhận tại nhà thuốc
                                </label>
                            </div>
                            <div class="radio radio-sm danh-xung-comment danh-xung-hiddenLocation">
                                <label class="d-flex align-items-center">
                                    <input type="radio" name="hiddenLocation" value="2">
                                    Giao hàng tận nơi
                                </label>
                            </div>
                        </div>
                        <div class="form-err txt-left" id="errorhiddenLocation" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="u-flex">
                            <div class="form-group row">
                                <div class="col">
                                    <select name="city_id" id="city" class="form-control w-200 @error('city_id') is-invalid  @enderror"  data-url="{{ route('ajax.address.districts') }}">
                                        <option value="">Chọn tỉnh/Thành phố</option>
                                        {!! $cities !!}
                                    </select>
                                    <div class="form-err txt-left" id="errorCity" style="display: none;">
                                        <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                             <i class="fas fa-minus alert-ic bg-danger"></i>
                                            <span class="">Thông tin bắt buộc</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col">
                                    <select name="district_id" id="district" class="form-control w-200 @error('district_id') is-invalid @enderror"  data-url="{{ route('ajax.address.communes') }}" >
                                        <option value="">Chọn quận/huyện</option>
                                    </select>
                                    <div class="form-err txt-left" id="errorDistrict" style="display: none;">
                                        <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                             <i class="fas fa-minus alert-ic bg-danger"></i>
                                            <span class="">Thông tin bắt buộc</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="address">
                            <div class="form-group">
                                <input type="text" name="addressCart" id="addressCart" class="form-control" placeholder="Nhập địa chỉ">
                            </div>
                            <div class="form-err txt-left" id="errorAddressCart" style="display: none;">
                                <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                     <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="">Thông tin bắt buộc</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="row">
                <div class="hinhthuc_thanhtoan">
                    <div class="col-12">
                        <div class="ttile">Chọn hình thức thanh toán</div>
                        <div class="check-form-create-comment">
                            <div class="radio radio-sm danh-xung-comment danh-xung-payment">
                                <label class="d-flex align-items-center">
                                    <input type="radio" name="payment" value="1">
                                    Thanh toán tiền mặt khi nhận hàng
                                </label>
                            </div>
                        </div>
                        <div class="form-err txt-left" id="errorpayment" style="display: none;">
                            <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                 <i class="fas fa-minus alert-ic bg-danger"></i>
                                <span class="">Thông tin bắt buộc</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
{{-- @endforeach --}}
</div>
<div class="col-lg-4 col-sm-12 col-12">
    <div class="cart-cta radius-12 radius-none">
        <div class="cart-cta__title">
            <h3 class="u-flex">
                <i class="fa fa-shopping-bag" style="margin-right: 5px;"></i> THÔNG TIN ĐƠN HÀNG</h3>
        </div>
        <div class="cart-cta__total">
            <div class="u-flex"><span class="txt-gray">Tổng tiền</span>
            <span class="txt-gray total-price">{{ number_format($totalPrice) }}đ</span></div>
            <div class="u-flex">
                <span class="txt-gray">Khuyến mãi giảm</span><span class="txt-gray">0đ</span>
            </div>
            <div class="u-flex textCanThanhToan">
                <span class="txt-gray">Cần thanh toán</span>
                <span class="total-price">{{ number_format($totalPrice) }}đ</span>
            </div>
        </div>
        <div class="cart-cta__btn txt-center">
            <button class="btn btn-md btn-primary txt-red js-btn-shopping-cart" data-url="{{route('cart.order.submit')}}"><span>HOÀN TẤT ĐẶT HÀNG</span></button>
            <div class="txt-gray block-none">
                Bằng cách đặt hàng, bạn đồng ý với <br />
                <a href="/tos" class="txt-gray underline">Điều khoản sử dụng</a> của Thuốc tốt
            </div>
        </div>
    </div>
    
</div>

{{-- @else
    <div class="cart-staus txt-center">
        <a href="title-status">Chưa có sản phẩm nào trong giỏ hàng</a>
    </div>
    <a href="{{makeLink('home')}}" class="btn btn-md btn-primary txt-red"><span>Tiếp tục mua sắm</span></button> --}}
@endif