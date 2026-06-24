<?php
include_once(dirname(__FILE__)."/include/config.ini.php");

if(!isset($_SESSION["requestID"])){//再コミットを防ぐ
	$_SESSION["requestID"]=md5(uniqid(rand()));
}

$error = array();
if(isset($_POST) && !empty($_POST)){
	if(!isset($name) || empty($name)){
		$error["name"] = "担当者名が入力されていません。";
	}
	if(!isset($tel) || empty($tel)){
		$error["tel"] = "電話番号が入力されていません。";
	}
	if(!isset($mail) || empty($mail)){
		$error["mail"] = "メールアドレスが入力されていません。";
	}else{
		if(!preg_match('/^[0-9a-zA-Z\-\_\.]+\@[0-9a-zA-Z\-\_\.]+$/', $mail)){
			$error["mail"] =  "メールアドレスが正しくありません。";
		}
	}

	if(empty($error)){
		$_SESSION["formData"]=serialize($_POST);
		header("Location: confirm.php");
		die();
	}
}else{
	if(isset($_SESSION["formData"])){
		$data = unserialize($_SESSION["formData"]);
		if(isset($data["mode"]) && $data["mode"]=="back"){
			extract($data);
		}
	}

}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php include("../ssi/headtagmanager.html");?>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>空室・金額確認｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="空室・金額確認。オープンオフィスのレンタルオフィスは【入会金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="空室・金額確認,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="canonical" href="http://regus-openoffice.jp/form/form.php">
<!-- 404 script type="text/javascript" charset="utf-8" src="/openoffice/script/opo-allpage.js"></script-->
<!-- 404 script type="text/javascript" charset="utf-8" src="/openoffice/script/tlib.1.18.core.min.js"></script-->
<!-- 404 script type="text/javascript" charset="utf-8" src="./script/officeform.js"></script-->
<!-- 404 link href="/openoffice/css/style.css" rel="stylesheet" type="text/css"-->
<!--SP nav-->
<link rel="stylesheet" href="/openoffice/sp/common/css/normalize.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/include/css/drawer.min.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/include/css/layout.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/css/common_layout.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/form2/css/layout.scss" type="text/css">
<link href="css/officeform_2.css" rel="stylesheet" type="text/css">
<script src="/openoffice/sp/common/js/script.js" type="text/javascript"></script>
<script src="/openoffice/sp/common/js/drawer.js"></script>
<script src="/openoffice/sp/common/js/iscroll.min.js"></script>
<script type="text/javascript" src="/openoffice/sp/common/js/wow.js"></script>
<script src="/openoffice/sp/common/js/dropdown.js"></script>
<script type="text/javascript" src="/openoffice/sp/common/js/jquery.easing.min.js"></script>
<script>
$(document).ready(function() {
	$(".drawer").drawer();
});
</script>
<!--/SP nav-->
<style type="text/css">
#wrapper #inner {
  padding: 0 3.5%;
	width: 100% !important;
	margin: 0;
}
#submit_button {
	border: 0;
}
.checkbox_visit {
	vertical-align: middle;
  margin: 0px 2px;	
}
</style>
<?php include("../ssi/js.html");?>

<base target="_top">
<meta name="google-site-verification" content="aQyLxq1Kvlt4I80QsZ7plYTf7THuiZn9bjX76BBAn_0" />
</head>
<body class="drawer drawer--top" style="overflow-y: visible;">
<?php include("../ssi/bodygoogle.html");?>

<div id="wrapper">
<header>    <div class="logo">
      <a href="https://www.regus-office.jp/"><img src="/openoffice/sp/common/include/img/logo.gif" alt="Openoffice"></a>
    </div>
	<button type="button" class="drawer-toggle drawer-hamburger">
		<span class="sr-only">メニュー</span>
		<span class="drawer-hamburger-icon"></span>
	</button>
	<nav class="drawer-nav" role="navigation">
		<ul class="drawer-menu">
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/center_list/">オフィスを探す</a></li>
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/intro/">オープンオフィスとは？</a></li>
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/intro/step_hop.html">ご利用までのステップ</a></li>
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/intro/one_day.html">オープンオフィスの一日</a></li>
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/sonota/qanda.html">よくあるご質問</a></li>
			<li class="nav_link"><a class="drawer-menu-item drawer-toggle anc" href="/openoffice/sp/company_infomation/outline.html">会社概要</a></li>
		</ul>
	</nav>
</header>
<div id="ttl">
  
    <h1>空室・金額確認</h1>
  
</div>
<div id="inner">
<div class="content_outer">
  <div class="subblock_Fm">


<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">
<h3>空室・金額確認を希望するセンターをご記入ください</h3>
<span style="font-size: 0.8em;">お問い合わせいただきましたら、専門スタッフより、すぐにメール、もしくはお電話にて対応させていただきます。</span>
<table class="form1">
<?php /*
<tr><th align="left">お問い合わせの内容</th>
<td>
	<label for="free1_0" class="block"><input id="free1_0" type="checkbox" name="kengaku" class="checkbox" value="見学希望" <?php if($_POST["kengaku"]){echo "checked";}?>>見学希望</label>
	<label for="free1_1" class="block"><input id="free1_1" type="checkbox" name="siryoukibou" class="checkbox" value="資料希望" <?php if($_POST["siryoukibou"]){echo "checked";}?>>資料希望</label>
	<label for="free1_2" class="block"><input id="free1_2" type="checkbox" name="gosoudan" class="checkbox" value="ご相談" <?php if($_POST["gosoudan"]){echo "checked";}?>>ご相談</label>
<?php //echo (isset($office) && $office?"オープンオフィス".$office."　":"");?>
<script type="text/javascript">Checkbox_free1.draw("<?php echo (isset($free1)?$free1:"");?>");</script>
<noscript>
<input type="text" name="free1" value="<?php echo (isset($free1)?$free1:"見学希望 / 資料希望 / ご相談");?>" size="50" class="formsize2">
<p>※該当しないものを削除してください。</p>
</noscript>
</td>
</tr>

<tr><th align="left">会社名（団体名）</th>
<td><input type="text" size="50" maxlength="50" name="co" value="<?php echo (isset($co)?$co:"");?>" class="formsize1">
</td>
</tr>
*/ ?>

<tr><th align="left">担当者名 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="name" value="<?php echo (isset($name)?$name:"");?>" class="formsize1" <?php if(isset($error["name"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["name"])){?>
<div class="required" style="padding-top: 3px; color: red;"><?php echo $error["name"];?></div><?php
}?>
</td>
</tr>

<tr><th align="left">電話番号 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="tel" value="<?php echo (isset($tel)?$tel:"");?>" class="formsize2" <?php if(isset($error["tel"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["tel"])){?>
<div class="required" style="padding-top: 3px; color: red;"><?php echo $error["tel"];?></div><?php
}?>
</td>
</tr>

<tr><th align="left">メールアドレス <span class="required">（必須）</span></th>
<td><input name="mail" type="text" id="mail" value="<?php echo (isset($mail)?$mail:"");?>" size="50" maxlength="80" class="formsize2" <?php if(isset($error["mail"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["mail"])){?>
<div class="required" style="padding-top: 3px; color: red;"><?php echo $error["mail"];?></div><?php
}?>
</td>
</tr>

<tr>
	<th align="left">空室・金額確認を希望するセンター</th>
	<td style="vertical-align: middle;"><input type="text" size="50" maxlength="50" name="center" value="<?php echo (isset($center)?$center:"");?>" class="formsize1">
	</td>
</tr>

<tr>
	<th align="left">見学予約を希望する</th>
	<td><input class="checkbox_visit" type="checkbox" name="visit" value="yes"> する</td>
</tr>

</table>

<input name="requestID" type="hidden" id="requestID" value="<?php echo $_SESSION["requestID"];?>">
<input name="office" type="hidden" id="office" value="<?php echo (isset($office)?$office:"");?>">
<input name="floor" type="hidden" id="floor" value="<?php echo (isset($floor)?$floor:"");?>">
<input name="room" type="hidden" id="room" value="<?php echo (isset($room)?$room:"");?>">
<p class="form-submit"><input id="submit_button" type="submit" value="送信">
</p>
</form>

</div>
<div style="max-width: 320px;margin: 40px auto"><img src="img/bnr_cam.jpg" alt="オフィス利用用　最大30％オフを実施中"></div>
</div>
</div>

<footer>
<p>東京・大阪をはじめ全国でサービス拠点を展開。<br>個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
<small>Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</small>
</footer>

<?php include("../ssi/accesslogger.html");?>
</div><?php include("../ssi/footertag.html");?>
</div></body></html>