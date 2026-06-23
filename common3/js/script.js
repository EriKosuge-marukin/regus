jQuery(function ($) {

 var topBtn = $(".pagetop");
 topBtn.hide();


 $(window).scroll(function () {
  if ($(this).scrollTop() > 70) {
   topBtn.fadeIn();
  } else {
   topBtn.fadeOut();
  }
 });

 // ボタンをクリックしたらスクロールして上に戻る
 topBtn.click(function () {
  $("body,html").animate({
    scrollTop: 0,
   },
   300,
   "swing"
  );
  return false;
 });

 //スティッキーヘッダー
 $(function () {
  var $win = $(window),
   $mv = $(".mv"),
   $header = $(".header");
  (mvHeight = $mv.outerHeight()), (fixedClass = "js-fixed");

  $win.on("load scroll", function () {
   var value = $(this).scrollTop();

   if (value > mvHeight) {
    $header.addClass(fixedClass);
   } else {
    $header.removeClass(fixedClass);
   }
  });
 });


 $(function () {
  var sc = $(window).scrollTop();
  $(window).on("scroll", function () {
   sc = $(window).scrollTop();
   scCheck()
  })


  // 221026_c修正
  function scCheck() {
   var w = $(window).width();
   if (w > 520) {
    if (sc > 70) {
     $("#FOLLOW-HEADER").addClass("action");
    } else {
     $("#FOLLOW-HEADER").removeClass("action");
    }
   } else {
    if (sc > 70) {
     $("#FOLLOW-HEADER").addClass("action");
    } else {
     $("#FOLLOW-HEADER").removeClass("action");
    }
   }
  }
 })
 // 221026_c修正




 //追従ドロワーメニュー
 $(function () {
  $(".js-fh-hamburger").click(function () {
   $(this).toggleClass("js-open");

   if ($(this).hasClass("js-open")) {
    $(".js-fh-sp-nav").addClass("js-nav-open");
    $("#menu--fh-btn").attr("src", '/common3/images/logo-white.svg');
    $("body").toggleClass("noscroll");
   } else {
    $(".js-fh-sp-nav").removeClass("js-nav-open");
    $("#menu--fh-btn").attr("src", '/common3/images/logo.svg');
    $("body").toggleClass("noscroll");
   }
  });
 });

 //ドロワーメニュー
 $(function () {
  $(".js-hamburger").click(function () {
   $(this).toggleClass("js-open");

   if ($(this).hasClass("js-open")) {
    $(".js-sp-nav").addClass("js-nav-open");
    $("#menu-btn").attr("src", '/common3/images/logo-white.svg');
    $("body").toggleClass("noscroll");
   } else {
    $(".js-sp-nav").removeClass("js-nav-open");
    $("#menu-btn").attr("src", '/common3/images/logo.svg');
    $("body").toggleClass("noscroll");
   }
  });
 });

 $(function () {
  $(".js-close").click(function () {
   $(".js-sp-nav").removeClass("js-open");
   $(".js-hamburger").removeClass("js-open");
   $("body").toggleClass("noscroll");
  });
 });

 // 221025修正
 $(function () {
  $('.header__sp-nav a[href^="#"]').on("click", function () {
   $("body").removeClass("noscroll");
   $(".js-fh-sp-nav").removeClass("js-nav-open");
   $(".js-fh-hamburger").removeClass("js-open");
   $("#menu--fh-btn").attr("src", '/common3/images/logo.svg');
  });
 });
 // 221025修正

 //アコーディオン
 $(function () {
  $(".jsAccordionTitle").on("click", function () {
   $(this).next().toggleClass("is-open");
   $(this).toggleClass("is-active");
  })
 });


 //ドロップダウンメニュー
 $(function () {
  $('.dropdwn__items').hover(function () {
   $(".dropdwn__menu:not(:animated)", this).slideDown(300);
  }, function () {
   $(".dropdwn__menu", this).slideUp(300);
  });
 });

 // スムーススクロール (絶対パスのリンク先が現在のページであった場合でも作動)

 $(document).on("click", 'a[href*="#"]', function () {
  let time = 400;
  let header = $("header").innerHeight();
  let target = $(this.hash);
  if (!target.length) return;
  let targetY = target.offset().top - header;
  $("html,body").animate({
    scrollTop: targetY,
   },
   time,
   "swing"
  );
  return false;
 });
});

//タブ
$('.tab_box .tab_btn').click(function () {
 var index = $('.tab_box .tab_btn').index(this);
 $('.tab_box .tab_btn, .tab_box .tab_panel').removeClass('active');
 $(this).addClass('active');
 $('.tab_box .tab_panel').eq(index).addClass('active');
});


$(function () {
 var w = $(window).width();
 if (w >= 521) {
  var swiper = new Swiper(".top-swiper", {
   loop: true,
   autoplay: {
    /* スライド自動切り替え永続 */
    disableOnInteraction: false,
    /* スライド自動切り替え方向 */
    reverseDirection: false,
    /* マウスホバーでスライド自動切り替え停止 */
    pauseOnMouseEnter: true,
   },
   effect: "slide",
   speed: 1000,
   slidesPerView: 1,
   pagination: {
    el: ".swiper-pagination",
    clickable: true,
   },
   navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
   },
   centeredSlides: false,
   spaceBetween: 30,
   breakpoints: {
    961: {
     slidesPerView: 2,
    }
   }
  });
 }
});

var service_swiper = new Swiper(".service-swiper", {
 loop: true,
 effect: "slide",
 speed: 1000,
 allowTouchMove: true,
 spaceBetween: 15,
 slidesPerView: '1',
 spaceBetween: 20,
 loopAdditionalSlides: 1,

});

var service_swiper = new Swiper(".newOpenPc-swiper", {
 loop: true,
 effect: "slide",
 speed: 1000,
 allowTouchMove: true,
 slidesPerView: '3',
 spaceBetween: 20,
 loopAdditionalSlides: 1,
 pagination: {
  el: ".newOpenPc-pagination",
  clickable: true,
 },
 navigation: {
  nextEl: ".swiper-button-next",
  prevEl: ".swiper-button-prev",
 },
 breakpoints: {


  961: {
   slidesPerView: 3,
   spaceBetween: 37,
  }
 }

});

var newOpen_swiper = new Swiper(".newOpen-swiper", {
 loop: true,
 effect: "slide",
 speed: 1000,
 allowTouchMove: true,
 spaceBetween: 15,
 slidesPerView: '1',
 spaceBetween: 20,
 loopAdditionalSlides: 1,

});





if (navigator.userAgent.indexOf('iPhone') > 0) {
 let body = document.getElementsByTagName('body')[0];
 body.classList.add('iphone');
}

if (navigator.userAgent.indexOf('Android') > 0) {
 let body = document.getElementsByTagName('body')[0];
 body.classList.add('Android');
}

if (navigator.userAgent.indexOf('iPhone') > 0) {
 let body = document.getElementsByTagName('body')[0];
 body.classList.add('iphone');
}

if (navigator.userAgent.indexOf('Android') > 0) {
 let body = document.getElementsByTagName('body')[0];
 body.classList.add('Android');
}

$(function () {
 var w = $(window).width();
 if (w >= 960) {
  $(".followHeader__tel").on("click", function () {
   $(this).toggleClass("act");
   $(".followHeader__number").fadeToggle(function () {
    if ($(this).is(':visible')) {
     $(this).css('display', 'flex');
    }
   });
   return false;
  });
 } else {
  return false;
 }
});

// 2221022修正
$(function () {
 const swiper = new Swiper(".sp_kv", {
  loop: true,
  speed: 800,
  autoplay: {
   /* スライド自動切り替え永続 */
   disableOnInteraction: false,
   delay: 1000,
   /* スライド自動切り替え方向 */
   reverseDirection: false,
   /* マウスホバーでスライド自動切り替え停止 */
   pauseOnMouseEnter: true,
  },
  pagination: {
   el: ".swiper-pagination",
   clickable: true
  },
  navigation: {
   nextEl: ".swiper-button-next",
   prevEl: ".swiper-button-prev",
   clickable: true
  }
 });
});

// 2221022修正
// 2221027修正
$(function() {
  var scrollArrow = $('.scrolldown4');    
  scrollArrow.hide();
  //スクロールが100に達したらボタン表示
  $(window).scroll(function () {
      if ($(this).scrollTop() > 100) {
        scrollArrow.fadeIn();
      } else {
        scrollArrow.fadeOut();
      }
  });
  //スクロールしてトップ
  scrollArrow.click(function () {
      $('body,html').animate({
          scrollTop: 0
      }, 500);
      return false;
  });
});
// 2221027修正