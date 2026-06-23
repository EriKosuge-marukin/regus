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
    //Google reCapcha V3の判定OK場合には送信処理へ進む
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
<?php include("../ssi/headtagmanager.html");?>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>空室・金額確認｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="空室・金額確認。オープンオフィスのレンタルオフィスは【入会金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="空室・金額確認,レンタルオフィス,東京,大阪,個室,オープンオフィス">
<link rel="shortcut icon" href="/openoffice/favicon.ico">
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
    <h1 class="contactH1">空室・金額確認</h1>
    <div class="lead">
      <h3>空室・金額確認を希望するセンターをご記入ください</h3>
      <p>お問い合わせいただきましたら、専門スタッフより、<span>すぐにメール、もしくはお電話にて対応させていただきます。</span></p>
    </div>
    <div class="content_outer">
      <div class="subblock_Fm">

        <form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"];?> ">

          <table class="form1 mgT20">

            <tr>
              <th align="left">担当者名 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="name" placeholder="山田 太郎" value="<?php echo (isset($name) ? $name : ""); ?>" class="formsize1" <?php if (isset($error["name"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["name"])) {
?>
                <div class="required" style="padding-top: 3px;"><?php echo $error["name"]; ?></div>
<?php
}
?>
              </td>
            </tr>

            <tr>
              <th align="left">電話番号 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="tel" placeholder="0312345678" value="<?php echo (isset($tel) ? $tel : ""); ?>" class="formsize2" <?php if (isset($error["tel"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["tel"])) {
?>
                <div class="required" style="padding-top: 3px;"><?php echo $error["tel"]; ?></div>
<?php
}
?>
                <p class="noteTel">※お電話番号の入力間違いにご注意ください。</p>
              </td>
            </tr>

            <tr><th align="left">メールアドレス <span class="required">（必須）</span></th>
              <td>
                <input name="mail" type="text" id="mail" placeholder="sample@sample.jp" value="<?php echo (isset($mail) ? $mail : ""); ?>" size="50" maxlength="80" class="formsize1" <?php if (isset($error["mail"])) { ?>style="background-color: #FFDDDD"<?php } ?>>
<?php
if (isset($error["mail"])) {
?>
                <div class="required" style="padding-top: 3px;"><?php echo $error["mail"]; ?></div>
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
          <input name="office" type="hidden" id="office" value="<?php echo (isset($office) ? $office : ""); ?>">
          <input name="floor" type="hidden" id="floor" value="<?php echo (isset($floor) ? $floor : ""); ?>">
          <input name="room" type="hidden" id="room" value="<?php echo (isset($room) ? $room:""); ?>">
          <input type="hidden" name="recaptchaResponse" id="recaptchaResponse"><?php //google Recapcha V3?>
          <p class="form-submit"><input id="submit_button" type="submit" value="送信"></p>

        </form>

      </div>
    </div>
  </div>

  <div id="OPO_footer">
    <p class="footerTxt">東京・大阪をはじめ全国でサービス拠点を展開。個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
    <div id="OPO_copyright" class="OPO-block">Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</div>
  </div>

<?php include("../ssi/accesslogger.html");?>
</div>
<?php include("../ssi/footertag.html");?>
</div>
</body>
</html>
