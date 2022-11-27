<div class="ss06_product product-relate">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="title_home_in">
                    <h2><i class="fas fa-eye"></i> Sản phẩm vừa xem</h2>
                </div>
            </div>
            <div class="col-sm-12 col-12">
                @if( isset($products) && $products->count()>0 )
                <div class="list-product autoplay6-tintuc category-slide-1 list_feedback1" style="width:100%">
                    {{-- <div class="row"> --}}
                        @foreach ($products as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                @endphp
                                <div class="col-product-item">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ asset($product->avatar_path) }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">   {{ceil(100 -($product->price)*100/($product->old_price))." %"}} </span>
                                                    @endif

                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                            </div>
                                            {{--
                                            <div class="pro-item-star">
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
                                            </div>
                                            --}}

                                            <div class="content">
                                                <h3><a href="{{ $link }}">{{ $tran->name }}</a></h3>
                                                <div class="product-info__price">
                                                    @if ($product->price)
                                                    <span class="">{{ number_format($product->price) }}đ</span>
                                                        @if ($product->size)
                                                        {{ '/ '.$product->size }}
                                                        @endif
                                                    @else
                                                    <span class="">Liên hệ</span>
                                                    @endif
                                                    @if ($product->old_price>0)
                                                    <strike class="">{{ number_format($product->old_price) }}đ</strike>
                                                    @endif
                                                </div>
                                                @if (isset($product->price) && $product->price > 0)  
                                                    <div class="product-btn">
                                                        <button type="submit" id="addCart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}" class="add-to-cart single_add_to_cart_button button alt wow bounce" data-wow-duration="3s" data-wow-delay="2s">Chọn mua</button>
                                                    </div>
                                                @endif

                                            </div>

                                        </div>
                                    </div>
                                </div>
                    @endforeach
                {{-- </div> --}}
            </div>
            @endif
        </div>
    </div>
</div>
</div>