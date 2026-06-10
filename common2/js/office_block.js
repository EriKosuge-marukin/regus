/*オフィス詳細ページの左ブロック(#detail)の高さが足りないときに起きるレイアウト崩れを調整するJs*/
$(function() {
	//<div class="detail">ブロックの高さを取得
	var detail_height = $('#detail').height();
	
	if(detail_height <= 510 ){
		//オフィス詳細ブロックが480px以下の時はCSSに高さを追加
		$('#detail').css({'height':'510px'});
	}
});