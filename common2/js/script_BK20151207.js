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
   $("a[href^=#]").click(function() {
      var speed = 1000;
      var href= $(this).attr("href");
      var target = $(href == "#" || href == "" ? 'html' : href);
      var position = target.offset().top;
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
		var w = $(window).width();
    var x = 750;
    if (w >= x) {
				$(".btnSpNav img").attr("src","/common2/images/btn_hamberger.gif");
        $(".hambergerNav").css("display","none");
    }else{
        $(".sticky").css("display","none");
		}
	});

	//Sticky Header
	var $window = $(window), 
	$appear = $("nav"), 
	$sticky = $(".sticky"), 
	appearNav = $appear.offset().top;
	
	var fixedSwitch = false;
	
	$window.on("scroll", function () {
		if ($window.scrollTop() > 90 && $(window).width() >= 750) {　// 90 or appearNav
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
	$(window).resize(function(){
		if ($window.scrollTop() > 90 && $(window).width() >= 750) {
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