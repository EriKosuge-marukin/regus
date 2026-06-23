// 京阪淀屋橋オフィス フロアマップ・価格表連携
// 2013/11/15(Fri)  office taihei


function MapLink (map_id, rooms)
{
    var self = this;

    this._onPriceListClick = function (e) { self.selectRoom(this.id); };
    this._onMapClick = function (e) { self.selectRoom(this.getAttribute("alt")); };
    this._init(map_id, rooms);
}
MapLink.prototype = {
    map: null, // マップ画像
    marker: null, // マーカー
    rooms: {}, // 各部屋データ
    select_tr: null, // 選択中TR
    _init: function (map_id, rooms) {
        var i;
        var map,cmap,marker,outer;
        var j,area,room;
        var trs,tr;

        map = tLib.get(map_id);
        if ( ! map )
            return;
        
        cmap = tLib.makeNode({name:"map", attr:{"name":map_id +"_table"}});
        marker = tLib.makeNode({name:"div", attr:{"class":"map-marker","style":"display:none;"}});
        outer = tLib.makeNode({attr:{"style":"position:relative;"},child:[cmap,marker]});
        map.parentNode.replaceChild(outer,map);
        outer.appendChild(map);
        
        map.setAttribute("usemap","#"+ map_id +"_table");
        
        for ( j in rooms ) {
            room = rooms[j];
            area = tLib.makeNode(
                {
                    name:"area",
                    attr:{"shape":"circle","coords":room.x+","+room.y+",20","alt":j,"style":"cursor:pointer;"},
                    event:{"click":this._onMapClick}
                }
            );
            cmap.appendChild(area);
        }
        
        for ( i in rooms ) {
            tr = tLib.get(i);
            if ( tr ) {
                tr.addEvent("click",this._onPriceListClick);
                tr.style.cursor = "pointer";
            }
        }

        this.map = map;
        this.marker = marker;
        this.rooms = rooms;
    },

    selectRoom: function (roomno) {
        // 価格表
        var tr = tLib.get(roomno);
        if ( tr ) {
            if ( this.select_tr )
                tLib.removeClass(this.select_tr, "select");
            tLib.addClass(tr, "select");
            this.select_tr = tr;
        }

        // フロア図マーカー
        var room = this.rooms[roomno];
        if ( room ) {
            this.marker.style.display = "block";
            this.marker.style.left    = room.x +"px";
            this.marker.style.top     = room.y +"px";
        }
    }

};


function init()
{
    new MapLink(
        "map_sapporo-minami5f",
        {
            "room_501" :{"x":353, "y":216 },
            "room_503" :{"x":295, "y":216 },
            "room_506" :{"x":238, "y":216 },
            "room_502" :{"x":347, "y":129 },
            "room_504" :{"x":300, "y":129 },
            "room_505" :{"x":251, "y":129 },
            "room_507" :{"x":206, "y":129 },
            "room_508" :{"x":209, "y":58 },
            "room_509" :{"x":132, "y":37 },
            "room_510" :{"x":97,  "y":84 },
            "room_511" :{"x":97,  "y":142 },
            "room_512" :{"x":140, "y":236 },
            "room_513" :{"x":160, "y":291 },
            "room_514" :{"x":547, "y":56 },
            "room_516" :{"x":596, "y":47 },
            "room_518" :{"x":647, "y":47 },
            "room_520" :{"x":728, "y":47 },
            "room_521" :{"x":763, "y":104 },
            "room_522" :{"x":763, "y":152 },
            "room_524" :{"x":763, "y":206 },
            "room_515" :{"x":550, "y":158 },
            "room_517" :{"x":594, "y":158 },
            "room_519" :{"x":658, "y":139 },
            "room_523" :{"x":658, "y":176 },
            "room_525" :{"x":658, "y":216 }
        }
    );

    new MapLink(
        "map_sapporo-minami6f",
        {
            "room_602" :{"x":756, "y":207 },
            "room_604" :{"x":756, "y":132 },
            "room_605" :{"x":730, "y":45 },
            "room_607" :{"x":646, "y":45 },
            "room_609" :{"x":596, "y":45 },
            "room_611" :{"x":549, "y":54 },
            "room_612" :{"x":507, "y":54 },
            "room_614" :{"x":455, "y":54 },
            "room_616" :{"x":397, "y":54 },
            "room_617" :{"x":301, "y":45 },
            "room_618" :{"x":253, "y":45 },
            "room_619" :{"x":204, "y":45 },
            "room_620" :{"x":129, "y":40 },
            "room_621" :{"x":108, "y":90 },
            "room_623" :{"x":108, "y":141 },
            "room_601" :{"x":654, "y":216 },
            "room_603" :{"x":654, "y":178 },
            "room_606" :{"x":653, "y":140 },
            "room_608" :{"x":599, "y":157 },
            "room_610" :{"x":552, "y":157 },
            "room_613" :{"x":462, "y":157 },
            "room_615" :{"x":412, "y":157 },
            "room_S"   :{"x":315, "y":176 },
            "room_622" :{"x":218, "y":155 },
            "room_625" :{"x":218, "y":219 },
            "room_626" :{"x":212, "y":287 },
            "room_624" :{"x":134, "y":265 }
        }
    );
}

tLib.get(window).addEvent("load",init);


