$(document).ready(function () {
    $('._backTop').click(function () {
        $("html, body").animate({
            scrollTop: 0
        }, "slow");
    });
    if ($(window).scrollTop() > 90) {
        $('._backTop').stop().show();
    } else {
        $('._backTop').stop().hide();
    }
    $(window).scroll(function () {
        if ($(this).scrollTop() > 90) {
            $('._backTop').stop().show();
        } else {
            $('._backTop').stop().hide();
        }
    });
    $('.policy_note_box .btn_banner').click(function () {
        $('.policy_note').css('height', 'auto');
        $(this).hide();
    })

    var windowBreakpoint = $(window).width();

    if (windowBreakpoint >= 769) {
        var _height = $('.nstnd_box_info').height();
        $('.nstnd_item_info_top').css({
            'transform': 'translateY(' + _height + 'px)'
        });
        $(".nstnd_item").mouseover(function () {
            $(this).find('.nstnd_item_info_top').css({
                'transform': 'translateY(0px)'
            });
        });
        $(".nstnd_item").mouseleave(function () {
            $(this).find('.nstnd_item_info_top').css({
                'transform': 'translateY(' + _height + 'px)'
            });
        });
    }


    if ($('.bcvct_slide').length) {
        var swiper_1 = new Swiper('.bcvct_slide', {
            slidesPerView: 3.9,
            spaceBetween: 31,
            pagination: {
                el: '.swiper-pagination-bcvct',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-bcvct',
                prevEl: '.swiper-button-prev-bcvct',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1.3,
                    spaceBetween: 20,
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 1.8,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 3.9,
                }
            }
        });
    }
    if ($('.partner_slide').length) {
        var swiper_1 = new Swiper('.partner_slide', {
            slidesPerView: 6,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-partner',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-partner',
                prevEl: '.swiper-button-prev-partner',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20,
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 2,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 3,
                },
                // when window width is >= 640px
                768: {
                    slidesPerView: 6,
                }
            }
        });
    }
    if ($('.gmst_slide').length) {
        var swiper_1 = new Swiper('.gmst_slide', {
            slidesPerView: 3,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-gmst',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-gmst',
                prevEl: '.swiper-button-prev-gmst',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1.5,
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 3,
                }
            }
        });
    }

    if ($('.th_slide').length) {
        var swiper_1 = new Swiper('.th_slide', {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-th',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-th',
                prevEl: '.swiper-button-prev-th',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1.5,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 2.5,
                }
            }
        });
    }
    if ($('.nstnd_slide').length) {
        var swiper_1 = new Swiper('.nstnd_slide', {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-nstnd',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-nstnd',
                prevEl: '.swiper-button-prev-nstnd',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1.3,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 2.1,
                }
            }
        });
    }
    if ($('.tt_slide').length) {
        var swiper_6 = new Swiper('.tt_slide', {
            slidesPerView: 1,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-tt',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-tt',
                prevEl: '.swiper-button-prev-tt',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 1.8,
                }
            }
        });
    }
    if ($('.cdst_slide2').length) {
        var swiper_1 = new Swiper('.cdst_slide2', {
            slidesPerView: 3,
            spaceBetween: 20,
            pagination: {
                el: '.swiper-pagination-cdst2',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-cdst2',
                prevEl: '.swiper-button-prev-cdst2',
            },
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 1.1,
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 2.1,
                }
            }
        });
    }
    $('#profile-tab').on('click', function () {
        if ($('.cdst_slide').length) {
            setTimeout(function () {
                if ($('.cdst_slide').hasClass('swiper-container-initialized')) {
                    return false;
                }
                var swiper_1 = new Swiper('.cdst_slide', {
                    slidesPerView: 3,
                    spaceBetween: 20,
                    pagination: {
                        el: '.swiper-pagination-cdst',
                        clickable: true,
                    },
                    navigation: {
                        nextEl: '.swiper-button-next-cdst',
                        prevEl: '.swiper-button-prev-cdst',
                    },
                    breakpoints: {
                        // when window width is >= 320px
                        320: {
                            slidesPerView: 1.1,
                        },
                        // when window width is >= 640px
                        640: {
                            slidesPerView: 2.1,
                        }
                    }
                });
            }, 200)

        }
    })








    if ($('.cddt_slide').length) {
        var swiper_3 = new Swiper('.cddt_slide', {
            slidesPerView: 1,
            spaceBetween: 30,
            pagination: {
                el: '.swiper-pagination-cddt',
                clickable: true,
            },
            navigation: {
                nextEl: '.swiper-button-next-cddt',
                prevEl: '.swiper-button-prev-cddt',
            },
        });
    }
    var _height1 = $('.tt_item ').height();
    var _height_img = $('.tt_item_img').height();
    var _height2 = _height1 - _height_img;
    $('.tt_item_body').css('min-height', _height2 + 'px');
    $('.tt_item_body_other').css('min-height', (_height2 - 1) + 'px');
    mobileMenu();
});
// jQuery('.scrollbar-note').scrollbar({
//     "scrollY": "advanced",
// });

function mobileMenu() {
    const windowWidth = $(window).width();

    $('.menu-hamburger').click(function () {
        $('.menu-overlay').addClass('active');
        $('.menu-items').addClass('active');
        $(this).siblings('.header_content_box_new').find('.header_sp').addClass('active');
        $(this).parents('.tatu_header').addClass('active');
        // if ($('.menu-hamburger').hasClass('active')) {
        $(this).addClass('active');
        // }
    });



    $(document).mouseup(function (e) {
        if (
                !$('.menu-items').is(e.target) &&
                $('.menu-items').has(e.target).length === 0 &&
                !$('.header_content_box_new').is(e.target) &&
                $('.header_content_box_new').has(e.target).length === 0
                ) {
            $('.menu-items').siblings('.menu-overlay').removeClass('active');
            $('.menu-items').removeClass('active');
            $('.header_sp').removeClass('active');
            $('.tatu_header').removeClass('active');
        }
    });
    // $('.header_sp_mb span').click(function () {
    //     $('.menu-items').siblings('.menu-overlay').removeClass('active');
    //     $('.menu-items').removeClass('active');
    // })
    $('.menu-hamburger-close').click(function () {
        $('.menu-items').siblings('.menu-overlay').removeClass('active');
        $('.menu-items').removeClass('active');
        $('.header_sp').removeClass('active');
        $('.tatu_header').removeClass('active');
    })

    $('#popup-success').modal('show');

}

new WOW().init();

function loadvideo(element) {
    $("#id_video")[0].src += '?autoplay=1';
    $(element).remove();
}
function clickaudio(el, id) {
    var audio = document.getElementById(id);
    var e = $(el).hasClass('active');
    if (e) {
        $(el).removeClass('active');
        audio.pause();
    } else {
        $(el).addClass('active');
        audio.play();
    }
}
