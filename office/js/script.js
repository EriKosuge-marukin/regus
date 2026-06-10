// JavaScript Document
$(function(){
  $('.slider').slick({
      autoplay:false,
      speed: 1000,
      infinite: true,
      arrow: true,
      dots: true
  });
});

/*---↓250123追加分--*/

$(document).ready(function(){
    // メインスライドとサムネイルの同期設定
    $('.slider_lower').slick({
      slidesToShow: 1,
      slidesToScroll: 1,
      arrows: true,
      fade: true,
      dots: false,
      asNavFor: '.thumbnail-slider'
    });

    $('.thumbnail-slider').slick({
      slidesToShow: 7,
      slidesToScroll: 1,
      asNavFor: '.slider_lower',
      arrows: true,
      dots: false,
      centerMode: true,
      focusOnSelect: true,
      prevArrow: '<div class="slick-prev-custom"></div>',
      nextArrow: '<div class="slick-next-custom"></div>'
    });

    // メインスライドが切り替わったときの処理
    $('.slider_lower').on('afterChange', function(event, slick, currentSlide){
      // すべてのサムネイルから active クラスを削除
      $('.thumbnail-slider li').removeClass('active');
      // 現在のスライドに対応するサムネイルに active クラスを追加
      $('.thumbnail-slider li').eq(currentSlide).addClass('active');
    });

    // 初期状態で最初のサムネイルに枠線を適用
    $('.thumbnail-slider li').eq(3).addClass('active');
  });



$(document).ready(function(){
  $('.slider-wrapper').each(function(){
      var $this = $(this);

      // メインスライダーの設定
      var $mainSlider = $this.find('.main-slider').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          fade: true,
          asNavFor: $this.find('.thumbnail-slider02')
      });

      // サムネイルスライダーの設定
      var $thumbSlider = $this.find('.thumbnail-slider02').slick({
          slidesToShow: 5,
          slidesToScroll: 1,
          asNavFor: $this.find('.main-slider'),
          dots: false,
          centerMode: true,
          focusOnSelect: true,  // サムネイルをクリックするとメインが切り替わる
          arrows: false
      });

      // デバッグ用のイベント確認
      $mainSlider.on('afterChange', function(event, slick, currentSlide){
          console.log('Main slider moved to: ', currentSlide);
      });

      $thumbSlider.on('afterChange', function(event, slick, currentSlide){
          console.log('Thumbnail slider moved to: ', currentSlide);
      });
  });
});
/*---↑250123追加分--*/


$(function(){
    $('.win_open').on('click',function(){
        $('.name02').fadeOut();
        $(this).find('.name02').fadeIn(); 
    });
    $('.batsu').on('click',function(){
        $(this).parent('.name02').fadeOut(); 
    });
    $(".name02").on("click", function (e) {
        e.stopPropagation();
    });    
});


/*追従お問い合わせボタン　*/
window.addEventListener("scroll", function () {
    const elm = document.querySelector(".fixed_contact");
    const scroll = window.pageYOffset;
    if (scroll > 70) {
      elm.style.opacity = "1";
    } else {
      elm.style.opacity = "0";
    }
  });