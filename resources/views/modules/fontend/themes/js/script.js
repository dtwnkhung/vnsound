$(function () {
	$('#menu').mmenu();
	$('.nav li').hover(function () {
		$('ul:first', this).stop().slideDown();
	}, function () {
		$('ul', this).hide();
	});

	$('.menu-drop-sub li').hover(function () {
		if ($('ul', this).length > 0) {
			$('.submenu').stop().show();
			$('.submenu').html($('ul', this).html());
		}
	}, function () {
		$('.submenu').stop().hide();
		$('.submenu').html('');
	})

	$('.main-menu-drop').click(function (e) {
		e.stopPropagation();
		$('.subpage,.scroll').stop().slideToggle();
	})
	$(document).click(function () {
		$('.subpage').stop().hide();
	})
	$('.showdangky').click(function (e) {
		e.preventDefault();
		if ($(this).data('product') != '') $('#frmproduct').val($(this).data('product'));
		$('.overlay').stop().fadeIn();
		$('.pop-dangky').stop().fadeIn();
		return false;
	});
	$('.overlay').click(function () {
		$('.overlay').stop().fadeOut();
		$('.pop-dangky').stop().fadeOut();
	})
	$('.menu-drop-sub li').hover(function () {
		$('ul', this).show();
	}, function () {
		$('ul', this).hide();
	})
	var menubar = $('.header').position();
	$(window).scroll(function (event) {
		if ($(this).scrollTop() > (menubar.top) + 76) {
			$('.header').addClass('stic');
		} else {
			$('.header').removeClass('stic');
		}
	});

	/* btn go top */
	$(".gototop").click(function () {
		$("html, body").animate({
			scrollTop: 0
		}, "slow");
		return false;
	});
	$('.intro-detail img,.content-detail img,.content-text img').each(function () {
		$(this).removeAttr('height');
		$(this).css({
			'height': ''
		});
	});


	


	$('.menuleftmobile span').text($('.submenupc li.title').text());
	$('.menuleftmobile span').click(function () {
		$('ul', this).slideDown();
	})
	$('.menuleftmobile ul').html($('.submenupc').html());
	$('.menuleftmobile span').click(function () {
		var me = $(this).parent();
		$('ul', me).stop().slideToggle();
	})
	$('.submenu-left li.active').each(function () {
		$('.menuleftmobile span').text($(this).text());
	});

});

$(function(){
	$('.ih').matchHeight();
	$('.ih1').matchHeight(); 
	$('.item-download').hover(function () {
		if ($(window).width() > 100)
			$('.mask-dl', this).stop().fadeIn('fast');
			//$('.btn-item-pro', this).addClass("btn-item-pro-hover");
	}, function () {
		//$('.btn-item-pro').hide();
		$('.mask-dl', this).hide();
	});
})

(function ($) {
	$.fn.extend({
		menuBar: function () {
			var object = $(this);
			$('li', object).hover(function (e) {
				$('ul', this).stop().slideDown();
			}, function () {
				$('ul', this).stop().hide();
			});
		},

		playVideo: function () {
			var object = $(this);
			var parentObject = object.parent();
			var mainObject = object.parent().parent();
			var video = object.data('video');
			var framevideo = '<div class="youtube-embed-wrapper" style="height:0; overflow:hidden; padding-bottom:56.25%; padding-top:30px; position:relative"><iframe allowfullscreen="" frameborder="0" height="360" src="https://www.youtube.com/embed/' + video + '?autoplay=1" style="position:absolute;top:0;left:0;width:100%;height:100%" width="640"></iframe></div>';
			object.click(function (e) {
				e.preventDefault();
				$('.hide-on-play').hide();
				parentObject.append(framevideo);
				mainObject.css({ 'background': '#EEE' });
			});
		},
		showSearch: function () {
			var obj = this;
			obj.hover(function () {
				$('.b-search-pc', obj).stop().fadeIn();
			}, function () {
				$('.b-search-pc', obj).stop().fadeOut();
			});
		},
		dropProjectHome: function () {
			var obj = this;
			var html = $('.subproject').html();
			$('.drop', obj).html(html);
		},
		dropProjectHomeHover: function () {
			var obj = this;
			$(this).hover(function () {
				$('.drop', obj).stop().slideDown();
			}, function () {
				$('.drop', obj).hide();
			});
		},
		checkNull: function () {
			var obj = this;
			var ok = true;
			$('.notNull', obj).each(function () {
				if ($(this).val() == '') {
					$(this).addClass('error');
					ok = false;
				}
			});
			return ok;
		},
		frmSubmit: function () {
			var obj = this;
			obj.submit(function () {
				var ok = $(this).checkNull();
				if (ok == false) {
					if (obj.data('alert') == '') {
						alert("Bạn cần điền đủ thông tin vào những trường màu đỏ");
					} else {
						alert(obj.data('alert'));
					}
				}
				return ok;
			});
		},

	});
	$(document).ready(function () {
		$('#regfrm').frmSubmit();
		$('#frmnewletter').frmSubmit();
	});
})(jQuery);