
// (function ($) {

var preloader = 'off'; // on - for enable preloader, off - for disable preloader

/* predefined vars begin */
var mobile_menu_show = 0;
var $tmp_h = '101';
/* predefined vars end */

/* --------------------------------------------------
 * header | sticky
 * --------------------------------------------------*/
function header_sticky() {
    jQuery("header").addClass("clone", 1000, "easeOutBounce");
    var $document = $(document);
    var vscroll = 0;
    var header = jQuery("header.autoshow");
    if ($document.scrollTop() >= 50 && vscroll == 0) {
        header.removeClass("scrollOff");
        header.addClass("scrollOn");
        header.css("height", "auto");
        vscroll = 1;
    } else {
        header.removeClass("scrollOn");
        header.addClass("scrollOff");
        vscroll = 0;
    }
}

/* --------------------------------------------------
 * plugin | enquire.js
 * --------------------------------------------------*/
function init_resize() {
    enquire.register("screen and (min-width: 993px)", {
        match: function () {
            mobile_menu_show = 1;
        },
        unmatch: function () {
            mobile_menu_show = 0;
            jQuery("#menu-btn").show();
        }
    });

    enquire.register("screen and (max-width: 993px)", {
        match: function () {
            $('header').addClass("header-mobile");
        },
        unmatch: function () {
            $('header').removeClass("header-mobile");
            jQuery('header').css("height", $tmp_h);
        }
    });

    init();

    var header = $('header');
    header.removeClass('smaller');
    header.removeClass('logo-smaller');
    header.removeClass('clone');


};

/* --------------------------------------------------
 * center x and y
 * --------------------------------------------------*/
function center_xy() {
    jQuery('.center-xy').each(function () {
        jQuery(this).parent().find("img").on('load', function () {
            var w = parseInt(jQuery(this).parent().find(".center-xy").css("width"), 10);
            var h = parseInt(jQuery(this).parent().find(".center-xy").css("height"), 10);
            var pic_w = jQuery(this).css("width");
            var pic_h = jQuery(this).css("height");
            var tp = jQuery(this).parent();
            tp.find(".center-xy").css("left", parseInt(pic_w, 10) / 2 - w / 2);
            tp.find(".center-xy").css("top", parseInt(pic_h, 10) / 2 - h / 2);
            tp.find(".bg-overlay").css("width", pic_w);
            tp.find(".bg-overlay").css("height", pic_h);
        }).each(function () {
            if (this.complete) $(this).load();
        });
    });
}
/* --------------------------------------------------
 * add arrow for mobile menu
 * --------------------------------------------------*/
function menu_arrow() {
    // mainmenu create span
    jQuery('#mainmenu li a').each(function () {
        if ($(this).next("ul").length > 0) {
            $("<span></span>").insertAfter($(this));
        }
    });
    // mainmenu arrow click
    jQuery("#mainmenu > li > span").on("click", function () {

        var iteration = $(this).data('iteration') || 1;
        switch (iteration) {
            case 1:
                $(this).addClass("active");
                $(this).parent().find("ul:first").css("height", "auto");
                var curHeight = $(this).parent().find("ul:first").height();
                $(this).parent().find("ul:first").css("height", "0");
                $(this).parent().find("ul:first").animate({
                    'height': curHeight
                }, 300, 'easeOutQuint');
                $('header').css("height", $('#mainmenu')[0].scrollHeight + curHeight + (parseInt($tmp_h) * 2));
                break;
            case 2:
                var curHeight = $(this).parent().find("ul:first").height();
                $(this).removeClass("active");
                $(this).parent().find("ul:first").animate({
                    'height': "0"
                }, 300, 'easeOutQuint');
                $('header').css("height", $('#mainmenu')[0].scrollHeight - curHeight + (parseInt($tmp_h) * 2));
                break;
        }
        iteration++;
        if (iteration > 2) iteration = 1;
        $(this).data('iteration', iteration);
    });
    jQuery("#mainmenu > li > ul > li > span").on("click", function () {
        var iteration = $(this).data('iteration') || 1;
        switch (iteration) {
            case 1:
                $(this).addClass("active");
                $(this).parent().find("ul:first").css("height", "auto");
                $(this).parent().parent().parent().find("ul:first").css("height", "auto");
                var curHeight = $(this).parent().find("ul:first").height();
                $(this).parent().find("ul:first").css("height", "0");
                $(this).parent().find("ul:first").animate({
                    'height': curHeight
                }, 400, 'easeInOutQuint');
                break;
            case 2:
                $(this).removeClass("active");
                $(this).parent().find("ul:first").animate({
                    'height': "0"
                }, 400, 'easeInOutQuint');
                break;
        }
        iteration++;
        if (iteration > 2) iteration = 1;
        $(this).data('iteration', iteration);
    });
}
/* --------------------------------------------------
 * multiple function
 * --------------------------------------------------*/
function init() {
    var sh = jQuery('#de-sidebar').css("height");
    var dh = jQuery(window).innerHeight();
    var h = parseInt(sh) - parseInt(dh);

    function scrolling() {
        var mq = window.matchMedia("(min-width: 993px)");
        var ms = window.matchMedia("(min-width: 768px)");
        if (mq.matches) {
            var distanceY = window.pageYOffset || document.documentElement.scrollTop,
                shrinkOn = 0,
                header = jQuery("header");
            if (distanceY > shrinkOn) {
                header.addClass("smaller");
            } else {
                if (header.hasClass('smaller')) {
                    header.removeClass('smaller');
                }
            }
        }
        if (mq.matches) {
            if (jQuery("header").hasClass("side-header")) {
                if (jQuery(document).scrollTop() >= h) {
                    jQuery('#de-sidebar').css("position", "fixed");
                    if (parseInt(sh) > parseInt(dh)) {
                        jQuery('#de-sidebar').css("top", -h);
                    }
                    jQuery('#main').addClass("col-md-offset-3");
                    jQuery('h1#logo img').css("padding-left", "7px");
                    jQuery('header .h-content').css("padding-left", "7px");
                    jQuery('#mainmenu li').css("width", "103%");
                } else {
                    jQuery('#de-sidebar').css("position", "relative");
                    if (parseInt(sh) > parseInt(dh)) {
                        jQuery('#de-sidebar').css("top", 0);
                    }
                    jQuery('#main').removeClass("col-md-offset-3");
                    jQuery('h1#logo img').css("padding-left", "0px");
                    jQuery('header .h-content').css("padding-left", "0px");
                    jQuery('#mainmenu li').css("width", "100%");
                }
            }

        }
    }

    // --------------------------------------------------
    // looping background
    // --------------------------------------------------

    scrolling();
}
// de_init end //


if (preloader == "off") {
    jQuery("#preloader").hide();
}


/* --------------------------------------------------
 * center-y
 * --------------------------------------------------*/
function centerY() {
    jQuery('.full-height').each(function () {
        var dh = jQuery(window).innerHeight();
        jQuery(this).css("min-height", dh);
    });
}



// --------------------------------------------------
// preloader
// --------------------------------------------------



/* --------------------------------------------------
 * document ready
 * --------------------------------------------------*/

var id_active = 0;
var swiper;
jQuery(document).ready(function () {
    // $('.boxdtns_left_item').click(function () {
    //     $('.boxdtns_left .boxdtns_left_item').removeClass('active');
    //     $(this).addClass('active');
    //     var id = $(this).attr('data-id');
    //     swiper.slideTo(id - 1);
    // });
    var swiperOptions = {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '.swiper-button-next-boxdtns',
            prevEl: '.swiper-button-prev-boxdtns',
        },
        pagination: {
            el: '.swiper-pagination-boxdtns',
            clickable: true,
        },
    }
    var swiper = new Swiper('.boxdtns_right_slide', swiperOptions);

    $(".boxdtns_left_item").click(function () {
        let elementId = $(this).data("id");
        let verticalNavItem = $(".vertical-nav .vertical-nav-item[data-nav-id=" + elementId + "]");
        let prjItem = $(".prj-content[data-prj-id=" + elementId + "]");
        $(".vertical-nav .vertical-nav-item").removeClass("active");
        $(".prj-content").removeClass("active");;
        verticalNavItem.addClass("active");
        prjItem.addClass("active");
        // swiper.destroy();
        // setTimeout(function () {
        //     swiper.init(swiperOptions);
        // }, 1000)
    })

    let sliderHeight = $(".slider-container").outerHeight();
    let sliderHeightHalf = sliderHeight / 2;
    console.log(sliderHeight);
    $(".vertical-nav").css('height', '' + sliderHeight + 'px')
    $(".vertical-nav .vertical-nav-item").css('height', '' + sliderHeightHalf + 'px')




    var swiper2 = new Swiper('.boxdtns_right_slide_2', {
        slidesPerView: 1,
        spaceBetween: 0,
        navigation: {
            nextEl: '.swiper-button-next-boxdtns',
            prevEl: '.swiper-button-prev-boxdtns',
        },
        pagination: {
            el: '.swiper-pagination-boxdtns',
            clickable: true,
        },
    });
    swiper.on('slideChange', function () {
        $('.boxdtns_left_item .boxdtns_left_item').removeClass('active');
        $('#popup_mennu_item_' + (swiper.activeIndex + 1)).addClass('active');
    });


    // if ($('.proj_da_slide').length > 0) {

    //     var artists_slide = new Swiper('.proj_da_slide', {
    //         slidesPerView: 1,
    //         spaceBetween: 0,
    //         navigation: {
    //             nextEl: '.swiper-button-next-proj_da',
    //             prevEl: '.swiper-button-prev-proj_da',
    //         },
    //         pagination: {
    //             el: '.swiper-pagination-proj_da',
    //             clickable: true,
    //         },
    //     });
    // }






    $('.de-preloader').delay(500).fadeOut(500);
    center_xy();
    init_resize();



    if (jQuery('header').hasClass("autoshow")) {
        $op_header_autoshow = 1;
    }


    $('#mainmenu > li:has(ul)').addClass('menu-item-has-children');


    centerY();

    $('#mainmenu li:has(ul)').addClass('has-child');


    // --------------------------------------------------
    // navigation for mobile
    // --------------------------------------------------
    jQuery('#menu-btn').on("click", function () {

        var h = jQuery('header')[0].scrollHeight;
        if (mobile_menu_show == 0) {
            jQuery('header.header-mobile').stop(true).animate({
                'height': h
            }, 200, 'easeOutCubic');
            mobile_menu_show = 1;
        } else {
            jQuery('header.header-mobile').stop(true).animate({
                'height': $tmp_h
            }, 200, 'easeOutCubic');
            mobile_menu_show = 0;
        }
    })


    menu_arrow();
    init();

    new WOW().init();

    $('.libary_area_op').click(function () {
        if ($(this).hasClass('active')) {
            $(this).removeClass('active');
            $('.libary_area_menu_sidebar').removeClass('libary-fix');
        } else {
            $(this).addClass('active');
            $('.libary_area_menu_sidebar').addClass('libary-fix');

        }

    })
    $('.libary_area_close').click(function () {
        $('.libary_area_menu_sidebar').removeClass('libary-fix');
        $('.libary_area_op').removeClass('active');
    })


    /* --------------------------------------------------
     * window | on resize
     * --------------------------------------------------*/
    $(window).resize(function () {
        init_resize();
        centerY();
    });

    $(window).on('load', function () {
        jQuery('#preloader').delay(500).fadeOut(500);
        window.dispatchEvent(new Event('resize'));
    });
    if ($('.artists_slide').length > 0) {

        var artists_slide = new Swiper('.artists_slide', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-artists',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-artists',
                prevEl: '.swiper-button-prev-artists',
            },
            breakpoints: {
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            }
        });
    }

    if ($('.libary_slide').length > 0) {

        var artists_slide = new Swiper('.libary_slide', {
            spaceBetween: 20,
            // loopedSlides: 8,
            loop: true,
            slidesPerView: 3.2,
            direction: "vertical",
            freeMode: true,
            mousewheel: {
                releaseOnEdges: true,
            },

            breakpoints: {
                1200: {
                    slidesPerView: 3.2,
                    direction: "vertical",
                },
                768: {
                    slidesPerView: 8,
                    direction: "vertical",
                    mousewheel: {
                        releaseOnEdges: true,
                    },
                },
                767: {
                    slidesPerView: 5,
                    direction: "horizontal",
                    mousewheel: {
                        releaseOnEdges: false,
                    },
                },
                575: {
                    slidesPerView: 3,
                    direction: "horizontal",
                    mousewheel: {
                        releaseOnEdges: false,
                    },
                },
                480: {
                    slidesPerView: 1.5,
                    direction: "horizontal",
                    mousewheel: {
                        releaseOnEdges: false,
                    },
                },
                320: {
                    slidesPerView: 1.2,
                    direction: "horizontal",
                    mousewheel: {
                        releaseOnEdges: false,
                    },
                },
            }
        });
    }
    // var thumb = document.querySelectorAll(".thumbContainer");

    // thumb.forEach(function (image, index) {
    //     var delay = index * 90;
    //     image.classList.add("fadeInSlide");
    //     image.style.animationDelay = delay + "ms";
    // });




    if ($('.sponcor_slide').length > 0) {
        var artists_slide = new Swiper('.sponcor_slide', {
            slidesPerView: 6,
            spaceBetween: 10,
            pagination: {
                el: '.swiper-pagination-sponcor',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-sponcor',
                prevEl: '.swiper-button-prev-sponcor',
            },
            breakpoints: {
                992: {
                    slidesPerView: 6,
                    spaceBetween: 10,
                },
                768: {
                    slidesPerView: 4,
                    spaceBetween: 10,
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                480: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
                320: {
                    slidesPerView: 2,
                    spaceBetween: 10,
                },
            }
        });
    }





    $('.course_tab_item').click(function () {
        $('.course_tab_other .course_tab_item').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('data-id');
        $('.course_content_other').hide();
        $('#course_box' + id).show();
    })
    $('.dct_tab_item').click(function () {
        $('.dct_tab .dct_tab_item').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('data-id');
        $('.dct_other').hide();
        $('#dct' + id).show();
    })


    if ($('.knowledge_content_slide').length > 0) {
        var artists_slide = new Swiper('.knowledge_content_slide', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-knowledge',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-knowledge',
                prevEl: '.swiper-button-prev-knowledge',
            },
            breakpoints: {
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
            }
        });
    }
    $('.knowledge_tab_item').click(function () {
        $('.knowledge_tab_other .knowledge_tab_item').removeClass('active');
        $(this).addClass('active');
        var id = $(this).attr('data-id');
        $('.knowledge_content_other').hide();
        $('#knowledge_box' + id).show();

        if ($('.knowledge_content_slide').length > 0) {
            var artists_slide = new Swiper('.knowledge_content_slide', {
                slidesPerView: 3,
                spaceBetween: 30,
                pagination: {
                    el: '.swiper-pagination-knowledge',
                    clickable: true,
                },
                navigation: {
                    nextEl: '.swiper-button-next-knowledge',
                    prevEl: '.swiper-button-prev-knowledge',
                },
                breakpoints: {
                    992: {
                        slidesPerView: 3,
                        spaceBetween: 30,
                    },
                    575: {
                        slidesPerView: 2,
                        spaceBetween: 30,
                    },
                    480: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                    },
                    320: {
                        slidesPerView: 1,
                        spaceBetween: 30,
                    },
                }
            });
        }
    })

    if ($('.service_slide').length > 0) {
        var service_slide = new Swiper('.service_slide', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-service',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-service',
                prevEl: '.swiper-button-prev-service',
            },
            breakpoints: {
                992: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
            }
        });
    }

    if ($('.opinion_slide').length > 0) {
        var service_slide = new Swiper('.opinion_slide', {
            slidesPerView: 4,
            spaceBetween: 112,
            pagination: {
                el: '.swiper-pagination-opinion',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-opinion',
                prevEl: '.swiper-button-prev-opinion',
            },
            breakpoints: {
                1200: {
                    spaceBetween: 112,
                },
                992: {
                    slidesPerView: 4,
                    spaceBetween: 30,
                },
                768: {
                    slidesPerView: 3,
                    spaceBetween: 30,
                },
                575: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                480: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                320: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
            }
        });
    }
    var proj_da_slide = new Swiper('.proj_da_slide', {
        slidesPerView: 'auto',
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next-proj_da',
            prevEl: '.swiper-button-prev-proj_da',
        },
        pagination: {
            el: '.swiper-pagination-proj_da',
            clickable: true,
        },
    });

    // scroll to follow 
    let currentLink = location.href;
    $(".follow-trigger").attr("href", `${currentLink}#follow-artist`)


    // slider anh sp
    var galleryThumbs = new Swiper('.detail_other_slide', {
        spaceBetween: 16,
        slidesPerView: 5,
        freeMode: true,
        watchSlidesVisibility: true,
        watchSlidesProgress: true,
        watchOverflow: true,

    });
    var galleryProductDetail = new Swiper('.detail_child_slide', {
        spaceBetween: 10,
        thumbs: {
            swiper: galleryThumbs
        },
        navigation: {
            nextEl: '.swiper-button-next-other-slide',
            prevEl: '.swiper-button-prev-other-slide',
        },
        pagination: {
            el: '.swiper-pagination-other-slide',
            clickable: true,

        },
    });



});


// var sliderSelector = '.outstanding_slide',
//     options = {
//         init: false,
//         loop: true,
//         speed: 800,
//         // spaceBetween: 30,
//         slidesPerView: 5, // or 'auto'
//         centeredSlides: true,
//         effect: 'coverflow', // 'cube', 'fade', 'coverflow',
//         coverflowEffect: {
//             rotate: 0, // Slide rotate in degrees
//             stretch: -40, // Stretch space between slides (in px)
//             depth: 100, // Depth offset in px (slides translate in Z axis)
//             //                modifier: 1, // Effect multipler
//             slideShadows: true, // Enables slides shadows
//         },
//         grabCursor: true,
//         parallax: true,
//         pagination: {
//             el: '.swiper-pagination-outstanding',
//             clickable: true,
//         },
//         navigation: {
//             nextEl: '.swiper-button-next-outstanding',
//             prevEl: '.swiper-button-prev-outstanding',
//         },
//         breakpoints: {
//             767: {
//                 slidesPerView: 5,
//             },
//             480: {
//                 slidesPerView: 2,
//                 coverflowEffect: {
//                     stretch: -0, // Stretch space between slides (in px)
//                     depth: 50, // Depth offset in px (slides translate in Z axis)
//                 },
//             },
//             320: {
//                 slidesPerView: 'auto',
//             }
//         },
//         // Events
//         on: {
//             imagesReady: function () {
//                 this.el.classList.remove('loading');
//             },
//             slideChange: function () {
//                 var _html = $('.vnsound_outstanding .swiper-slide.swiper-slide-active .outstanding_item_slide').html();
//                 $('.outstanding_txt_content').html(_html);
//             }
//         }
//     };
// var outstanding_slide = new Swiper(sliderSelector, options);

// // Initialize slider
// outstanding_slide.init();


$('.slider-for').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    arrows: false,
    fade: true,
    asNavFor: '.slider-nav'
});
$('.slider-nav').slick({
    slidesToShow: 5,
    slidesToScroll: 1,
    arrows: false,
    cssEase: 'ease',
    asNavFor: '.slider-for',
    dots: false,
    centerMode: true,
    centerPadding: 0,
    focusOnSelect: true,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('.gallery-slider').slick({
    infinite: true,
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 2000,
    arrows: false,
    responsive: [
        {
            breakpoint: 1024,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
                dots: true
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 2
            }
        },
        {
            breakpoint: 480,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});


var sliderlandmark = '.landmark_slide',
    options = {
        init: false,
        loop: true,
        speed: 800,
        // spaceBetween: 30,
        slidesPerView: 4, // or 'auto'
        centeredSlides: true,
        effect: 'coverflow', // 'cube', 'fade', 'coverflow',
        coverflowEffect: {
            rotate: -0, // Slide rotate in degrees
            stretch: -40, // Stretch space between slides (in px)
            depth: 100, // Depth offset in px (slides translate in Z axis)
            //                modifier: 1, // Effect multipler
            slideShadows: true, // Enables slides shadows
        },
        grabCursor: true,
        parallax: true,
        pagination: {
            el: '.swiper-pagination-landmark',
            clickable: true,
        },
        navigation: {
            nextEl: '.swiper-button-next-landmark',
            prevEl: '.swiper-button-prev-landmark',
        },
        breakpoints: {
            900: {
                slidesPerView: 4,
                coverflowEffect: {
                    stretch: -40, // Stretch space between slides (in px)
                    depth: 100, // Depth offset in px (slides translate in Z axis)
                },
            },
            767: {
                slidesPerView: 4,
                coverflowEffect: {
                    stretch: -0, // Stretch space between slides (in px)
                    depth: 50, // Depth offset in px (slides translate in Z axis)
                },
            },
            480: {
                slidesPerView: 2,
                coverflowEffect: {
                    stretch: 0, // Stretch space between slides (in px)
                    depth: 50, // Depth offset in px (slides translate in Z axis)
                },
            },
            320: {
                slidesPerView: 'auto',
            }
        },
        // Events
        on: {
            imagesReady: function () {
                this.el.classList.remove('loading');
            }
        }
    };
var landmark_slide = new Swiper(sliderlandmark, options);

// Initialize slider
landmark_slide.init();

// })(jQuery);
$('.proj_da').on('shown.bs.modal', function (e) {
    $(".ql-editor").removeAttr("contenteditable")
    $(".ql-clipboard").removeAttr("contenteditable")
    var proj_da_slide = new Swiper('.proj_da_slide_popup', {
        slidesPerView: 1,
        spaceBetween: 30,
        navigation: {
            nextEl: '.swiper-button-next-proj_da',
            prevEl: '.swiper-button-prev-proj_da',
        },
        pagination: {
            el: '.swiper-pagination-proj_da',
            clickable: true,
        },

    });
    proj_da_slide.on('paginationUpdate', function () {
        proj_da_slide.update();
    });
})
