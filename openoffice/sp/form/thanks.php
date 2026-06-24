<?php
include_once(dirname(__FILE__)."/include/config.ini.php");
$error = false;
if(isset($_GET["err"]) && $_GET["err"]){
	$error = true;
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php include("../ssi/headtagmanager.html");?>
<!--↓yahooコンバージョン測定タグ//-->
    <script async>
ytag({
  "type": "yss_conversion",
  "config": {
    "yahoo_conversion_id": "1000137052",
    "yahoo_conversion_label": "9DYmCOXyrlYQ0dnizQM",
    "yahoo_conversion_value": "0"
  }
});
</script>
<!--↑yahooコンバージョン測定タグ//-->
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>問い合わせ・見学予約｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="問い合わせ・見学予約。オープンオフィスのレンタルオフィスは【保証金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="問い合わせ・見学予約,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

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
  
    <h1>問い合わせありがとうございました</h1>
  
</div>
<div id="inner">
<div class="content_outer">
  <div class="subblock_Fm">

<?php if($error){?>
<h1 class="thanks_0"><font color="red">メールの送信に失敗しました。</font></h1>
<?php }else{?>
<h1 class="thanks">お申込みを受け付けました。</h1>
<p class="thanks_p">お問合せ・見学会参加へのお申込み有難うございます。こちらから1営業日以内にご連絡させて頂きます。</p>
<?php }?>
<div class="contactF">
<h2>土日祝日は受付窓口をお休み頂いております。</h2>

<div class="tel">
<h3>お電話でのお問合せ</h3>
    平日月曜から金曜の朝9：00～18：00でお願いします。<br>
土日・祝祭日(および年末年始)は、受付休業です。

<p class="telNum">0120-974-685</p>
</div>



</div>
</div>

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