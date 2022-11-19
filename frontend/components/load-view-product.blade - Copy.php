<div class="ss06_product">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-12">
                <div class="title_home_in">
                    <h2><i class="fas fa-eye"></i> Sản phẩm vừa xem</h2>
                </div>
            </div>
            <div class="col-sm-12 col-12">
                @if( isset($products) && $products->count()>0 )
                <div class="list-product list_feedback1">
                    <div class="row">
                        @foreach ($products as $product)
                        @php
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
                                            @if (isset($data->price) && $data->price > 0)  
                                            <span class="addCart add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                                <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                            </span>
                                            @else
                                                <span class="addCart" data-toggle="modal" data-target="#modal-add-cart_{{$product->id}}">
                                                    <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                                </span>
                                            @endif
                                        </div>
                                        {{-- model-add-cart --}}
                                        <div class="modal fade modal-First" id="modal-add-cart_{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content"  image="">
                                                    <div class="modal-body">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        </button>
                                                        <div class="image-modal">
                                                            <div class="info_product_modal">
                                                                <div class="title">
                                                                    {{ $product->name }}
                                                                </div>
                                                                <div class="image">
                                                                    <img src="{{ asset($product->avatar_path) }}" alt="{{ $product->name }}">
                                                                </div>
                                                                <div class="list-attr">
                                                                    <div class="attr-item">
                                                                        <div class="price">
                                                                            @if ($product->price)
                                                                                @if ($product->price_after_sale)
                                                                                    <span id="priceChange">Giá: {{ number_format($product->price_after_sale) }} <span class="donvi">đ</span></span>
                                                                                @endif
                                                                                @if ($product->sale>0)
                                                                                    <span class="title_giacu">Giá cũ: </span>
                                                                                    <span class="old-price">{{ number_format($product->price) }} {{ $unit  }}</span>
                                        
                                                                                    <div class="tiet_kiem">
                                                                                        <div class="g2">(Tiết kiệm: <b>{{ number_format(
                                                                                            ($product->price - $product->price_after_sale)) }}</b>)</div>
                                                                                        <div class="tk">
                                                                                            <b>-{{ $product->sale }}%</b>
                                                                                        </div>
                                                                                    </div>
                                                                                @endif
                                                                            @else
                                                                            Liên hệ
                                                                            @endif
                                                                        </div>
                                                                        <p>Giá bán lẻ đề xuất chưa bao gồm phí trước bạ và phí đăng ký (bao gồm VAT)</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                        
                                                            <div class="newsletter-content">
                                                                <h2>YÊU CẦU TƯ VẤN SẢN PHẨM</h2>
                                                                <form action="{{ route('contact.storeAjax2') }}"  data-url="{{ route('contact.storeAjax2') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST" class="input-wrapper input-wrapper-inline input-wrapper-round">
                                                                    @csrf
                                                                    <input type="text" class="form-control" name="content" placeholder="Sản phẩm muốn xem *" value="{{ $product->name }}" required>
                                                                    <input type="text" class="form-control" name="name" placeholder="Họ tên *">
                                                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại *" required>
                                                                    <input type="text" class="form-control" name="email" placeholder="Email của bạn">
                                                                    <button>Đăng ký ngay</button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
            @endif
        </div>
    </div>
</div>
</div>