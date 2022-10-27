(function($){

	$(document).ready(function() {
		$(function(){
			//$('#header .lang a').opOver(1.0,0.5,200);	
			//$('#header .contact a').opOver(1.0,0.5,200);
			//$('#header #subnav ul li a').opOver(1.0,0.5,200);
			$('#sidemenu #maker ul li a').opOver(1.0,0.5,200);
			$('#favorite-list .product a').opOver(1.0,0.5,200);

			//$('.btn-list a').opOver(1.0,0.5,200);	
			//$('.button a').opOver(1.0,0.5,200);	
			$('.btn-ccl a').opOver(1.0,0.5,200);
			$('.bn a').opOver(1.0,0.5,200);

		});
	});
	
	/* bxslider */
	$(function(){
		var slider = $("#slider ul").bxSlider({
			slideWidth: 860,
			slideMargin: 90,
			auto: true,
			easing: 'easeInOutQuint',
			pause: 6000,
			speed: 1200,
			pager: true, //ページャーの有無
			minSlides: 1,
			maxSlides: 3,
			nextText: "次へ",
			prevText: "前へ",
			onSliderLoad: function(){
				var w = 0;
				$("#slider ul > li").each(function(){
					w += $(this).outerWidth(true);
				}).parent().css("width", w);
			},
			onSlideAfter: function(){
				slider.startAuto();
			}
		});
	});
	
	/* サイドメニューアコーディオン */
	$(function() {
		var $header = $("#header");

		function isPc() {
			return ($header.css('white-space') == 'normal');
		}

		function isSp() {
			return ($header.css('white-space') == 'nowrap');
		}
		
		$('#sidemenu .accordion ul').hide();
		$('#sidemenu #category p').click(function(){
			$(this).next().slideToggle();
			$(this).toggleClass("active");
			return false;
		});
		$('#sidemenu #maker p').click(function(){
			$(this).next().slideToggle();
			$(this).toggleClass("active");
			return false;
		});
		$('#sidemenu #spec p').click(function(){
			$(this).next().slideToggle();
			$(this).toggleClass("active");
			return false;
		});
		$('#sidemenu #price p').click(function(){
			$(this).next().slideToggle();
			$(this).toggleClass("active");
			return false;
		});
		if (isPc()) {
			$('#sidemenu #category ul').show();
			$('#sidemenu #maker ul').show();
			//$('#sidemenu #category ul').slideDown();
			//$('#sidemenu #maker ul').slideDown();
			$('#sidemenu #category h2').toggleClass("active");
			$('#sidemenu #maker h2').toggleClass("active");
		}
		
		if (isSp()) {
			$('#sidemenu2 .accordion ul').hide();
			$('#sidemenu2 #category2 h2').click(function(){
				$(this).next().slideToggle();
				$(this).toggleClass("active");
				return false;
			});
			$('#sidemenu2 #maker2 h2').click(function(){
				$(this).next().slideToggle();
				$(this).toggleClass("active");
				return false;
			});
			$('#sidemenu2 #spec2 h2').click(function(){
				$(this).next().slideToggle();
				$(this).toggleClass("active");
				return false;
			});
			$('#sidemenu2 #price2 h2').click(function(){
				$(this).next().slideToggle();
				$(this).toggleClass("active");
				return false;
			});
			
			$('#sidemenu2 #category2 ul').show();
			$('#sidemenu2 #maker2 ul').show();
			//$('#sidemenu #category ul').slideDown();
			//$('#sidemenu #maker ul').slideDown();
			$('#sidemenu2 #category2 h2').toggleClass("active");
			$('#sidemenu2 #maker2 h2').toggleClass("active");
		}
		
	});

	/* グローバルナビを固定
	$(function() {
		var beginFixed = $('#header').height();
		if (beginFixed < $(window).scrollTop()) {
			$('body').addClass('fixed');
		}
		$(window).scroll(function(){
			if (beginFixed < $(this).scrollTop()) {
				$('body').addClass('fixed');
			} else {
				$('body').removeClass('fixed');
			}
		});
	}); */

	/* gnav */
	$(function() {
		$("#gnav .gnav-item").hover(
			function() {
				$(this).find('ul').stop().fadeIn(200);
			},
			function(){
				$(this).find('ul').stop().fadeOut(200);
			}
		);
	});

	/* spnav */
	$(function() {
		var $header = $("#header");
		var $gnav = $("#spmenu");

		function isPc() {
			return ($header.css('white-space') == 'normal');
		}

		function isSp() {
			return ($header.css('white-space') == 'nowrap');
		}

		$("#spnav").click(function() {
			if ($header.hasClass('open')) {
				$header.removeClass('open');
				$gnav.slideUp(400);
			} else {
				$header.addClass('open');
				$gnav.slideDown(400);
			}
		});

		// PC表示のときgnavを表示する
		$(window).resize(function(e) {
			if (isPc()) {
				//$gnav.show();
				//$gnav.find(".gnav-item ul").hide();
			}
		});
	});

	/* PageTopボタン */
	$(function(){
		var topBtn = $('#pagetop');
		topBtn.hide();
		//スクロールが100に達したらボタン表示
		$(window).scroll(function () {
			if ($(this).scrollTop() > 100) {
					topBtn.fadeIn();
			} else {
					topBtn.fadeOut();
			}
		});
		//スクロールしてトップ
		topBtn.click(function (){
			$('body,html').animate({
				scrollTop: 0
			}, 500);
			return false;
		});
	});
	
	/* ページ内リンクのスムーズスクロール */
	// $(function(){
	// 	$('a[href^=#]').click(function(){ 
	// 		var href= $(this).attr("href"); 
	// 		var target = $(href == "#" || href == "" ? 'html' : href);
	// 		var position = target.offset().top;
	// 		$("html, body").animate({scrollTop:position}, 500, "swing");
	// 		return false;
	// 	});
	// });
	
	$(function() {
		var showFlag = false;
		var quickNavi = $('#quicknav');
		quickNavi.css('top', '-80px');
		//スクロールが100に達したらボタン表示
		$(window).scroll(function () {
			if ($(this).scrollTop() > 200) {
				if (showFlag == false) {
					showFlag = true;
					quickNavi.stop().animate({'top' : '0px'}, 300);
				}
			} else {
				if (showFlag) {
					showFlag = false;
					  quickNavi.stop().animate({'top' : '-80px'}, 300);
				}
			}
		});
	});
	
	// スマホの固定メニュー
	$(function(){
	var box    = $("#subnav");
	var boxTop = box.offset().top;
	$(window).scroll(function () {
		if($(window).scrollTop() >= boxTop) {
			box.addClass("fixed");
			$("body").css("margin-top","0px");
		} else {
			box.removeClass("fixed");
			$("body").css("margin-top","0px");
		}
	});
	});
	
	// スマホのタップ用
	(function () {
		var tapClass = "";
		var hoverClass = "";
		var Hover = window.Hover = function (ele) {
		return new Hover.fn.init(ele);
		};
		Hover.fn = {
		//Hover Instance
		init : function (ele) {
		this.prop = ele;
		}
		, bind : function (_hoverClass, _tapClass) {
		hoverClass = _hoverClass;
		tapClass = _tapClass;
		$(window).bind("touchstart", function(event) {
		var target = event.target || window.target;
		var bindElement = null;
		if (target.tagName == "A" || $(target).hasClass(tapClass)) {
		bindElement = $(target);
		} else if ($(target).parents("a").length > 0) {
		bindElement = $(target).parents("a");
		} else if ($(target).parents("." + tapClass).length > 0) {
		bindElement = $(target).parents("." + tapClass);
		}
		if (bindElement != null) {
		Hover().touchstartHoverElement(bindElement);
		}
		});
		}
		, touchstartHoverElement : function (bindElement) {
		bindElement.addClass(hoverClass);
		bindElement.unbind("touchmove", Hover().touchmoveHoverElement);
		bindElement.bind("touchmove", Hover().touchmoveHoverElement);
		bindElement.unbind("touchend", Hover().touchendHoverElement);
		bindElement.bind("touchend", Hover().touchendHoverElement);
		}
		, touchmoveHoverElement : function (event) {
		$(this).removeClass(hoverClass);
		}
		, touchendHoverElement : function (event) {
		$(this).removeClass(hoverClass);
		}
		}
		Hover.fn.init.prototype = Hover.fn;
		Hover().bind("hover", "tap");
		}
	)();


	// 絞り込みフォームのリセットボタン
	$(function(){
		function clearForm(form) {
			for(var i=0; i<form.elements.length; ++i) {
				clearElement(form.elements[i]);
			}
		}
		function clearElement(element) {
			switch(element.type) {
				case "hidden":
				case "submit":
				case "reset":
				case "button":
				case "image":
					return;
				case "file":
					return;
				case "text":
				case "password":
				case "textarea":
					element.value = "";
					$(element).removeAttr("value");
					return;
				case "checkbox":
				case "radio":
					element.checked = false;
					$(element).removeAttr("checked");
					return;
				case "select-one":
				case "select-multiple":
					element.selectedIndex = 0;
					return;
				default:
			}
		}

		$('#refine-reset').on('click',function(){
			clearForm(document.getElementById('refine-form'));
		});

		$('#refine-form select').each(function(param) {
			$(this).val($(this).data('selected'));
		});
	});


	// 絞り込みフォームのsubmitボタンを押したときに空のクエリを削除する
	$(function(){
		function cleanQuery(query) {
			var arr = [];
			$.each(query.split('&'), function(i, param) {
				if (param === 's=') {
					arr.push(param);
				}
				if (param.split('=')[1]) {
					arr.push(param);
				}
			});
			return arr.join('&');
		}

		$('#refine-form').on('submit', function(event) {
			console.log(event);
			event.preventDefault();

			var query = cleanQuery($(this).serialize());
			location.href = this.action + '?' + query;
		});
	});

	// 絞り込みフォームのスペックを6つ以上チェックできないようにする
	$('#refine-form input[name="spec[]"]').click(function() {
		var $count = $('#refine-form input[name="spec[]"]:checked').length;
		var $not = $('#refine-form input[name="spec[]"]').not(':checked');
	
		if ($count >= 5) {
			$not.attr("disabled",true);
		} else {
			$not.attr("disabled",false);
		}
	});

	// reviewの5段階評価
	$(function(){
		if ($('#rateit').length) {
			$('#rateit').rateit({
				max: 5,
				step: 1,
			});
		}
	});

	$(function(){
		if ($('.revi#container').length) {
			$('#loginEmail').text($('#hiddenLoginEmail').val());
			$('#productName').text($('#hiddenProductName').val());

		} else if ($('.unsu#container').length) {
			$('#loginUser').text($('#hiddenLoginUser').val());
		}
	});

})(jQuery);

