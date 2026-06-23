$(function(){
	
	$(".gallery .pic li:first").css("display","block");	
	$(".gallery .thumb li").hover(function() {
		$(this).css("cursor","pointer");
		$(this).stop(true,false).fadeTo(100, 0.65);
	},function() {
		$(this).css("cursor","default");
		$(this).stop(true,false).fadeTo(100, 1);
	});
	$(".gallery .thumb li").click(function() {
		var num = $(this).index();
		$(".gallery .pic li").css("display","none");	
		$(".gallery .pic li").eq(num).css("display","block");
	});
	
	
});
$(function(){
	
	$(".galleryA .pic li:first").css("display","block");	
	$(".galleryA .thumb li").hover(function() {
		$(this).css("cursor","pointer");
		$(this).stop(true,false).fadeTo(100, 0.65);
	},function() {
		$(this).css("cursor","default");
		$(this).stop(true,false).fadeTo(100, 1);
	});
	$(".galleryA .thumb li").click(function() {
		var num = $(this).index();
		$(".galleryA .pic li").css("display","none");	
		$(".galleryA .pic li").eq(num).css("display","block");
	});
	
	
});