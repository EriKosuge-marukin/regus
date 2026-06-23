## 2009-03-31 mailform pro Ver.2.x.x config file

##UTF-8モード (0:通常 / 1:日本語以外対応)
$config{'utf8'} = 0;

##vCardを有効にする(0:無効 / 1:有効)
$config{"vCard"} = 0;

##スクリプトのURL / ※基本的にここは変更しなくてOKです
$config{"url"} = 'http://' . $ENV{'SERVER_NAME'} . $ENV{'SCRIPT_NAME'};

##リファラードメインチェック / ドメインチェックをしない場合は行頭に半角＃を入れてください
$config{"domain"} = $ENV{'HTTP_HOST'};

##全文英語のスパム候補を除外(0:除外 / 1:除外しない)
$config{"english_spam"} = 0;

##リンク系スパム候補を除外(0:除外 / 1:除外しない)
$config{"link_spam"} = 0;

##sendmailのパス
$config{"sendmail"} = '/usr/lib/sendmail';
##$config{"sendmail"} = '/usr/lib/sendmail';

##フォームからの送信先 設定したほうの先頭の#を削除してください
# ひとつの場合 
##@mailto = ('yoshifumi_ohtani@marukin-ad.co.jp','yamagishi@marukin-ad.co.jp');
##@mailto = ('info.asia@regus.com','yoshifumi_ohtani@marukin-ad.co.jp');
###@mailto = ('# 複数の場合 (シングルクォートでくくったメールアドレスをカンマで区切って指定);
##@mailto = ('ISTJP@RegusGroupServices.onmicrosoft.com','APAC.MarketingJP@regus.com','Info.Japan@regus.com','Satomi.Kawasaki@regus.com','Masayuki.Uwabo@regus.com','yoshifumi_ohtani@marukin-ad.co.jp');

@mailto = ('yamagishi@marukin-ad.co.jp');

##フォームからの差出人
##$config{"mailfrom"} = $mailto[0];
$config{"mailfrom"} = 'regus-team@marukin-ad.co.jp';


##フォームの差出人名
$config{"fromname"} = 'regus-team@marukin-ad.co.jp';

##サンクスページのURL(URLかsend.cgiから見た相対パス)
$config{"thanks_url"} = '../thanks.html';

##サンクスページに通し番号を渡す(1:ON / 0:OFF)
$config{"thanks_serial"} = 0;

##入力時間の平均時間をHTMLに表示する場合の書式
$config{"input_time_format"} = '<p>このフォームの入力にはおおよそ <strong><avg></strong> 程度掛かります。</p>';

##自動返信メールに通し番号を付けるかどうか(1:つける / 0:つけない)
$config{"return_subject_serial"} = 0;

##通し番号に日付を付けるかどうか(1:つける / 0:つけない)
$config{"return_subject_serial_date"} = 0;

##ログファイルのパス
#$config{"log_file"} = 'postlog.cgi';

##ログファイルのパスワード
#$config{"password"} = 'password';

##送信有効期限 ※有効期限を設定する場合はエラーページを用意して下さい。
##期限の書式は YYYY-MM-DD HH:MM:SS です。
##受付開始日時
#$config{"expires_break"} = '2009-01-22 06:21:00';
##受付終了日時
#$config{"expires"} = '2009-03-22 06:30:00';

##送信有効期限をHTMLに表示する場合の書式
$config{"expires_time_format"} = '<p class="expires">このフォームは <strong><expires></strong> で締め切りとさせて頂きます。</p>';
$config{"expires_time_timeout"} = '<p class="expires">このフォームの送信は <expires> で既に締め切りました。</p>';
$config{"expires_time_break"} = '<p class="expires">このフォームからのご応募は <expires> から開始いたします。</p>';

##送信数制限 ※送信数制限を設定する場合はエラーページを用意して下さい。
#$config{"limit"} = 10000;

##送信数制限をHTMLに表示する場合の書式
$config{"limit_format"} = '<p class="limit">残り応募数はあと <strong><limit></strong> 枠です。</p>';
$config{"limit_over"} = '<p class="limit"><strong>このフォームの応募数を超えました。</strong></p>';

##エラーページURL
#$config{"error_url"} = 'http://cgi.synck.com/mailform/pro2.0.0/error.html';

##設置者に届くメールの件名
$config{"subject"} = 'レンタルオフィスに関するお問い合わせ';

##設置者に届くメールの本文整形 / 自動生成の場合 NULL / 特殊整形文字 <resbody>:送信内容一式 / <date>:日付 / <serial>:通し番号 / <input_time>:入力秒
$config{"posted_body"} = <<'__posted_body__';

NOTE TO BUSINESS CENTERS: IF YOU HAVE AN SSC IN YOUR REGION (AMERICAS, UK & EMEA), YOUR SSC WILL FOLLOW UP ON THIS INQUIRY, AND YOU SHOULD NOT ACTION IT UNLESS SPECIFICALLY TOLD OTHERWISE. 

The following inquiry has been made by a {culture} user - the page they came from was https://www.regus-office.jp/lp/rentaloffice_02/eShareoffice/.

Source Major: Marketing Activity
Source Minor: Internet - SEM
Source Detail: <se> <pivcode> : Japan

Name: <お名前>

E-mail: <email>

Phone: <電話番号>

Service: <ご希望のサービス>

URLパラメータ: <urlparam>

Number of people: {howmanypeople}

Location of Interest: {locationOfInterest}

Question: {question}

How did you hear about Regus: {HDYH}



Cluster: {cluster}
ClusterPostcode: {clusterpostcode}

SEM: {utm_medium}
Referrer: {utm_source}
Keyword Ad Group: {utm_campaign}
Keyword: {utm_term}

UID: {UID}


__posted_body__

##送信者に届く自動返信メールの件名
$config{"return_subject"} = 'レンタルオフィスに関するお問い合わせ、ありがとうございました';

##送信者に届く自動返信メールの本文 / 特殊整形文字 <resbody>:送信内容一式 / <date>:日付 / <serial>:通し番号 / <input_time>:入力秒
$config{"return_body"} = <<'__return_body__';
<お名前> 様

この度はリージャスにお問い合わせいただき、誠にありがとうございます。

いただいたお問合せの内容、現在の見学予約状況を確認し、
オフィス案内担当よりご連絡をいたしますので、今しばらくお待ちください。


弊社リージャスは、国内・世界最大手のレンタルオフィス運営会社でございます。
現在、世界120ヶ国3,000拠点以上、国内では23都市105拠点にてレンタルオフィス事業を展開しております。

2016年には、「丸の内鉄鋼ビル」「関西国際空港」「JRJP博多」「大名古屋ビルヂング」など、
国内有数のランドマークビルに続々とリージャスビジネスセンターをオープンいたしました。

また、リージャスはフォーチュン500企業の半数から、個人起業家のお客様まで、
幅広い層のお客様にご利用いただいております。

以下に弊社が提供するサービスについてご紹介いたします。

●レンタルオフィス●
24時間365日アクセス可能な専用オフィスのご契約です。
・個室、セミプライベート、コワーキング（シェアオフィス）の様々な部屋タイプ
・豊富な拠点数と部屋タイプから、お客様のご予算やご要望に見合ったオフィスをご用意
・1名様から100名様単位まで、幅広い人数に対応可能
・ご予算に合わせてリージャスとオープンオフィスの2ブランドのご提案
・電話番号、インターネット回線込の料金設定
・バイリンガル受付秘書（オープンオフィスは除く）
・無料会議室のご利用が可能（一部センターは除く）
・御社の所在地として一流のビル住所がご利用可能
・一ヶ月から年単位まで、契約期間が柔軟に選択可能
・初期費用が大幅に削減可能（保証金2ヶ月分のみ）
・お客様同士の交流も盛んで新たなビジネスチャンスも生まれます。

●コワーキング（月5・10日間アクセス）●https://www.regus-office.jp/coworking-spaces/coworking_list/
月に必要な日数のみシェアオフィスがご利用できます。
・月間に必要な日数のみコワーキングオフィス（シェアオフィス）がご利用可能
・インターネット回線込の料金設定
・御社の所在地として一流のビル住所がご利用可能
・無料会議室のご利用が可能（一部センターは除く）
・初期費用は初月利用料のみ
・契約期間は月額単位で、長期契約が不要
・月額1万円台からのリーズナブルな料金設定

●バーチャルオフィス●https://www.regus-office.jp/service/virtualoffice/virtualoffice/
実際のオフィス拠点において、固定の住所や電話番号をご利用いただけるサービスです。
・月額料金7,900円から、信頼のあるビジネスビルの住所がご利用可能
・御社専用の電話番号をご用意（プランによって異なります。）
・バイリンガル受付秘書（オープンオフィスは除く）
・実際のレンタルオフィスを営業している拠点にてバーチャルオフィスを提供しておりますので、
対外的な印象はレンタルオフィスと変わりません。
・レンタルオフィスへのアップグレードも容易
・無料会議室のご利用が可能（プランによって異なります。一部センターは除く）
・追加料金で、必要時に実際のオフィスや会議室もご利用可能

●ビジネスワールド●
リージャスのビジネスセンターに併設されているWi-Fi・電源・カフェ完備のビジネスラウンジが、営業時間内いつでもご利用いただけるサービスです。
・一流ビルのリージャスのビジネスラウンジにて、仕事をすることができます。
・バーチャルオフィスと組み合わせてコストの削減も可能です。

●時間貸し会議室●https://www.regus-office.jp/service/meetingroom/meetingroom/
固定の契約がなくても、必要な日時にのみワンストップで会議室や小規模オフィスがご利用いただけます。
・2名様用面接オフィスから最大200名様用のセミナールームまで、
社内会議、面接、セミナー等に1時間単位でご利用いただける施設をご用意しております。


---------------------------------------------------------------------------------
まずはご説明およびご内覧のご希望は、
下記フォームからお気軽にご予約ください。
最寄りのセンターにてお客様に最適なオフィスを、所要時間約一時間でご案内いたします。
https://www.regus-office.jp/form/visit_mail

日本リージャスの会社案内は、
下記のデジタルパンフレットでご覧いただけます。
https://www.regus-office.jp/digibook/

お客様の実際のご利用事例をご紹介。
情報誌「@Regus」は以下のリンクからご覧いただけます。
https://www.regus-office.jp/at-regus/new/


その他、何かご不明な点がございましたらお気軽に下記連絡先へお尋ねください。

どうぞ宜しくお願いいたします。


日本リージャス 株式会社
オフィス案内担当
0120-965-412　/　03-5764-1240
〒160-0023
東京都新宿区西新宿三丁目7番1号
新宿パークタワーN30階
---------------------------------------------------------------------------------

─ご送信内容の確認───────────────────────────
受付番号：<serial>
<resbody>
────────────────────────────────────

__return_body__


##件名につける通し番号用ファイル
$config{"serial_file"} = 'serial.dat';

##入力時間の合計を記憶するファイル
$config{"input_time_file"} = 'time.dat';

##コンバージョンレート算出用ログファイル
$config{"conversion_file"} = 'unique.dat';

if($config{'utf8'}){
	use MIME::Base64;
	$config{'charset'} = 'UTF-8';
}
else {
	$config{'charset'} = 'ISO-2022-JP';
}
