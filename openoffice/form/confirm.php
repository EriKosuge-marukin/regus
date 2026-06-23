<?php
include_once(dirname(__FILE__) . "/include/config.ini.php");

if (empty($_SESSION["requestID"]) || empty($_SESSION["formData"])) {
  header("Location: form.php");
  exit;
}

$data = unserialize($_SESSION["formData"]);

if (
  empty($data["requestID"]) || $_SESSION["requestID"] != $data["requestID"] ||
  empty($data["name"]) ||
  empty($data["tel"]) ||
  empty($data["mail"])
) {
  header("Location: form.php");
  exit;
}

if (!empty($_POST)) {
  if ($mode == "back") {
    $data["mode"] = $mode;
    $_SESSION["formData"] = serialize($data);
    header("Location: form.php");
    exit;
  }

  if ($mode == "send") {

    // 自動返信 /////////////////////////////////////////////
    $subject = "【Openoffice】問い合わせ・見学予約";

    $message = "
" . $data["name"] . "様

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
[会社名(団体名)：Company]
[担当者名： Name]" . $data["name"] . "
[電話番号： Telephone]" . $data["tel"] . "
[携帯電話： mobile phone]
[Eメール：E-mail] " . $data["mail"] . "
ご検討中のセンター（任意）" . $data['think_about'] . "
見学予約： " . ((!empty($data["visit"]) && $data["visit"] == "yes") ? "する" : "しない") . "

--------------------------------------------------------
※お申込みの見学会日程についてはご希望に添えない場合がござい
ます。ご了承下さい。


-----------------------------------------------
オープンオフィス 株式会社
オフィス案内担当　enquiry@openoffice.co.jp

〒107-0062　港区南青山2-2-8 DFビル5Ｆ
TEL 0120-974-685
-----------------------------------------------";


    // 管理者宛 /////////////////////////////////////////////
    $subject_admin = "【Openoffice】問い合わせ・見学予約";

    $message_admin = "Source Major: Marketing Activity

Source Minor: Internet-Openoffice

Source Detail: Regus-Openoffice.jp

" . $data["name"] . "様

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
[会社名(団体名)：Company]
[担当者名： Name]" . $data["name"] . "
[電話番号： Telephone]" . $data["tel"] . "
[携帯電話： mobile phone]
[Eメール：E-mail] " . $data["mail"] . "
ご検討中のセンター（任意）" . $data['think_about'] . "
見学予約： " . ((!empty($data["visit"]) && $data["visit"] == "yes") ? "する" : "しない") . "

--------------------------------------------------------
※お申込みの見学会日程についてはご希望に添えない場合がござい
ます。ご了承下さい。


-----------------------------------------------
オープンオフィス 株式会社
オフィス案内担当　enquiry@openoffice.co.jp

〒107-0062　港区南青山2-2-8 DFビル5Ｆ
TEL 0120-974-685
-----------------------------------------------
問い合わせフォームリンク元ページ：" .  $pre_page_val;


    $to = $data["mail"];
    $from = 'From: ' . mb_encode_mimeheader(mb_convert_encoding('オープンオフィス ', "ISO-2022-JP", "AUTO")) . '<enquiry@openoffice.co.jp>' . "\r\n";
    $from .= 'Return-Path: enquiry@openoffice.co.jp' . "\r\n";
//$from .= 'Bcc: relay@regus-office.jp'; //←※本番用設定

    //$from .= 'Bcc: Akihiro.koseki@regus.com,Kyoko.yagi@regus.com,Masaki.takahashi@regus.com,Yosuke.suzuki@regus.com,Kei.nakamura@regus.com,Maki.takeda@regus.com,Kazuya.moue@regus.com,Satomi.kawasaki@regus.com,Masayuki.Uwabo@regus.com,yoshifumi_ohtani@marukin-ad.co.jp,Tomomi.akiyama@regus.com,ISTJP@RegusGroupServices.onmicrosoft.com,tam@lc93.jp';

    mb_language("japanese");
    mb_internal_encoding("SJIS");

    $mail_result = mb_send_mail($to, $subject, $message, $from);

	$to_admin = 'relay@regus-office.jp';//本番アドレス
    //$to_admin = 'isi@lc93.jp';
    //$to_admin = 'tamura93@gmail.com';
    //$to_admin .= 'yoshifumi_ohtani@marukin-ad.co.jp';

    $mail_result &= mb_send_mail($to_admin, $subject_admin, $message_admin, $from);

    session_destroy();

    header("Location: thanks.php" . ($mail_result ? "" : "?err=1"));
    exit;
  }
}

extract($data);

?><!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
<?php include("../ssi/headtagmanager.html"); ?>
<meta http-equiv="Content-Type" content="text/html; charset=Shift_JIS">
<title>問い合わせ・見学予約｜レンタルオフィス（個室）ならオープンオフィス</title>
<meta name="description" content="問い合わせ・見学予約。オープンオフィスのレンタルオフィスは【入会金なし】【24時間利用】【完全個室】会議室併設で全国50拠点以上に展開。レンタルオフィスならオープンオフィス。">
<meta name="keywords" content="問い合わせ・見学予約,レンタルオフィス,東京,大阪,個室,オープンオフィス">

<link rel="shortcut icon" href="/openoffice/favicon.ico">
<script type="text/javascript" charset="utf-8" src="/openoffice/script/opo-allpage.js"></script>
<script type="text/javascript" charset="utf-8" src="/openoffice/script/tlib.1.18.core.min.js"></script>
<script type="text/javascript" charset="utf-8" src="./script/officeform.js"></script>
<link href="css/officeform.css" rel="stylesheet" type="text/css">
<link href="/openoffice/css/style.css" rel="stylesheet" type="text/css">
<?php include("../ssi/js.html"); ?>
<base target="_top">
<meta name="google-site-verification" content="aQyLxq1Kvlt4I80QsZ7plYTf7THuiZn9bjX76BBAn_0">
</head>

<body>
<?php include("../ssi/bodygoogle.html"); ?>
<div id="OPO_body_Fm">
  <div id="OPO_header_Fm">
    <div id="OPO_header_title_Fm">
      <div id="OPO_header_toplink"><p>問い合わせ・見学予約｜個室のレンタルオフィスならOpenoffice：東京・大阪をはじめ全国に50拠点以上</p></div>
      <p id="OPO_header_openoffice" style="margin:11px 0 0 11px;">
        <a href="https://www.regus-office.jp/openoffice/"><img src="/openoffice/images/ind_head01.png" width="187" height="42" alt="REGUS"></a>
      </p>
    </div>
  </div><!--header-->
  <div id="OPO_main_Fm">
   <h1 class="contactH1">空室・金額確認</h1>
    <div class="content_outer">
      <div class="subblock_Fm">

        <form name="form1" method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
          <br>
          <h3>お問い合わせの内容をご記入ください</h3>

          <table class="form1 mgT20">

            <tr>
              <th align="left">担当者名 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="name" value="<?php echo $name; ?>" class="formsize1" disabled="disabled">
              </td>
            </tr>

            <tr>
              <th align="left">電話番号 <span class="required">（必須）</span></th>
              <td>
                <input type="text" size="50" maxlength="50" name="tel" value="<?php echo $tel; ?>" class="formsize2" disabled="disabled">
              </td>
            </tr>

            <tr>
              <th align="left">メールアドレス <span class="required">（必須）</span></th>
              <td>
                <input name="mail" type="text" id="mail" value="<?php echo $mail; ?>" size="50" maxlength="80" class="formsize2" disabled="disabled">
              </td>
            </tr>

            <tr>
              <th align="left">ご検討中のセンター（任意）</th>
              <td>
                <input type="text" size="50" maxlength="50" name="think_about" value="<?php echo $think_about; ?>" class="formsize1" disabled="disabled">
              </td>
            </tr>

            <tr>
              <th align="left">見学予約を希望する</th>
              <td>
                <?php echo (!empty($visit) && ($visit == "yes")) ? "する" : "しない"; ?>
              </td>
            </tr>

          </table>

          <input name="requestID" type="hidden" id="requestID" value="<?php echo $_SESSION["requestID"]; ?>">
          <input name="mode" type="hidden" id="mode" value="">
          <input name="pre_page_val" type="hidden" id="pre_page_val" value="<?php echo isset($pre_page_val) ? $pre_page_val : $_SERVER['HTTP_REFERER']; ?>">
          <p class="form-submit">
            <input id="back_button" type="submit" value="戻る" onclick="document.getElementById('mode').value='back'"/>
            <input id="submit_button" type="submit" value="送信" onclick="document.getElementById('mode').value='send'"/>
          </p>

        </form>

      </div>
    </div>
  </div>
  <div id="OPO_footer">
    <p class="footerTxt">東京・大阪をはじめ全国でサービス拠点を展開。個室のレンタルオフィスをお探しならオープンオフィスにお任せください。</p>
    <div id="OPO_copyright" class="OPO-block">Copyright  (C)  Openoffice : Regus  Group Companies . All Rights Reserved.</div>
  </div>
  <?php include("../ssi/accesslogger.html"); ?>
</div>
<?php include("../ssi/footertag.html"); ?>
</body>
</html>
