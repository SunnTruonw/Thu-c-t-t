$(document).ready(function() {

    $(".menu-desktop .nav-sub .nav-sub-child").each(function() {
        let length = $(this).find(".nav-sub-item-child").length;
        if (length) {
            $(this).prev("a").append("<i class='fa fa-angle-right pt_icon_right'></i>");
        }
    });
    // $(".menu-desktop .nav-item .nav-sub").each(function() {
    //     if ($(this).find(".nav-sub-item").length) {
    //         $(this).prev("a").append("<i class='fa fa-angle-down' aria-hidden='true'></i>");
    //     }
    // })
    $(".menu_fix_mobile .nav-sub").each(function() {
        if ($(this).find(".nav-sub-item").length) {
            $(this).parent(".nav-item").prepend("<i class='fa fa-chevron-down mm1'></i>");
        }
    })
    $(".menu_fix_mobile .nav-sub-child").each(function() {
            if ($(this).find(".nav-sub-item-child").length) {
                $(this).parent(".nav-sub-item").prepend("<i class='fa fa-chevron-down mm2'></i>");
            }
        })
        // $(".menu_fix_mobile .megamenu-container .list-megamenu").each(function() {
        //     if ($(this).find(".megamenu-item").length) {
        //         $(this).parents(".nav-megamenu").prepend("<i class='fa fa-chevron-down mega-mn1'></i>");
        //     }
        // });
    $('.menu_fix_mobile .mn-icon').click(function() {
        event.preventDefault();
        $(this).parent('a').next('ul').slideToggle();
        $(this).parent().toggleClass('active');
    });

    $(".megamenu-item-sub .submenu-right3").each(function() {
        let length = $(this).find("li").length;
        if (length) {
            $(this).prev("a").append("<div class='openc'></div>");

        }
    })
    $(".megamenu-item-sub .openc").click(function() {
        event.preventDefault();
        $(this).parents(".megamenu-item-sub").find(".submenu-right3").slideToggle();
        $(this).parents(".megamenu-item-sub").toggleClass('active');
    })

    $(".language_selected").click(function() {
        $(this).parent().find(".language_change").toggle();
    });

    $(".language_selected_mb").click(function() {
        $(this).parent().find(".language_change_mb").toggle();
    });

    $(".mega-mn1").click(function() {
        event.preventDefault();
        $(this).parents(".nav-megamenu").find(".megamenu-container").slideToggle();
    });

    $('.list-bar').click(function() {
        $('.menu_fix_mobile').toggleClass('main-menu-show');
        $(this).toggleClass('change');
    });

    $('.close-menu #close-menu-button').click(function() {
        $(this).parent().parent().removeClass('main-menu-show');
        $('.list-bar').removeClass('change');
    });

    $('.menu_fix_mobile .mm1').click(function() {
        $(this).parent().find('.nav-sub').slideToggle();
        $(this).parent().toggleClass('active');
    });
    $('.menu_fix_mobile .mm2').click(function() {
        $(this).parent().find('.nav-sub-child').slideToggle();
        $(this).parent().toggleClass('active');
    });

    $('.show_search a').click(function() {
        $('#search').slideToggle();
    });
    $('.close-search').click(function() {
        $('#search').slideToggle();
    })
    $('.search_mobile').click(function() {
        $('#search').slideToggle();
    });
    $('.load-more-cate-btn').click(function() {

        $('.cate-right-top').addClass('show-list');
    });

    $('.load-more-cate-btn2').click(function() {

        $('.info_detail .content').addClass('show-list');
        $(this).parent().hide();
    });

    $('.list_image_video .image img').click(function() {
        var src = $(this).attr('data-video');

        var link_video = $('#videos').attr('src', src);
    })

    $(window).scroll(function(event) {
        var pos_body = $('html,body').scrollTop();
        if (pos_body > 105) {
            $('.header2').addClass('fixed');
        } else {
            $('.header2').removeClass('fixed');
        }
    });
    $('.autoplay1-ykkh').slick({
        dots: false,
        infinite: true,
        speed: 300,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: false,
    });

    $('.faded').slick({
        dots: false,
        infinite: true,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        cssEase: 'linear'
    });
    $('.faded-detail').slick({
        dots: true,
        infinite: true,
        speed: 1000,
        autoplay: true,
        autoplaySpeed: 3000,
        fade: true,
        cssEase: 'linear'
    });
    $('.tin-tuc-home').slick({
        dots: false,
        arrows: true,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,

                }
            }
        ]
    });

    $('.autoplay4-ykkh').slick({
        dots: false,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 3,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                }
            }
        ]
    });

    $('.slide_service5').slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                }
            }
        ]
    });



    $('.slide_cate').slick({
        dots: true,
        arrows: false,
        slidesToShow: 6,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    $('.autoplay5-pro').slick({
        dots: false,
        arrows: true,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,

                }
            }
        ]
    });
    $('.autoplay5-pro-2').slick({
        dots: false,
        arrows: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,

                }
            }
        ]
    });
    $('.autoplay4-pro').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });

    $('.autoplay_height').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        vertical: true,
        autoplaySpeed: 2500,
        responsive: [{
            breakpoint: 768,
            settings: {
                slidesToShow: 1,
            }
        }]
    });

    $('.autoplay3-news').slick({
        dots: true,
        arrows: true,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: false,
        autoplaySpeed: 2500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,
                }
            },
            {
                breakpoint: 550,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });


    $('.slide_video').slick({
        dots: false,
        slidesToShow: 3,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 2500,
    });

    $('.autoplay5-doitac').slick({
        dots: false,
        slidesToShow: 7,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
    $('.autoplay6-tintuc').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4,

                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
    $('.autoplay4-ban-chay').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        pauseOnHover: true,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    $('.autoplay6-video').slick({
        dots: false,
        slidesToShow: 4,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 1,
                }
            }
        ]
    });
    $('.autoplay6-spkhac').slick({
        dots: false,
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 1500,
        responsive: [{
                breakpoint: 991,
                settings: {
                    slidesToShow: 4,

                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2,

                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                }
            }
        ]
    });
});






function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

function myFunction2(x) {
    x.classList.toggle("change2");
}