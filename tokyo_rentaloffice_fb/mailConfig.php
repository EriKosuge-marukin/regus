<?php
$from     = "yoshifumi_ohtani@marukin-ad.co.jp";
$fromName = "リージャスお問い合わせ";
$to       = array(
    "Hidehiko.Sakai@regus.com",
    "Masaki.Takahashi@regus.com",
    "Masayuki.Uwabo@regus.com",
    "Yuriko.KakoBatt@regus.com",
    "kaori.ogawa@regus.com",
    "Akihiro.Koseki@regus.com",
    "Kazuki.Nishikawa@regus.com",
    "Kyoko.Yagi@regus.com",
    "Yosuke.Suzuki@regus.com"
);


$adminSubject = "【内覧希望・お問い合わせ】がありました";
$adminBody = <<<EOF
━━━━━━━━【内覧希望・お問い合わせ】━━━━━━━━

下記URLのフォームより内覧希望・お問い合わせを受け付けました。
http://www.regus-office.jp/lp/tokyo_rentaloffice_fb/


[お名前]
{$_SESSION["name"]}

[メールアドレス]
{$_SESSION["email"]}

[電話番号]
{$_SESSION["tel"]}

━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━
EOF;
