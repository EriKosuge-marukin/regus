// JavaScript Document
$(function(){
	//表示・非表示用（m_box全てを非表示にする記述です。）
	//表示しておきたいm_boxがある場合は「$('h1').next('div.m_box').show();（h1の次にあるm_box）」
	//等を次の行に追加する必要があります。
	$('div.m_box').hide();

	//非表示にしたm_boxを開閉するスライドです。
	//ただし、main_area内のh2の次にあるm_boxのみが対象になります。
	$('h2.practice').click(function(){
		if($(this).hasClass('active_sp')==false){
			$(this).addClass('active_sp');
		} else {
			$(this).removeClass('active_sp');
		};
		$(this).next('div.m_box').slideToggle();
	});
	
	$('h2.practice02').click(function(){
		if($(this).hasClass('active_sp02')==false){
			$(this).addClass('active_sp02');
		} else {
			$(this).removeClass('active_sp02');
		};
		$(this).next('div.m_box').slideToggle();
	});
	
	$('.btn_close').click(function(){
		$(this).parents('div.m_box').slideUp();
		$(this).parents('div.m_box').prev('h2').removeClass('active_sp');
		$(this).parents('div.m_box').prev('h2').removeClass('active_sp02');
	});

	
});