// 溜池山王オフィス フロアマップ・価格表連携
// 2013/10/18(Fri) office taihei


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
        "map_tameike3f",
        {
          "room_309"  :{"x":50, "y":63 },
          "room_308"  :{"x":50, "y":140 },
          "room_307"  :{"x":50, "y":194 },
          "room_306"  :{"x":50, "y":250 },
          "room_310"  :{"x":127, "y":46 },
          "room_311"  :{"x":193, "y":46 },
          "room_313"  :{"x":259, "y":46 },
          "room_314"  :{"x":325, "y":61 },
          "room_S-01" :{"x":153, "y":132 },
          "room_S-02" :{"x":233, "y":132 },
          "room_S-03" :{"x":153, "y":162 },
          "room_S-04" :{"x":233, "y":162 },
          "room_S-05" :{"x":153, "y":190 },
          "room_S-06" :{"x":233, "y":190 },
          "room_304"  :{"x":155, "y":248 },
          "room_305"  :{"x":141, "y":362 },
          "room_303"  :{"x":202, "y":366 },
          "room_302"  :{"x":245, "y":369 },
          "room_301"  :{"x":291, "y":370 }
        }
    );

    new MapLink(
        "map_tameike8f",
        {
            "room_801" :{"x":388, "y":45 },
            "room_802" :{"x":451, "y":45 },
            "room_803" :{"x":520, "y":45 },
            "room_804" :{"x":513, "y":143 },
            "room_805" :{"x":565, "y":143 },
            "room_806" :{"x":593, "y":45 },
            "room_807" :{"x":612, "y":143 },
            "room_808" :{"x":656, "y":143 },
            "room_809" :{"x":659, "y":45 },
            "room_810" :{"x":699, "y":143 },
            "room_811" :{"x":718, "y":45 },
            "room_812" :{"x":323, "y":45 },
            "room_813" :{"x":274, "y":138 },
            "room_814" :{"x":257, "y":45 },
            "room_815" :{"x":215, "y":138 },
            "room_816" :{"x":189, "y":45 },
            "room_817" :{"x":155, "y":138 },
            "room_818" :{"x":122, "y":45 },
            "room_819" :{"x":96, "y":138 },
            "room_820" :{"x":37, "y":138 },
            "room_821" :{"x":46, "y":45 }
        }
    );
}

tLib.get(window).addEvent("load",init);