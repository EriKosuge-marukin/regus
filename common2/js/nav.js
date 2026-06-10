
$(function() {
	var contactLink = $('header nav ul li a.contact');
	var spNavTgl = $('header .spNavTgl');

	spNavTgl.on('click',function() {
		$('header nav').slideToggle();
		spNavTgl.toggleClass('ex');
		if(spNavTgl.hasClass('ex')) {
			spNavTgl.children('i').text('閉 じ る');
			//$('body').css('overflow','hidden');
		} else {
			spNavTgl.children('i').text('メニュー');
			//$('body').css('overflow','');
		}
	});
});

$(function() {
	var subMenuTgl = $('header nav ul.nav02 span');

	subMenuTgl.on('click',function() {
		if($(this).next('ul').css('display') === "none") {
			$(this).next('ul').slideDown();
			$(this).addClass('ex');
			//
			subMenuTgl.not(this).next('ul').slideUp();
			subMenuTgl.not(this).removeClass('ex');
		} else if(($(this).next('ul').css('display') === "block")) {
			$(this).next('ul').slideUp();
			$(this).removeClass('ex');
		}
	});
});


$(window).on('load', function() {
	var path = location.pathname;
	var el = $('ul.nav02').children('li').children('a');
	var href;

	path = path.split('/');
	path = "/" + path[1] + "/";

	console.log(path);

	el.each(function() {
		href = $(this).attr('href');
		if(path == href) {
			$(this).addClass('act');
		}
	});
});




$(window).resize(function(){
    //windowの幅をxに代入
    var x = $(window).width();
    //windowの分岐幅をyに代入
    var y = 750;
    if (x >= y) {
        $('nav').css('display','');
		$('.inner> div:eq(1)').removeClass('ex');
		$('.spNavTgl').children('i').text('メニュー');
        //$('nav').removeClass('onNav');
          //$('nav').css('display','none');
    }else{
        //$('nav').css('display','');
        //$('nav').css('display','block');
		
    }
});




