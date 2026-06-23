<?php

$from = "h.shiraishi@marukin-ad.co.jp";
$fromName = "リージャスお問い合わせ";
$to       = array(
    "h.shiraishi@marukin-ad.co.jp",
    "yoshifumi_ohtani@marukin-ad.co.jp"
);

/*
$from = "Kazuki.Nishikawa@regus.com";
$fromName = "リージャスお問い合わせ";
$to       = array(
    "Kazuki.Nishikawa@regus.com",
    "Akihiro.koseki@regus.com",
    "Kaori.Ogawa@regus.com",
    "Kyoko.Yagi@regus.com",
    "Yosuke.Suzuki@regus.com",
    "Masaki.takahashi@regus.com",
);
*/
$adminSubject = "【内覧希望・お問い合わせ】がありました";

$bodyService = "";
foreach($_SESSION["service"] as $value){
    $bodyService .= $value . "\n";
}

$adminBody = <<<EOF
━━━━━━━━【内覧希望・お問い合わせ】━━━━━━━━

下記URLのフォームより内覧希望・お問い合わせを受け付けました。
http://www.regus-office.jp/form/visit_bizocean


[メールアドレス]
{$_SESSION["email"]}

[見学希望センター]
{$_SESSION["center"]}

[見学希望日]
{$_SESSION["month"]}月{$_SESSION["day"]}日{$_SESSION["hour"]}時{$_SESSION["minute"]}分

[ご興味のあるサービス]
{$bodyService}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;
