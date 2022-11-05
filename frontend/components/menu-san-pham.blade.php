@php
   $i=1;
   if (!isset($limit)) {
     $limit=99;
   }

@endphp

@foreach ($data as $value)
    <li class="nav-item">
        <a href="{{$value['slug_full']}}">
            <span> {{$value['name']}}</span>
            @isset($value['childs'])
                @if (count($value['childs'])>0&&$limit>=$i+1)
                    {!!  $icon_d??""  !!}
                @endif
            @endisset
        </a>
        @isset($value['childs'])
            @if (count($value['childs'])>0&&$limit>=$i+1)
                <div class="menu-dropdown">
                    <div class="row no-gutters">
                        <div class="col-3">
                            <ul class="sub-nav-left p-b-16">
                                @foreach ($value['childs'] as $key => $childValue)
                                    <li class="nav-sub-item @if($loop->first) active  @endif" data-id="li{{$childValue->id}}">
                                        <a href="">
                                            <div class="sub-nav-picture m-r-8">
                                                <picture>
                                                    <img alt="{{$childValue['name']}}" srcset="" class="loaded" src="" />
                                                </picture>
                                            </div>
                                            <div class="sub-nav-name fs-p-14">
                                                <span>{{$childValue['name']}} </span>
                                            </div>
                                        </a>
                                    </li>
                                @endforeach
                                {{-- <li class="nav-sub-item" data-id="li2">
                                    <a href="">
                                        <div class="sub-nav-picture m-r-8">
                                            <picture>
                                                <img alt="Sinh lý - Nội tiết tố" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                            </picture>
                                        </div>
                                        <div class="sub-nav-name fs-p-14">
                                            <span>Sinh lý - Nội tiết tố </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-sub-item" data-id="li3">
                                    <a href="">
                                        <div class="sub-nav-picture m-r-8">
                                            <picture>
                                                <img alt="Sinh lý - Nội tiết tố" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                            </picture>
                                        </div>
                                        <div class="sub-nav-name fs-p-14">
                                            <span>Sinh lý - Nội tiết tố </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-sub-item" data-id="li4">
                                    <a href="">
                                        <div class="sub-nav-picture m-r-8">
                                            <picture>
                                                <img alt="Sinh lý - Nội tiết tố" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                            </picture>
                                        </div>
                                        <div class="sub-nav-name fs-p-14">
                                            <span>Sinh lý - Nội tiết tố </span>
                                        </div>
                                    </a>
                                </li>
                                <li class="nav-sub-item" data-id="li5">
                                    <a href="">
                                        <div class="sub-nav-picture m-r-8">
                                            <picture>
                                                <img alt="Sinh lý - Nội tiết tố" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                            </picture>
                                        </div>
                                        <div class="sub-nav-name fs-p-14">
                                            <span>Sinh lý - Nội tiết tố </span>
                                        </div>
                                    </a>
                                </li> --}}

                            </ul>
                        </div>
                        <div class="col-9">
                            <div class="sub-nav-right active" id="li1">

                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                    <div class="sub-nav-title m-b-12">
                                        <div class="u-flex justify-between align-items-center">
                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                <i class="fab fa-gripfire"></i>
                                                Bán chạy nhất
                                            </div>
                                            <a class="link p-t-2" href="">Xem tất cả</a>
                                        </div>
                                    </div>
                                    <div class="sub-nav-product-list">
                                        <div class="row row-cols-5">
                                            <div class="col p-x-8">
                                                <div class="sub-nav-product-item">
                                                    <a href="">
                                                        <div class="sub-nav-product-picture m-b-12">
                                                            <picture>
                                                                <img
                                                                    alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)"
                                                                    class="loaded"
                                                                    src="{{asset('frontend/images/product-test.webp')}}"
                                                                />
                                                            </picture>
                                                        </div>
                                                        <div class="sub-nav-product-info">
                                                            <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)
                                                            </div>
                                                            <div class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                <span class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                / Hộp
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-nav-right" id="li2">
                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                    <div class="sub-nav-title m-b-12">
                                        <div class="u-flex justify-between align-items-center">
                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                <i class="fab fa-gripfire"></i>
                                                Bán chạy nhất
                                            </div>
                                            <a class="link p-t-2" href="">Xem tất cả</a>
                                        </div>
                                    </div>
                                    <div class="sub-nav-product-list">
                                        <div class="row row-cols-5">
                                            <div class="col p-x-8">
                                                <div class="sub-nav-product-item">
                                                    <a href="">
                                                        <div class="sub-nav-product-picture m-b-12">
                                                            <picture>
                                                                <img alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)" class="loaded" src="{{asset('storage/product/2/e1.webp')}}" />
                                                            </picture>
                                                        </div>
                                                        <div class="sub-nav-product-info">
                                                            <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)
                                                            </div>
                                                            <div class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                <span class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                / Hộp
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-nav-right" id="li3">
                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                    <div class="sub-nav-title m-b-12">
                                        <div class="u-flex justify-between align-items-center">
                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                <i class="fab fa-gripfire"></i>
                                                Bán chạy nhất
                                            </div>
                                            <a class="link p-t-2" href="">Xem tất cả</a>
                                        </div>
                                    </div>
                                    <div class="sub-nav-product-list">
                                        <div class="row row-cols-5">
                                            <div class="col p-x-8">
                                                <div class="sub-nav-product-item">
                                                    <a href="">
                                                        <div class="sub-nav-product-picture m-b-12">
                                                            <picture>
                                                                <img alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)" class="loaded" src="{{asset('storage/product/2/r1.webp')}}" />
                                                            </picture>
                                                        </div>
                                                        <div class="sub-nav-product-info">
                                                            <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)
                                                            </div>
                                                            <div class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                <span class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                / Hộp
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-nav-right" id="li4">
                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                    <div class="sub-nav-title m-b-12">
                                        <div class="u-flex justify-between align-items-center">
                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                <i class="fab fa-gripfire"></i>
                                                Bán chạy nhất
                                            </div>
                                            <a class="link p-t-2" href="">Xem tất cả</a>
                                        </div>
                                    </div>
                                    <div class="sub-nav-product-list">
                                        <div class="row row-cols-5">
                                            <div class="col p-x-8">
                                                <div class="sub-nav-product-item">
                                                    <a href="">
                                                        <div class="sub-nav-product-picture m-b-12">
                                                            <picture>
                                                                <img alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)" class="loaded" src="{{asset('storage/product/2/w1.webp')}}" />
                                                            </picture>
                                                        </div>
                                                        <div class="sub-nav-product-info">
                                                            <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)
                                                            </div>
                                                            <div class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                <span class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                / Hộp
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="sub-nav-right" id="li5">
                                <div class="sub-nav-cate p-t-16 p-b-4 p-x-16">
                                    <div class="row row-cols-4 flex-wrap sub-nav-cate-wrap">
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col sub-nav-cate-item p-x-8">
                                            <a href="" class="u-flex align-items-center bg-white txt-gray-800 circle p-y-4 p-l-4 p-r-16 box-full">
                                                <div class="sub-nav-cate-picture m-r-8">
                                                    <picture>
                                                        <img alt="Huyết áp" srcset="" class="loaded" src="{{asset('frontend/images/icon-test-menu.webp')}}" />
                                                    </picture>
                                                </div>
                                                <div class="sub-nav-cate-name">
                                                    <span>Huyết áp</span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="sub-nav-product box-t-2 p-x-16 p-t-12 p-b-16">
                                    <div class="sub-nav-title m-b-12">
                                        <div class="u-flex justify-between align-items-center">
                                            <div class="u-flex align-items-center fs-p-16 txt-gray-800 f-w-500">
                                                <i class="fab fa-gripfire"></i>
                                                Bán chạy nhất
                                            </div>
                                            <a class="link p-t-2" href="">Xem tất cả</a>
                                        </div>
                                    </div>
                                    <div class="sub-nav-product-list">
                                        <div class="row row-cols-5">
                                            <div class="col p-x-8">
                                                <div class="sub-nav-product-item">
                                                    <a href="">
                                                        <div class="sub-nav-product-picture m-b-12">
                                                            <picture>
                                                                <img
                                                                    alt="Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)"
                                                                    class="loaded"
                                                                    src="{{asset('frontend/images/product-test.webp')}}"
                                                                />
                                                            </picture>
                                                        </div>
                                                        <div class="sub-nav-product-info">
                                                            <div class="sub-nav-product-name fs-p-16 truncate2 txt-gray-700">
                                                                Viên Uống Sâm Nhung Bổ Thận Nv Dolexphar Giúp Tráng Dương, Mạnh Gân Cốt (30 Viên)
                                                            </div>
                                                            <div class="product-info-price txt-gray-700 m-t-4 fs-p-16">
                                                                <span class="fs-p-18 txt-primary-700 f-w-500 fs-p-md-14">110.000đ</span>
                                                                / Hộp
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endisset
    </li>
@endforeach