#!/bin/bash

#cp -p status_test.png status_window.png
#cp -p status_test.png status_24.png
#cp -p status_test.png status_private.png
#cp -p status_test.png status_aircon.png
#cp -p status_test.png status_freespace.png
#cp -p status_test.png status_meeting.png
#cp -p status_test.png status_tbox.png
#cp -p status_test.png status_parking.png
#cp -p status_test.png status_maxcapa01.png
#cp -p status_test.png status_maxcapa02.png
#cp -p status_test.png status_maxcapa03.png
#cp -p status_test.png status_maxcapa04.png
#cp -p status_test.png status_maxcapa05.png
#cp -p status_test.png status_maxcapa06.png
#cp -p status_test.png status_maxcapa07.png
#cp -p status_test.png status_maxcapa08.png
#cp -p status_test.png status_maxcapa09.png

srcdir="/home/taihei/work/businessBank/fromBusinessBank/111216/icon書き出し"
params="--sharp 0x0.5"

webimage $srcdir/窓あり.jpg          --size 34x34 $params status_window.png
webimage $srcdir/24h.gif                          $params status_24.png
webimage $srcdir/完全個室.gif                     $params status_private.png
webimage $srcdir/個別空調.gif                     $params status_aircon.png
webimage $srcdir/フリースペース.jpg  --size 34x34 $params status_freespace.png
webimage $srcdir/無料会議室.jpg      --size 34x34 $params status_meeting.png
webimage $srcdir/宅配ボックス.gif                 $params status_tbox.png
webimage $srcdir/ビル駐車場.gif                   $params status_parking.png
webimage $srcdir/1名.gif                          $params status_maxcapa01.png
webimage $srcdir/2名.gif                          $params status_maxcapa02.png
webimage $srcdir/3名.gif                          $params status_maxcapa03.png
webimage $srcdir/4名.gif                          $params status_maxcapa04.png
webimage $srcdir/5名.gif                          $params status_maxcapa05.png
webimage $srcdir/6名.gif                          $params status_maxcapa06.png
webimage $srcdir/7名.gif                          $params status_maxcapa07.png
webimage $srcdir/8名.gif                          $params status_maxcapa08.png
# webimage $srcdir/ status_maxcapa09.png

# 1_2名.gif
# 2_3名.gif
# 3_4名.gif
# 4_5名.gif
# 5_6名.gif
# 6_7名.gif
# 7_8名.gif
# 10万円.gif
# 20万円.gif
# 30万円.gif
