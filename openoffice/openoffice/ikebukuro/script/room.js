// 京都河原町御池オフィス フロアマップ・価格表連携
// 2014/01/14 office taihei


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
        "map_kyoto3f",
        {
            "room_301" :{"x":254, "y":80 },
            "room_303" :{"x":311, "y":67 },
            "room_304" :{"x":366, "y":67 },
            "room_306" :{"x":425, "y":67 },
            "room_307" :{"x":482, "y":67 },
            "room_309" :{"x":541, "y":67 },
            "room_310" :{"x":599, "y":67 },
            "room_312" :{"x":678, "y":67 },
            "room_302" :{"x":307, "y":233 },
            "room_305" :{"x":392, "y":225 },
            "room_308" :{"x":485, "y":225 },
            "room_311" :{"x":577, "y":247 },
            "room_313" :{"x":675, "y":225 }
        }
    );

    new MapLink(
        "map_kyoto4f",
        {
            "room_401" :{"x":254, "y":86 },
            "room_402" :{"x":309, "y":65 },
            "room_403" :{"x":366, "y":65 },
            "room_404" :{"x":424, "y":65 },
            "room_406" :{"x":478, "y":70 },
            "room_408" :{"x":593, "y":70 },
            "room_410" :{"x":679, "y":67 },
            "room_405" :{"x":441, "y":223 },
            "room_407" :{"x":550, "y":191 },
            "room_409" :{"x":576, "y":253 },
            "room_411" :{"x":678, "y":220 }
        }
    );

    new MapLink(
        "map_kyoto5f",
        {
            "room_501" :{ "x":349, "y":65 },
            "room_502" :{ "x":435, "y":67 },
            "room_504" :{ "x":495, "y":67 },
            "room_506" :{ "x":551, "y":67 },
            "room_507" :{ "x":606, "y":67 },
            "room_509" :{ "x":680, "y":67 },
            "room_503" :{ "x":435, "y":188 },
            "room_505" :{ "x":503, "y":242 },
            "room_508" :{ "x":583, "y":242 },
            "room_510" :{ "x":673, "y":221 }
        }
    );
}

tLib.get(window).addEvent("load",init);