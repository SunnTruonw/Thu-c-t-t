@extends('frontend.layouts.main')
@section('title', $seo['title'] ?? '' )
@section('keywords', $seo['keywords']??'')
@section('description', $seo['description']??'')
@section('abstract', $seo['abstract']??'')
@section('image', $seo['image']??'')
@section('content')

<style>
    p.title-filter-result.block-none{
        font-size: 14px;
    }
    .fillter-tags.u-flex.align-items-center.flex-wrap {
        margin-left: 15px;
    }
    .badge-xs:not([class*="badge-sub"]){
        border-radius: 15px;
        border: 1px solid #d8e0e8;
        font-size: 13px;
        font-weight: 400;
    }
    .badge-circle .icon-right {
        border-radius: 0 100px 100px 0;
        margin-left: 12px;
    }

</style>
    <div class="lc__load" style="display: none;">
        <div class="block-none">
            <div class="wrap-spinner txt-center border">
                <div class="spinner spinner-primary spinner-big"></div>
                <span class="spinner-text">Đang cập nhật...</span>
            </div>
        </div>
        <div class="none-block">
            <div class="wrap-spinner txt-center border">
                <div class="spinner spinner-primary"></div>
                <span class="spinner-text">Đang cập nhật...</span>
            </div>
        </div>
    </div>
    <div class="content-wrapper">
        <div class="main">
            @isset($breadcrumbs,$typeBreadcrumb)
                @include('frontend.components.breadcrumbs',[
                    'breadcrumbs'=>$breadcrumbs,
                    'type'=>$typeBreadcrumb,
                ])
            @endisset
            <div class="block-product">
                
                

    			<div class="container">
    				<div class="row">
    					<div class="col-12 col-sm-12 col-lg-12">
    						<iframe src="/fix-html/create.html" style="border: 0px;margin: 0px;padding: 0px;width: 100%;height: 100%;min-height:1360px;top: 0px;left: 0px;"></iframe>
    					</div>
    				</div>
    			</div>
                
            </div>

            <form action="#" method="get" name="formfill" id="formfill" data-ajax="submit" class="d-none">
                @csrf
            </form>

        </div>
    </div>
@endsection
@section('js')
<script>
    $('.action_show_more').showMoreItems({
        startNum: 6,
        afterNum: 5,
        original: true,
        moreText: 'Xem thêm',
        customBtnShowMore: [
            '<a class="link cs-btn">',
            '</a>'
        ],
        backMoreText: 'Thu gọn'
    });

    $(document).ready(function () {

        function search_cate() {
            var convertToAscii = function (str) {
                str = str.toLowerCase();
                str = str
                .replace(/ /g, '-')
                .replace(/Ä‘/g, 'd')
                .replace(/Ä/g, 'D')
                .replace(/-+-/g, '-')
                .replace(/ + /g, '-')
                .replace(/^\-+|\-+$/g, '')
                .replace(/^\-+|\-+$/g, '')
                .replace(/Ă¬|Ă­|á»‹|á»‰|Ä©/g, 'i')
                .replace(/á»³|Ă½|á»µ|á»·|á»¹/g, 'y')
                .replace(/ĂŒ|Ă|á»|á»ˆ|Ä¨/g, 'I')
                .replace(/á»²|Ă|á»´|á»¶|á»¸/g, 'Y')
                .replace(/Ă¨|Ă©|áº¹|áº»|áº½|Ăª|á»|áº¿|á»‡|á»ƒ|á»…/g, 'e')
                .replace(/Ă¹|Ăº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯/g, 'u')
                .replace(/Ăˆ|Ă‰|áº¸|áºº|áº¼|Ă|á»€|áº¾|á»†|á»‚|á»„/g, 'E')
                .replace(/Ă™|Ă|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®/g, 'U')
                .replace(/Ă |Ă¡|áº¡|áº£|Ă£|Ă¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ/g, 'a')
                .replace(/Ă²|Ă³|á»|á»|Ăµ|Ă´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡/g, 'o')
                .replace(/Ă€|Ă|áº |áº¢|Ăƒ|Ă‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´/g, 'A')
                .replace(/Ă’|Ă“|á»Œ|á»|Ă•|Ă”|á»’|á»|á»˜|á»”|á»–|Æ |á»œ|á»|á»¢|á»|á» /g, 'O')
                .replace(
                    /!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\'| |\"|\&|\#|\[|\]|~/g,
                    ' '
                )
                .replace(
                    /!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g,
                    ' '
                );
            return str; 
        };

        //input search
        var box_search = $('.js-box-search');
        box_search.each(function () {

            var $that = $(this), input_search = $that.find('.form-search-input');
            var checkbox = $that.find('.checkbox');
            var clearBtn = $that.find('.form-search-close');

            // console.log(input_search, checkbox, clearBtn);
            clearBtn.hide();

            add_token_filter(checkbox);

        input_search.off('keyup').on('keyup', function () {

            var $that = $(this), value = convertToAscii($that.val().trim());

            var data_filter = $that.closest('.js-box-search').find('.checkbox:not(".filterAll")');

            var data_all = $that.closest('.js-box-search').find('.checkbox.filterAll');

            var valueInput = input_search.val();

            let js_box_search = $that.closest('.js-box-search');


            // console.log('valueInput',valueInput);
            if (valueInput == '') {
                clearBtn.hide();
                data_all.show();
            } else {
                clearBtn.show();
                data_all.hide();
            };

            clearBtn.click(function () {
                input_search.val('');
                $(this).hide();
                data_all.show();

                data_filter.addClass('customShowMore').show();

                js_box_search.find('.link.cs-btn').remove();
                js_box_search.find('.search_action_show_more').showMoreItems({
                startNum: 4,
                afterNum: 5,
                original: true,
                moreText: 'Xem thêm',
                customBtnShowMore: [
                    '<a class="link cs-btn">',
                    '</a>'
                ],
                backMoreText: 'Thu gọn',
                searchFilter: true,
                });
                if ($(".group-checkbox .filterNormal").hasClass("checked")) {
                $(".group-checkbox .filterNormal.checked").css('display', '');
                }
            })

            data_filter.removeClass('customShowMore').hide();

            tokenFilter(data_filter, value);

            js_box_search.find('.link.cs-btn').remove();

            !js_box_search.find('.action_show_more').hasClass('search_action_show_more') && js_box_search.find('.action_show_more').addClass('search_action_show_more');

            js_box_search.find('.search_action_show_more').showMoreItems({
                startNum: 4,
                afterNum: 5,
                original: true,
                moreText: 'Xem thêm',
                customBtnShowMore: [
                '<a class="link cs-btn">',
                '</a>'
                ],
                backMoreText: 'Thu gọn',
                searchFilter: true,
            });

            if ($(".group-checkbox .filterNormal").hasClass("checked")) {    
                $(".group-checkbox .filterNormal.checked").css('display', '');
            }
            
            });
        });

        function add_token_filter(item) {
            item.each(function () {

            var $that = $(this), checkbox = $that.not('.filterAll'), input = checkbox.find('input');

            var token_filter = convertToAscii(checkbox.find('.label-text').text());

            input.attr('data-search', token_filter);

            });
        } 

        tokenFilter = function (nameFilter, searchSplit) {
            return nameFilter.filter(function () {
                var result = $(this).find('input[type="checkbox"]').attr('data-search').toLowerCase().indexOf(searchSplit) > -1;
                return result;
                }).closest('.checkbox').addClass('customShowMore').show();
            };

            $('.cate__brand--text p').addClass('fs-p-16 fs-p-md-14 txt-gray-700 js-more');
        }

        search_cate();
    });

    $(document).ready(function () {
        var btnDeleteAll = $('a.link.btn-delete');
        // count checkbox filter
        $('.filterDesk .group-checkbox').each(function(){

            let checkbox = $(this).find('.checkbox.filterNormal'),
                checkLength = checkbox.length
            ;
            // console.log('checkLength', checkLength);
            checkbox.css('order',`${checkLength}`);
        })

        //change input checkbox
        $('body').on('change', '.filterDesk .group-checkbox .checkbox.filterNormal input[type="checkbox"]', function (e) {

            let label = $(this).next('span.label-text').text();
            let dataTag = $(this).attr('data-tag');
            
            let tag = $(`span.badge[data-id="${dataTag}"]`);
            let checkboxLength = $(this).closest('.group-checkbox').find('.checkbox.filterNormal').length;

            if (this.checked) {
                $(this).closest('.checkbox').addClass('checked');
                let checked = $(this).closest('.group-checkbox').find('.checked').length;

                $(this).parent().parent().css('order',`${checkboxLength - checked}`);
                $(`input[data-tag="${dataTag}"]`).prop('checked', true);
                addTag(label, dataTag);
               
            } else {
                $(`input[data-tag="${dataTag}"]`).prop('checked', false);
                removeTag(tag);
                $(this).closest('.checkbox').removeClass('checked');
                $(this).parent().parent().css('order',`${checkboxLength}`);
            }
        });

        //delete all tag
        btnDeleteAll.click(function () {
            if($('.filterDesk .group-checkbox .checkbox.filterNormal input[type="checkbox"]').is(":checked")){
                $('.group-checkbox .checkbox.filterNormal input[type="checkbox"]').prop("checked", false);
                $('.filterDesk .group-checkbox').each(function(){
                    let checkbox = $(this).find('.checkbox.filterNormal'),
                        checkLength = checkbox.length
                    ;

                    checkbox.css('order',`${checkLength}`);
                })
            }
            removeAllTag();
            $('.wrapFilterTag').hide();
            $('#cate-top').show();
        });

        //add tag
        function addTag(title, id) {
            btnDeleteAll.before(
                `<span class="badge badge-outline-gray badge-circle badge-xs tag tag_filter" data-id="${id}">
                    ${title}
                        <i class="fa fa-times icon-sm icon-right"></i>
                </span>`
            );
            if ($('span.badge').length > 0) {
                btnDeleteAll.closest('.wrapFilterTag').attr('style', '');
            }

            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                        
                    }
                    $('#hot-product').remove();
                    $('#cate-top').hide();
                    $('.lc__load').hide();
                }
            });
        }

        //xoa tag item
        function removeTag($elTag) {
            let dataTag = $elTag.attr('data-id');
            var lc_filter =$('.filterDesk');
            $elTag.remove();

            lc_filter.find(`input[data-tag="${dataTag}"]`).prop('checked', false);
                checkIsCheckedCheckBox(lc_filter.find(`input[data-tag="${dataTag}"]`));

            if ($('span.badge.tag').length === 0) {
                btnDeleteAll.closest('.wrapFilterTag').attr('style', 'display: none !important');
                $('#cate-top').show();
            }

            let contentWrap = $('#dataProductSearch');
            let urlRequest = '{{ url()->current() }}';
            let data=$("#formfill").serialize();

            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                    $('.lc__load').hide();
                }
            });

        }

        //on click tag item
        $('body').on('click', '.tag_filter', function (e) {
            let dataTag = $(this).attr('data-id');

            if($('.filterDesk .group-checkbox .checkbox.filterNormal input[type="checkbox"]').is(":checked")){
                let checkboxLength =   $(`input[data-tag="${dataTag}"]`).closest('.group-checkbox').find('.checkbox.filterNormal').length;
                
                $(`input[data-tag="${dataTag}"]`).prop('checked', false);
                $(`input[data-tag="${dataTag}"]`).parent().parent().removeClass('checked');
                $(`input[data-tag="${dataTag}"]`).parent().parent().css('order',`${checkboxLength / 2}`);
        
            }
            removeTag($(this));
        });

        //xóa all tag
        function removeAllTag() {
            $('span.badge.tag_filter').each(function () {
                removeTag($(this)); 
            });
        }

        //is_checkbox
        function checkIsCheckedCheckBox(checkbox) {
            let flag = false;
            let groupCheckbox = checkbox.closest('.group-checkbox');

            groupCheckbox.find('.checkbox.filterNormal').each(function () {
                if ($(this).find('input[type="checkbox"]').is(':checked'))
                    flag = true;
            });
            if (flag === true) {
                groupCheckbox.find('.checkbox.filterAll').find('input[type="checkbox"]').prop('checked', false);
            } else {
                groupCheckbox.find('.checkbox.filterAll').find('input[type="checkbox"]').prop('checked', true);
            }
        }

        //AJAX

        $(document).on('change','.field-form',function(){
          // $( "#formfill" ).submit();
            let stt = 0;
            stt = parseInt(stt);
            $(".field-form").each(function() {
                let is_check = $(this).is(':checked');
                if(is_check){
                    stt++;
                }
            });
            if(stt>0){
                $(".wrapFilterTag").show();
            }
            else{
                $(".wrapFilterTag").hide();
            }

           let contentWrap = $('#dataProductSearch');

            let urlRequest = '{{ url()->current() }}';

            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                    $('#hot-product').remove();
                    $('#cate-top').hide();
                    $('.lc__load').hide();
                }
            });
        });

        $(document).on('click','.btn-search',function(event){
          event.preventDefault();

           let contentWrap = $('#dataProductSearch');

            let urlRequest = '{{ url()->current() }}';

            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                    $('#hot-product').remove();
                    $('#cate-top').hide();
                    $('.lc__load').hide();
                }
            });
        });

        $(document).on('submit',"[data-ajax='submit']",function(event){
          // $( "#formfill" ).submit();
          event.preventDefault();

           let contentWrap = $('#dataProductSearch');

            let urlRequest = '{{ url()->current() }}';

            let data=$("#formfill").serialize();
            $.ajax({
                type: "GET",
                url: urlRequest,
                data:data,
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function(data) {
                    if (data.code == 200) {
                        let html = data.html;
                        contentWrap.html(html);
                    }
                    $('#hot-product').remove();
                    $('#cate-top').hide();
                    $('.lc__load').hide();
                }
            });
        });

        $(document).on('change','.field-change-link',function(){
          // $( "#formfill" ).submit();

           let link=$(this).val();
           if(link){
               window.location.href=link;
           }
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
                beforeSend: function () {
                    $('.lc__load').show();
                },
                success: function (response) {
                    let html = response.html;
                    contentWrap.html(html);
                    $('.lc__load').hide();
                }
            });
        });
    });
    
</script>





@endsection
