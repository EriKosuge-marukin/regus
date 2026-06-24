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