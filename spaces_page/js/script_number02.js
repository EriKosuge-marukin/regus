
//$(document).on('ready', function() {
//$('.thumb_slider').slick({
//arrows:true,
   // autoplay: false,
		//autoplaySpeed: 3000,
		//speed: 400,
//asNavFor:'.thumb' 
//});
//$('.thumb').slick({
//asNavFor:'.thumb_slider', // スライダを他のスライダのナビゲーションに設定する（class名またはID名）
//focusOnSelect: true, // クリックでのスライド切り替えを有効にするか
//slidesToShow:5, // 表示するスライド数を設定
//slidesToScroll:1 // スクロールするスライド数を設定
//});
//});





$(function() {

	$('.sliderArea').each(function(i){

		$(this).addClass('data-id' + i);

		$(this).find('.thumb_slider').slick({

			slidesToShow: 1,
            slidesToScroll: 1,
            /*250328-----------------*/
            arrows: true,
            
            /*250328-----------------*/
            fade: true,
            asNavFor: '.data-id'+i+' .thumb'

		});

		$(this).find('.thumb').slick({

			slidesToShow: 6,
            slidesToScroll: 1,
            asNavFor: '.data-id'+i+' .thumb_slider',
            dots: false,
            centerMode:false,
            focusOnSelect: true,
            autoplay: false,
            /*250328-----------------*/
            arrows: false,
            /*250328-----------------*/
            autoplaySpeed: 5000,
            speed: 1000,
                responsive: [{
                breakpoint:768, // 768px以下のサイズに適用
                settings: {
                slidesToShow: 4,
               slidesToScroll: 1,autoplay: true
                },
              },
            ],
        });

	});
}); // 未テスト



