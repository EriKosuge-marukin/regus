<?php
include_once(dirname(__FILE__)."/include/config.ini.php");
if(!isset($_SESSION["requestID"])){//再コミットを防ぐ
	header("Location: form.php");
	die();
}
if(!isset($_SESSION["formData"])){
	header("Location: form.php");
	die();
}

$data = unserialize($_SESSION["formData"]);

if($_SESSION["requestID"]!=$data["requestID"]){
	header("Location: form.php");
	die();
}

if(isset($_POST) && !empty($_POST)){


	if($mode=="back"){
		$data["mode"] = $mode;
		$_SESSION["formData"] = serialize($data);

		header("Location: form.php");
		die();
	}
	if($mode=="send"){

		$subject = "【Openoffice】問い合わせ・見学予約";

		$message = "Source Major: Marketing Activity

Source Minor: Internet-Openoffice

Source Detail: Regus-Openoffice.jp

" . ($data["co"]?$data["co"]."　":"").$data["name"]."様

このたびはオープンオフィスへお問合せをいただき、
誠にありがとうございました。

いただいたお問合せの内容、現在の見学予約状況を確認し、
オフィス案内担当よりご連絡をいたしますので、
今しばらくお待ちください。

これからスタートする、あなたのオフィスライフが最高のも
のになるように、またビジネスがスムーズに開始できるよう
に、サポートしてまいります。

どうぞよろしくお願い致します。

	★こちらの内容で受け付けました。
--------------------------------------------------------
[会社名(団体名)：Company]".$data["co"]."
[担当者名： Name]".$data["name"]."
[電話番号： Telephone]".$data["tel"]."
[携帯電話： mobile phone]".$data["fax"]."
[Eメール：E-mail] ".$data["mail"]."

お問い合わせの内容： ".(isset($data["office"])?"オープンオフィス".$data["office"]."　":"").$data["free1"]."
興味のあるオフィス： ".str_replace(" /", "/",str_replace(array("\r\n", "\r", "\n"), "/", $data["free2"]))."
希望する部屋が具体的にあれば： ".$data["free3"]."
お問い合わせ詳細：
".$data["free6"]."

--------------------------------------------------------
※お申込みの見学会日程についてはご希望に添えない場合がござい
ます。ご了承下さい。


-----------------------------------------------
オープンオフィス 株式会社
オフィス案内担当　enquiry@openoffice.co.jp

〒107-0062　港区南青山2-2-8 DFビル5Ｆ
TEL 0120-956-122
-----------------------------------------------";

		$to = $data["mail"];
		$from = 'From: '.mb_encode_mimeheader (mb_convert_encoding('オープンオフィス ',"ISO-2022-JP","AUTO")).'<enquiry@openoffice.co.jp>'."\r\n";
		$from .= 'Return-Path: enquiry@openoffice.co.jp'."\r\n";
		//$from .= 'Bcc: relay@regus-office.jp'; ←※本番用設定
		$from .= 'Bcc: mim@lc93.jp'; //←※開発用設定
		// $from .= 'Bcc: Akihiro.koseki@regus.com,Kyoko.yagi@regus.com,Masaki.takahashi@regus.com,Yosuke.suzuki@regus.com,Kei.nakamura@regus.com,Maki.takeda@regus.com,Kazuya.moue@regus.com,Satomi.kawasaki@regus.com,Masayuki.Uwabo@regus.com,yoshifumi_ohtani@marukin-ad.co.jp,Tomomi.akiyama@regus.com,ISTJP@RegusGroupServices.onmicrosoft.com';

		mb_language("japanese");
		mb_internal_encoding("SJIS");

		$mail_result = mb_send_mail($to, $subject, $message, $from);

		session_destroy();

		header("Location: thanks.php".($mail_result?"":"?err=1"));
		die();
	}
}

extract($data);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php include("../ssi/headtagmanager.html");?>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>問い合わせ・見学予約｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="問い合わせ・見学予約。オープンオフィスのレンタルオフィスは【保証金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="問い合わせ・見学予約,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<link rel="canonical" href="http://regus-openoffice.jp/form/form.php">
<script type="text/javascript" charset="utf-8" src="/openoffice/script/opo-allpage.js"></script>
<script type="text/javascript" charset="utf-8" src="/openoffice/script/tlib.1.18.core.min.js"></script>
<script type="text/javascript" charset="utf-8" src="./script/officeform.js"></script>
<link href="/openoffice/css/style.css" rel="stylesheet" type="text/css">
<!--SP nav-->
<link rel="stylesheet" href="/openoffice/sp/common/css/normalize.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/include/css/drawer.min.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/include/css/layout.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/common/css/common_layout.css" type="text/css">
<link rel="stylesheet" href="/openoffice/sp/form/css/layout.scss" type="text/css">
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
  
    <h1>問い合わせ・見学予約　確認</h1>
  
</div>
<div id="inner">
<div class="content_outer">
  <div class="subblock_Fm">

<form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">
<h3>お問い合わせの内容をご確認ください</h3>
<table class="form1">

<tr><th align="left">お問い合わせの内容</th>
<td>
<?php echo (isset($office) && $office?"オープンオフィス".$office."　":"");?>
<script type="text/javascript">Checkbox_free1.draw("<?php echo $free1;?>", true);</script>
<noscript>
<input type="text" name="free1" value="<?php echo $free1;?>" size="50" class="formsize2" disabled="disabled">
<p>※該当しないものを削除してください。</p>
</noscript>
</td>
</tr>

<tr><th align="left">会社名（団体名）</th>
<td><input type="text" size="50" maxlength="50" name="co" value="<?php echo $co;?>" class="formsize1" disabled="disabled">
</td>
</tr>

<tr><th align="left">担当者名 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="name" value="<?php echo $name;?>" class="formsize1" disabled="disabled">
</td>
</tr>

<tr><th align="left">電話番号 <span class="required">（必須）</span></th>
<td><input type="text" size="50" maxlength="50" name="tel" value="<?php echo $tel;?>" class="formsize2" disabled="disabled">
</td>
</tr>

<tr><th align="left">携帯電話</th>
<td><input type="text" size="50" maxlength="50" name="fax" value="<?php echo $fax;?>" class="formsize2" disabled="disabled">
</td>
</tr>

<tr><th align="left">Eメール <span class="required">（必須）</span></th>
<td><input name="mail" type="text" id="mail" value="<?php echo $mail;?>" size="50" maxlength="80" class="formsize2" disabled="disabled">
</td>
</tr>
<tr><th align="left">興味のあるオフィス</th>
<td><script type="text/javascript">Checkbox_free2.draw("<?php echo str_replace(array("\r\n", "\r", "\n"), "/", $free2);?>", true)</script>
<noscript>
<textarea name="free2" rows="3" cols="50" class="formsize1"><?php echo $free2;?></textarea>
</noscript>
<p id="free3_blk" style="line-height:1.5em;">希望する部屋が具体的にあれば<br>
<input name="free3" type="text" size="50" value="<?php echo $free3;?>" class="formsize2" disabled="disabled">
</p>
</td>
</tr>

<tr><th align="left">お問い合わせ詳細</th>
<td><textarea name="free6" rows="5" cols="40" class="formsize1" disabled="disabled"><?php echo $free6;?></textarea></td>
</tr>

</table>

<input name="requestID" type="hidden" id="requestID" value="<?php echo $_SESSION["requestID"];?>">
<input name="mode" type="hidden" id="mode" value="">
<p class="form-submit"><input id="back_button" type="submit" value="戻る" onclick="document.getElementById('mode').value='back'"/> <input id="submit_button_2" type="submit" value="送信" onclick="document.getElementById('mode').value='send'"/>
</p>
</form>

</div>
</div>
</div>
<footer>
<p>東京・大阪をはじめ全国でサービス拠点を展開。<br>個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
<small>Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</small>
</footer>

<?php include("../ssi/accesslogger.html");?>
</div><?php include("../ssi/footertag.html");?>
</div></body></html>