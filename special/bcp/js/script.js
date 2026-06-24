$(function(){

	//FBタイムラインレスポンシブ
	var fbUrl = "https://www.facebook.com/RegusJP/"
	var fbTitle = "日本リージャス";
	var windowWidth = $(window).width();
	$(window).resize(function(){
		var ww = $(window).width();
		if(windowWidth != ww) {
			$("#fbPagePlugin").html('<div class="fb-page" data-href="' + fbUrl + '" data-width="500" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true" data-show-posts="true"><div class="fb-xfbml-parse-ignore"><blockquote cite="' + fbUrl + '"><a href="' + fbUrl + '">' + fbTitle + '</a></blockquote></div></div>');
			window.FB.XFBML.parse();
			windowWidth = ww;
		}
	});
	
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

	//mouseover
	$("a").hover(function(){
		if($(this).hasClass("notOpacity")){	
		}else{
			$(this).stop(true,false).fadeTo(100, 0.65);
		}
	},function(){
		if($(this).hasClass("notOpacity")){	
		}else{
			$(this).stop(true,false).fadeTo(100, 1.0);
		}
	});
	$(".area a").hover(function(){
			$(this).stop(true,false).fadeTo(100, 1);
	},function(){
			$(this).stop(true,false).fadeTo(100, 1);
	});

	//smooth scroll
	var scrollSpeed = 1000;
	$(".pageTop").click(function() {
		var speed = 1000;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top;
		$("body,html").animate({scrollTop:position}, speed, "easeInOutCubic");
		return false;
  });
	
	$("a[href^=#]").click(function() {
		w = $(window).width();
		x = 750;
		if (w >= x) {
			mgSticky = 65;
		}else{
			mgSticky = 0;
		}
		var speed = 1000;
		var href= $(this).attr("href");
		var target = $(href == "#" || href == "" ? 'html' : href);
		var position = target.offset().top- mgSticky; 
		$("body,html").animate({scrollTop:position}, speed, "easeInOutCubic");
		return false;
  });

	//SP Nav
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

	//Sticky Nav
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

});