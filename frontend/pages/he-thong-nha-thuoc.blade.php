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

        <style>
            .tab-drug-store{
                display: none;
            }
            .tab-drug-store.current{
                display: block !important;
            }

            .info-contact::before {
                content: "\f35a";
                font-family: "Font Awesome 5 Free";
                position: absolute;
                left: 0;
                font-weight: 900;
                top: 3px;
                color: #FA0000;
                -moz-osx-font-smoothing: grayscale;
                -webkit-font-smoothing: antialiased;
                display: inline-block;
                font-style: normal;
                font-variant: normal;
                text-rendering: auto;
                line-height: 1;
            }

            .info-contact .address a {
                font-style: normal;
                font-weight: normal;
                font-size: 16px;
                line-height: 19px;
                color: #000000;
            }

            .info-contact {
                margin-bottom: 20px;
                padding-bottom: 20px;
                border-bottom: 1px dashed #CACACA;
                padding-left: 20px;
                position: relative;
            }

            h2.contact-title {
                font-style: normal;
                font-weight: 700;
                font-size: 30px;
                line-height: 35px;
                text-align: center;
                text-transform: uppercase;
                color: #000000;
                margin: 85px 0px 66px;
            }
        </style>

        @if( isset($listSystem) && $listSystem->count()>0 )
        <div class="wrap-contact-front">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-12">
                        <h2 class="contact-title">Hệ thống nhà thuốc &amp; Trung tâm dịch vụ</h2>
                    </div>

                    <div class="contact-info col-12 col-md-6 col-lg-4 offset-lg-2 offset-md-1">
                        @php
                        $i=0;
                        $j=0;
                        @endphp
                        <div class="title-drug-store">
                            <h4>Chọn vị trí nhà thuốc</h4>
                        </div>
                        <select name="tabs" class="option_address form-control">
                            @foreach( $listSystem as $item)
                                @php
                                $i++;
                                @endphp
                                <option value="{{ $item->id }}" id="tab{{ $i }}" data-tab="content{{$i}}" @if($loop->first) selected @endif>
                                    {{ $item->name }}
                                </option>
                            @endforeach

                        </select>

                        @foreach( $listSystem as $item)
                        @php
                        $j++;
                        @endphp
                        <div class="tab-drug-store content{{$j}} @if($loop->first) current @endif mt-5">
                            <div class="title-drug-store-count">
                                <h6> Có {{$item->childs()->count()}} nhà thuốc tại {{$item->name}}</h6>
                            </div>
                           
                            @foreach( $item->childs()->where('active',1)->orderBy('order')->latest()->get() as $itemChild)
                            <div class="info-contact">
                                <div class="address">
                                    <a class="select_address" href="javascript:;" data-id_address="{{ $itemChild->id }}">{{ $itemChild->name }}</a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endforeach

                    </div>
                    <div class="contact-map col-12 col-md-6 col-lg-6">
                        <div id="maps">
                            @foreach( $listSystem as $item)
                            @if($loop->first)
                            @php
                            $itemChild = $item->childs()->where('active',1)->orderBy('order')->latest()->first();
                            @endphp

                            {!! $itemChild->description !!}
                            @endif
                            @endforeach
                        </div>

                    </div>

                </div> --}}
                Đang cập nhật nội dung !
            </div>
        </div>
        @endif
    </div>
</div>

<div class="modal fade in" id="modalAjax">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Chi tiết đơn hàng</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <div class="content" id="content">

                </div>
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(document).on('click', '.select_address', function() {
        let id_address = $(this).data('id_address');

        let urlRequest = window.location;

        urlRequest = urlRequest + '?' + 'id_address' + '=' + id_address;

        if (id_address != '') {
            $.ajax({
                url: urlRequest,
                method: "GET",

                success: function(data) {

                    $('#maps').html(data);
                }
            })
        }
    });

    $(document).on('change', '.option_address', function() {
        //tab
        var tab_id = $('option:selected', this).attr('data-tab');
        var el = $("#" + tab_id);
        $('.tab-drug-store').removeClass('current');
        $("." + tab_id).addClass('current');

        let id_address_city = $(this).val();
        let urlRequest = window.location;

        urlRequest = urlRequest + '?' + 'id_address_city' + '=' + id_address_city;

        if (id_address_city != '') {
            $.ajax({
                url: urlRequest,
                method: "GET",

                success: function(data) {

                    $('#maps').html(data);
                }
            })
        }
    });
</script>
@endsection