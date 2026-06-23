// 仙台オフィス フロアマップ・価格表連携
// 2013/07/22 office taihei

var map_id = "map_sendai";
var rooms = {
    "room_501" :{x:316,y:385},
    "room_502" :{x:310,y:295},
    "room_503" :{x:280,y:385},
    "room_504" :{x:270,y:295},
    "room_505" :{x:240,y:385},
    "room_506" :{x:190,y:385},
    "room_507" :{x:155,y:300},
    "room_508" :{x:140,y:385},
    "room_509" :{x:105,y:385},
    "room_510" :{x:50, y:385},
    "room_511" :{x:30, y:305},
    "room_512" :{x:30, y:300},
    "room_513" :{x:30, y:240},
    "room_514" :{x:65, y:200},
    "room_515" :{x:110,y:190},
    "room_516" :{x:155,y:265},
    "room_517" :{x:155,y:185},
    "room_518" :{x:205,y:280},
    "room_519" :{x:225,y:165},
    "room_520" :{x:240,y:280},
    "room_521" :{x:270,y:255},
    "room_522" :{x:300,y:255},
    "room_523" :{x:290,y:150},
    "room_524" :{x:325,y:255},
    "room_525" :{x:355,y:235},
    "room_526" :{x:360,y:140},
    "room_527" :{x:375,y:235},
    "room_528" :{x:408,y:128},
    "room_529" :{x:460,y:115},
    "room_530" :{x:528,y:100},
    "room_531" :{x:540,y:190},
    "room_532" :{x:580,y:85 },
    "room_533" :{x:625,y:75 },
    "room_534" :{x:690,y:55 },
    "room_535" :{x:758,y:50 },
    "room_536" :{x:750,y:125},
    "room_537" :{x:755,y:160},
    "room_538" :{x:764,y:210},
    "room_539" :{x:774,y:272},
    "room_540" :{x:768,y:325},
    "room_541" :{x:622,y:362},
    "room_542" :{x:570,y:268},
    "room_543" :{x:535,y:275},
    "room_544" :{x:495,y:290},
    "room_S-01":{x:620,y:290},
    "room_S-02":{x:685,y:275},
    "room_S-03":{x:615,y:260},
    "room_S-04":{x:680,y:250},
    "room_S-05":{x:608,y:240},
    "room_S-06":{x:675,y:222},
    "room_S-07":{x:600,y:215},
    "room_S-08":{x:595,y:190},
    "room_S-09":{x:662,y:172},
    "room_S-10":{x:590,y:162},
    "room_S-11":{x:655,y:150}
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