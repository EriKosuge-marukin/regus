$(function () {
	if(navigator.userAgent.indexOf('Android') > 0){
		$("html").addClass("android");
	}
});


$(window).scroll(function(){
	var y = window.pageYOffset;
	if(y < 200 ) {
		$('.foot_btn').css('transform','translateY(110px)');
	} else {
		$('.foot_btn').css('transform','translateY(0px)');
	}
});

