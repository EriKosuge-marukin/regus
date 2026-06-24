// -*- coding: utf-8 -*-

function smartphonePhonenoAppend()
{
    // スマートフォン(iPad含む)対応 電話番号リンク埋込み
    var phone_no = "tel:0120956122";

    var useragent = navigator.userAgent;
    if ( useragent.indexOf('iPhone') >= 0 || useragent.indexOf('iPod') >= 0 || useragent.indexOf('Android') >= 0 ) {

        function _inner_a(node) {
            // 対象ノードの中にAタグ挿入
            var anode = document.createElement("a");
            anode.setAttribute("href",phone_no);
            while ( node.firstChild ) {
                anode.appendChild(node.firstChild);
            }
            node.appendChild(anode);
        }

        function _outer_a(node) {
            // 対象ノードの外にAタグ挿入
            var anode = document.createElement("a");
            anode.setAttribute("href",phone_no);
            node.parentNode.replaceChild(anode,node);
            anode.appendChild(node);
        }

        function _maparea(node) {
            // 対象ノードの中にareaタグ追加(わからない事がある方用)
            var areanode = document.createElement("area");
            areanode.setAttribute("sharp","rect");
            areanode.setAttribute("coords","336,1,645,130");
            areanode.setAttribute("href",phone_no);
            areanode.setAttribute("alt","お電話でのお問い合せはこちら");
            node.appendChild(areanode);
        }

        var targets = new Array( // 電話リンク変換対象ID
            {id:"OPO_header_address",func:_inner_a}, // 各ページヘッダー
            {id:"phoneimg1",func:_outer_a}, // TOPページ中央 見学について
            {id:"query_map",func:_maparea} // TOPページ下わからない事がある方
        );

        for ( i in targets ) {
            var target = targets[i];
            var node = document.getElementById(target.id);
            if ( node )
                target.func(node);
        }
    }
}

if ( window.addEventListener ) {
    window.addEventListener("load", smartphonePhonenoAppend, false);
}


// roll.js より

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
