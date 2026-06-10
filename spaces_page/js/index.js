$(function () {
 $(".area_box").hide();
 $(".midashi").click(function () {
  if ($(this).hasClass("open")) {
   $(this).next().stop().slideUp();
   $(this).removeClass("open");
  } else {
   $(".open").removeClass("open");
   $(".area_box").slideUp();
   $(this).next().stop().slideDown();
   $(this).addClass("open");
  }
 });
});

$(function () {
 var contact = $("#contact_top");
 $(window).on("load scroll resize", function () {
  var side_w = $(".side_nav").width();
  var side_h = $(".side_nav").outerHeight();
  var start = $("#start").offset().top;
  var stop = start + side_h - $(this).height();
  if ($(window).scrollTop() > start && $(window).scrollTop() < stop) {
   contact.removeClass("poa").addClass("sc").css("width", side_w);
  } else if ($(window).scrollTop() > stop) {
   contact.removeClass("sc").addClass("poa").css("width", side_w);
  } else {
   contact.removeClass("sc");
  }
 });
});

// 221012修正

// ギャラリーモーダル

// 電話番号モーダル
$(function () {
 const w = $(window).width();
 if (w >= 768) {
  const tel = $(".hd_tel");
  tel.on("click", function () {
   $(".hd_tel_modal").fadeIn();
   return false;
  });
  $(".hd_tel_modal_close,.hd_tel_modal_wrap").on("click", function () {
   $(".hd_tel_modal").fadeOut();
  });
  $(".hd_tel_modal_inner").on("click", function (e) {
   e.stopPropagation();
  });
 }
});

// 221012修正



// 230418追加

$(function () {
 const w = $(window).width();
 if (w >= 768) {
  const tel = $(".mod_tel");
  tel.on("click", function () {
   $(".hd_tel_modal").fadeIn();
   return false;
  });
  $(".hd_tel_modal_close,.hd_tel_modal_wrap").on("click", function () {
   $(".hd_tel_modal").fadeOut();
  });
  $(".hd_tel_modal_inner").on("click", function (e) {
   e.stopPropagation();
  });
 }
});

// 230418追加



window.addEventListener("DOMContentLoaded", () => {
  // モーダルを取得
  const modal = document.getElementById("modal");
  // モーダルを表示するボタンを全て取得
  const openModalBtns = document.querySelectorAll(".js-open-modal");
  // モーダルを閉じるボタンを全て取得
  const closeModalBtns = document.querySelectorAll(".js-close-modal");

  // Swiperの設定
  const swiper = new Swiper(".swiper", {
    loop: true,
    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },
    spaceBetween: 30,
  });

  // モーダルを表示するボタンをクリックしたとき
  openModalBtns.forEach((openModalBtn) => {
    openModalBtn.addEventListener("click", () => {
      // data-slide-indexに設定したスライド番号を取得
      const modalIndex = openModalBtn.dataset.slideIndex;
      swiper.slideTo(modalIndex);
      modal.classList.add("is-active");
    });
  });

  // モーダルを閉じるボタンをクリックしたとき
  closeModalBtns.forEach((closeModalBtn) => {
    closeModalBtn.addEventListener("click", () => {
      modal.classList.remove("is-active");
    });
  });
});