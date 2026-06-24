jQuery(function($){
	//$("#photo img").bind("load",function(){
		//var ImgHeight = $(this).height();
		//$('#photo').css('height',ImgHeight);
	//});
	
	$('#thumb a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thumb a').removeClass('over');
			$(this).addClass('over');
			//$('#photo img').hide().attr('src',$(this).attr('href')).fadeIn();
			$('#photo img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});

jQuery(function($){
	//$("#photoA img").bind("load",function(){
		//var ImgHeight = $(this).height();
		//$('#photoA').css('height',ImgHeight);
	//});
	
	$('#thumbA a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thumbA a').removeClass('over');
			$(this).addClass('over');
			//$('#photo img').hide().attr('src',$(this).attr('href')).fadeIn();
			$('#photoA img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});

jQuery(function($){
	//$("#photoB img").bind("load",function(){
		//var ImgHeightB = $(this).height();
		//$('#photoB').css('height',ImgHeightB);
	//});
	$('#thumbB a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thumbB a').removeClass('over');
			$(this).addClass('over');
			$('#photoB img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});

jQuery(function($){
	//$("#photoC img").bind("load",function(){
		//var ImgHeightC = $(this).height();
		//$('#photoC').css('height',ImgHeightC);
	//});
	$('#thumbC a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thumbC a').removeClass('over');
			$(this).addClass('over');
			$('#photoC img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});

jQuery(function($){
	//$("#photoD img").bind("load",function(){
		//var ImgHeightD = $(this).height();
		//$('#photoD').css('height',ImgHeightD);
	//});
	$('#thumbD a').click(function(){
		if($(this).hasClass('over') == false){
			$('#thumbD a').removeClass('over');
			$(this).addClass('over');
			$('#photoD img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});


//AOMORI
jQuery(function($){
	$('.galleryAO .thumb a').click(function(){
		if($(this).hasClass('over') == false){
			$('.galleryAO  .thumb a').removeClass('over');
			$(this).addClass('over');
			$('.galleryAO .pic img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});


jQuery(function($){
	$('.galleryAO .thumb22 a').click(function(){
		if($(this).hasClass('over') == false){
			$('.galleryAO  .thumb22 a').removeClass('over');
			$(this).addClass('over');
			$('.galleryAO .pic22 img').hide().attr('src',$(this).attr('href')).fadeIn("fast");
		};
		return false;
	}).filter(':eq(0)').click();
});