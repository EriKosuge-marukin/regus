var hovers = new Array();
var chgbanner;
function init () {
    // tLib.each([ {id:"startup_banner_img",path:"/images/startup_banner_o.png"} ],
    //           function (data) {
    //               hovers[hovers.length] = new tLib.ImgOver(data.id, data.path);
    //           });

    // 右サイドオフィス一覧の mouseover 処理
    var outer = tLib.get("thumbs_outer");
    outer.addEvent("mouseover", function () { tLib.addClass(this,"over"); });
    outer.addEvent("mouseout", function () { tLib.removeClass(this,"over"); });

    // chgbanner = new ChangeNode( tLib.get("chg_banner") );
    // chgbanner.list.push(tLib.makeNode({name:"a",attr:{"href":"/service_guide/deskset.html"},child:[{name:"img",attr:{"width":"310","height":"117","alt":"デスクセット 永久無料キャンペーン／【赤坂・渋谷】オフィス／ 期間限定！お申込みは【2011年6月末日】まで！","src":"images/index_campaign110601.jpg"}}]}));
    // chgbanner.start();

    // TOPバナーアニメーション
    var node = tLib.get("top_banner");
    if ( node ) {
        var imgs = tLib.selectNodes(node,"img");
        var old_n = 0;
        var img_n = 1;
        var sleep_time = 8; // 6
        var dur_time = 2;
        var anim = tLib.anim({
                "onStart": function (v,sec) {
                    if ( tLib.status.transition ) {
                        imgs[img_n].style[tLib.getPrefixProperty("transitionProperty")] = "opacity";
                        imgs[img_n].style[tLib.getPrefixProperty("transitionDuration")] = sec +"s";
                        imgs[img_n].style[tLib.getPrefixProperty("opacity")] = v;
                    }
                },
                "onChange": function (v) {
                    imgs[img_n].style[tLib.getPrefixProperty("opacity")] = this.value[0];
                },
                "onStop": function (v) {
                    if ( tLib.status.transition ) {
                        imgs[old_n].style[tLib.getPrefixProperty("transitionProperty")] = "none";
                    }
                    imgs[old_n].style[tLib.getPrefixProperty("opacity")] = 0;
                    old_n = img_n;
                    img_n ++;
                    if ( imgs.length <= img_n )
                        img_n = 0;
                    imgs[old_n].style.zIndex = 0;
                    imgs[img_n].style.zIndex = 1;
                    this.setValue(0);
                    anim.sleep(sleep_time);
                    if ( tLib.status.transition )
                        anim.cssTo(1,dur_time);
                    else
                        anim.vectorTo({"val":1,"sv":0,"ev":0},dur_time);
                }});
        for ( var i=1; i<imgs.length; i++ ) {
            if ( tLib.status.transition ) {
                imgs[i].style[tLib.getPrefixProperty("transitionProperty")] = "none";
            }
            imgs[i].style[tLib.getPrefixProperty("opacity")] = 0;
        }
        anim.setValue(0);
        imgs[old_n].style.zIndex = 0;
        imgs[img_n].style.zIndex = 1;
        anim.sleep(sleep_time);
        if ( tLib.status.transition )
            anim.cssTo(1,dur_time);
        else
            anim.vectorTo({"val":1,"sv":0,"ev":0},dur_time);
    }

}

function ChangeNode (target) {
    var my = this;
    this.list = new Array(target);
    this.nowno = 0;
    this.nownode = target;
    this.interval = 5000;
    function _change () {
        var next = ( my.nowno + 1 <= my.list.length -1 ? my.nowno + 1 : 0 );
        my.nownode.parentNode.replaceChild(my.list[next], my.nownode);
        my.nownode = my.list[next];
        my.nowno = next;
    };
    this.start = function () {
        window.setInterval(_change, this.interval);
    }
}

tLib.get(window).addEvent("load", init);
