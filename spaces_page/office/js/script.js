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