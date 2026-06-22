$(function(){

	//IE8 nth-child
	$(".sideNavBox .area li:eq(3)").css("margin-right","0px");
	$(".sideNavBox .area li:eq(7)").css("margin-right","0px");
	$(".areaList li:eq(2)").css("margin-right","0px");
	$(".areaList li:eq(5)").css("margin-right","0px");
	$(".rental dl:eq(4)").css("margin","0");
	$(".officeBox:eq(1)").css("margin-right","0px");
	$(".officeBox:eq(3)").css("margin-right","0px");
	$(".search li:eq(2)").css("margin-right","0px");
	$(".search li:eq(5)").css("margin-right","0px");
	$(".search li:eq(8)").css("margin-right","0px");
	$(".search li:eq(11)").css("margin-right","0px");
	$(".thumb li:eq(2)").css("margin-right","0px");
	$(".thumb li:eq(5)").css("margin-right","0px");
	$(".surround dl:eq(2)").css("margin-right","0px");
	$(".surround dl:eq(5)").css("margin-right","0px");

	//smooth scroll
	$(function(){
    $('a[href^="#"]').click(function(){
        var speed = 500;
        var href= $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        /*console.log(position);*/
        $("html, body").animate({scrollTop:position}, speed, "swing");
        return false;
    });
});

	$("a[href^=#]").click(function() {
		w = $(window).width();
		x = 750;
		if (w >= x) {
			mgSticky = 150;
		}else{
			mgSticky = typeof _mgSticky == "undefined" ? 115 : _mgSticky;
		}
		var speed = 1000;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top - mgSticky;
		$("body,html").animate({scrollTop:position}, speed, "easeInOutCubic");
		return false;
  });

  //MAPのページ内リンク用追記▼
	$("area[href^=#]").click(function() {
		w = $(window).width();
		x = 750;
		if (w >= x) {
			mgSticky = 130;
		}else{
			mgSticky = 120;
		}
		var speed = 1000;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top - mgSticky;
		$("body,html").animate({scrollTop:position}, speed, "easeInOutCubic");
		return false;
  });
  //MAPのページ内リンク用追記▲

	//SP Nav
	/*
	$(".btnSpNav").click(function() {
		if($(".hambergerNav").css("display") == "none"){
			$(".btnSpNav img").attr("src","/common2/images/btn_close.gif");
			$(".hambergerNav").slideDown();
		}else{
			$(".btnSpNav img").attr("src","/common2/images/btn_hamberger.gif");
			$(".hambergerNav").slideUp();
		}
	});

	var w = $(window).width();
	var x = 750;

	$(window).on("load resize", function(){
	w = $(window).width();
  x = 750;
    if (w >= x) {
			mgSticky = 65;
			$(".btnSpNav img").attr("src","/common2/images/btn_hamberger.gif");
			$(".hambergerNav").css("display","none");
    }else{
			mgSticky = 0;
	    $(".sticky").css("display","none");
		}
	});
	*/


	//Sticky Nav
	/*
	var $window = $(window),
	//追従するナビが現れる位置
	$appear = $("nav"),
	//追従するナビのクラス
	$sticky = $(".sticky"),
	appearNav = $appear.offset().top;
	//切り替え幅
	switchWidth = 750;
	var fixedSwitch = false;

	$window.on("scroll", function () {
		if ($window.scrollTop() > appearNav && $(window).width() >= switchWidth) {
			if ( fixedSwitch === false){
				$sticky.show();
				fixedSwitch = true;
		 	}
		}else{
			if ( fixedSwitch === true){
				$sticky.hide();
				fixedSwitch = false;
			}
		}
	});
	$window.trigger("scroll");
	*/
});

$(function () {
	var w = $(window).width();
	if (w > 750 && $("header nav").length) {
		var start_offset = $("header nav").offset().top;
		$(window).on("scroll load", function () {
			var header_h = $("header").outerHeight();
			var scroll = $(window).scrollTop();

			if (scroll >= start_offset) {
				$("header").addClass("fixed");
				$("header").next().css("margin-top", header_h);
			}
			else {
				$("header").removeClass("fixed");
				$("header").next().css("margin-top", 0);
			}

			if ($("header").hasClass("fixed")) {
				$(".hd_logo img").attr("src", "/common2/images/logo_hdr_fix.png");
				$(".hd_tel img").attr("src", "/common2/images/img_top_tel3_fix.png");
				$(".hd_contact img").attr("src", "/common2/images/btn_top_btn240415-b_fix.png");
                //btn_top_contact2_fix.png
			}
			else {
				$(".hd_logo img").attr("src", "/common2/images/logo_hdr.gif");
				$(".hd_tel img").attr("src", "/common2/images/img_top_tel3.png");
				$(".hd_contact img").attr("src", "/common2/images/btn_top_contact2.gif");
			}
		});
	}
	else {
/*
		var start_offsetsp = $(".hd_links").offset().top;
		$(window).on("scroll load", function () {
			var header_h = $("header").outerHeight();
			var links_h = $(".hd_links").outerHeight();
			var scroll = $(window).scrollTop();
			if (scroll >= start_offsetsp) {
				$("header").addClass("fixed_sp");
				$(".hd_links").fadeOut();
				$("header").next().css("margin-top", links_h); //
			}else{
				$("header").removeClass("fixed_sp");
				$(".hd_links").fadeIn();
				$("header").next().css("margin-top", header_h); //
			}
		});
*/

		//var start_offsetsp = $(".hd_links").offset().top;
		var start_offsetsp = $("header").offset().top;
/**/
		$(window).on("scroll load", function () {
			var header_h = $("header").outerHeight();
			var links_h = $(".hd_links").outerHeight();
			var scroll = $(window).scrollTop();

			if (scroll > start_offsetsp) {
				//console.log('scroll >= start_offsetsp', scroll, start_offsetsp, $("header").offset().top);

				//$("header").addClass("fixed_sp");
				$("body").css('margin-top', '51px');
				$("body").css('margin-bottom', '80px');
				//var wrapper_top = $("header").outerHeight();
				//$(".wrapper").offset({top: wrapper_top});

				//$(".hd_links").fadeOut();
				//$("header").next().css("margin-top", links_h); //
				//$("header").next().css("margin-top", header_h + links_h); //

			}
			else {
				//console.log('NOT scroll >= start_offsetsp', scroll, start_offsetsp, $("header").offset().top);

				//$("header").removeClass("fixed_sp");
				$("body").css('margin-top', '0');
				//$(".hd_links").fadeIn();
				//$("header").next().css("margin-top", header_h); //
				//$("header").next().css("margin-top", header_h); //

			}
		});
	}/**/
});
$(function () {
	var path = location.pathname;
	var el = $('ul.gnav').children('li').children('a').children(".bd_wt");
	var href;

	path = path.split('/');
	path = "/" + path[1] + "/";

	console.log(path);

	el.each(function() {
		href = $(this).parent("a").attr('href');
		//alert(href);
		if(path == href) {
			$(this).addClass('act2');
		}
	});
	var w = $(window).width();
	$(".corona p.close").on("click", function () {
		$(".corona").fadeOut();
	});
	if (w > 750) {
		$(".gnav >li").hover(function () {
			$(this).find(".acco_wrap").slideDown();
			$(this).find(".bd_wt").addClass("act");
		}, function () {
			$(this).find(".acco_wrap").stop().slideUp();
			$(this).find(".bd_wt").removeClass("act");
		});
	} else {
		$(".gnav >li >a").on("click",function(){
			if($(this).hasClass("open")){
				$(".gnav >li >a").removeClass("open");
				$(".gnav >li >a").next().stop().slideUp();
				return false;
			}else{
				$(".gnav >li >a").next().slideUp().removeClass("open");
				$(this).next().slideDown().addClass("open");
				$(".gnav >li >a").removeClass("open");
				$(this).addClass("open");
				return false;
			}
		});
	}
});

$(function () {
	$(".close_acco p").css('padding-bottom', '60px');
	var w = $(window).width();
	//alert(h);
	var $animation = $('.icon-animation');
	$animation.on('click', function () {
		var h = $(window).height();
		var header_h = $("header").outerHeight();
		var nav_h = h - header_h;
		$("nav").not(".ftrNav").css("height", nav_h);
		$("nav").not(".ftrNav").stop().slideToggle();
		var nav_list_h = $("nav").not(".ftrNav").children("ul").height();
		if (nav_list_h > nav_h) {
			$("nav").not(".ftrNav").addClass("sc");
		} else {
			$("nav").not(".ftrNav").removeClass("sc");
		}
		if ($(this).hasClass('is-open')) {
			$(this).removeClass('is-open');
			$("html").css("overflow", "auto");
		} else {
			$(this).addClass('is-open');
			$("html").css("overflow", "hidden");
		}
	});
	$(".close_acco p").on("click",function(){
		var h = $(window).height();
		var header_h = $("header").outerHeight();
		var nav_h = h - header_h;
		$("nav").not(".ftrNav").css("height", nav_h);
		$("nav").not(".ftrNav").stop().slideToggle();
		var nav_list_h = $("nav").not(".ftrNav").children("ul").height();
		if (nav_list_h > nav_h) {
			$("nav").not(".ftrNav").addClass("sc");
		} else {
			$("nav").not(".ftrNav").removeClass("sc");
		}
		if ($animation.hasClass('is-open')) {
			$animation.removeClass('is-open');
			$("html").css("overflow", "auto");
		} else {
			$animation.addClass('is-open');
			$("html").css("overflow", "hidden");
		}
		//$animation.removeClass("is-open");
		//$("nav").slideToggle();
	});
});