<?php
	
//Google recapcha V3
// サイトキーを入力
$key = '6Lc5opEbAAAAAGFLiqzOb3Z3KTac_xmW_OXWjk7Z';
// シークレット キーを入力
$secretKey = '6Lc5opEbAAAAAAsPZBS0EQC_Cql7SrVqBFTzEZIB';
if (isset($_POST['name']) && isset($_POST['mail'])) 
{
  $Response = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['recaptchaResponse']);
  $result = json_decode($Response);
  if ($result->success) 
  {
    $grpc_message = 'success_msg';
    $grpc_status = 'success_sts';
  } 
  else 
  {
    $grpc_message = $result->{'error-codes'}[0];
    $grpc_status = 'danger';
  }
}

/*
echo $message;
echo "@@@";
echo $status;
*/
?><?php
include_once(dirname(__FILE__)."/include/config.ini.php");

if (!isset($_SESSION["requestID"])) { //再コミットを防ぐ
  $_SESSION["requestID"] = md5(uniqid(rand()));
}

$error = [];

if (isset($_POST) && !empty($_POST)) {

  if (!isset($name) || empty($name)) {
    $error["name"] = "担当者名が入力されていません。";
  }

  if (!isset($tel) || empty($tel)) {
    $error["tel"] = "電話番号が入力されていません。";
  }

  if (!isset($mail) || empty($mail)) {
    $error["mail"] = "メールアドレスが入力されていません。";
  } else {
    if (!preg_match('/^[0-9a-zA-Z\-\_\.]+\@[0-9a-zA-Z\-\_\.]+$/', $mail)) {
      $error["mail"] = "メールアドレスが正しくありません。";
    }
  }

  if (empty($error)) {
    $_SESSION["formData"] = serialize($_POST);
    //Google reCapcha V3の場合には送信処理へ進む
    if($grpc_status == "success_sts"){
	    header("Location: confirm.php");
	    die();
    }
  }

} else {

  if (isset($_SESSION["formData"])) {
    $data = unserialize($_SESSION["formData"]);
    if (isset($data["mode"]) && $data["mode"] == "back") {
      extract($data);
    }
  }

}
?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<?php include("../ssi/headtagmanager.html"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>問い合わせ｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="問い合わせ・見学予約。オープンオフィスのレンタルオフィスは【入会金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="問い合わせ・見学予約,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
select[name="think_about"] {
  width: 100%;
  padding: 4pt 2pt;
}
select {font-size: 12.6pt;}
#submit_button {
  border: 0;
}
.checkbox_visit {
  vertical-align: middle;
  margin: 0px 2px;
}
</style>
<?php include("../ssi/js.html"); ?>

<base target="_top">
<meta name="google-site-verification" content="aQyLxq1Kvlt4I80QsZ7plYTf7THuiZn9bjX76BBAn_0" />
<!---Google reCapcha V3--->
<script src="https://www.google.com/recaptcha/api.js?render=<?php echo $key ?>"></script>
<script>
  grecaptcha.ready(function () {
    grecaptcha.execute("<?php echo $key ?>", {action: "sent"}).then(function(token) {
      var recaptchaResponse = document.getElementById("recaptchaResponse");
      recaptchaResponse.value = token;
    });
  });
</script>
</head>

<body class="drawer drawer--top" style="overflow-y: visible;">

<?php include("../ssi/bodygoogle.html"); ?>

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

  <div id="ttl"><h1>問い合わせ</h1></div>

  <div id="inner">
    <div class="content_outer">
      <div class="subblock_Fm">

        <form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?> ">
          <h3>お問い合わせの内容をご記入ください</h3>
          <span style="font-size: 0.8em;">お問い合わせいただきましたら、専門スタッフより、<span class="sSentence">すぐにメール、もしくはお電話にて対応させていただきます。</span></span>

          <table class="form1">
<?php /*
<tr><th align="left">お問い合わせの内容</th>
<td>
    <label for="free1_0" class="block"><input id="free1_0" type="checkbox" name="kengaku" class="checkbox" value="見学希望" <?php if($_POST["kengaku"]){echo "checked";} ?>>見学希望</label>
    <label for="free1_1" class="block"><input id="free1_1" type="checkbox" name="siryoukibou" class="checkbox" value="資料希望" <?php if($_POST["siryoukibou"]){echo "checked";} ?>>資料希望</label>
    <label for="free1_2" class="block"><input id="free1_2" type="checkbox" name="gosoudan" class="checkbox" value="ご相談" <?php if($_POST["gosoudan"]){echo "checked";} ?>>ご相談</label>
<?php //echo (isset($office) && $office?"オープンオフィス".$office."　":""); ?>
<script type="text/javascript">Checkbox_free1.draw("<?php echo (isset($free1)?$free1:""); ?>");</script>
<noscript>
<input type="text" name="free1" value="<?php echo (isset($free1)?$free1:"見学希望 / 資料希望 / ご相談"); ?>" size="50" class="formsize2">
<p>※該当しないものを削除してください。</p>
</noscript>
</td>
</tr>

<tr><th align="left">会社名（団体名）</th>
<td><input type="text" size="50" maxlength="50" name="co" value="<?php echo (isset($co)?$co:""); ?>" class="formsize1">
</td>
</tr>
*/ ?>

            <tr>
              <th align="left">担当者名 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="name" value="<?php echo(isset($name)?$name:""); ?>" class="formsize1" <?php if (isset($error["name"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["name"])) {
?>
                <div class="required" style="padding-top: 3px; color: red;"><?php echo $error["name"]; ?></div>
<?php
}
?>
              </td>
            </tr>

            <tr>
              <th align="left">電話番号 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="tel" value="<?php echo (isset($tel) ? $tel : ""); ?>" class="formsize2" <?php if (isset($error["tel"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["tel"])) {
?>
                <div class="required" style="padding-top: 3px; color: red;"><?php echo $error["tel"]; ?></div>
<?php
}
?>
              </td>
            </tr>

            <tr>
              <th align="left">メールアドレス <span class="required">（必須）</span></th>
              <td>
                <input name="mail" type="text" id="mail" value="<?php echo (isset($mail) ? $mail : ""); ?>" size="50" maxlength="80" class="formsize2" <?php if (isset($error["mail"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["mail"])) {
?>
<div class="required" style="padding-top: 3px; color: red;"><?php echo $error["mail"]; ?></div>
<?php
}
?>
              </td>
            </tr>

            <tr>
              <th align="left">ご検討中のセンター（任意）</th>
              <td>
                <select name="think_about">
<option value="">選択してください</option>
<?php
//echo (isset($think_about) ? $think_about : "");
$ta_ary = [
'南青山',
'青山セントラル',
'乃木坂',
'赤坂ビジネスプレイス',
'赤坂見附',
'溜池山王',
'麻布十番',
'日本橋箱崎',
'日本橋セントラル',
'渋谷TOC',
'渋谷hills',
'渋谷神南',
'大崎駅西口',
'五反田駅西口',
'西新宿駅前',
'池袋',
'神保町',
'西新橋',
'大門駅前',
'立川駅南',
'札幌南',
'仙台青葉通',
'仙台駅前',
'横浜金港町',
'本厚木駅前',
'大宮駅西口',
'水戸',
'新潟',
'名古屋丸の内',
'名古屋伏見',
'名駅南',
'刈谷',
'豊田',
'京都烏丸',
'京都河原町御池',
'御堂筋',
'新大阪北',
'京阪淀屋橋',
'大阪平野町',
'大阪肥後橋',
'神戸三宮南',
'広島大手町',
'高松',
'博多駅前通り',
'小倉',
'大分',
'熊本銀座通り'
];

foreach ($ta_ary as $ta) {
  $selected = (!empty($think_about) && $ta == $think_about) ? ' selected' : '';
  echo '<option value="' . $ta . '"' . $selected . '>' . $ta . '</option>' . PHP_EOL;
}
?>
                </select>
              </td>
            </tr>

            <tr>
              <th align="left">見学予約を希望する</th>
              <td><input type="checkbox" name="visit" value="yes"<?php echo (!empty($visit) && $visit == 'yes') ? ' checked' : ''; ?>> する</td>
            </tr>

          </table>

          <input name="requestID" type="hidden" id="requestID" value="<?php echo $_SESSION["requestID"]; ?>">
          <input name="office" type="hidden" id="office" value="<?php echo(isset($office)?$office:""); ?>">
          <input name="floor" type="hidden" id="floor" value="<?php echo(isset($floor)?$floor:""); ?>">
          <input name="room" type="hidden" id="room" value="<?php echo(isset($room)?$room:""); ?>">
          <input type="hidden" name="recaptchaResponse" id="recaptchaResponse"><?php //google Recapcha V3?>
          <p class="form-submit"><input id="submit_button" type="submit" value="送信"></p>

        </form>

      </div>

    </div>
  </div>

  <footer>
    <p>東京・大阪をはじめ全国でサービス拠点を展開。<br>個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
    <small>Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</small>
  </footer>

<?php include("../ssi/accesslogger.html"); ?>
</div>
<?php include("../ssi/footertag.html"); ?>
</div>
</body>
</html>
