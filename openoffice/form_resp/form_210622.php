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
<title>空室・金額確認｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="空室・金額確認。オープンオフィスのレンタルオフィスは【入会金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="空室・金額確認,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<link rel="canonical" href="https://www.regus-office.jp/openoffice/form_resp/form.php">
<script type="text/javascript" charset="utf-8" src="/openoffice/script/opo-allpage.js"></script>
<script type="text/javascript" charset="utf-8" src="/openoffice/script/tlib.1.18.core.min.js"></script>
<script type="text/javascript" charset="utf-8" src="./script/officeform.js"></script>
<link href="css/officeform.css" rel="stylesheet" type="text/css">
<link href="/openoffice/css/style.css" rel="stylesheet" type="text/css">
<style type="text/css">
</style>
<?php include("../ssi/js.html");?>

<base target="_top">
<meta name="google-site-verification" content="aQyLxq1Kvlt4I80QsZ7plYTf7THuiZn9bjX76BBAn_0" />
</head>
<body>
<?php include("../ssi/bodygoogle.html");?>
<div id="OPO_body_Fm">
<div id="OPO_header_Fm">
<div id="OPO_header_title">
<p id="OPO_header_openoffice"><a href="https://www.regus-office.jp/"><img src="/openoffice/images/ind_head01.png" alt="REGUS"></a></p>
<div id="OPO_header_toplink"><p>空室・金額確認｜個室のレンタルオフィスならOpenoffice：東京・大阪をはじめ全国に50拠点以上</p></div>

</div>
</div><!--header-->
<div id="OPO_main_Fm">
<div id="OPO_main_title_blk_Fm">
  
    <h1>空室・金額確認</h1>
  
</div><div class="lead">
<h3>空室・金額確認を希望するセンターをご記入ください</h3>
<p>お問い合わせいただきましたら、専門スタッフより、すぐにメール、もしくはお電話にて対応させていただきます。</p> 
</div>
<div class="content_outer">
<div class="bnrArea"><img src="images/bnr_cam.jpg"></div>
  <div class="subblock_Fm">


<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">

<table class="form1 mgT20">
<tr><th align="left">担当者名 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="name" value="<?php echo (isset($name)?$name:"");?>" class="formsize1" <?php if(isset($error["name"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["name"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["name"];?></div><?php
}?>
</td>
</tr>

<tr><th align="left">電話番号 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="tel" value="<?php echo (isset($tel)?$tel:"");?>" class="formsize2" <?php if(isset($error["tel"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["tel"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["tel"];?></div><?php
}?>
</td>
</tr>

<tr><th align="left">メールアドレス <span class="required">（必須）</span></th>
<td><input name="mail" type="text" id="mail" value="<?php echo (isset($mail)?$mail:"");?>" size="50" maxlength="80" class="formsize1" <?php if(isset($error["mail"])){?>style="background-color: #FFDDDD"<?php }?>><?php
if(isset($error["mail"])){?>
<div class="required" style="padding-top: 3px;"><?php echo $error["mail"];?></div><?php
}?>
</td>
</tr>

<tr>
	<th align="left">空室・金額確認を<br>希望するセンター</th>
	<td style="vertical-align: middle;"><input type="text" size="50" maxlength="50" name="center" value="<?php echo (isset($center)?$center:"");?>" class="formsize1">
	</td>
</tr>

<tr>
	<th align="left">見学予約を希望する</th>
	<td><input type="checkbox" name="visit" value="yes"> する</td>
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
</div>
</div>

<div id="OPO_footer">
<p class="footerTxt">東京・大阪をはじめ全国でサービス拠点を展開。個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
<div id="OPO_copyright" class="OPO-block">Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</div>
</div>

<?php include("../ssi/accesslogger.html");?>
</div><?php include("../ssi/footertag.html");?>
</div></body></html>