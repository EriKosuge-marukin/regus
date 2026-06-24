<!doctype html>
<html lang="ja">
<head>
<!--#include virtual="/openoffice/ssi/headtagmanager.html" -->
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="robots" content="follow,index">
<meta name="google-site-verification" content="oWvuR9gprE2qJLA_WMJdA8obyCAcYBEACdGWM0gWcIs" />
<title>問い合わせ・見学予約｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="問い合わせ・見学予約。オープンオフィスのレンタルオフィスは【保証金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="問い合わせ・見学予約,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<meta name="format-detection" content="telephone=no">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
<link href="/openoffice/sp/common/css/normalize.css" rel="stylesheet" type="text/css">
<!--メールフォームプロ用CSS-->
<link rel="stylesheet" href="/openoffice/sp/form_test/mfp.statics/mailformpro.css" type="text/css">
<!--/メールフォームプロ用CSS-->
<link href="/openoffice/sp/common/css/common_layout.css" rel="stylesheet" type="text/css">
<link href="/openoffice/sp/common/include/css/layout.css" rel="stylesheet" type="text/css">
<link href="/openoffice/sp/form/css/layout.css" rel="stylesheet" type="text/css">
</head>

<body class="drawer drawer--top">
	<!--#include virtual="/openoffice/sp/common/include/tag_top.html"-->
<div id="wrapper"> 
<!--#include virtual="/openoffice/sp/common/include/header.html"-->
<div class="ttl">
<h1>
問い合わせ・見学予約
</h1>
</div>
<div class="inner">
<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">
<p>お問い合わせの内容をご記入ください</p>
<div class="form_area">
<div class="inner">
<form name="form1" method="post" action="/openoffice/sp/form_test/form.php ">
<table border="0" cellpadding="0" cellspacing="0">
<tr>
<th>お問い合わせの内容</th>
<td>
	
<?php echo (isset($office) && $office?"オープンオフィス".$office."　":"");?>
<script type="text/javascript">Checkbox_free1.draw("<?php echo (isset($free1)?$free1:"");?>");</script>
<noscript>
<input type="text" name="free1" value="<?php echo (isset($free1)?$free1:"見学希望 / 資料希望 / ご相談");?>" size="50" class="formsize2">
<p>※該当しないものを削除してください。</p>
</noscript>	

<ul class="detail">
<li><label for="free1_0" class="block"><input id="free1_0" type="checkbox" class="checkbox" value="見学希望">見学希望</label></li>
<li><label for="free1_1" class="block"><input id="free1_1" type="checkbox" class="checkbox" value="資料希望">資料希望</label></li>
<li><label for="free1_2" class="block"><input id="free1_2" type="checkbox" class="checkbox" value="ご相談">ご相談</label></li>
</ul>
<noscript>
<input type="text" name="free1" value="見学希望 / 資料希望 / ご相談" size="50" class="formsize2">
<p>※該当しないものを削除してください。</p>
</noscript>
</td>
</tr>
<tr>
<th>会社名（団体名）</th>
<td class="name">
<input type="text" size="50" maxlength="50" name="tel" value="<?php echo (isset($tel)?$tel:"");?>" class="formsize2" <?php if(isset($error["tel"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["tel"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["tel"];?></div><?php
}?>
</td>
</tr>
<tr>
<th>担当者名 <span>（必須）</span></th>
<td class="name">
<input type="text" size="50" maxlength="50" name="name" value="<?php echo (isset($name)?$name:"");?>" class="formsize1" <?php if(isset($error["name"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["name"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["name"];?></div><?php
}?>
</td>
</tr>
<tr>
<th>電話番号 <span>（必須）</span></th>
<td class="name">
<input type="text" size="50" maxlength="50" name="tel" value="<?php echo (isset($tel)?$tel:"");?>" class="formsize2" <?php if(isset($error["tel"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["tel"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["tel"];?></div><?php
}?>
</td>
</tr>
<tr>
<th>携帯電話</th>
<td class="name">
<input type="text" size="50" maxlength="50" name="fax" value="<?php echo (isset($fax)?$fax:"");?>" class="formsize2">
</td>
</tr>
<tr>
<th>Eメール：E-mail<span>（必須）</span></th>
<td class="mail">
<input name="mail" type="text" id="mail" value="<?php echo (isset($mail)?$mail:"");?>" size="50" maxlength="80" class="formsize2" <?php if(isset($error["mail"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["mail"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["mail"];?></div><?php
}?>
</td>
</tr>

<tr>
<th>興味のあるオフィス</th>
<td>
	<script type="text/javascript">Checkbox_free2.draw()</script>
<ul class="office">
<li><label for="free2_0" class="officeblk osakahigobashi">
	<input id="free2_0" type="checkbox" class="checkbox" value="大阪肥後橋 ">大阪肥後橋</label></li>
<li><label for="free2_1" class="officeblk osakahirano">
	<input id="free2_1" type="checkbox" class="checkbox" value="大阪平野町 ">大阪平野町</label></li>
<li><label for="free2_2" class="officeblk takamatsu">
	<input id="free2_2" type="checkbox" class="checkbox" value="高松 ">高松</label></li>
<li><label for="free2_3" class="officeblk omiyaekinishi">
	<input id="free2_3" type="checkbox" class="checkbox" value="大宮駅西口 ">大宮駅西口</label></li>
<li><label for="free2_4" class="officeblk moriokaodori">
	<input id="free2_4" type="checkbox" class="checkbox" value="盛岡大通 ">盛岡大通</label></li>
<li><label for="free2_5" class="officeblk kinkoucho">
	<input id="free2_5" type="checkbox" class="checkbox" value="横浜金港町 ">横浜金港町</label></li>
<li><label for="free2_6" class="officeblk daimonekimae">
	<input id="free2_6" type="checkbox" class="checkbox" value="大門駅前 ">大門駅前</label></li>
<li><label for="free2_7" class="officeblk gotandaekinishi">
	<input id="free2_7" type="checkbox" class="checkbox" value="五反田駅西口 ">五反田駅西口</label></li>
<li><label for="free2_8" class="officeblk honatsugi">
	<input id="free2_8" type="checkbox" class="checkbox" value="本厚木駅前 ">本厚木駅前</label></li>
<li><label for="free2_9" class="officeblk oosakieki">
	<input id="free2_9" type="checkbox" class="checkbox" value="大崎駅西口 ">大崎駅西口</label></li>
<li><label for="free2_10" class="officeblk toyota">
	<input id="free2_10" type="checkbox" class="checkbox" value="豊田">豊田</label></li>
<li><label for="free2_11" class="officeblk nishishinjyukuekimae">
	<input id="free2_11" type="checkbox" class="checkbox" value="西新宿駅前">西新宿駅前</label></li>
<li><label for="free2_12" class="officeblk kariya">
	<input id="free2_12" type="checkbox" class="checkbox" value="刈谷"></label><span class="officename">刈谷</label></li>
<li><label for="free2_13" class="officeblk kobesannomiya">
	<input id="free2_13" type="checkbox" class="checkbox" value="神戸三宮南">神戸三宮南</label></li>
<li><label for="free2_14" class="officeblk ooita">
	<input id="free2_14" type="checkbox" class="checkbox" value="大分">大分</label></li>
<li><label for="free2_15" class="officeblk niigata">
	<input id="free2_15" type="checkbox" class="checkbox" value="新潟">新潟</label></li>
<li><label for="free2_16" class="officeblk nagoyamarunouchi">
	<input id="free2_16" type="checkbox" class="checkbox" value="名古屋丸の内">名古屋丸の内</label></li>
<li><label for="free2_17" class="officeblk shinosakakita">
	<input id="free2_17" type="checkbox" class="checkbox" value="新大阪北">新大阪北</label></li>
<li><label for="free2_18" class="officeblk tachikawa">
	<input id="free2_18" type="checkbox" class="checkbox" value="立川駅南">立川駅南</label></li>
<li><label for="free2_19" class="officeblk kumaomotoginzadori">
	<input id="free2_19" type="checkbox" class="checkbox" value="熊本銀座通り">熊本銀</label></li>
</ul>
</td>
</tr>

<tr>
<th class="detail">お問い合わせ詳細</th>
<td class="text">
<textarea name="free6" rows="5" cols="40" class="formsize1"><?php echo (isset($free6)?$free6:"");?></textarea>
</td>
</tr>
</table>
<!--/お問い合わせ内容-->
<div class="btns">
<ul>
<li>
<input name="requestID" type="hidden" id="requestID" value="<?php echo $_SESSION["requestID"];?>">
<input name="office" type="hidden" id="office" value="<?php echo (isset($office)?$office:"");?>">
<input name="floor" type="hidden" id="floor" value="<?php echo (isset($floor)?$floor:"");?>">
<input name="room" type="hidden" id="room" value="<?php echo (isset($room)?$room:"");?>">
<input id="submit_button" type="submit" value="送信">

</li>
</ul>
</div>
<!--/送信ボタン-->
</form>
</div>
</div>





</div>
</div>
<!--#include virtual="/openoffice/sp/common/include/footer.html"--> 
	<!--#include virtual="/openoffice/sp/common/include/tag_btm.html"-->
</body>
</html>