@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')

@section('content')
<style type="text/css">
    
   

    @media (max-width: 991px){
        .content_mucluc{
            position: relative;
        }
    }

    @media (max-width: 550px){
        .product-relate {
            padding: 15px 0;
        }
    }

</style>
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/css/xzoom/xzoom.css') }}">
    <script type="text/javascript" src="{{ asset('frontend/js/xzoom/xzoom.min.js') }}"></script>
    @if(Session::has('msg'))
    <script type="text/javascript">
        alert("{{ Session::get('msg') }}");
    </script>
    @endif
    <div class="content-wrapper">
        @isset($breadcrumbs,$typeBreadcrumb)
        @include('frontend.components.breadcrumbs',[
            'breadcrumbs'=>$breadcrumbs,
            'type'=>$typeBreadcrumb,
        ])
        @endisset
        
        <div class="main">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        @isset($slider)
                        {{--
                        <div class="slide-product-detail">
                              <div class="slider-product-detail faded-detail">
                                  @foreach ($slider as $item)
                                  <div class="slider-product-detail-item">
                                      <div class="slider-item-image">
                                          <img src="{{ $item->image_path }}" alt="{{ $item->name }}">
                                      </div>
                                  </div>
                                  @endforeach
                              </div>
                        </div>
                        --}}
                        @endisset
                        <div class="blog-product-detail" data-id="{{$data->id}}">
                   
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-left">
                                    <div class="row" >
                                        <div class="" id="dataProductSearch" style="width: 100%;">
                                            <div class="box-product-main">
                                                <div class="row" >
                                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                                                        {{--<p class="lc-detail-brand d-lg-none">
                                                            Thương hiệu: <span>Thuoctot365</span>
                                                        </p>--}}
                                                        <div class="title_sp_detail d-lg-none">
                                                            <div class="name">{{ $data->name }}</div>
                                                            <div class="pcd-rating">
                                                                <div class="pdc-title_serial txt-gray-400">
                                                                    (<span id="copy">{{ $data->masp }}</span>)
                                                                </div>
                                                                @if($data->comments()->count()>0)
                                                                    <ul class="rating-star pro-item-start-rating">
                                                                        @for($i = 1; $i <= 5; $i++)
                                                                            @if($i <= $avgRating)
                                                                                <i class="star-bold far fa-star"></i>
                                                                            @else
                                                                                <i class="far fa-star"></i>
                                                                            @endif
                                                                        @endfor
                                                                      
                                                                        <li class="txt-gray">
                                                                            <a class="link scroll-to-review">
                                                                                <span class="total-reviews">{{$countRating}}</span> Đánh giá
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="box-image-product">
                                                            <div id="img_{{ $data->id }}" class="image-main active">
                                                                <a class="hrefImg" href="{{ asset($data->avatar_path) }}" data-lightbox="image">
                                                                    <i class="fas fa-expand-alt"></i>
                                                                    <img class="expandedImg" src="{{  asset($data->avatar_path) }}" alt="{{ $data->name }}">
                                                                </a>
                                                                @if ($data->images()->count())
                                                                <div class="list-small-image">
                                                                    <div class="pt-box autoplay5-product-detail-new">
                                                                        <div class="small-image column">
                                                                            <img src="{{ asset($data->avatar_path) }}" alt="{{ asset($data->name) }}">
                                                                        </div>
                                                                        @foreach ($data->images as $image)
                                                                        <div class="small-image column" data-id_option="{{ $image->id }}">
                                                                            <img src="{{ asset($image->image_path) }}" alt="{{ $data->name }}">
                                                                        </div>
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                @endif
                                                            </div>
                                                            @if ($data->options()->count())
                                                                @foreach ($data->options as $item)
                                                                <div id="img_{{ $item->id }}" class="image-main">
                                                                    <a class="hrefImg" href="{{ asset($item->avatar_type) }}" data-lightbox="image">
                                                                        <i class="fas fa-expand-alt"></i>
                                                                        <img class="expandedImg" src="{{  asset($item->avatar_type) }}" alt="{{ $data->name }}">
                                                                    </a>
                                                                    @if ($item->images()->count())
                                                                    <div class="list-small-image">
                                                                        <div class="pt-box autoplay5-product-detail-new">
                                                                            <div class="small-image column">
                                                                                <img src="{{ asset($item->avatar_type) }}" alt="{{ asset($data->name) }}">
                                                                            </div>
                                                                            @foreach ($item->images as $image)
                                                                            <div class="small-image column" data-id_option="{{ $image->id }}">
                                                                                <img src="{{ asset($image->image_path) }}" alt="{{ $data->name }}">
                                                                            </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            @endif
                                                        </div>

                                                        <div class="product_sharing">
                                                            <ul class="fastcontact" style="text-align: center;">
                                                                <li>
																	@isset($header['hotline_top22'])
																		<i class="mli-phone"></i> <b>{{$header['hotline_top22']->name}}</b> <br>
																		<span style="color: #f00; font-weight: bold;">
																		<a style="color: #f00;" href="tel:{!!$header['hotline_top22']->value!!}">{!!$header['hotline_top22']->slug!!}</a> 
																	@endisset
                                                                </li>
                                                            </ul>
                                                        </div>

                                                    </div>
                                                    <div class="col-lg-6 col-md-12 col-sm-12 col-12 product-detail-infor">
                                                        <div class="box-infor">
                                                            {{--<p class="lc-detail-brand d-lg-block d-none">
                                                                Thương hiệu: <span>Thuoctot365</span>
                                                            </p>--}}
                                                            <div class="title_sp_detail d-lg-block d-none">
                                                                <h1 class="name">{{ $data->name }}</h1>
                                                                <div class="pcd-rating">
                                                                    <div class="pdc-title_serial txt-gray-400">
                                                                        (<span id="copy">{{ $data->masp }}</span>)
                                                                    </div>
                                                                    @if($data->comments()->count()>0)
                                                                        <ul class="rating-star pro-item-start-rating">
                                                                            @for($i = 1; $i <= 5; $i++)
                                                                                @if($i <= $avgRating)
                                                                                    <i class="star-bold far fa-star"></i>
                                                                                @else
                                                                                    <i class="far fa-star"></i>
                                                                                @endif
                                                                            @endfor
                                                                          
                                                                            <li class="txt-gray">
                                                                                <a class="link scroll-to-review">
                                                                                    <span class="total-reviews">{{$countRating}}</span> Đánh giá
                                                                                </a>
                                                                            </li>
                                                                        </ul>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="detail-line"></div>
                                                            <div class="pcd-price">
                                                                @if ($data->old_price>0)
                                                                <strike class="detailPrice">
                                                                    {{ number_format($data->old_price) }}đ
                                                                </strike>
                                                                @endif

                                                                @if ($data->price)
                                                                <span class="detailFinalPrice">
                                                                    {{ number_format($data->price)}}đ
                                                                </span>
                                                                
                                                                    @if ($data->size)
                                                                    <span class="unit">{{ '/'.$data->size }}</span>
                                                                    @endif
                                                                @else
                                                                <span class="detailFinalPrice">
                                                                    Liên hệ
                                                                </span>
                                                                @endif
                                                            </div>
                                                            <div class="detail_category">
                                                                Danh mục: <a href="{{ $data->category->slug_full }}">{{ $data->category->name }}</a>
                                                            </div>
                                                            <div class="info-desc">
                                                                <div class="col_2_desc">
                                                                    <div class="desc">
                                                                        {!! $data->description !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @if($data->content3 != null)
                                                            <div class="quatang">
                                                                <div class="title">
                                                                    Quà tặng khi mua sản phẩm
                                                                </div>
                                                                <div class="box_quatang">
                                                                    {!! $data->content3 !!}
                                                                </div>
                                                            </div>
                                                            @endif

                                                            {{--
															<div class="list-attr">
                                                                <div class="attr-item">
                                                                    <div class="price">
                                                                        @if ($data->price)
                                                                            @if ($data->price)
                                                                                <span id="priceChange">{{ number_format($data->price) }} <span class="donvi">/{{ $data->size ?? $unit }}</span></span>
                                                                            @endif
                                                                            @if ($data->old_price>0)
                                                                                <span id="old_priceChange" class="old-price">{{ number_format($data->old_price) }} /{{ $data->size ?? $unit  }}</span>
                                                                            @endif                                   
                                                                        @else
                                                                           Giá : {{ __('home.lien_he') }}
                                                                        @endif                                                         
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            --}}
                                                            <div class="wrap-price">
                                                                    <div class="attr-item" style="display: inline-block;">
                                                                        <div class="form-group">
                                                                            <label for="">{{ __('product.so_luong') }}</label>
                                                                            <div class="wrap-add-cart" id="product_add_to_cart">
                                                                                <div class="box-add-cart">
                                                                                    <div class="pro_mun">
                                                                                        <a class="cart_qty_reduce cart_reduce">
                                                                                            <span class="iconfont icon fas fa-minus" aria-hidden="true"></span>
                                                                                        </a>
                                                                                        <input type="text" value="1" class="optionChange" name="cart_quantity" onkeyup="this.value=this.value.replace(/[^\d]/g,'')" maxlength="5" min="1" id="cart_quantity" disabled="disabled">
                                                                                        <a class="cart_qty_add">
                                                                                            <span class="iconfont icon fas fa-plus" aria-hidden="true"></span>
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{--
                                                            @if(isset($data->size) && $data->size != null)
                                                                <div class="attr-item">
                                                                    <div class="form-group">
                                                                        <label for="">Khối lượng: </label>
                                                                        <div class="select_size">
                                                                            <div class="group-control">
                                                                                <input id="{{ $data->size }}-0" class="optionChange size {{ $data->price??0 }}-0" type="radio" checked name="size" value="{{ $data->price }}-0" data-old_price="{{ $data->old_price??0 }}-{{ $data->id }}"  data-size="{{ $data->size }}" data-tooltop-title="{{$data->size}}">
                                                                                <label for="{{ $data->size }}-0" class="image_label">
                                                                                    {{$data->size}}
                                                                                </label>
                                                                            </div>
                                                                            @foreach ($data->options as $item)
                                                                            <input id="{{ $item->size }}-{{ $item->id }}" class="optionChange size {{ $item->price??0 }}-{{ $item->id }}" type="radio" name="size" value="{{ $item->price }}-{{ $item->id }}" data-old_price="{{ $item->old_price??0 }}-{{ $item->id }}"  data-size="{{ $item->size }}" data-tooltop-title="{{$item->size}}">
                                                                            <label for="{{ $item->size }}-{{ $item->id }}" class="image_label">
                                                                                {{$item->size}}
                                                                            </label>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                            --}}
                                                              
                                                            <div class="single_variation_wrap">
                                                                @if (isset($data->price) && $data->price > 0)
                                                                    <button type="submit" id="addCart" data-url="{{ route('cart.add',['id' => $data->id]) }}" data-start="{{ route('cart.add',['id' => $data->id,]) }}" data-info="{{ __('home.them_san_pham') }}" data-agree="{{ __('home.dong_y') }}" data-skip="{{ __('home.huy') }}" data-addfail="{{ __('home.them_san_pham_that_bat') }}" class="add-to-cart single_add_to_cart_button button alt wow bounce" data-wow-duration="3s" data-wow-delay="2s">Chọn mua</button>
                                                                @else
                                                                    <button data-toggle="modal" data-target="#modal-add-cart" class="single_add_to_cart_button button alt wow bounce" data-wow-duration="3s" data-wow-delay="2s">Chọn mua</button>
                                                                @endif
                                                                <a class="find_address" href="{{ route('home.drugStore') }}">
                                                                    Tìm nhà thuốc
                                                                </a>
                                                            </div>

                                                            @if(isset($camket) && $camket)
                                                                <div class="pdc-feature">
                                                                    <div class="pdc-feature_top">
                                                                        <div class="pdc-feature_top--head">
                                                                            {{$camket->name}}
                                                                        </div>
                                                                        <div class="pdc-feature_top--content">
                                                                            @if($camket->childs()->count() > 0)
                                                                                @foreach($camket->childs()->where('active', 1)->orderBy('order')->get() as $value)
                                                                                    <div class="feature-item">
                                                                                        <div class="icon">
                                                                                            <img src="{{ asset($value->image_path) }}" alt="{{$value->name}}">
                                                                                        </div>
                                                                                        
                                                                                        <div class="item-text">
                                                                                            <p>{{$value->name}}</p>
                                                                                            <p>{{$value->value}}</p>
                                                                                        </div>
                                                                                    </div>
                                                                                @endforeach
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    {{--@if(isset($header['tai_sao1']->slug) && $header['tai_sao1']->slug)
                                                                    <div class="pdc-feature_bottom m-t-12">
                                                                        <div class="d-flex justify-center align-items-center">
                                                                            <a href="tel:{{ $header['tai_sao1']->slug }}" class="click-to-call"><i class="ic-call bg-success m-r-8"></i>{{ $header['tai_sao1']->slug }}</a>
                                                                            <p class="fs-p-20 txt-gray-600 m-l-4">
                                                                                Gọi tư vấn (8:00-22:00)
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    @endif--}}
                                                                </div>
                                                            @endif
                                                            {{-- <div class="share">
                                                                <script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-591d2f6c5cc3d5e5"></script>
                                                                <div class="addthis_inline_share_toolbox"></div>
                                                            </div> --}}

                                                            {{-- <div class="box-buy box-buy-two mt-2">
                                                                <select name="" id="" class="form-control select-price">
                                                                    <option value="">/m²</option>
                                                                </select>
                                                                <a class="btn-buynow addnow" href="{{ route('cart.buy',['id' => $data->id,]) }}"><span>Mua ngay</span></a>
                                                                <a class="add-to-cart" data-url="{{ route('cart.add',['id' => $data->id,]) }}" data-info="Thành công" data-addfail="Thất bại" data-skip="Hủy bỏ" data-agree="Tiếp tục"><span>Thêm vào giỏ</span></a>
                                                                <a class="add-compare" data-url="{{ route('compare.add',['id' => $data->id,]) }}"><span>Thêm vào so sánh</span></a>
                                                            </div> --}}

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            {{--
                                            <div class="tab-product">
                                                <div role="tabpanel">
                                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
        
                                                        <li class="nav-item">
                                                          <a class="nav-link active"  data-toggle="tab" href="#mota" role="tab" aria-controls="tabmoto" aria-selected="false">Thông tin chi tiết</a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link"  data-toggle="tab" href="#danhgiasao" role="tab" aria-controls="tabdanhgiasao" aria-selected="false">Đánh giá sao ({{$data->stars()->count()}})</a>
                                                          </li>
                                                        
                                                        <li class="nav-item">
                                                            <a class="nav-link"  data-toggle="tab" href="#huongdanmuahang" role="tab" aria-controls="tabhuongdanmuahang" aria-selected="true">Hướng dẫn mua hàng</a>
                                                        </li>
                                                        
                                                        <li class="nav-item">
                                                            <a class="nav-link"  data-toggle="tab" href="#quydinhdoihang" role="tab" aria-controls="tabquydinhdoihang" aria-selected="true">Quy định đổi hàng</a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link"  data-toggle="tab" href="#huongdanchonsize" role="tab" aria-controls="tabhuongdanchonsize" aria-selected="true">Hướng dẫn chọn size</a>
                                                        </li>

                                                        <li class="nav-item">
                                                            <a class="nav-link" href="{{route('home.drugStore')}}" role="tab" aria-controls="tabhethongshowroom" aria-selected="true">Hệ thống nhà thuốc</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="myTabContent">
                                                        <div class="tab-pane fade  show active" id="mota" role="tabpanel" aria-labelledby="tabmota-tab">
                                                            
                                                            <div class="row">
                                                                <div class="col-lg-3 col-sm-12 col-12">
                                                                    <div class="content_mucluc">
                                                                        @foreach (config('paragraph.posts.type') as $typeKey => $typeParagraph)
                                                                            @if ($data->paragraphs()->where([['type', $typeKey], ['active', 1]])->count() > 0)
                                                                                <div class="title_mucluc">
                                                                                    <i class="fas fa-list"></i>
                                                                                    <span>Nội dung chính</span>
                                                                                </div>
                                                                                <div class="box-link-paragraph">
                                                                                    <ul>
                                                                                        @include('frontend.components.paragraph',['typeKey'=>$typeKey,'data'=>$data])
                                                                                    </ul>
                                                                                </div>
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-9 col-sm-12 col-12">
                                                                    {!! $data->content !!}
                                                                    @foreach (config('paragraph.posts.type') as $typeKey => $typeParagraph)
                                                                        @if ($data->paragraphs()->where([['type', $typeKey], ['active', 1]])->count() > 0)
                                                                            <div class="list-content-paragraph">
                                                                                @include('frontend.components.paragraph-content',['typeKey'=>$typeKey,'data'=>$data])
                                                                            </div>
                                                                        @endif
                                                                    @endforeach
                                                                </div>
                                                        
                                                            </div>

                                                        </div>
                                                        <div class="tab-pane fade" id="danhgiasao" role="tabpanel" aria-labelledby="tabdanhgiasao-tab">
                                                            @if($data->stars()->count()>0)
                                                            <div class="list-star js-list-star">
                                                                <div class="js-load" style="display: none;">
                                                                    <div class="spinner-border text-info"></div>
                                                                </div>
                                                                @foreach($data->stars()->where('active',1)->orderBy('created_at')->get() as $item)
                                                                <div class="item-star">
                                                                    <div class="box">
                                                                        <div class="auth-star">
                                                                            <div class="icon">{{ $item->name_tat($item->name) }}</div>
                                                                            <div class="text-star">
                                                                                <div class="name">{{ $item->name }}</div>
                                                                                <div class="date-create">{{ Carbon::parse($item->created_at)->format('d-m-Y') }}</div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="content-star">
                                                                            <h3>{{ $item->title }}</h3>
                                                                            <div class="desc">
                                                                                {{ $item->content }}
                                                                            </div>
                                                                        </div>
                                                                        @if($item->star)
                                                                        <div class="point-star">
                                                                            {{ $item->star }}
                                                                            <span class="point">
                                                                                <i class="fas fa-star"></i>
                                                                            </span>
                                                                        </div>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                                @endforeach
                                                                <div class="pagination-star js-pagination-ajax mt-3">
                                                                </div>
                                                            </div>
                                                            @endif
                                                            <div id="danhgia" class="danhgia_sao">
                                                                <div class="contact-form">
                                                                    <div class="form">
                                                                        <form action="{{ route('product.rating',['id' => $data->id]) }}" method="POST" method="POST">
                                                                            @csrf
                                                                            <div class="form_danhgia">
                                                                                <label>Đánh giá <span>*</span></label>
                                                                                
                                                                                <div id="rating">
                                                                                    <input type="radio" id="star5" name="rating" value="5" />
                                                                                    <label class = "full" for="star5" title="Awesome - 5 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star4half" name="rating" value="4.5" />
                                                                                    <label class="half" for="star4half" title="Pretty good - 4.5 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star4" name="rating" value="4" />
                                                                                    <label class = "full" for="star4" title="Pretty good - 4 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star3half" name="rating" value="3.5" />
                                                                                    <label class="half" for="star3half" title="Meh - 3.5 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star3" name="rating" value="3" />
                                                                                    <label class = "full" for="star3" title="Meh - 3 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star2half" name="rating" value="2.5" />
                                                                                    <label class="half" for="star2half" title="Kinda bad - 2.5 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star2" name="rating" value="2" />
                                                                                    <label class = "full" for="star2" title="Kinda bad - 2 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star1half" name="rating" value="1.5" />
                                                                                    <label class="half" for="star1half" title="Meh - 1.5 stars"></label>
                                                                                    
                                                                                    <input type="radio" id="star1" name="rating" value="1" />
                                                                                    <label class = "full" for="star1" title="Sucks big time - 1 star"></label>
                                                                                    
                                                                                    <input type="radio" id="starhalf" name="rating" value="0.5" />
                                                                                    <label class="half" for="starhalf" title="Sucks big time - 0.5 stars"></label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label>Khách hàng <span>*</span></label>
                                                                                <input type="text" placeholder="Khách hàng" required="required" name="name">
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label>Email</label>
                                                                                <input type="email" placeholder="Email" required="required" name="email">
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label>Điện thoại <span>*</span></label>
                                                                                <input type="number" placeholder="Điện thoại" required="required" name="phone">
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label>Tiêu đề <span>*</span></label>
                                                                                <input type="text" placeholder="Tiêu đề" required="required" name="title">
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label>Nội dung <span>*</span></label>
                                                                                <textarea name="content" placeholder="Nội dung" id="noidung" cols="30" rows="5"></textarea>
                                                                            </div>
                                                                            <div class="form_danhgia">
                                                                                <label></label>
                                                                                <div class="sao_danhgia">
                                                                                    <button type="submit" name="submit">Đánh giá</button>
                                                                                </div>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="huongdanmuahang" role="tabpanel" aria-labelledby="tabhuongdanmuahang-tab">
                                                            @isset($huongDanMuaHang)
                                                            {!!$huongDanMuaHang->description!!}
                                                            @endisset
                                                        </div>
                                                        <div class="tab-pane fade" id="quydinhdoihang" role="tabpanel" aria-labelledby="tabquydinhdoihang-tab">
                                                            @isset($quyTrinh)
                                                            {!!$quyTrinh->description!!}
                                                            @endisset

                                                        </div>
                                                        
                                                        <div class="tab-pane fade" id="huongdanchonsize" role="tabpanel" aria-labelledby="tabhuongdanchonsize-tab">
                                                            @isset($huongDanChonSize)
                                                            {!!$huongDanChonSize->description !!}
                                                            @endisset
                                                        </div>

                                                        <div class="tab-pane fade" id="tabhethongshowroom" role="tabpanel" aria-labelledby="tabtabhethongshowroom-tab">
                                                            Đang cập nhật!
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            --}}

                                            <div class="modal fade modal-First" id="modal-add-cart" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-add-cart" role="document">
                                                    <div class="modal-content"  image="">
                                                        <div class="modal-body ">
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            </button>
                                                            <div class="image-modal">
                                                                <div class="info_product_modal">
                                                                    <div class="title">
                                                                        {{ $data->name }}
                                                                    </div>
                                                                    <div class="image">
                                                                        <img src="{{ asset($data->avatar_path) }}" alt="{{ $data->name }}">
                                                                    </div>
                                                                    <div class="list-attr">
                                                                        <div class="attr-item">
                                                                            <div class="price">
                                                                                @if ($data->price)
                                                                                    @if ($data->price_after_sale)
                                                                                        <span id="priceChange">Giá: {{ number_format($data->price_after_sale) }} <span class="donvi">đ</span></span>
                                                                                    @endif
                                                                                    @if ($data->sale>0)
                                                                                        <span class="title_giacu">Giá cũ: </span>
                                                                                        <span class="old-price">{{ number_format($data->price) }} {{ $unit  }}</span>
                
                                                                                        <div class="tiet_kiem">
                                                                                            <div class="g2">(Tiết kiệm: <b>{{ number_format(
                                                                                                ($data->price - $data->price_after_sale)) }}</b>)</div>
                                                                                            <div class="tk">
                                                                                                <b>-{{ $data->sale }}%</b>
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
                                                                    {{--<div class="dec">(Để chúng tôi phục vụ chu đáo hơn)</div>--}}
                                                                    <form action="{{ route('contact.storeAjax2') }}"  data-url="{{ route('contact.storeAjax2') }}" data-ajax="submit" data-target="alert" data-href="#modalAjax" data-content="#content" data-method="POST" method="POST" class="input-wrapper input-wrapper-inline input-wrapper-round">
                                                                        @csrf
                                                                        <input type="text" class="form-control" name="content" placeholder="Sản phẩm muốn xem *" value="{{ $data->name }}" required>
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

                                            
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-lg-3 col-sm-12 col-xs-12 block-content-right">
                                    <div class="box-list-fill">
                                        <div class="title-s">
                                            Tìm kiếm <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                    <div class="list-fill">
                                        <div class="form-group">
                                                <div class="input-group">
                                                    <input form="formfill" type="text"  class="form-control keyword input-search" name="keywords" placeholder="Từ khóa" />
                                                    <div class="input-group-append">
                                                        <button class="input-group-text btn-search"><i class="fas fa-search"></i></button>
                                                    </div>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="box-list-fill">
                                        <div class="title-s">
                                            Danh mục sản phẩm <i class="fas fa-minus"></i>
                                        </div>
                                    </div>
                                    <div class="list-fill">
                                        <div class="form-group">
                                            <div class="price_check">
                                                <div class="form-check">
                                                    <ul>
                                                        @php
                                                            $products = \App\Models\CategoryProduct::find(185);
                                                        @endphp
                                                        @foreach($products->childs()->where('active', 1)->get() as $value)
                                                            <li><a href="{{$value->slug_full}}">{{$value->name}}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="col-lg-3 col-md-12 col-sm-12 col-12 block-content-left">
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
                                </div> --}}
                            </div>
              
                        </div>
                    {{--
                    <div class="col-12 col-lg-3" >
                        @isset($sidebar)
                            @include('frontend.components.sidebar',[
                                // "categoryProduct"=>$sidebar['categoryProduct'],
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
                    --}}
                </div>
            </div>

            <div class="info_detail">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 col-12">
                            <div class="row">
                                <div class="col-lg-3 col-sm-12 col-12">
                                    <div class="content_mucluc">
                                        @foreach (config('paragraph.posts.type') as $typeKey => $typeParagraph)
                                            @if ($data->paragraphs()->where([['type', $typeKey], ['active', 1]])->count() > 0)
                                                <div class="title_mucluc">
                                                    <i class="fas fa-list"></i>
                                                    <span>THÔNG TIN SẢN PHẨM</span>
                                                </div>
                                                <div class="box-link-paragraph">
                                                    <ul>
                                                        @include('frontend.components.paragraph',['typeKey'=>$typeKey,'data'=>$data])
                                                    </ul>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-lg-9 col-sm-12 col-12">
                                    <div class="content">
                                        {!! $data->content !!}
                                        @foreach (config('paragraph.posts.type') as $typeKey => $typeParagraph)
                                            @if ($data->paragraphs()->where([['type', $typeKey], ['active', 1]])->count() > 0)
                                                <div class="list-content-paragraph">
                                                    @include('frontend.components.paragraph-content',['typeKey'=>$typeKey,'data'=>$data])
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="btn-overlay-top txt-center load-more-attr load-more-cate">
                                        <a class="load-more-cate-btn2 btn btn-sm btn-rounded btn-outline-gray btn-icon btn-icon-right f-w-500">
                                            Xem thêm
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			

            <div class="block-comment">
				
                        <div class="col-sm-12 col-12 mt-4">
                            <div class="ls-comments">
                                <div class="row">
                                    @if(!empty($data->questions) && count($data->questions) > 0)
                                        <div class="col-sm-12 col-12 mt-4">
                                            <div class="single-start">
                                                <div class="container">
                                                    <div class="single-start-title">
                                                        Câu hỏi thường gặp
                                                    </div>
                                                    <div class="single-start-top fleft txt-left p-3">
                                                        <div class="accordion">
                                                            <div class="row">
                                                                @foreach($data->questions()->where('active', 1)->orderBy('order')->orderBy('id', 'desc')->limit(10)->get() as $item)
                                                                    <div class="col-md-12 col-sm-12 col-12">
                                                                        <div class="accordion-header" id="headingSix{{$item->id}}">
                                                                            <button class="accordion-button plain collapsed lb-toggle" type="button" data-toggle="collapse" data-target="#collapseSix{{$item->id}}" aria-expanded="false" aria-controls="collapseSix{{$item->id}}">
                                                                               <span class="item-vote-user"><i class="fa fa-question-circle"></i>{{$item->name}}</span> 
                                                                               @if($loop->first) 
                                                                                    <i class="fa fa-angle-up"></i>
                                                                               @else
                                                                                    <i class="fa fa-angle-down"></i>
                                                                               @endif
                                                                            </button>
                                                                        </div>
                                                                        <div class="accordion-item">
                                                                            <div id="collapseSix{{$item->id}}" class="accordion-collapse collapse @if($loop->first) show @endif" aria-labelledby="headingSix{{$item->id}}" data-bs-parent="#accordionExample{{$item->id}}" style="">
                                                                                <div class="accordion-body">
                                                                                    {!!$item->value!!}
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="cboth"></div>
                                                </div>
                                
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                <div class="single-start">
                    <div class="container">
                        <div class="single-start-title">
                            Bình luận
                        </div>
                        <div class="single-start-top ls-comment">
                            <div class="form-comment">
                                <div class="form-group">
                                    <textarea id="contentComment" name="contentComment" rows="4" cols="5" placeholder="Nhập nội dung câu hỏi (Vui lòng gõ tiếng Việt có dấu)…" class="form-control cps-textarea comment_content "></textarea>
                                </div>
                                
                                <div class="lc-reply-button">
                                    <div class="btn btn-md btn-primary txt-red btn-modal-create-comment show-modal-create-comment" id="openModalCreateComment" data-target="#modal-comment" data-type="1">
                                        GỬI BÌNH LUẬN
                                    </div>
                                  </div>
                                  
                            </div>
                            <div class="error-comment">
                                <div class="alert alert-md alert-danger alert-des" id="errorContentComment" style="display: none;">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="">Mời bạn viết bình luận. (Tối thiểu 3 ký tự)</span>
                                </div>
                            </div>
                            
                        </div>

                        <div class="single-start-bottom">
                            <form action="">
                                @csrf
                                <div class="block-item-content" id="comments">
                                    
                                </div>
                                <!--load-more item-vote -->
                                    <div class="container-btn-show-all" id="lcViewMoreCm">
                                        <input type="hidden" value="1" id="pageComment">
                                        <input type="hidden" value="" id="countLoadMoreCm">
                                        @if(!empty($data->comment) && $data->comment()->where('type_comment', 1)->count() > 0)
                                        <a href="javascript:void(0)" class="load-more-cate-btn2 btn btn-sm btn-rounded btn-outline-gray btn-icon btn-icon-right f-w-500" id="loadMoreComments">
                                            Xem thêm bình luận
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        @endif
                                    </div>
                                <!-- end load-more item-vote -->
                            </form>
                        </div>
                        <div class="cboth"></div>
                    </div>
    
                </div>
            </div>

            <div class="block-star">
                <div class="single-start">
                    <div class="container">
                        <div class="single-start-title">
                            Đánh giá &amp; nhận xét 
                        </div>
                        <div class="single-start-top">
                            <div class="single-start-top-right">
                                <div class="title-avg-star block-none">Đánh Giá Trung Bình</div>
                                <p class="rating-average" id="avgRating">{{!empty($avgRating) ? $avgRating : '-' }}/5</p>
                                <div class="pro-item-start-rating">
                                    <i class="star-bold far fa-star"></i>
                                    <i class="star-bold far fa-star"></i>
                                    <i class="star-bold far fa-star"></i>
                                    <i class="star-bold far fa-star"></i>
                                    <i class="star-bold far fa-star"></i>
                                </div>
                                <div class="single-start-top-total"><strong id="countRating">{{$countRating}}</strong> đánh giá </div>
                            </div>
                            <!--ratinf detail -->
                            <div class="rating_detail single-start-top-midel">
                                @if(isset($star5) && $star5)
                                <div class="rating_detail-item">
                                    <button type="button" value="5">
                                        <div class="box-star-title pro-item-start-rating">
                                            <span>5</span>
                                            <i class="star-bold fas fa-star"></i>
                                        </div>
                                        <div class="percent-rating rating_detail_item_js">
                                            <div class="box-percent" @if($countRating != 0) style="width: {{(count($star5)/$countRating)*100}}%;" @endif>
                                                <div class="main-percent"></div>
                                            </div>
                                        </div>
                                        <div class="review-cout">{{$star5->count()}}</div>
                                    </button>
                                </div>
                                @endif
                                @if(isset($star4) && $star4)
                                    <div class="rating_detail-item">
                                        <button type="button" value="4">
                                            <div class="box-star-title pro-item-start-rating">
                                                <span>4</span>
                                                <i class="star-bold fas fa-star"></i>
                                            </div>
                                            <div class="percent-rating rating_detail_item_js">
                                                <div class="box-percent" @if($countRating != 0) style="width: {{(count($star4)/$countRating)*100}}%;" @endif>
                                                    <div class="main-percent"></div>
                                                </div>
                                            </div>
                                            <div class="review-cout">{{$star4->count()}}</div>
                                        </button>
                                    </div>
                                @endif
                                @if(isset($star3) && $star3)
                                    <div class="rating_detail-item">
                                        <button type="button" value="3">
                                            <div class="box-star-title pro-item-start-rating">
                                                <span>3</span>
                                                <i class="star-bold fas fa-star"></i>
                                            </div>
                                            <div class="percent-rating rating_detail_item_js">
                                                <div class="box-percent" @if($countRating != 0) style="width: {{(count($star3)/$countRating)*100}}%;" @endif>
                                                    <div class="main-percent"></div>
                                                </div>
                                            </div>
                                            <div class="review-cout">{{$star3->count()}}</div>
                                        </button>
                                    </div>
                                @endif
                                @if(isset($star2) && $star2)
                                <div class="rating_detail-item">
                                    <button type="button" value="2">
                                        <div class="box-star-title pro-item-start-rating">
                                            <span>2</span>
                                            <i class="star-bold fas fa-star"></i>
                                        </div>
                                        <div class="percent-rating rating_detail_item_js">
                                            <div class="box-percent" @if($countRating != 0) style="width: {{(count($star2)/$countRating)*100}}%;" @endif>
                                                <div class="main-percent"></div>
                                            </div>
                                        </div>
                                        <div class="review-cout">{{$star2->count()}}</div>
                                    </button>
                                </div>
                                @endif
                                @if(isset($star1) && $star1)
                                <div class="rating_detail-item">
                                    <button type="button" value="1">
                                        <div class="box-star-title pro-item-start-rating">
                                            <span>1</span>
                                            <i class="star-bold fas fa-star"></i>
                                        </div> 
                                        <div class="percent-rating rating_detail_item_js">
                                            <div class="box-percent" @if($countRating != 0) style="width: {{(count($star1)/$countRating)*100}}%;" @endif>
                                                <div class="main-percent"></div>
                                            </div>
                                        </div>
                                        <div class="review-cout">{{$star1->count()}}</div>
                                    </button>
                                </div>
                                @endif
                            </div>
                            <!--ratinf detail -->
                            <div class="single-start-top-left">
                                <p class="single-vote-sub-title">Bạn đánh giá sao sản phẩm này?</p>
                                <a class="single-vote-btn btn-modal-create-comment" data-toggle="modal" data-target="#modal-danh-gia" data-type="2">Đánh giá ngay</a>
                            </div>
                            <div class="cboth"></div>
                        </div>
                        <div class="single-start-bottom">
                            <form action="">
                                @csrf
                                <div class="block-item-review" id="reviews">
                                    
                                </div>
                                <!--load-more item-vote -->

                                    <div class="container-btn-show-all" id="lcViewMoreRv">
                                        <input type="hidden" value="1" id="pageReview">
                                        <input type="hidden" value="" id="countLoadMoreRv">
                                        @if(!empty($data->comment) && $data->comment()->where('type_comment', 2)->count() > 0)
                                        <a href="javascript:void(0)" class="load-more-cate-btn2 btn btn-sm btn-rounded btn-outline-gray btn-icon btn-icon-right f-w-500" id="loadMoreReviews">
                                            Xem thêm đánh giá
                                            <i class="fas fa-angle-down"></i>
                                        </a>
                                        @endif
                                    </div>
                                <!-- end load-more item-vote -->
                            </form>
                        </div>
                        <div class="cboth"></div>
                    </div>
                    <!--end container-->
                </div>
            </div>

            @isset($dataRelate)
                @if ($dataRelate->count())
                    <div class="product-relate">
                        <div class="container">
                            <div class="row">
                                <div class="col-sm-12 col-12">
                                    <div class="title">
                                        <h2>
                                            <i class="far fa-star"></i>
                                            {{ __('product.san_pham_lien_quan') }}
                                        </h2>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-12">
                                    <div class="row">
                                        <div class="list-product-card autoplay6-spkhac category-slide-1" style="width:100%;">
                                            @foreach ($dataRelate as $product)
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
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                        
                    </div>
                @endif
            @endisset
        </div>
    </div>

    <!-- Modal send commnet-->
    <div class="dklt modal fade modal-First" id="modal-comment" tabindex="-1"
	 aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
	<div class="bg-overlay"></div>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-title single-start-title">Thông Tin Người Gửi</div>
                  <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body txt-center">
                    <div class="form-info">
                        <div class="row">
                            <input type="hidden" name="product_id" value="{{$data->id}}" id="productId">
                            <input type="hidden" name="type_comment" value="1" id="type_comment">
                            <div class="col-12">
                                <div class="u-flex flex-wrap no-gutters check-form-create-comment">
                                    <div class="radio radio-sm danh-xung-comment">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="danhXungComment" value="1">
                                            Anh
                                        </label>
                                    </div>
                                    <div class="radio radio-sm danh-xung-comment" data-id="2">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="danhXungComment" value="2">
                                            Chị
                                        </label>
                                    </div>
                                </div>
                                <div class="form-err txt-left" id="errorDanhXungComment" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="nameComment" class="form-control radius-8-mb" placeholder="Nhập họ và tên" id="nameComment" maxlength="50">
                                </div>
                                <div class="form-err txt-left" id="errorNameComment" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="tel" maxlength="10" name="phoneComment" class="form-control radius-8-mb" placeholder="Nhập số điện thoại" id="phoneComment">
                                </div>
                                <div class="form-err txt-left" id="errorPhoneComment" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="text-phone-error-comment">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" name="emailComment" id="emailComment" class="form-control" placeholder="Nhập email (Không bắt buộc)">
                                </div>
                                <div class="form-err txt-left email-error" id="errorEmailComment" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md " style="display: inline;">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Email không hợp lệ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="sendComment" data-url="{{route('product.create.comment')}}" class="button_plus txt-red">
                        Gửi bình luận
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal danh gia-->
    <div class="dklt modal fade modal-First" id="modal-danh-gia" tabindex="-1"
	 aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
	<div class="bg-overlay"></div>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-title single-start-title">Đánh giá &amp; nhận xét</div>
                  <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body txt-center">
                    <div class="form-info">
                        <div class="row">
                            <input type="hidden" name="product_id" value="{{$data->id}}" id="productId">
                            <div class="col-12">
                                <div class="u-flex flex-wrap no-gutters check-form-create-review">
                                    <div class="radio radio-sm danh-xung-review">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="danhXungReview" value="1">
                                            Anh
                                        </label>
                                    </div>
                                    <div class="radio radio-sm danh-xung-review" data-id="2">
                                        <label class="d-flex align-items-center">
                                            <input type="radio" name="danhXungReview" value="2">
                                            Chị
                                        </label>
                                    </div>
                                </div>
                                <div class="form-err txt-left" id="errorDanhXungReview" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                         
                                        <span class="">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="text" name="nameReview" class="form-control radius-8-mb" placeholder="Nhập họ và tên" id="nameReview" maxlength="50">
                                </div>
                                <div class="form-err txt-left" id="errorNameReview" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <input type="tel" maxlength="10" name="phoneReview" class="form-control radius-8-mb" placeholder="Nhập số điện thoại" id="phoneReview">
                                </div>
                                <div class="form-err txt-left" id="errorPhoneReview" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="text-phone-error-comment">Thông tin bắt buộc</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="email" name="emailReview" id="emailReview" class="form-control" placeholder="Nhập email (Không bắt buộc)">
                                </div>
                                <div class="form-err txt-left email-error" id="errorEmailReview" style="display: none;">
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md " style="display: inline;">
                                         <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Email không hợp lệ</span>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group m-t-12">
                                    <textarea id="contentReview" name="contentReview" class="form-control" rows="3" placeholder="Nhập nội dung đánh giá (Vui lòng gõ tiếng Việt có dấu)…"></textarea>
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md txt-left p-t-10" id="errorContentReview" style="display: none;">
                                        <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Mời bạn viết bình luận. (Tối thiểu 3 ký tự)</span>
                                    </div>
                                </div>
                                <div class="lc__reviews-rating txt-center m-t-16">
                                    <p class="fs-p-18 txt-gray-700 f-w-500 m-b-8 fs-p-md-16">
                                        Bạn chấm sản phẩm này bao nhiêu sao?
                                    </p>
                                    <div class="u-flex align-items-center justify-center relative">
                                        <ul class="lc__rating-star row no-gutters justify-center align-center m-b-4 js-rating create-rating">
                                            <li class="m-r-8" data-num="1">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="m-r-8" data-num="2">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="m-r-8" data-num="3">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="m-r-8" data-num="4">
                                                <i class="fas fa-star"></i>
                                            </li>
                                            <li class="m-r-8" data-num="5">
                                                <i class="fas fa-star"></i>
                                            </li>
                                        </ul>
                                        <span class="messrating fs-p-16 txt-gray-700" id="messrating"></span>
                                    </div>
                                    <div class="alert alert-md alert-danger alert-des alert-sm-md m-t-16 m-t-md-0 error-star" style="display: none;">
                                        <i class="fas fa-minus alert-ic bg-danger"></i>
                                        <span class="">Vui lòng đánh giá của bạn về sản phẩm này</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="sendReview" data-url="{{route('product.create.comment')}}" class="button_plus txt-red">
                        Gửi đánh giá
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal replay commnet-->
    <div class="dklt modal fade modal-First" id="modalReplyComment" tabindex="-1"
	 aria-labelledby="exampleModalCenterTitle" aria-modal="true" role="dialog">
	    <div class="modal-dialog modal-dialog-centered" role="document">
		<div class="modal-content">
            <button type="button" class="close button-close" data-dismiss="modal" aria-label="Close"></button>
            <div class="modal-title single-start-title">Trả Lời “<span id="replyNameComment" class="f-w-500"></span>”</div>
            <input type="hidden" id="replyIdComment">
            <input type="hidden" id="replyTypeComment">
            <div class="modal-body txt-center txt-gray-700 p-t-0 p-x-md-16">
                <div class="form-info">
                    <div class="row">
                        <input type="hidden" name="product_id" value="{{$data->id}}" id="productId">
                        <input type="hidden" name="type_comment" value="1" id="type_comment">
                        <div class="col-12">
                            <div class="u-flex flex-wrap no-gutters check-form-reply-comment">
                                <div class="radio radio-sm danh-xung-reply-comment">
                                    <label class="d-flex align-items-center">
                                        <input type="radio" name="danhXungReplyComment" value="1">
                                        Anh
                                    </label>
                                </div>
                                <div class="radio radio-sm danh-xung-comment" data-id="2">
                                    <label class="d-flex align-items-center">
                                        <input type="radio" name="danhXungReplyComment" value="2">
                                        Chị
                                    </label>
                                </div>
                            </div>
                            <div class="form-err txt-left" id="errorDanhXungReplyComment" style="display: none;">
                                <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    
                                    <span class="">Thông tin bắt buộc</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <input type="text" name="nameReplyComment" class="form-control radius-8-mb" placeholder="Nhập họ và tên" id="nameReplyComment" maxlength="50">
                            </div>
                            <div class="form-err txt-left" id="errorNameReplyComment" style="display: none;">
                                <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="">Thông tin bắt buộc</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="form-group">
                                <input type="tel" maxlength="10" name="phoneReplyComment" class="form-control radius-8-mb" placeholder="Nhập số điện thoại" id="phoneReplyComment">
                            </div>
                            <div class="form-err txt-left" id="errorPhoneReplyComment" style="display: none;">
                                <div class="alert alert-md alert-danger alert-des alert-sm-md ">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="text-phone-error-comment">Thông tin bắt buộc</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="email" name="emailReplyComment" id="emailReplyComment" class="form-control" placeholder="Nhập email (Không bắt buộc)">
                            </div>
                            <div class="form-err txt-left email-error" id="errorEmailReplyComment" style="display: none;">
                                <div class="alert alert-md alert-danger alert-des alert-sm-md " style="display: inline;">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="">Email không hợp lệ</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-12">
                            <div class="form-group m-t-12">
                                <textarea id="contentReplyComment" name="contentReplyComment" class="form-control" rows="3" placeholder="Nhập nội dung câu hỏi (Vui lòng gõ tiếng Việt có dấu)…"></textarea>
                                <div class="alert alert-md alert-danger alert-des alert-sm-md txt-left p-t-10" id="errorContentReplyComment" style="display: none;">
                                    <i class="fas fa-minus alert-ic bg-danger"></i>
                                    <span class="">Mời bạn viết bình luận. (Tối thiểu 3 ký tự)</span>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
            </div>
            <div class="modal-footer">
                <button id="sendReplyComment" data-url="{{route('product.create.comment')}}" class="button_plus txt-red">
                    GỬI NGAY
                </button>
            </div>
		</div>
        </div>
    </div>

<div id="modal_ajax">

</div>



    <script type="text/javascript" src="{{ asset('frontend/js/xzoom/setup.js') }}"></script>
    <form action="" method="get" name="formfill" id="formfill" class="d-none">
        @csrf
    </form>
    
    <script type="text/javascript">
        // js  show childs category Ä‘á»‡ quy
            $(document).on('click', '.lb-toggle', function() {
                $('.accordion-button').removeClass('plain ');
                $(this).toggleClass('active ');
                $(this).find('i').toggleClass('fa-angle-down').toggleClass('fa-angle-up');
            });
        // end js  show childs category Ä‘á»‡ quy

        $(document).ready(function() {
            $('.autoplay1').slick({
                dots: false,
                arrows: false,
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                speed: 300,
                autoplaySpeed: 3000,
            });
            // $('.column').click(function() {
            //     var src = $(this).find('img').attr('src');
            //     $(".hrefImg").attr("href", src);
            //     $("#expandedImg").attr("src", src);
            // });
            $('.column').click(function() {
                var src = $(this).find('img').attr('src');
                let parent = $(this).parents('.image-main');
                parent.find(".hrefImg").attr("href", src);
                parent.find(".expandedImg").attr("src", src);
            });
            $('.slide_small').slick({
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                responsive: [{
                    breakpoint: 992,
                    settings: {
                        slidesToShow: 3,
                    }
                }]
            });


            $(document).on('click','.tab-link ul li a',function(){
                    $('.tab-link ul li a').removeClass('active');
                    $(this).addClass('active');
            });

            $('.autoplay5-product-detail-new').slick({
                dots: false,
                slidesToShow: 4,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 3000,
                responsive: [{
                        breakpoint: 1025,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 5,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 551,
                        settings: {
                            slidesToShow: 4,
                            slidesToScroll: 1,
                        }
                    },
                    {
                        breakpoint: 425,
                        settings: {
                            slidesToShow: 3,
                            slidesToScroll: 1,
       
                        }
                    }
                ]
            });

            //tạm đóng lại do không dùng đến
            if(0){
                $(document).on('change','.field-form',function(){
              // $( "#formfill" ).submit();
    
                    let contentWrap = $('#dataProductSearch');
    
                    let urlRequest = '{{ makeLinkById('category_products',$data->category->id) }}';
                    let data=$("#formfill").serialize();
                    $.ajax({
                        type: "GET",
                        url: urlRequest,
                        data:data,
                        success: function(data) {
                            if (data.code == 200) {
                                let html = data.html;
                                contentWrap.html(html);
                            }
                        }
                    });
                });
                // load ajax phaan trang
                $(document).on('click','.pagination a',function(){
                    event.preventDefault();
                    let contentWrap = $('#dataProductSearch');
                    let href=$(this).attr('href');
                    //alert(href);
                    $.ajax({
                        type: "Get",
                        url: href,
                    // data: "data",
                        dataType: "JSON",
                        success: function (response) {
                            let html = response.html;
    
                            contentWrap.html(html);
                        }
                    });
                });
            }
        });
    </script>
    <script type="text/javascript">
        $(document).ready(function() {
            var boxnumber = $('.box-add-cart input').val();
            parseInt(boxnumber);
            $('.cart_qty_add').click(function() {
                if ($(this).parent().parent().find('input').val() < 50) {
                    var a = $(this).parent().parent().find('input').val(+$(this).parent().parent().find(
                        'input').val() + 1);

                        console.log('+');

                        //  let url = $('#addCart').data('start');
                        //  url += "?quantity=" + $('#cart_quantity').val();
                        //  $('#addCart').attr('data-url',url);

                        //  let url2 = $('#buyCart').attr('href');
                        //  url2 += "?quantity=" + $('#cart_quantity').val();
                        //  $('#buyCart').attr('href',url2);
                        $(".optionChange").trigger('change');
                }
            });

            $('.cart_qty_reduce').click(function() {
                if ($(this).parent().parent().find('input').val() > 1) {
                    if ($(this).parent().parent().find('input').val() > 1) $(this).parent().parent().find(
                        'input').val(+$(this).parent().parent().find('input').val() - 1);

                        console.log('-');

                        //   let url = $('#addCart').data('start');
                        //  url += "?quantity=" + $('#cart_quantity').val();

                        //  $('#addCart').attr('data-url',url);

                        //  let url2 = $('#buyCart').attr('href');
                        //  url2 += "?quantity=" + $('#cart_quantity').val();
                        //  $('#buyCart').attr('href',url2);
                        $(".optionChange").trigger('change');
                }
            });
            

            $(document).on('change','#cart_quantity',function(){
                if ($(this).parent().parent().find('input').val() > 1) {
                    var a = $(this).val();
                       $(".optionChange").trigger('click');
                    // let url = $('#addCart').data('start');
                    // url += "?quantity=" + $('#cart_quantity').val();
                    // $('#addCart').attr('data-url',url);
                    
                    // let url2 = $('#buyCart').attr('href');
                    //      url2 += "?quantity=" + $('#cart_quantity').val();
                    //      $('#buyCart').attr('href',url2);
                }
            });

            //Add Cart Pro 
            // $(document).on('change','.optionChange',function(){
            //     // let val= ($(this).val());
            //     let val= $('input[name=size]:checked').val() ?? $(this).val();
            //     let arrPriceAndId = val.split("-").map(function(value,index){
            //         return parseInt(value);
            //     });
            //     //Giá cũ
            //     let old_price = $(this).data('old_price');
            //     let name_option = $(this).data('tooltop-title');
            //     let arrPriceAndId2 = old_price.split("-").map(function(value2,index){
            //         return parseInt(value2);
            //     });
 
            //     var nf = Intl.NumberFormat();

            //     let text= 'Liên hệ';
            //     let text2= '';
            //     let url = $('#addCart').data('start');
            //     url += "?quantity=" + $('#cart_quantity').val();
            //     if(arrPriceAndId[1]){
            //         url += "&option=" + arrPriceAndId[1];
            //     }

            //     if(arrPriceAndId[0]>0){
            //         let price= nf.format(arrPriceAndId[0]);
            //         text=price+' /' + name_option;
            //     }
            //     if(arrPriceAndId2[0]>0){
            //         let price2= nf.format(arrPriceAndId2[0]);
            //         // text2=price2+' <span>₫</span>';
            //         text2=price2+' /' + name_option;
            //     }

            //     console.log('url', url);
            //     $('#addCart').attr('data-url',url);
            //     $('#priceChange').html(text);
            //     $('#name_option').html(name_option);
            //     $('#old_priceChange').html(text2);
            // });

            
            $(document).on('change ','.optionChange',function(){
                let val= ($(this).val()) ;
                let arrPriceAndId = val.split("-").map(function(value,index){
                    return parseInt(value);
                });
 
                var nf = Intl.NumberFormat();

                let text= 'Liên hệ';
                let url = $('#addCart').data('start');
                url += "?quantity=" + $('#cart_quantity').val();
                if(arrPriceAndId[1]){
                    url += "&option=" + arrPriceAndId[1];
                }
                if(arrPriceAndId[0]>0){
                    let price= nf.format(arrPriceAndId[0]);
                    text=price+'<span class="donvi"> {{ $unit }}</span>';
                }
                $('#addCart').attr('data-url',url);
                $('#priceChange').html(text);
            });

            

            
        });

        $(function () {
            let width;
            width = $(window).width();
            
            if (width>991) {
                (function () {
                    var inc = 0;
                    $('.name-p').each(function () {
                        $(this).attr('data-scsp', "data" + inc)
                        inc++;
                    });
                })();
                (function () {
                    var inc = 0;
                    $('.scrollLink').each(function (ev) {
                        $(this).attr('data-scsp', "data" + inc)
                        inc++;
                    });
                })();

                $(window).on("load scroll", function () {
                    var windowScroll = $(this).scrollTop();
                    $(".name-p").each(function () {
                        var thisOffsetTop = Math.round($(this).offset().top - 30);

                        if (windowScroll >= thisOffsetTop) {
                            var thisAttr = $(this).attr('data-scsp');
                            $('.scrollLink').removeClass("active");
                            $('.scrollLink[data-scsp="' + thisAttr + '"]').addClass("active");
                        }
                    });
                });
            }

            $(window).resize(function() {
                width = $(window).width();
                if (width>991) {
                    (function () {
                        var inc = 0;
                        $('.name-p').each(function () {
                            $(this).attr('data-scsp', "data" + inc)
                            inc++;
                        });
                    })();
                    (function () {
                        var inc = 0;
                        $('.scrollLink').each(function (ev) {
                            $(this).attr('data-scsp', "data" + inc)
                            inc++;
                        });
                    })();

                    $(window).on("load scroll", function () {
                        var windowScroll = $(this).scrollTop();
                        $(".name-p").each(function () {
                            var thisOffsetTop = Math.round($(this).offset().top - 30);

                            if (windowScroll >= thisOffsetTop) {
                                var thisAttr = $(this).attr('data-scsp');
                                $('.scrollLink').removeClass("active");
                                $('.scrollLink[data-scsp="' + thisAttr + '"]').addClass("active");
                            }
                        });
                    });
                }
            });
        });
    </script>

    <script>
        $(function(){
            //get id product
            let idProduct = $('.blog-product-detail').attr('data-id');

            let products = localStorage.getItem("products");

            if(!products){
                arrayProduct = new Array();
                arrayProduct.push(idProduct);

                localStorage.setItem('products', JSON.stringify(arrayProduct));
            }else{
                //chuyen ve arr
                products = $.parseJSON(products);

                if(products.indexOf(idProduct) == -1){

                    products.push(idProduct);
                    localStorage.setItem('products', JSON.stringify(products));
                }   
            }
            // console.log(products);
        })
    </script>
@endsection
@section('js')
@endsection
