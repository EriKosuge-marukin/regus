

$(function() {
    //クリックしたときのファンクションをまとめて指定
    $('#recruitNav li').click(function() {
        //.index()を使いクリックされたタブが何番目かを調べ、
        //indexという変数に代入します
        var index = $('#recruitNav li').index(this);
        //コンテンツを一度すべて非表示にし、
        $('#recruitTabContent >li').css('display','none');
        //クリックされたタブと同じ順番のコンテンツを表示します。
        $('#recruitTabContent >li').eq(index).css('display','block');
        //一度タブについているクラスselectを消し、
        $('#recruitNav li').removeClass('select');
        //クリックされたタブのみにクラスselectをつけます。
        $(this).addClass('select')
        $('#recruitTabContent >li.show').css('display','block');
    });
});
