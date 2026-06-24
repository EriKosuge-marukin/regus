


$(function(){
//URLにアンカー（#○○）があれば取得
var urlHash = location.hash;
//アンカー（#○○）がある場合
if(urlHash){
$('.tab_01').removeClass('act')
$('.box01').removeClass('show');
    $('.tab_02').addClass('act');
$('.box02').addClass('show');
var thisHash = $('.tab_area > li').find(urlHash);
//親要素の中の子要素にurlHash（#○○）と同じid属性を持った要素がある場合

	}
});

$(function () {
  // ①タブをクリックしたら発動
  $('.tab_area li').click(function() {
 
    // ②クリックされたタブの順番を変数に格納
    var index = $('.tab_area li').index(this);
 
    // ③クリック済みタブのデザインを設定したcssのクラスを一旦削除
    $('.tab_area li').removeClass('act');
 
    // ④クリックされたタブにクリック済みデザインを適用する
    $(this).addClass('act');
 
    // ⑤コンテンツを一旦非表示にし、クリックされた順番のコンテンツのみを表示
    $('.tab_contents').removeClass('show').eq(index).addClass('show');
 
  });
});