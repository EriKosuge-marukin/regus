// オープンオフィス問い合わせ・見学予約フォーム用スクリプト
// 2011/08/15(Mon)
// 2012/02/28(Tue) 赤坂見附追加
// 2012/07/26(Thu) 長野削除
// 2012/09/18(Tue) 青山centre,赤坂,新宿,日本橋,渋谷オフィス名変更
// 2013/06/06(Thu) MergeCheckBox idに指定したノードが見つからなかった場合にエラーになるのを修正
// 2013/09/25(Wed) welcomeでの拡張をマージ。セパレータ、スペース対応。赤坂見附追加
// 2013/09/26(Thu) 仙台、名古屋追加

// MergeCheckBox
// 複数チェックボックスの結果を一つの INPUT にまとめる
function MergeCheckBox (params)
{
    var i;
    for ( i in params ) {
        this[i] = params[i];
    }
}
MergeCheckBox.prototype = {
    init : function () {
        var i,node;
        var caller = this;
        this.master =tLib.get(this.id);
        this.subs = new Array();
        for ( i=0; i<this.data.length; i++ ) {
            node = tLib.get(this.id+"_"+i);
            if ( node ) {
                node.addEvent("change", function (){ caller.change(); });
                node.addEvent("click", this._ie_change ); // IE は onChange のタイミングが違うため揃える
                this.subs.push(node);
            }
        }
    },
    master : null,
    subs : [],
    separater : "/",
    change : function (node) {
        var i;
        var value = "";
        for ( i=0; i<this.subs.length; i++ ) {
            if ( this.subs[i].checked ) {
                value += ( value != "" ? this.separater : "" ) + this.subs[i].value;
            }
        }
        this.master.value = value;
    },
    _ie_change : function () {
        this.blur();
        this.focus();
    }
};

// お問い合わせの目的
var Checkbox_free1 = new MergeCheckBox (
    {
        id : "free1",
        data : [ "見学希望", "資料希望", "ご相談" ],
        draw : function () {
            var i;
            for ( i=0; i<this.data.length; i++ ) {
                document.write("<label for=\""+ this.id +"_"+ i +"\" class=\"block\"><input id=\""+ this.id +"_"+ i +"\" type=\"checkbox\" class=\"checkbox\" value=\""+ this.data[i] +"\">"+ this.data[i] +"</span></label> ");
            }
            document.write("<input type=\"hidden\" id=\""+ this.id +"\" name=\""+ this.id +"\" value=\"\">");
        }
    });

// ご興味のあるオフィス
var Checkbox_free2 = new MergeCheckBox (
    {
        id : "free2",
        data : [
		{css:"honatsugi", name:"本厚木 "},
		{css:"oosakieki", name:"大崎駅西口 "},
		{css:"toyota", name:"豊田"},
		{css:"nishishinjyukuekimae", name:"西新宿駅前"},
		{css:"kariya", name:"刈谷"},
		{css:"kobesannomiya", name:"神戸三宮南"},
		{css:"ooita", name:"大分"},
		{css:"niigata", name:"新潟"},
		{css:"nagoyamarunouchi", name:"名古屋丸の内"},
		{css:"shinosakakita", name:"新大阪北"},
		{css:"tachikawa", name:"立川駅南"},
		{css:"kumaomotoginzadori", name:"熊本銀座通り"},
		{css:"sendaiekimae", name:"仙台駅前"},
		{css:"nishishinabashi", name:"西新橋"},
			{css:"meiekihigashi", name:"名駅東"},
			{css:"shibuyajinnan", name:"渋谷神南"},
			{css:"hiroshimaootemachi", name:"広島大手町"},
			{css:"hakozaki", name:"日本橋箱崎"},
			{css:"jinbocho", name:"神保町"},
			{css:"hakata-ekimae", name:"博多駅前通り"},
			{css:"kokura", name:"小倉"},
			{css:"mito", name:"水戸"},
			{css:"sapporo-minami", name:"札幌南"},
			{css:"kyoto-karasuma", name:"京都烏丸"},
			{css:"ikebukuro", name:"池袋"},
			
			{css:"akasaka", name:"赤坂ビジネスプレイス"},
			{css:"centre", name:"青山セントラル"},
            {css:"minamiaoyama", name:"南青山"},
            {css:"azabu", name:"麻布十番"},
            //{css:"aoyama246", name:"青山246"},
            {css:"mitsuke", name:"赤坂見附"},
            {css:"tameike-sanno", name:"溜池山王"},
			{css:"hills", name:"渋谷hills"},
            {css:"nogizaka", name:"乃木坂"},
            {css:"shibuya", name:"渋谷TOC"},
            {css:"sendai", name:"仙台青葉通り"},
            {css:"nihonbashi", name:"日本橋セントラル"},
            {css:"shinjuku", name:"新宿ウエスト"},
			{css:"kyoto-kawaramachi", name:"京都川原町"},
			{css:"nagoya", name:"名古屋伏見"},
			{css:"keihan-yodoyabashi", name:"京阪淀屋橋"},
			
            //{},
            //{},
            //{},
            
            {css:"virtual", name:"バーチャルオフィス"},{},
        ],
        separater : "\n",
        draw : function () {
            document.write("<p>");
            var i;
            for ( i=0; i<this.data.length; i++ ) {
                if ( this.data[i].css ) {
                    document.write("<label for=\""+ this.id +"_"+ i +"\" class=\"officeblk "+ this.data[i].css +"\"><input id=\""+ this.id +"_"+ i +"\" type=\"checkbox\" class=\"checkbox\" value=\""+ this.data[i].name +"\"></label><span class=\"officename\">"+ this.data[i].name +" </span>");
                } else {
                    // スペース
                    document.write("<label class=\"officeblk blank\"></label><span class=\"officename\"></span>");
                }
            }
            document.write("<br style=\"clear:left;\">");
            document.write("</p>");
            document.write("<input type=\"hidden\" id=\""+ this.id +"\" name=\""+ this.id +"\" value=\"\">");
        }
    });


function init()
{
    Checkbox_free1.init();
    Checkbox_free2.init();

    tLib.addClass(tLib.get("free3_blk"),"script");

    var node = tLib.get("submit_button");
    if (node) {
        node.addEvent("mousedown", function (){ this.className = "down"; });
        node.addEvent("mouseover", function (){ this.className = "over"; });
        node.addEvent("mouseup", function (){ this.className = ""; this.blur(); });
        node.addEvent("mouseout", function (){ this.className = ""; this.blur(); });
    }
}


tLib.get(window).addEvent("load",init);
