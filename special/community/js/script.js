$(function(){
    $('.plan_area li:nth-child(2n)').each(function(){
        $(this).css({marginRight: 'auto'});
    })
		$('ul.lounge li:nth-child(3n)').each(function(){
        $(this).css({marginRight: 'auto'});
    })
		$(".plan_areaa li").heightLine({
			  minWidth:640
		});
		
});


$(function(){
   // #で始まるアンカーをクリックした場合に処理
   $('a[href^=#]').click(function() {
      // スクロールの速度
	  var mgSticky=65;
      var speed =300; // ミリ秒
      // アンカーの値取得
      var href= $(this).attr("href");
      // 移動先を取得
      var target = $(href == "#" || href == "" ? 'html' : href);
      // 移動先を数値で取得
      //var position = target.offset().top;
	  var position = target.offset().top-mgSticky;
      // スムーススクロール
      $('body,html').animate({scrollTop:position}, speed, 'swing');
      return false;
   });
});