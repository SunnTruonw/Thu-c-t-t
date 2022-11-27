@isset($data)
@if (isset($data)&&$data->count() > 0)

    @php
        $chunk = $data->chunk(5);
    @endphp
    @foreach ($chunk as $item)
    <div class="col-sm-12 col-12">
        <div class="list_nowrap">
            <div class="row">
                @foreach ($item as $product)
                    @php
                        $unit = 'đ';
                        $tran=$product->translationsLanguage()->first();
                        $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                    @endphp
                    <div class="col-product-item box_sp_home col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="product-item">
                            <div class="box">
                                <div class="image">
                                    <a href="{{ $link }}">
                                        <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : asset('frontend/images/no-images.jpg') }}" alt="{{ $tran->name }}">
                                        @if ($product->old_price && $product->price)
                                            <span class="sale">  {{ceil(100 -($product->price)*100/($product->old_price))."%"}} </span>
                                        @endif
                                        @if($product->baohanh)
                                            <div class="km">
                                                {{ $product->baohanh }}
                                            </div>
                                        @endif
                                    </a>
                                    <div class="cart">
                                        <span class="addCart add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                            <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                        </span>
                                    </div>
                                    {{-- <div class="pro-item-star">
                                        <span class="pro-item-start-rating">
                                            @php
                                                $avgRating = 0;
                                                $sumRating = array_sum(array_column($product->productStars->toArray(), 'star'));
                                                $countRating = count($product->productStars);
                                                if ($countRating != 0) {
                                                    $avgRating = $sumRating / $countRating;
                                                }
                                            @endphp
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= $avgRating)
                                                    <i class="star-bold far fa-star"></i>
                                                @else
                                                @endif
                                            @endfor
                                        </span>
                                    </div> --}}
                                </div>
                                <div class="content">
                                    <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
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
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
@else
<div class="col-md-12">
    <div class="empty__cate-img">
        <picture>
            <img src="{{asset('frontend/images/cate-empty.png')}}" alt="">
        </picture>
    </div>
    <h4 class="text-center empty__cate-title">Không tìm thấy sản phẩm phù hợp</h4>
</div>
@endif
@endisset
