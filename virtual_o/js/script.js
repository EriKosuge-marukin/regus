$(function () {
  //IE8 nth-child
  $(".sideNavBox .area li:eq(3)").css("margin-right", "0px");
  $(".sideNavBox .area li:eq(7)").css("margin-right", "0px");
  $(".areaList li:eq(2)").css("margin-right", "0px");
  $(".areaList li:eq(5)").css("margin-right", "0px");
  $(".rental dl:eq(4)").css("margin", "0");
  $(".officeBox:eq(1)").css("margin-right", "0px");
  $(".officeBox:eq(3)").css("margin-right", "0px");
  $(".search li:eq(2)").css("margin-right", "0px");
  $(".search li:eq(5)").css("margin-right", "0px");
  $(".search li:eq(8)").css("margin-right", "0px");
  $(".search li:eq(11)").css("margin-right", "0px");
  $(".thumb li:eq(2)").css("margin-right", "0px");
  $(".thumb li:eq(5)").css("margin-right", "0px");
  $(".surround dl:eq(2)").css("margin-right", "0px");
  $(".surround dl:eq(5)").css("margin-right", "0px");

  //MAPのページ内リンク用追記▼
  $("area[href^=#]").click(function () {
    w = $(window).width();
    x = 750;
    if (w >= x) {
      mgSticky = 130;
    } else {
      mgSticky = 120;
    }
    var speed = 1000;
    var href = $(this).attr("href");
    var target = $(href == "#" || href == "" ? "html" : href);
    var position = target.offset().top - mgSticky;
    $("body,html").animate({ scrollTop: position }, speed, "easeInOutCubic");
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


// =========================
// ヘッダー固定処理
// =========================
$(function () {
  // 画面幅取得
  var w = $(window).width();

  // PC表示（751px以上）かつ、header内にnavが存在する場合
  if (w > 750 && $("header nav").length) {
    // navの初期位置
    var start_offset = $("header nav").offset().top;
    // header高さ（固定時の余白用）
    var headerHeight = $("header").outerHeight();

    // スクロール時とページロード時に実行
    $(window).on("scroll load", function () {
      var scroll = $(window).scrollTop();

      // nav位置までスクロールしたら固定化
      if (scroll >= start_offset) {
        // 初回のみ実行
        if (!$("header").hasClass("fixed")) {
          $("header").addClass("fixed");

          // ガタつき防止
          $("body").css("padding-top", headerHeight + "px");

          // 固定時画像
          $(".hd_logo img").attr(
						"src",
						"/common2/images/logo_hdr_fix.png"
					);
          $(".hd_tel img").attr(
						"src",
						"/common2/images/img_top_tel3_fix.png"
					);
          $(".hd_contact img").attr(
            "src",
            "/common2/images/btn_top_btn240415-b_fix.png",
          );
        }
      } else {
        // 固定解除時のみ実行
        if ($("header").hasClass("fixed")) {
          $("header").removeClass("fixed");

          // 余白解除
          $("body").css("padding-top", "");

          // 通常画像
          $(".hd_logo img").attr(
						"src",
						"/common2/images/logo_hdr.gif"
					);
          $(".hd_tel img").attr(
						"src",
						"/common2/images/img_top_tel3.png"
					);
          $(".hd_contact img").attr(
            "src",
            "/common2/images/btn_top_contact2.gif",
          );
        }
      }
		});
	}


	// =========================
  // スムーススクロール
  // =========================
  $('a[href^="#"]').on("click", function (e) {
    e.preventDefault();

    var href = $(this).attr("href");
    var target = $(href === "#" ? "body" : href);

    if (!target.length) return;

    var offset = 0;

    // PC
    if ($(window).width() > 750) {
      offset = 66;
    }
    // SP
    else {
      offset = 0;
    }

    $("html, body").animate({
      scrollTop: target.offset().top - offset
    }, 500);

  });

});


$(function () {
  var path = location.pathname;
  var el = $("ul.gnav").children("li").children("a").children(".bd_wt");
  var href;

  path = path.split("/");
  path = "/" + path[1] + "/";

  console.log(path);

  el.each(function () {
    href = $(this).parent("a").attr("href");
    //alert(href);
    if (path == href) {
      $(this).addClass("act2");
    }
  });
  var w = $(window).width();
  $(".corona p.close").on("click", function () {
    $(".corona").fadeOut();
  });
  if (w > 750) {
    $(".gnav >li").hover(
      function () {
        $(this).find(".acco_wrap").slideDown();
        $(this).find(".bd_wt").addClass("act");
      },
      function () {
        $(this).find(".acco_wrap").stop().slideUp();
        $(this).find(".bd_wt").removeClass("act");
      },
    );
  } else {
    $(".gnav >li >a").on("click", function () {
      if ($(this).hasClass("open")) {
        $(".gnav >li >a").removeClass("open");
        $(".gnav >li >a").next().stop().slideUp();
        return false;
      } else {
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
  $(".close_acco p").css("padding-bottom", "60px");
  var w = $(window).width();
  //alert(h);
  var $animation = $(".icon-animation");
  $animation.on("click", function () {
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
    if ($(this).hasClass("is-open")) {
      $(this).removeClass("is-open");
      $("html").css("overflow", "auto");
    } else {
      $(this).addClass("is-open");
      $("html").css("overflow", "hidden");
    }
  });
  $(".close_acco p").on("click", function () {
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
    if ($animation.hasClass("is-open")) {
      $animation.removeClass("is-open");
      $("html").css("overflow", "auto");
    } else {
      $animation.addClass("is-open");
      $("html").css("overflow", "hidden");
    }
    //$animation.removeClass("is-open");
    //$("nav").slideToggle();
  });
});
