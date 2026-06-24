$(function () {
    var currentTabIndex = -1;
    var tabClick = function(tabIndex){
        if(tabIndex != currentTabIndex){
            if(tabIndex >= 0) {
                $(".tabBox").eq(currentTabIndex).hide();
                $(".btnTab li").eq(currentTabIndex).removeClass("on");
            }
            $(".tabBox").eq(tabIndex).show();
            $(".btnTab li").eq(tabIndex).addClass("on");
            currentTabIndex = tabIndex;	
        }
    };
		
		$(".btnTab li").click(function () {
       tabClick($(".btnTab li").index(this));
    });
		tabClick(0);

	
$(window).on('load', function() {
var tab = $('.fixBtn');
var taboffset = tab.offset();
$(window).resize(function(){
	taboffset = tab.offset();
});
$(window).on("scroll touchmove",function () {
		if($(window).scrollTop() > taboffset.top - 110) {
			tab.addClass("fxBB");
		}else{
			tab.removeClass("fxBB");
		}
	});
var tabSp = $('.fixBtnSp');
var prodArea = $('#base');
var prodAreaOffset = prodArea.offset();
var tabSpViewFlag = false;
$(window).resize(function(){
	prodAreaOffset = prodArea.offset();
});
$(window).on("scroll touchmove",function () {
		//console.log($(window).scrollTop(),prodAreaOffset.top);
		if($(window).scrollTop() > prodAreaOffset.top-30 && !tabSpViewFlag) {
			//console.log(1);
			tabSp.addClass("fxBB");
			tabSpViewFlag = true;
		}else if($(window).scrollTop() <= prodAreaOffset.top-30 && tabSpViewFlag){
			//console.log(0);
			tabSp.removeClass("fxBB");
			tabSpViewFlag = false;
		}
	});
});
	/*
	$("a .spImg").hover(function(){
		if($(this).hasClass("notOpacity")){
		}else{
			$(this).stop(true,false).fadeTo(100, 1.0);
		}
	},function(){
		if($(this).hasClass("notOpacity")){
		}else{
			$(this).stop(true,false).fadeTo(100, 1.0);
		}
	});*/
});
