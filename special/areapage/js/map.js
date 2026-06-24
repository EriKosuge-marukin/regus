function attachMessage(marker, msg) {
    google.maps.event.addListener(marker, 'click', function(event) {
      new google.maps.InfoWindow({
        content: msg
      }).open(marker.getMap(), marker);
    });
  }
// 位置情報と表示データの組み合わせ
  var data = new Array();//マーカー位置の緯度経度
  data.push({position: new google.maps.LatLng(35.681382, 139.766084), content: '東京駅'});
  data.push({position: new google.maps.LatLng(35.690921, 139.700258), content: '新宿駅'});
 
  var myMap = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,//地図縮尺
    center: new google.maps.LatLng(35.69106, 139.733989),//地図の中心点
    scrollwheel: false,
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
 
  for (i = 0; i < data.length; i++) {
    var myMarker = new google.maps.Marker({
      position: data&#91;i&#93;.position,
      map: myMap
    });
    attachMessage(myMarker, data&#91;i&#93;.content);
  }