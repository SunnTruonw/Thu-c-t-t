@extends('frontend.layouts.main')
@section('title', $header['seo_home']->name)
@section('image', asset($header['seo_home']->image_path))
@section('keywords', $header['seo_home']->slug)
@section('description', $header['seo_home']->value)
@section('abstract', $header['seo_home']->slug)

@section('content')
<style type="text/css">
    .search_desktop{
        display: none;
    }

    @media(max-width: 991px){
        .list-bar{
            top: 50%;
        }
    }
</style>
<div class="lc__mask lc__mask_search_suggest"></div>
<div class="content-wrapper">
    <div class="main">
        <div class="wrap-slide-home">
            <div class="slide">
                @isset($slider)
                    <div class="box-slide faded cate-arrows-1">
                        @foreach ($slider as $item)
                        <div class="item-slide">
                            <a href="{{ $item->slug }}"><img src="{{ asset($item->image_path) }}" alt="{{ $item->name }}"></a>
                        </div>
                        @endforeach
                    </div>
                    
                    
                @endisset
            </div>
        </div>
        <div class="bg_hoa section-search">
            <div class="container">
				<div class="row">
                    <div class="col-12 col-sm-12">
						<div class="box-form-slide">
							<div class="tim-tour-title">
								Nhập từ khóa tìm kiếm trên Thuốc Tốt 365...
							</div>
							<form action="{{ makeLink('search') }}" autocomplete="off" method="GET">
								<div class="content-search-tour">
									<div id="vnt-sidebar">
										<div class="boxFilterSearch">
											<div class="content">
												<div class="form-group s-item form-input">
													<div class="formFa">
														<input name="keyword" class="form-control js-input-search" placeholder="Nhập từ khóa tìm kiếm" />
														<button type="submit" class="btn-search-slide"> <i class="fas fa-search"></i> </button>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
								@if(isset($header['search_top']) && $header['search_top'])
									<div class="section-keywords bg-while">
										<div class="p-x-md-0">
											<div class="box-title text-center m-b-16 m-b-md-12">
												<div class="u-flex justify-between align-items-center">
													<h2 class="u-flex align-items-center fs-p-20 fs-p-md-16 txt-gray-900">
														<i class="fas fa-poll m-r-8"></i>
														{{$header['search_top']->name}}
													</h2>
												</div>
											</div>
											<div class="section-keywords-body">
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
							</form>
						</div>
                    </div>
                </div>
            </div>
        </div>
        {{--
		@if (isset($hotro)&&$hotro)
		<div class="support">
			<div class="container">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="group-title">
                            <div class="title title-img">{{ $hotro->name }}</div>
                        </div>
                    </div>
                    @foreach ($hotro->childs()->where('active',1)->orderby('order')->latest()->get() as $item)
                        @php
                            $tran=$item->translationsLanguage()->first();
                        @endphp
                        <div class="col-xs-4 item">
                            <div class="box_item">
                                <div class="icon">
                                    <img src="{{ $item->image_path != null ?  asset($item->image_path) : asset('frontend/images/no-images.jpg') }}" alt="{{ $tran->name }}">
                                </div>
                                <div class="info">
                                    <div class="title">{{ $tran->name }}</div>
                                    <div class="desc">
                                        <p>{!! $tran->value !!}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                     @endforeach
                     <div class="col-12 col-sm-12 text-center">
                        <div class="btn-mua-thuoc-ngay">
                            <a href="" class="btn btn-lg btn-primary circle text-uppercase">
                                MUA THUỐC NGAY
                            </a>
                            @if(isset($header['tai_sao1']->slug) && $header['tai_sao1']->slug)
                            <a href="tel:{{ $header['tai_sao1']->slug }}" class="link-hotline">Hoặc mua qua hotline
                                <strong>{{ $header['tai_sao1']->slug }}</strong>
                            </a>
                            @endif
                        </div>
                    </div>
				</div>
			</div>
		</div>
        @endif
        --}}
		<div class="box_flash_sale">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="col-inner">
                            <div class="section-title-container">
                                <h2 class="section-title section-title-center">
                                    FLASH SALE GIỜ VÀNG
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
						@if( isset($productsBest) && $productsBest->count()>0 )
                            <div class="list_feedback1 autoplay6-tintuc category-slide-1">
                                @foreach ($productsBest as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                @endphp
                                <div class="box-product-item">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : asset('frontend/images/no-images.jpg') }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">{{ceil(100 -($product->price)*100/($product->old_price))."%"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                @if ($product->old_price && $product->price)
                                                    <div class="cart">
                                                        <span class="addCart add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                                            <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                                        </span>
                                                    </div>
                                                @endif
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
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="section_category_products">
			<div class="ss04_category_product">
				<div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <div class="group-title">
                                <div class="title title-img">Danh mục nổi bật</div>
                            </div>
                        </div>
                    </div>
                    @if (isset($categories)&&$categories)
                    <div class="box-ovf-x">
                        @php
                            $categories2 = $categories->split(2);
                            $k = 0;
                        @endphp
                        @foreach ($categories2 as $item)
                            @php
                                $k++;
                            @endphp
                            <div class="row list-{{$k}}">
                                @foreach ($item as $category)
                                    @php
                                        $categoryProduct = new App\Models\CategoryProduct;
                                        $product = new App\Models\Product;
                                        $listIdCate = $categoryProduct->getALlCategoryChildrenAndSelf($category->id);
                                        $count = $product->whereIn('category_id', $listIdCate)->where('active', 1)->get()->count();
                                        $link=$category->slug_full;
                                    @endphp
                                    <div class="col-2 col-reset">
                                        <div class="product-item">
                                            <div class="box">
                                                <div class="image">
                                                    <a href="{{ $link }}">
                                                        <img src="{{ $category->icon_path != null ? asset($category->icon_path) : '../frontend/images/noimage.png' }}" alt="{{ $category->name }}">
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h3><a href="{{ $link }}">{{ $category->name }}</a></h3>
                                                    <div class="count-product text-center">
                                                        <p>{{$count}} sản phẩm</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endforeach
                    </div>
                    @endif
				</div>
			</div>
		</div>

        <div class="section-hau-covid">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="col-inner">
                            <div class="section-title-container">
                                <h2 class="section-title section-title-center">
                                    <i class="fa fa-plus-circle" aria-hidden="true"></i>Sản Phẩm Hậu Covid
                                </h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-12">
						@if( isset($productsBest) && $productsBest->count()>0 )
                            <div class="list_feedback1 autoplay6-tintuc category-slide-1">
                                @foreach ($productsBest as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                @endphp
                                <div class="box-product-item">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : asset('frontend/images/no-images.jpg') }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">{{ceil(100 -($product->price)*100/($product->old_price))."%"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                @if ($product->old_price && $product->price)
                                                    <div class="cart">
                                                        <span class="addCart add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                                            <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                                        </span>
                                                    </div>
                                                @endif
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
		<div class="ss03_product">
			<div class="container">
				<div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="col-inner">
                            <div class="section-title-container">
                                <h2 class="section-title section-title-center">
                                    <i class="fa fa-fire" aria-hidden="true"></i> Bán Chạy Nhất
                                </h2>
                            </div>
                        </div>
                    </div>
					<div class="col-12 col-sm-12">
						@if( isset($productHot) && $productHot->count()>0 )
                            <div class="list_feedback1 autoplay6-tintuc category-slide-1">
                                @foreach ($productHot as $product)
                                @php
                                    $tran=$product->translationsLanguage()->first();
                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                @endphp
                                <div class="box-product-item">
                                    <div class="product-item">
                                        <div class="box">
                                            <div class="image">
                                                <a href="{{ $link }}">
                                                    <img src="{{ $product->avatar_path != null ?  asset($product->avatar_path) : asset('frontend/images/no-images.jpg') }}" alt="{{ $tran->name }}">
                                                    @if ($product->old_price && $product->price)
                                                        <span class="sale">{{ceil(100 -($product->price)*100/($product->old_price))."%"}} </span>
                                                    @endif
                                                    @if($product->baohanh)
                                                        <div class="km">
                                                            {{ $product->baohanh }}
                                                        </div>
                                                    @endif
                                                </a>
                                                @if ($product->old_price && $product->price)
                                                    <div class="cart">
                                                        <span class="addCart add-to-cart" data-url="{{ route('cart.add',['id' => $product->id]) }}" data-start="{{ route('cart.add',['id' => $product->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}">
                                                            <img class="lazy" src="{{ asset('images/icon_add_cart.png')}}" width="30" height="35"> Thêm vào giỏ
                                                        </span>
                                                    </div>
                                                @endif
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @if(isset($supports) && $supports)
            <div class="box_ss_06">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-lg-3">
                            <div class="title_box_ss_06">
                                <h2>{{$supports->name}}</h2>
                                <p>{{$supports->slug}}</p>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-lg-9">
                            <div class="row">
                                @if($supports->childs()->count() > 0)
                                    @foreach($supports->childs()->where('active', 1)->orderBy('order')->get() as $value)
                                        <div class="col-4 col-sm-4 col-md-4 item">
                                            <div class="box_item">
                                                <div class="icon">
                                                    <img src="{{asset($value->image_path)}}" alt="{{$value->name}}">
                                                </div>
                                                <div class="info">
                                                    <div class="title">{{$value->name}}</div>
                                                    <div class="desc">
                                                        <p><a href="{{asset($value->slug)}}">Xem thêm <i class="fas fa-angle-right"></i></a></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if (isset($products)&&$products)
            <div class="ss05_product">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="title_home_in">
                                <h2><i class="fas fa-users"></i> Sản phẩm theo đối tượng</h2>
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6">
                            <div class="lc__box-filter">
                                <div class="lc__box-filter-item">
                                    <div class="lc__box-filter-title">
                                        <span>Lọc theo</span>
                                    </div>
                                    @if(isset($attributes) && $attributes)
                                        <div class="lc__box-filter-desc">
                                            <ul class="filter-main">
                                                @foreach($attributes->childs()->where('active', 1)->orderBy('order')->latest()->limit(3)->get() as $attributeItem)
                                                    <li class="item-filter-desc @if($loop->first) active @endif" data-id="{{ $attributeItem->id }}">{{$attributeItem->name}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if (isset($products)&&$products)
                            <div class="col-sm-12 col-12 padding_none">
                                <div class="list-product list_feedback1">
                                    <div class="row" id="dataProductSearch">
                                        @php
                                            $chunk = $products->chunk(5);
                                        @endphp
                                        @foreach ($chunk as $item)
                                        <div class="col-sm-12 col-12">
                                            <div class="list_nowrap">
                                                <div class="row">
                                                    @foreach ($item as $product)
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
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>	
        @endif
        
			
        @if(isset($post_home))
            <section class="section section-3">
                <div class="container">
                    <div class="row row-element">
                        <div class="">
                            <div class="title_home_in">
                                <h2><i class="fas fa-users"></i> Tin tức mới nhất</h2>
                            </div>
                        </div>
                        @if(isset($postTitle))
                            <div class="">
                                <div class="title_home_in_xemthe">
                                    <a href="{{$postTitle->slug_full}}">Xem Tất Cả</a>
                                </div>
                            </div>
                        @endif
                    </div>
                    <div class="row">
                        {{--
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
							@foreach($post_home as $post)
                                @if($loop->first)
                                    @php
                                        $tran=$post->translationsLanguage()->first();
                                        $link=$post->slug_full;
                                    @endphp
                                    <div class="col-inner">
                                        <a href="{{$link}}" class="plain">
                                            <div class="box box-normal box-text-bottom box-blog-post has-hover">
                                                <div class="box-image">
                                                    <a href="{{$link}}"><img  src="{{asset($post->avatar_path)}}" alt="{{$tran->name}}">
                                                </div>
                                                <div class="box-text text-left">
                                                    <div class="box-text-inner blog-post-inner">
                                                        <h5 class="post-title is-large text-left ">{{$tran->name}}</h5>
														<p><i class="fas fa-clock"></i> {{ Illuminate\Support\Carbon::parse($post->created_at)->format('d/m/Y') }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                @endif
							@endforeach
                        </div>
                        --}}
                        
						<div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="list-news2">
                                @foreach($post_home as $post)
                                @if($loop->first)
                                @else
                                @php
                                    $tran=$post->translationsLanguage()->first();
                                    $link=$post->slug_full;
                                @endphp
                                <div class="list-news2-item">
                                    
                                        <div class="image">
                                            <a href="{{$link}}"><img src="{{asset($post->avatar_path)}}" alt="{{$tran->name}}"></a>
                                        </div>
                                        <div class="info">
                                            <h3><a href="{{$link}}">{{$tran->name}}</a></h3>
                                            <p><i class="fas fa-clock"></i> {{ Illuminate\Support\Carbon::parse($post->created_at)->format('d/m/Y') }}</p>
                                            <div class="cate_news">
                                                <a href="{{$post->category->slug_full}}">{{$post->category->name}}</a>
                                            </div>
                                        </div>

                                </div>
                                @endif
								@endforeach
                             </div>
                        </div>
                    </div>
                </div>
            </section>
			@endif
    </div>
</div>


        </div>
        
        @if (isset($modalHome)&&$modalHome)
        <div class="modal fade modal-First" id="modal-first" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content"  image="">

                    <div class="modal-body">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            {{--
                            <span aria-hidden="true">&times;</span>
                            --}}
                        </button>

                        <div class="image-modal">
                            <div class="image">
                                <img src="{{ asset($modalHome->image_path) }}" alt="">
                            </div>
                            <div class="newsletter-content">
                                {{--<h4>Up to <span>20% Off</span></h4>--}}
                                <h2>{{ $modalHome->name }}</h2>
                                <div class="dec">{!! $modalHome->description !!}</div>
                                <form action="{{ route('contact.storeAjax') }}"  data-url="{{ route('contact.storeAjax') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST" class="input-wrapper input-wrapper-inline input-wrapper-round">
                                    @csrf
                                    <input type="text" class="form-control" name="name" placeholder="Họ tên *">
                                    <input type="text" class="form-control" name="phone" placeholder="Số điện thoại *" required>
                                    <input type="text" class="form-control" name="content" placeholder="Sản phẩm mua *" required>
                                    <button>Đăng ký ngay <i class="fas fa-paper-plane"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif

    </div>
@endsection
@section('js')

    <script>
        $(function(){
            //search
            var width = $(window).width();
            function search_scroll() {
                let input = $('.js-input-search');

                input.click(function () {
                    previousScrollY = window.scrollY;
                    $('.lc__mask').addClass('lc__block').css({
                    'opacity': '1',
                    'z-index': '1049',
                    'visibility': 'visible'
                    });
                    $('.box-form-slide').css('z-index', 1059);
                    $(this).closest('.section-search').addClass('is-open')
                    // if (width > 992) {
                    //     $('html, body').animate({
                    //         scrollTop: $('.section-search').offset().top - 200
                    //     }, 800);
                    // };
                })
            };

            $('.lc__mask_search_suggest').click(function () {
                $(this).removeClass('lc__block').css({
                    'opacity': '0',
                    'visibility': 'hidden'
                });
                $('.box-form-slide').css('z-index', 0);
            });

            function init() {
                search_scroll();
            }

            init();
        });
    </script>
    <script>
        $(function(){
            $('a[data-toggle="pill"]').on('shown.bs.tab', function (e) {
              $('.autoplay4-pro').slick('setPosition');
            });
        });
        // setTimeout(() => $('#modal-add-cart').modal('show'), 10000);
    </script>
    <script>
        $(function() {
            var now = new Date();
            var date = now.getDate();
            var month = (now.getMonth()+1);
            var year =  now.getFullYear();
            var timer;
                var then = year+'/'+month+'/'+date+' 23:59:59';
                var now = new Date();
                var compareDate = new Date(then) - now.getDate();
                timer = setInterval(function () {
                    timeBetweenDates(compareDate);
                }, 1000);
                function timeBetweenDates(toDate) {
                    var dateEntered = new Date(toDate);
                    var now = new Date();
                    var difference = dateEntered.getTime() - now.getTime();
                    if (difference <= 0) {
                        clearInterval(timer);
                    } else {
                        var seconds = Math.floor(difference / 1000);
                        var minutes = Math.floor(seconds / 60);
                        var hours = Math.floor(minutes / 60);
                        var days = Math.floor(hours / 24);
                        hours %= 24;
                        minutes %= 60;
                        seconds %= 60;
                        $("#days").text(days);
                        $("#hours").text(hours);
                        $("#minutes").text(minutes);
                        $("#seconds").text(seconds);
                    }
                }
            });
    </script>
@endsection
