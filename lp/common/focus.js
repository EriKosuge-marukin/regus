// -*- coding: utf-8 -*-

var select = null;

function init()
{
    // フォーム項目フォーカス時処理追加
    var taglist = new Array("input","textarea");
    var i,j,nodes,node;
    for ( i=0; i<taglist.length; i++ ) {
        nodes = document.getElementsByTagName(taglist[i]);
        for ( j=0; j<nodes.length; j++ ) {
            node = nodes.item(j);
            node.addEventListener("focus", formfocus, false);
            node.addEventListener("blur", formblur, false);
        }
    }
}

var focus_class = "formfocus";

function formfocus()
{
    this.className += ( this.className != "" ? " " : "") + focus_class;
}

function formblur()
{
    this.className = this.className.replace(focus_class, "");
}

if ( window.addEventListener )
    window.addEventListener("load", init, false);

