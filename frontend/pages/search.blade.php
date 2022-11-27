@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset
            <div class="wrap-content-main wrap-template-product template-detail">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 block-content-right">
                            @if (isset($dataProduct)&&$dataProduct)
                            <div class="ss05_product">
                                <div class="container">
                                    <div class="row">
                                    <div class="col-sm-12 col-12 padding_none">
                                        <div class="list-product list_feedback1">
                                            <div class="row">
                                                <div class="col-sm-12 col-12">
                                                    <div class="list_nowrap">
                                                        <div class="row">
                                                            @foreach ($dataProduct as $product)
                                                                @php
                                                                    $tran=$product->translationsLanguage()->first();
                                                                    $link= route('product.detail',['category'=>$product->category->slug, 'slug'=>$product->slug]);
                                                                @endphp
                                                                <div class="col-product-item box_sp_home col-sm-6 col-6">
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
                                                <div class="col-12">
                                                    @if (count($dataProduct))
                                                    {{$dataProduct->appends(request()->all())->onEachSide(1)->links()}}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>	
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')

@endsection
