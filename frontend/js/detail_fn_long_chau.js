var width = $(window).width();
var responsive = width < 992;
$(function () {
    $(document).ready(function () {
        $("html").addClass("cart-html");
        $("body").addClass("cart-body");
        $(".ppc-typhography a").not(".btn").addClass("link");

        // sticky buton scroll
        function stickyButton() {
            $(".pdc-cta_phone").hide();
            if ($(window).width() < 992) {
                var lastKnownScrollPosition = 0;
                var lcWindow = $(window);

                lcWindow.scroll(function () {
                    var height_element = $(".pdc-cta").position().top;

                    // console.log('height_element', height_element);

                    lastKnownScrollPosition = lcWindow.scrollTop() - 36;

                    // console.log('lastKnownScrollPosition', lastKnownScrollPosition);

                    if (lastKnownScrollPosition > height_element) {
                        $(".pdc-cta").addClass("stick-bottom");
                        $(".pdc-cta_phone").fadeIn();
                        $(".pdc-cta_phone").removeClass("hidden");
                        // console.log(1);
                    } else {
                        $(".pdc-cta").removeClass("stick-bottom");
                        // console.log(2);
                        $(".pdc-cta_phone").fadeOut();
                        $(".pdc-cta_phone").addClass("hidden");
                    }
                });
            }
        }

        stickyButton();

        // dropdown
        $(".check-form").checkList();

        var convertToAscii = function (str) {
            str = str.toLowerCase();
            str = str
                .replace(/ /g, "-")
                .replace(/Ä‘/g, "d")
                .replace(/Ä/g, "D")
                .replace(/-+-/g, "-")
                .replace(/ + /g, "-")
                .replace(/^\-+|\-+$/g, "")
                .replace(/^\-+|\-+$/g, "")
                .replace(/Ă¬|Ă­|á»‹|á»‰|Ä©/g, "i")
                .replace(/á»³|Ă½|á»µ|á»·|á»¹/g, "y")
                .replace(/ĂŒ|Ă|á»|á»ˆ|Ä¨/g, "I")
                .replace(/á»²|Ă|á»´|á»¶|á»¸/g, "Y")
                .replace(/Ă¨|Ă©|áº¹|áº»|áº½|Ăª|á»|áº¿|á»‡|á»ƒ|á»…/g, "e")
                .replace(/Ă¹|Ăº|á»¥|á»§|Å©|Æ°|á»«|á»©|á»±|á»­|á»¯/g, "u")
                .replace(/Ăˆ|Ă‰|áº¸|áºº|áº¼|Ă|á»€|áº¾|á»†|á»‚|á»„/g, "E")
                .replace(/Ă™|Ă|á»¤|á»¦|Å¨|Æ¯|á»ª|á»¨|á»°|á»¬|á»®/g, "U")
                .replace(/Ă |Ă¡|áº¡|áº£|Ă£|Ă¢|áº§|áº¥|áº­|áº©|áº«|Äƒ|áº±|áº¯|áº·|áº³|áºµ/g, "a")
                .replace(/Ă²|Ă³|á»|á»|Ăµ|Ă´|á»“|á»‘|á»™|á»•|á»—|Æ¡|á»|á»›|á»£|á»Ÿ|á»¡/g, "o")
                .replace(/Ă€|Ă|áº |áº¢|Ăƒ|Ă‚|áº¦|áº¤|áº¬|áº¨|áºª|Ä‚|áº°|áº®|áº¶|áº²|áº´/g, "A")
                .replace(/Ă’|Ă“|á»Œ|á»|Ă•|Ă”|á»’|á»|á»˜|á»”|á»–|Æ |á»œ|á»|á»¢|á»|á» /g, "O")
                .replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\:|\'| |\"|\&|\#|\[|\]|~/g, " ")
                .replace(/!|@|\$|%|\^|\*|\(|\)|\+|\=|\<|\>|\?|\/|,|\.|\:|\'| |\"|\&|\#|\[|\]|~/g, " ");
            return str;
        };

        //search city
        var input_search = $(".js-search");
        input_search.each(function () {
            var that = $(this);
            var wrapper = that.closest(".dropdown-menu-top").next(".js--city-list"),
                item_city = wrapper.children(),
                btn_close = that.next();

            btn_close.hide();
            loopItem(item_city);

            that.off("keyup");
            that.on("keyup", function () {
                loopItem(item_city);
                var searchVal = $(this).val().trim(),
                    filterCity = wrapper.find("[token-filter]"),
                    searchSplit = convertToAscii(searchVal);

                $(this).next().show();
                if (searchVal != "") {
                    filterCity.hide();
                    tokenFilter(filterCity, searchSplit);
                    tokenFilter(banking_filter_city, searchSplit);
                } else {
                    filterCity.show();
                    btn_close.hide();
                }
            });

            //function loop item
            function loopItem(items) {
                items.each(function () {
                    var nameCity = $(this).text();
                    dataCityName = $(this).attr("token-filter", `${convertToAscii(nameCity)}`);

                    items.click(function (e) {
                        e.preventDefault();
                        var name = $(this).text(),
                            nameOption = $(this).parent().prev().parent().prev().find("span"),
                            input = $(this).closest(".dropdown-menu").removeClass("open");
                        nameOption.text(name);

                        $(this).parent().closest(".dropdown-menu").prev().attr("data-city", name.trim());

                        items.removeClass("active");
                        $(this).addClass("active");

                        isInvalid_City($(this).parent().closest(".dropdown-menu").prev().attr("data-city"));

                        $(this).parent().closest(".dropdown-menu").prev().removeClass("is-invalid");

                        if ($(".js-tabs.checked").attr("data-tab") === "tab1") {
                            $(".select__region_district").find(".dropdown-button").removeClass("is-invalid");
                        }
                    });
                });
            }

            // function search filter
            tokenFilter = function (nameFilter, searchSplit) {
                return nameFilter
                    .filter(function () {
                        var result = $(this).attr("token-filter").toLowerCase().indexOf(searchSplit) > -1;
                        return result;
                    })
                    .show();
            };

            btn_close.bind("click", function () {
                $(this).hide();
                input_search.val("");
                item_city.show();
                $(".js--city-list")
                    .children()
                    .each(function () {
                        $(this).show();
                    });
            });
        });

        //slide
        var slides_count = $(".js-gallery .swiper-slide"); // <- add this
        var offer = $("#numberSlides");

        var jqSlide = function () {
            var JsPdSlider = new Swiper(".gallery-top", {
                slidesPerView: 1,
                spaceBetween: 0,
                allowTouchMove: false,

                navigation: {
                    nextEl: ".btn-next",
                    prevEl: ".btn-prev",
                },
                breakpoints: {
                    992: {
                        allowTouchMove: true,
                    },
                },
                runCallbacksOnInit: true,
                on: {
                    init: function () {
                        offer.text(`HĂ¬nh ${this.activeIndex + 1 + "/" + slides_count.length}`);
                    },
                    slideChange: function () {
                        // console.log(offer);
                        offer.text(`HĂ¬nh ${this.activeIndex + 1 + "/" + slides_count.length}`);
                    },
                },
            });

            var JsPdSliderThumbnail = new Swiper(".gallery-thumbs", {
                slidesPerView: "auto",
                spaceBetween: 16,
                breakpoints: {
                    4000: {
                        allowTouchMove: false,
                    },
                    992: {
                        spaceBetween: 8,
                    },
                },
            });

            $(".gallery-thumbs .swiper-slide").click(function () {
                $(".js--pd-slider--thumbnail .swiper-slide").removeClass("active");
                $(this).addClass("active");

                var index = $(this).index();
                JsPdSlider.slideTo(index);
            });

            JsPdSlider.on("transitionEnd", function (e) {
                responsive && JsPdSliderThumbnail.slideTo(JsPdSlider.realIndex);
                var index = JsPdSlider.realIndex + 1;
                $(".gallery-thumbs .swiper-slide").removeClass("active");
                $(".gallery-thumbs .swiper-slide:nth-child(" + index + ")").addClass("active");
            });

            //check slide desktop hiá»ƒn thá»‹ 3 áº£nh
            function check_slide_show_hide() {
                var batch = 4,
                    slide = $(".js-gallery").children();

                slide.hide();

                slide.slice(0, batch).show();
            }

            $(document).on("click", ".lg-toolbar .lg-close", function () {
                var width = $(window).width();

                if (width < 992) {
                    $("html,body").addClass("disable-scroll");
                } else {
                    $(".swiper-button-prev.btn-prev.slide-control").trigger("click");
                }
            });

            function checkBadgeGallery() {
                index = JsPdSlider.realIndex + 1;

                if (index != 1) {
                    $(".badge").remove();
                }
            }

            checkBadgeGallery();

            function nextOpenGalleryDesktop() {
                if (width > 992) {
                    $(".btn-next").click(function () {
                        var view_gallery = $(".js-open-gallery"),
                            index = JsPdSlider.realIndex + 1;
                        // console.log("index", index);
                        (parent = $(this).parent()), (itemHidden = parent.find(".swiper-slide:hidden"));

                        if (view_gallery.length > 0 && index >= 4 && 0 <= itemHidden.length) {
                            $(".swiper-slide-active").trigger("click");
                        }

                        // if(index > 1){
                        //   $('.badge-product').hide();
                        // }else{
                        //   $('.badge-product').show();
                        // }
                    });

                    $(".btn-prev").click(function () {
                        var view_gallery = $(".js-open-gallery"),
                            index = JsPdSlider.realIndex + 1;

                        // if(index === 1){
                        //   $('.badge-product').show();
                        // }
                    });
                }
            }

            function slideGalleryMobile() {
                if (responsive) {
                    // $('.gallery-top .swiper-slide').on('touchmove', function () {
                    //   var view_gallery = $('.js-open-gallery'),

                    //     index = JsPdSlider.realIndex + 1;

                    //   var parent = $(this).parent(), itemHidden = parent.find('.swiper-slide:hidden');
                    //   console.log(view_gallery.length);

                    //   if (view_gallery.length > 0 && index >= 3 && 0 <= itemHidden.length) {
                    //     $('.swiper-slide-next').trigger('click');
                    //   }

                    // });

                    $(".pcd-title-desk").remove();
                } else {
                    $(".pcd-title-mb").remove();
                }
            }

            function gallery() {
                const lgDemoUpdateSlides = document.getElementById("list-gallery");

                lightGallery(lgDemoUpdateSlides, {
                    addClass: "lg-update-slide-demo",
                    plugins: [lgAutoplay, lgFullscreen, lgZoom, lgThumbnail],
                    speed: 500,
                    download: false,
                    pager: false,
                    hash: false,
                    animateThumb: true,
                    zoomFromOrigin: false,
                    allowMediaOverlap: false,
                    toggleThumb: false,
                    closable: true,
                    appendSubHtmlTo: ".lg-outer",
                    mobileSettings: {
                        closable: true,
                        appendSubHtmlTo: ".lg-item",
                        appendCounterTo: ".lg-content",
                    },
                });

                if (responsive) {
                    if ($(".lg-outer .lg-thumb-outer").length === 0) {
                        $(".lg-sub-html").css("cssText", "top: -180px !important");
                    }
                }

                $("#lg-actual-size-1").attr("onclick", `ga('send', 'event', 'Product Detail Page', 'Click Product Image', 'Large Image', {'nonInteraction': 1});`);
            }

            function addBtnCloseMobile() {
                if (responsive) {
                    // console.log("abcd");
                    $(".js-close-gallery").remove();

                    $("body").append(`
            <button type="button" aria-label="Close gallery" class="lg-close lg-icon btn btn-lg circle js-close-gallery close-fixed p-x-0"> <i class="ic-close fs-ui-15"></i></button>
            `);
                }
            }
            addBtnCloseMobile();

            //Ä‘Ă³ng gallery
            $(document).on("click", ".js-close-gallery", function () {
                $(this).removeClass("show-icon");
                var close = $(".lg-toolbar .lg-close");
                close.trigger("click");
                $("html, body").removeClass("disable-scroll");
            });

            //click vĂ o xem thĂªm áº£nh
            $(document).on("click", ".js-open-gallery", function (e) {
                $(".js-gallery .swiper-slide.swiper-slide-active").trigger("click");

                $(".lg-update-slide-demo").addClass("lg-show lg-show-in").css("pointer-events", "unset");

                $(".js-close-gallery").addClass("show-icon");
                // addBtnCloseMobile();
            });

            // click outside gallery

            $(document).on("click", "#lg-backdrop-1", function (e) {
                $("#lg-close-1").trigger("click");
            });

            //click swiper-slide
            $(document).on("click", ".gallery-top .swiper-slide", function () {
                $(".lg-update-slide-demo").addClass("lg-show lg-show-in").css("pointer-events", "unset");

                if (responsive) {
                    if ($(".lg-outer .lg-thumb-outer").length === 0) {
                        $(".lg-sub-html").css("cssText", "top: -180px !important");
                    }
                    // console.log($('.js-close-gallery'));
                    $("html, body").addClass("disable-scroll");
                    $(".js-close-gallery").addClass("show-icon");

                    // addBtnCloseMobile();
                }

                $("#lg-actual-size-1").attr("onclick", `ga('send', 'event', 'Product Detail Page', 'Click Product Image', 'Large Image', {'nonInteraction': 1});`);
            });

            JsPdSlider.update();

            let initGallery = () => {
                width > 992 && check_slide_show_hide(); // check slide hiá»ƒn thá»‹ á»Ÿ desktop 3 áº£nh

                nextOpenGalleryDesktop(); // má»Ÿ gallery khi click Ä‘áº¿n áº£nh thá»© 4

                slideGalleryMobile();

                gallery(); // gá»i gallery
            };
            initGallery();
        };

        jqSlide();

        //slides

        var swiper = new Swiper(".js-slide--related", {
            slidesPerView: 5,
            slidesPerGroup: 5,
            navigation: {
                nextEl: ".js-slide--related + .next",
                prevEl: ".js-slide--related + .next + .prev",
            },
            breakpoints: {
                992: {
                    slidesPerView: "auto",
                    slidesPerGroup: 2,
                },
            },
        });

        $(".js-accordion a,.lc__cmt-content a").addClass("link");

        $(".lc-detail .js-accordion").each(function () {
            var ac_item = $(this).find(".js-acc");
            var content = $(this).find(".accordion-details");
            var link = content.find("a");
            content.hide();
            ac_item.first().addClass("open").find(".accordion-details").slideDown();
            ac_item.click(function () {
                var $that = $(this),
                    is_open = $that.is(".open");

                if (is_open) {
                    $that.removeClass("open").find(".accordion-details").slideUp();
                } else {
                    ac_item.removeClass("open").find(".accordion-details").slideUp();

                    $that.addClass("open").find(".accordion-details").slideDown();
                }
            });
        });

        var swiper = new Swiper(".js-slide--ChungNhan", {
            slidesPerView: 2,
            slidesPerGroup: 2,
            spaceBetween: 24,
            navigation: {
                nextEl: ".swiper-button-next",
                prevEl: ".swiper-button-prev",
            },
        });

        $("[event-view]").each(function () {
            $(this).click(function () {
                $(this).parent().parent().addClass("full-typhography");
                $(this).parent().fadeOut();
            });
        });

        tabs();
    });

    // rating
    function rating(params) {
        var rating = $(".js-rating"),
            ratingChild = rating.find("li");

        ratingChild
            .on("mouseover", function () {
                const VAL = parseInt($(this).data("num"));
                $(this)
                    .parent()
                    .find("li")
                    .each(function (index, element) {
                        index < VAL ? $(this).children().addClass("fill") : $(this).children().removeClass("fill");
                    });
            })
            .on("mouseout", function () {
                $(this)
                    .parent()
                    .find("li")
                    .each(function () {
                        $(this).children().removeClass("fill");
                    });
            });

        ratingChild.on("click", function () {
            const VAL = parseInt($(this).data("num"));
            var li = $(this).parent().children("li");

            for (i = 0; i < li.length; i++) {
                $(li[i]).removeClass("selected");
            }

            for (i = 0; i < VAL; i++) {
                $(li[i]).addClass("selected");
            }

            $(".js-rating").find("li").hasClass("selected") && $(".lc__reviews-rating .alert").hide();

            var ratingVal = parseInt($(".js-rating li .fill").parent().last().data("num"));
            responUserRatingMess(ratingVal);
        });

        function responUserRatingMess(ratingVal) {
            var mess = ["Không thích", "Tạm được", "Bình thường", "Hài lòng", "Tuyệt vời"];
            mess.filter(function (element, index) {
                index + 1 === ratingVal && $("#messrating").text(element);
            });
        }
    }
    rating();

    $(".ppc-typhography").outerHeight() >= 1300 ? $(".lc__btn-overlay").show() : $(".lc__btn-overlay").hide();

    var width = $(window).width();
    var responsive = width < 992;

    if (responsive) {
        function scroll_mobile() {
            var height = $(".detail_main").outerHeight();

            position_top_main = $(".detail_main").position().top - 50;

            var height_position = $(window).scrollTop() - position_top_main;

            height_position > 0
                ? $(".detail_main .row .col-3")
                      .addClass("fixed-top")
                      .css({
                          position: "fixed",
                          "z-index": "9999",
                      })
                      .show()
                : $(".detail_main .row .col-3").removeClass("fixed-top").css("position", "relative").hide();

            height_position > height && $(".detail_main .row .col-3").removeClass("fixed-top").css("position", "relative").hide();
        }

        $(this).scroll(function () {
            scroll_mobile();
        });

        $(".js-dropdown").click(function () {
            $(this).toggleClass("expand");
            $(".fixed-top").toggleClass("expand-overlay");
        });

        function TableContentEvent() {
            $(".js-dropdown").removeClass("expand");
            $(".fixed-top").removeClass("expand-overlay");
        }

        $("#navigation ul li a").click(function () {
            TableContentEvent();
        });
        $("expand-overplay.fixed-top").click(function () {
            TableContentEvent();
        });
        $(document).click(function (e) {
            var container = $(".table-content ");
            // if the target of the click isn't the container nor a descendant of the container
            if (!container.is(e.target) && container.has(e.target).length === 0) {
                TableContentEvent();
            }
        });
    }

    $(document).on("click", "[to-scroll]", function (e) {
        e.preventDefault();

        var link = $(this).attr("to-scroll"),
            position_content = $(".ppc-typhography").offset().top,
            height_content = $(".ppc-typhography").outerHeight();

        let animate = function (position) {
            $("body,html").animate({ scrollTop: position }, 900);
        };

        if ($(link).length > 0) {
            var position = $(link).offset().top - 50;

            $(this).parent().parent().hasClass("rating-star") && animate(position);

            if (position - position_content < 1300) {
                animate(position);
            } else {
                animate(position);
                $(".lc__btn-overlay").fadeOut();
                $(".ppc-typhography").addClass("full-typhography");
            }
            // height_content > 1300 && animate(position);
        }
    });

    //  detect ouside navigation mobile
    var elementToToggle = $(".js-detect");

    // Copy to clip board
    $(".js-copy-clipboard").on("click", function () {
        copyToClipboard("#copy");
        var toolbox = $(this).find(".lc-tooltip-box");
        toolbox.addClass("active");

        setTimeout(function () {
            toolbox.removeClass("active");
        }, 1000);
    });

    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).html()).select();
        document.execCommand("copy");
        $temp.remove();
    }

    // Notify MB
    $(".js-notify-mb").click(function () {
        var notifyMb = $(".notify-boxMB");
        var inner = notifyMb.find(".notify-boxMB_inner");
        var bottomBox = inner.find(".notify-boxMB_bottom");
        if (inner.length) {
            notifyMb.addClass("open");
        }
        if (bottomBox.hasScrollBar()) {
            inner.addClass("active");
        } else {
            inner.removeClass("active");
        }
    });

    var previousScrollY = 0;
    $(document).on("click touch", ".close-md", function () {
        var notifyMb = $(".notify-boxMB");
        notifyMb.removeClass("open");

        previousScrollY = window.scrollY;
        $("html")
            .css({
                marginTop: 0,
            })
            .removeClass("disable-scroll-safari");

        window.scrollTo(0, previousScrollY);

        $("#textSuccessHeaderMB").addClass("fade");
    });

    $(".notify-boxMB").mouseup(function (event) {
        // console.log(1);
        if (!$(".js-detect").is(event.target) && $(".js-detect").has(event.target).length === 0) {
            $(".notify-boxMB").removeClass("open");

            $("html").css({ marginTop: 0 }).removeClass("disable-scroll-safari");

            window.scrollTo(0, previousScrollY);
        }
    });

    function load_thuoc_lien_quan() {
        //load more
        var btn = $(".js-loadmore");
        var group_list = $("[list-group]"),
            width = $(window).width();
        batch = 6;

        group_list.each(function () {
            var that = $(this),
                item = that.find("[list-item]"),
                parent = that.parent("[wrap-list]"),
                btn_load = parent.find(".js-loadmore");

            item.hide();
            item.slice(0, batch).fadeIn();

            item.length < batch ? btn_load.hide() : btn_load.show();

            var countItemHidden = parent.find("[list-item]:hidden").length;
            countItemHidden === 0 && btn.hide();
        });

        btn.each(function () {
            btn.click(function (e) {
                e.preventDefault();

                var parent = $(this).parent("[wrap-list");

                $(parent).find("[list-item]:hidden").slideDown(".2");

                $(parent).find("[list-item]:hidden").length === 0 && $(this).fadeOut();
            });
        });
    }
    load_thuoc_lien_quan();

    // $('.cs-dropdown').cDropdown();
    $(".dropdown").cDropdown();

    $(window).on("load", function () {
        // edit_gallery();
    });

    // Tab event location
    $(".js-tabs").each(function () {
        var jsWrapper = $(this);
        var tabItem = $(".js-tabs .tab-item");

        tabItem.click(function (e) {
            e.preventDefault();
            var data_tab = $(this).attr("aria-tab");
            var tabShow = jsWrapper.find(".tab-content .tab-cv");

            tabItem.removeClass("active");
            $(this).addClass("active");

            tabShow.removeClass("showed");
            $(`.${data_tab}`).addClass("showed");
        });
    });

    // Tab event pop up location
    $(".js-tabMb .tab-item").click(function () {
        var dropdown = $(this).closest(".head-inner").find(".dropdown-group");
        // console.log(dropdown);
        $(".js-tabMb .tab-item").removeClass("active");
        $(this).addClass("active");
        if ($(".js-tabMb .tab-item:nth-child(2)").hasClass("active")) {
            dropdown.hide();
        } else {
            dropdown.show();
        }
    });

    function vuLoadMoreShop() {
        //load more
        var btn_loadMore = $(".js-loadMore"),
            batch = 5;

        $(".feature__location-inner").each(function () {
            var that = $(this),
                address_item = that.find(".address-item");
            address_item.hide();
            address_item.slice(0, batch).fadeIn();

            var countItemHidden = that.find(".address-item:hidden").length;

            countItemHidden === 0 && $(this).find(".rs-view").css("cssText", "display : none !important");

            $(this).find(btn_loadMore).children("span").text(parseInt(countItemHidden));
        });

        btn_loadMore.each(function () {
            var block_location = $(this).closest(".feature__location-inner");

            btn_loadMore.click(function (e) {
                e.preventDefault();

                var parent = $(this).closest(".feature__location-inner");
                $(parent).find(".address-item:hidden").slice(0, batch).css("cssText", "display : block !important");
                $(parent).find(".address-item:hidden").length === 0 && $(this).parent().css("cssText", "display : none !important");

                $(".feature__location-inner").animate(
                    {
                        scrollTop: $(this).offset().top,
                    },
                    1500
                );

                parseInt($(".address-item:hidden").length) > 0
                    ? $(this)
                          .find("span")
                          .text(parseInt($(".address-item:hidden").length))
                    : $(this).css("cssText", "display : none !important");
            });
        });
    }
    vuLoadMoreShop();
    tabs();
});

function modal_detail() {
    $(".lc-detail .modal").addClass("modal-detail");
}

function tabs() {
    $(document).click(".js-tabs .tab-item", function (e) {
        // e.preventDefault();
        var $that = $(this),
            parent = $that.find(".js-tabs"),
            tabCV = parent.find(".tab-cv.showed");

        if (tabCV.children().length === 0) {
            $(".tab").css("border-radius", "8px");
            tabCV.removeClass("showed").hide();
        } else {
            $(".tab").css("border-radius", "8px 8px 0px 0px");
        }
    });
}

/**
 *
 * DETAIL PROMOTION
 *
 * **/
function searchPromotion() {
    var inputPromotionSearch = $(".jsPromotionSearch");

    var btnClose = $(".jsSearchClose");
    var btnCacel = $(".jsSearchCancel");
    var dropdownMenu = $(".dropdown-menu");

    inputPromotionSearch.on("change keydown paste input propertychange click keyup", function userImportInput() {
        var valueInput = inputPromotionSearch.val().trim();

        btnClose.children().hide();
        dropdownMenu.removeClass("open");

        if (responsive) {
            $(".combo__promotion-search").addClass("fixed-mobile");

            $("html, body").addClass("disable-scroll");
        }

        if (valueInput) {
            btnClose.children().show();
            dropdownMenu.addClass("open");
        }
    });

    btnClose.click(function () {
        $(this).children().hide();
        inputPromotionSearch.val("");
        $(".combo__promotion-suggest .dropdown-menu.open").removeClass("open");
    });

    //
    btnCacel.click(function () {
        if (responsive) {
            $(this).children().hide();
            inputPromotionSearch.val("");

            $(".combo__promotion-search").removeClass("fixed-mobile");
            btnClose.children().hide();

            $(".combo__promotion-suggest .dropdown-menu.open").removeClass("open");

            $("html, body").removeClass("disable-scroll");
        }
    });

    $(document).on("click", ".dropdown-menu.open a", function () {
        $(".combo__promotion-suggest .dropdown-menu.open").removeClass("open");

        $(".combo__promotion-search.fixed-mobile").removeClass("fixed-mobile");
    });

    // click outside
    var width = $(window).width();
    if (width > 992) {
        $(document).on("click", function (e) {
            if (!inputPromotionSearch.is(e.target)) {
                $(".combo__promotion-suggest .dropdown-menu.open").removeClass("open");
            }
        });
    }
}

function scrollTabMenu() {
    //menu scroll NguyĂªnND

    // cache the navigation links
    var $navigationLinks = $("#navigation > ul > li > a");
    // cache (in reversed order) the sections
    var $sections = $($(".heading-drugs").get().reverse());

    // map each section id to their corresponding navigation link
    var sectionIdTonavigationLink = {};
    $sections.each(function () {
        var id = $(this).attr("id");
        sectionIdTonavigationLink[id] = $("#navigation > ul > li > a[href=\\#" + id + "]");
    });

    // throttle function, enforces a minimum time interval
    function throttle(fn, interval) {
        var lastCall, timeoutId;

        return function () {
            var now = new Date().getTime();

            if (lastCall && now < lastCall + interval) {
                // if we are inside the interval we wait
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    lastCall = now;
                    fn.call();
                }, interval - (now - lastCall));
            } else {
                // otherwise, we directly call the function
                lastCall = now;
                fn.call();
            }
        };
    }

    function highlightNavigation() {
        // get the current vertical position of the scroll bar
        var scrollPosition = $(window).scrollTop();

        // iterate the sections
        $sections.each(function () {
            var currentSection = $(this);
            // get the position of the section
            var sectionTop = currentSection.offset().top;
            var width = $(window).width();

            // if the user has scrolled over the top of the section
            if (scrollPosition >= sectionTop - 70) {
                // get the section id
                var id = currentSection.attr("id");
                // get the corresponding navigation link
                var $navigationLink = sectionIdTonavigationLink[id];

                var nav_text = $navigationLink.text();

                if (responsive) {
                    $(".table-heading").text(nav_text);
                }
                // if the link is not active
                // console.log(!$navigationLink.hasClass('active'));
                if (!$navigationLink.hasClass("active")) {
                    // remove .active class from all the links
                    $navigationLinks.removeClass("active");
                    // add .active class to the current link
                    $navigationLink.addClass("active");
                }
                // we have found our section, so we return false to exit the each loop
                return false;
            }
        });
    }

    $(window).scroll(throttle(highlightNavigation, 100));
}
var repsonsive = $(window).width() < 992;
function promotionModalEvent() {
    var previousScrollY = 0;

    // click button
    function enableScroll() {
        $("html").css({ marginTop: 0 }).removeClass("disable-scroll-safari");

        $(".modal-promotion").removeClass("modal--is-visible");

        window.scrollTo(0, previousScrollY);
    }

    if (repsonsive) {
        function disableScroll() {
            previousScrollY = window.scrollY;

            $("html")
                .css({
                    marginTop: -previousScrollY,
                })
                .addClass("disable-scroll-safari");
        }

        $(document).on("click", 'a[aria-controls="modalviewdetail"]', function () {
            disableScroll();
        });

        $(document).on("click", ".js-close, #modalviewdetail .js-modal-close", function (e) {
            enableScroll();
        });
    }

    $(document).on("click", ".modal-promotion", function (e) {
        enableScroll();
    });

    function outside_remove_scroll(e) {
        if ($(".modal.modal-promotion, #modalviewdetail").is(e.target) && $(".modal.modal-promotion, #modalviewdetail").has(e.target).length === 0) {
            enableScroll();
        }
    }

    //click outside
    $(document).on("click", ".modal-promotion, #modalviewdetail", function (e) {
        // console.log(1111);
        outside_remove_scroll(e);
    });
}

let init = () => {
    modal_detail();

    tabs();

    searchPromotion();
    // scrollFixedTopCTA();

    scrollTabMenu();

    promotionModalEvent();
};
init();

//fix
function locationSeoGoogle() {
    var locationHash = window.location.hash || false;

    var tabNavigation = $("#navigation"),
        tabNavigationItem = tabNavigation.find("a");

    elem = $(`a[href='${locationHash}'],${locationHash}`);
    // console.log(locationHash);
    if (locationHash) {
        $(".detail_main .tpcn-typho").addClass("full-typhography");
        $("html").addClass("detail-html");
        $(".tpcn-typho .lc__btn-overlay").hide();

        setTimeout(() => {
            elem.trigger("click");
        }, 900);
    }
}
// locationSeoGoogle();
$(window).on("load", function () {
    locationSeoGoogle();
});

function containerElasticTab() {
    //tab section link
    function targetTab() {
        var tabItem = $(".js-tabSelector");

        elasticSelector(".js-tabElastic");

        tabItem.on("click touchstart", function (e) {
            e.preventDefault();
            var that = $(this),
                target = that.attr("target");

            elasticTab(that);

            activeItem(tabItem, this);

            target === "large-text" ? $(".tpcn-typho").addClass("large-text") : $(".tpcn-typho").removeClass("large-text");
        });
    }

    function activeItem(selectorItem, Item) {
        selectorItem.removeClass("active");
        $(Item).addClass("active");
    }

    //Elastic
    function elasticSelector(parent) {
        var parent = $(parent);

        var activeItem = parent.find(".active");

        var activeWidth = activeItem.innerWidth();
        var activeHeight = activeItem.innerHeight();

        $(".js-selector").css({
            left: activeItem.position.left + "px",
            width: activeWidth + "px",
            height: activeHeight + "px",
        });
    }

    function elasticTab(that) {
        var activeWidth = that.innerWidth();
        var activeHeight = that.innerHeight();
        // console.log("activeHeight", activeHeight);
        var itemPos = that.position();
        // console.log(itemPos);
        $(".js-selector").css({
            left: itemPos.left + "px",
            width: activeWidth + "px",
        });
    }

    targetTab();
}
containerElasticTab();

jQuery.fn.extend({
    cDropdown: function () {
        return this.each(function () {
            var containermenu = $(this);
            var body = $("body");
            var arrow = containermenu.find(".c-dropdown-arrow");
            var itemmenu = containermenu.find(".dropdown-button"),
                itemmenuActive = containermenu.find(".dropdown-button.active"),
                search = containermenu.find(".dropdown-menu");
            input = containermenu.find(".form-search-input");
            iconClose = search.find(".js-close");

            iconClose.click(function () {
                $(this).closest(".dropdown-menu").removeClass("open");
                body.removeClass("disable-scroll");
            });

            itemmenu.click(function (e) {
                var submenuitem = containermenu.find(".dropdown-menu");

                itemmenu.toggleClass("active");
                submenuitem.toggleClass("open");
                arrow.addClass("active");
            });

            $(document).click(function (e) {
                if (!containermenu.is(e.target) && containermenu.has(e.target).length === 0) {
                    var isopened = containermenu.find(".dropdown-menu").css("display");
                    if (isopened == "block") {
                        containermenu.find(".dropdown-menu").removeClass("open");
                        arrow.removeClass("active");
                        itemmenu.removeClass("active");
                    }
                }
            });
        });
    },
    checkList: function () {
        return this.each(function (e) {
            var option = $(this).find(".radio");
            option.on("click", function () {
                option.removeClass("checked");
                $(this).addClass("checked");
            });
        });
    },

    hasScrollBar: function () {
        return this.get(0).scrollHeight > this.height();
    },
});

$(document).on("click", ".feature__location-inner.check-form .radio", function () {
    $(".feature__location-inner.check-form .radio").removeClass("checked");
    $(this).addClass("checked");
});
// set style for badge div
$(document).ready(function (e) {
    let findBadge = $(".badge-product").find(".badge-item").length;
    if (findBadge >= 1) {
        $(".badge-style").attr("style", "margin-left:124px");
    }
});
