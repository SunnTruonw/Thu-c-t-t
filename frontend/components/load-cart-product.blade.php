@foreach($data as $cartItem)
<div class="notify-item box-b-1">
    <div class="u-flex">
        <div class="item-img">
            <a href="{{$cartItem['slug_full'] ?? ''}}">
                <img
                    src="{{ $cartItem['avatar_path'] }}"
                    alt="{{ $cartItem['name'] }}"
                />
            </a>
        </div>
        <div class="item-info">
            <a href="{{$cartItem['slug_full'] ?? ''}}" class="txt-gray-700 truncate2">
                {{ $cartItem['name'] }}
            </a>
            <div class="d-flex justify-between align-items-center mt-4">
                <div class="product-count d-flex">
                    <div class="quantity-cart cart-item">
                        {{-- <div class="box-quantity text-center">
                            <span class="prev-cart">-</span>
                            <input class="number-cart" data-url="{{ route('cart.update',[
                                'id'=> $cartItem['id'],
                                'option'=>$cartItem['option_id'],
                                ]) }}" value="{{ $cartItem['quantity']}}" type="number" id="" name="quantity">
                            <span class="next-cart">+</span>
                        </div> --}}
                        <input class="number-cart form-control" data-popup="popup" max="10" data-url="{{ route('cart.update',[
                            'id'=> $cartItem['id'],
                            'option'=>$cartItem['option_id'],
                            'type' => 'popup'
                            ]) }}" value="{{ $cartItem['quantity']}}" type="number" id="" name="quantity">
                    </div>
                </div>
                <div class="d-flex justify-end align-items-center flex-wrap">
                    <strong class="txt-gray-700 new-price-cart">{{ number_format($cartItem['totalPriceOneItem']) }}đ</strong>

                    <span class="txt-gray-400 p-x-8">|</span>
                    <a data-url="{{ route('cart.remove',[
                        'id'=> $cartItem['id'],
                        'option'=>$cartItem['option_id'],
                        'type' => 'popup'
                        ]) }}" data-popup="popup" class="cursor-pointer btnRemoveHeader remove-cart">Xóa
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach