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
        "map_yodoyabashi",
        {
            "room_801" :{"x":646, "y":42 },
            "room_802" :{"x":571, "y":42 },
            "room_803" :{"x":511, "y":42 },
            "room_804" :{"x":461, "y":42 },
            "room_806" :{"x":399, "y":42 },
            "room_808" :{"x":340, "y":42 },
            "room_810" :{"x":278, "y":42 },
            "room_812" :{"x":215, "y":42 },
            "room_813" :{"x":167, "y":42 },
            "room_805" :{"x":456, "y":151 },
            "room_807" :{"x":392, "y":151 },
            "room_809" :{"x":328, "y":151 },
            "room_S"   :{"x":568, "y":198 },
            "room_829" :{"x":467, "y":223 },
            "room_828" :{"x":418, "y":223 },
            "room_826" :{"x":368, "y":223 },
            "room_824" :{"x":322, "y":223 },
            "room_811" :{"x":258, "y":163 },
            "room_814" :{"x":196, "y":163 },
            "room_822" :{"x":258, "y":233 },
            "room_820" :{"x":187, "y":233 },
            "room_835" :{"x":775, "y":279 },
            "room_834" :{"x":775, "y":339 },
            "room_833" :{"x":642, "y":353 },
            "room_832" :{"x":570, "y":353 },
            "room_831" :{"x":509, "y":353 },
            "room_830" :{"x":459, "y":353 },
            "room_827" :{"x":398, "y":353 },
            "room_825" :{"x":342, "y":353 },
            "room_823" :{"x":281, "y":353 },
            "room_821" :{"x":216, "y":353 },
            "room_819" :{"x":149, "y":353 },
            "room_815" :{"x":105, "y":67 },
            "room_816" :{"x":94, "y":139 },
            "room_817" :{"x":81, "y":234 },
            "room_818" :{"x":68, "y":325 }
        }
    );
}

tLib.get(window).addEvent("load",init);


