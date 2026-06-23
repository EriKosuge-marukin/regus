// 名古屋オフィス フロアマップ・価格表連携
// 2013/08/28 office taihei

var map_id = "map_nagoya";
var rooms = {
    "room_S-01" :{x:370,y:440},
    "room_S-02" :{x:450,y:440},
    "room_S-03" :{x:370,y:380},
    "room_S-04" :{x:450,y:380},
    "room_S-05" :{x:370,y:320},
    "room_S-06" :{x:450,y:320},
    "room_S-07" :{x:370,y:260},
    "room_S-08" :{x:450,y:260},
    "room_401" :{x:360,y:565},
    "room_403" :{x:440,y:565},
    "room_404" :{x:500,y:425},
    "room_405" :{x:515,y:565},
    "room_406" :{x:645,y:565},
    "room_407" :{x:710,y:540},
    "room_408" :{x:715,y:460},
    "room_409" :{x:580,y:415},
    "room_410" :{x:715,y:405},
    "room_411" :{x:715,y:335},
    "room_412" :{x:540,y:320},
    "room_413" :{x:715,y:275},
    "room_414" :{x:575,y:250},
    "room_415" :{x:715,y:220},
    "room_416" :{x:575,y:200},
    "room_417" :{x:715,y:170},
    "room_418" :{x:670,y: 90},
    "room_419" :{x:570,y: 90},
    "room_420" :{x:505,y:230},
    "room_421" :{x:315,y:270},
    "room_422" :{x:270,y: 95},
    "room_423" :{x:200,y: 90},
    "room_424" :{x:120,y: 90},
    "room_425" :{x: 95,y:180},
    "room_426" :{x:230,y:225},
    "room_427" :{x: 95,y:245},
    "room_428" :{x:230,y:270},
    "room_429" :{x: 95,y:295},
    "room_430" :{x: 95,y:340},
    "room_431" :{x:230,y:345},
    "room_432" :{x: 95,y:405},
    "room_433" :{x: 95,y:490},
    "room_434" :{x:125,y:560}
};

var marker;

function init()
{
    var map = tLib.get(map_id);
    if ( ! map )
        return;

    var cmap = tLib.makeNode({name:"map", attr:{"name":"map_sendai_table"}});
    marker = tLib.makeNode({name:"div", attr:{"id":"map_marker","style":"display:none;"}});
    var outer = tLib.makeNode({attr:{"style":"position:relative;"},child:[cmap,marker]});
    map.parentNode.replaceChild(outer,map);
    outer.appendChild(map);

    map.setAttribute("usemap","#map_sendai_table");

    var i,area,room;
    for ( i in rooms ) {
        room = rooms[i];
        area = tLib.makeNode(
            {
                name:"area",
                attr:{"shape":"circle","coords":room.x+","+room.y+",20","alt":i,"onclick":"onMapClick(this)","style":"cursor:pointer;"}
            }
        );
        cmap.appendChild(area);
    }

    var trs,tr;
    trs = document.getElementsByTagName("tr");
    for ( i=0; i<trs.length; i++ ) {
        tr = trs.item(i);
        if ( tr.id && tr.id.indexOf("room_") == 0 ) {
            tr = tLib.get(tr);
            tr.addEvent("click",onPriceListClick);
        }
    }
}

var select_tr = null;
function onMapClick(area)
{
    selectRoom(area.getAttribute("alt"));
}

function onPriceListClick()
{
    selectRoom(this.id);
}

function selectRoom(roomno)
{
    // 価格表
    var tr = tLib.get(roomno);
    if ( tr ) {
        if ( select_tr )
            tLib.removeClass(select_tr, "select");
        tLib.addClass(tr, "select");
        select_tr = tr;
    }

    // フロア図マーカー
    var room = rooms[roomno];
    if ( room ) {
        marker.style.display = "block";
        marker.style.left    = room.x +"px";
        marker.style.top     = room.y +"px";
    }
}


tLib.get(window).addEvent("load",init);