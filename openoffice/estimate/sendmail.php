<?php
/***************************************************************************/
/* 文面向けのデータについて
 *
 * フォーム(ユーザー情報及びお見積り情報)に入力された値は、
 * $mail_dataに格納されています。
 * 以下、データのリストとなります。
 *
 * 【お見積り】
 * $mail_data['fir_security']['pri'] ⇒ 保証金
 * $mail_data['fir_admission']['pri'] ⇒ 入会金
 * $mail_data['mon_price']['pri'] ⇒ ご利用料
 * $mail_data['mon_public']['pri'] ⇒ 共益費
 * $mail_data['other']['exit_pri'] ⇒ 退去料
 * $mail_data['fir_op_door_price']['pri'] ⇒ ドア付き社名プレート(値段)
 * $mail_data['fir_op_key_price']['pri'] ⇒ 鍵(値段)
 * $mail_data['fir_op_key_price']['cnt'] ⇒ 鍵(個数)
 * $mail_data['fir_op_build_price']['pri'] ⇒ ビル用セキュリティカード(値段)
 * $mail_data['fir_op_build_price']['cnt'] ⇒ ビル用セキュリティカード(枚数)
 * $mail_data['fir_op_security_price']['pri'] ⇒ セキュリティカード(値段)
 * $mail_data['fir_op_security_price']['cnt'] ⇒ セキュリティカード(枚数)
 * $mail_data['mon_op_rental_price']['pri'] ⇒ レンタル家具(値段)
 * $mail_data['mon_op_rental_price']['cnt'] ⇒ レンタル家具(個数)
 * $mail_data['fir_op_tel_price']['pri'] ⇒ 電話(初期費用)(値段)
 * $mail_data['mon_op_tel_price_mon']['pri'] ⇒ 電話(月額)(値段)
 * $mail_data['mon_op_tel_price_mon']['cnt'] ⇒ 電話(台数)
 * $mail_data['fir_op_fax_price']['pri'] ⇒ FAX(初期費用)(値段)
 * $mail_data['mon_op_fax_price_mon']['pri'] ⇒ FAX(月額)(値段)
 * $mail_data['mon_op_fax_price_mon']['cnt'] ⇒ FAX(台数)
 * $mail_data['mon_op_answer_price']['pri'] ⇒ 電話対応(値段)
 * $mail_data['fir_op_board_price']['pri'] ⇒ 共用部社名看板(作成費)(値段)
 * $mail_data['mon_op_board_price_mon']['pri'] ⇒ 共用部社名看板(月額掲載料)(値段)
 * $mail_data['mon_op_locker_price']['pri'] ⇒ 貸しロッカー(値段)
 * $mail_data['other']['start_date'] ⇒ 利用開始年月日
 * $mail_data['other']['use_month'] ⇒ 利用期間(整数のみ)
 * $mail_data['fir_total']['pri'] ⇒ 初期費用小計
 * $mail_data['mon_total']['pri'] ⇒ 毎月の費用小計
 * $mail_data['other']['total_first'] ⇒ 契約月の費用
 * $mail_data['other']['total_after'] ⇒ 2ヶ月目以降の費用
 *
 *
 * 【ユーザー情報】
 * $mail_data['fr_comp_name'] ⇒ 社名
 * $mail_data['fr_resp_name'] ⇒ 担当者名
 * $mail_data['fr_mail'] ⇒ メールアドレス
 * $mail_data['fr_tel'] ⇒ 電話番号
 * $mail_data['fr_address'][0] ⇒ 住所：郵便番号
 * $mail_data['fr_address'][1] ⇒ 住所：都道府県
 * $mail_data['fr_address'][2] ⇒ 住所：市区町村・番地
 * $mail_data['fr_address'][3] ⇒ 住所：アパート・建物名
 * $mail_data['fr_opinion'] ⇒ ご質問等
 */
/***************************************************************************/

include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);

$data = $dbClass->SelectOne("SELECT center_id, num FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_REQUEST['c_id'], 'o_id'=>$_REQUEST['o_id']));
$option = $dbClass->SelectOne("SELECT name FROM m_center WHERE center_id = :c_id", array('c_id'=>$_REQUEST['c_id']));

mb_convert_variables('SJIS', 'UTF-8', $data);
mb_convert_variables('SJIS', 'UTF-8', $option);

$mail_data = $_POST;

$address = $mail_data['fr_address'][0].$mail_data['fr_address'][1].$mail_data['fr_address'][2].$mail_data['fr_address'][3];

// ユーザー向け文面
$message = "
{$mail_data['fr_comp_name']}
{$mail_data['fr_resp_name']}様

この度は、オフィスのご契約をお申し込み頂きまして、誠にありがとうございます。
本メールは、お客様と弊社との間の下記オフィス契約のお申し込み受け付けのご案内でございます。

【お会社名】
{$mail_data['fr_comp_name']}
【ご氏名】
{$mail_data['fr_resp_name']}
【ご契約開始日】
{$mail_data['start_date']}
【ご契約期間】
{$mail_data['use_month']}ヶ月
【センター】
{$option['name']}
【オフィス番号】
{$data['num']}
【オフィス利用料（月額）】
{$mail_data['mon_price']['pri']}円
【共益費（月額）】
{$mail_data['mon_public']['pri']}円

*この度お申し込み頂きましたオフィス契約は、弊社からの承諾メールをもって成立致します。また、ご契約をお断りする場合がございます事を予めご了承下さいませ。
*本メールアドレスは送信専用でございますため、ご返信頂くことができません。

本来でしたら、拝顔の上ご契約のお申し込みを頂きました御礼を申し上げるべきところ、甚だ略儀ではございますが、書中をもちまして御礼申し上げる次第でございます。

ご不明な点がございましたら、下記へご連絡下さいます様お願い申し上げます。

オープンオフィス株式会社
電話　0120-974-685　（お問い合わせ時間：平日8:30 - 18:00）


尚、弊社では、誠に勝手ながら年末年始の営業日は下記の日程とさせていただきます。
 
　　● 年末の営業日　　2015年12月28日（月）まで
　　● 年始の営業日　　2016年  １月 4日（月）より　
 
お客様には大変ご迷惑をお掛け致しますが、何卒ご理解いただきます様お願い申し上げます。
本年中のご愛顧に心より御礼申し上げますと共に、2016年も変わらぬ お引き立てのほど
宜しくお願い申し上げます。

**********************************************************************
The information in this email is confidential and may be privileged.
If you are not the intended recipient, please destroy this message
and notify the sender immediately.
Regus PLC, 26, Boulevard Royal, L-2449 Luxembourg
**********************************************************************

";


// 管理者向け文面
$message_ad = "
NOTE TO BUSINESS CENTERS: IF YOU HAVE AN SSC IN YOUR REGION (AMERICAS, UK & EMEA), YOUR SSC WILL FOLLOW UP ON THIS INQUIRY, AND YOU SHOULD NOT ACTION IT UNLESS SPECIFICALLY TOLD OTHERWISE.

The following inquiry has been made by a {culture} user - the page they came from was https://www.regus-openoffice.jp

Source Major: Marketing Activity
Source Minor: Internet  OpenOffice
Source Detail:   : Japan

Company: {$mail_data['fr_comp_name']}

Name: {$mail_data['fr_resp_name']}

E-mail: {$mail_data['fr_mail']}

Phone: {$mail_data['fr_tel']}

Address：{$address}

Message：{$mail_data['fr_opinion']}

deposit：{$mail_data['fir_admission']['pri']}

Admission fee：{$mail_data['fir_security']['pri']}

Phone（Initian）：{$mail_data['fir_op_tel_price']['pri']}

Fax（Initian）：{$mail_data['fir_op_fax_price']['pri']}

Name Plate：{$mail_data['fir_op_door_price']['pri']}

Common Name Plate：{$mail_data['fir_op_board_price']['pri']}

Key：{$mail_data['fir_op_key_price']['pri']}

Key（quantity）：{$mail_data['fir_op_key_price']['cnt']}

Security card：{$mail_data['fir_op_security_price']['pri']}

Security card（quantity）：{$mail_data['fir_op_security_price']['cnt']}

Security card（Building）：{$mail_data['fir_op_build_price']['pri']}

Security card（Building）（quantity）：{$mail_data['fir_op_build_price']['cnt']}

Usage fee：{$mail_data['mon_price']['pri']}

Common service fee：{$mail_data['mon_public']['pri']}

Rental furniture：{$mail_data['mon_op_rental_price']['pri']}

Rental furniture（quantity）：{$mail_data['mon_op_rental_price']['cnt']}

Phone (Monthly)：{$mail_data['mon_op_tel_price_mon']['pri']}

Phone (Monthly)（quantity）：{$mail_data['mon_op_tel_price_mon']['cnt']}

Fax (Monthly)：{$mail_data['mon_op_fax_price_mon']['pri']}

Fax (Monthly)（quantity）：{$mail_data['mon_op_fax_price_mon']['cnt']}

Telephone support：{$mail_data['mon_op_answer_price']['pri']}

Common Name Plate (Monthly)：{$mail_data['mon_op_board_price_mon']['pri']}

locker：{$mail_data['mon_op_locker_price']['pri']}

Departure fee：{$mail_data['fir_total']['pri']}

URLパラメータ:

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

";


// ユーザー向け送信情報
$to = $mail_data['fr_mail'];
$subject = '【オープンオフィス】ご契約お申し込み受付完了';
$from = 'From: info@openoffice.co.jp'."\r\n";
$from .= 'Return-Path: info@openoffice.co.jp';

// 管理者向け送信情報
$to_ad = 'ISTJP@RegusGroupServices.onmicrosoft.com,APAC.MarketingJP@regus.com,info.asia@regus.com,info@openoffice.co.jp,Info.Japan@regus.com,Satomi.Kawasaki@regus.com,Masayuki.Uwabo@regus.com';
$subject_ad = 'Open-Office_Online _Purchase';
$from_ad = 'From: info@openoffice.co.jp'."\r\n";
$from_ad .= 'Return-Path: info@openoffice.co.jp';

mb_language("japanese");
mb_internal_encoding("SJIS");

$mail_result = mb_send_mail($to, $subject, $message, $from);
$mail_result_ad = mb_send_mail($to_ad, $subject_ad, $message_ad, $from_ad);

if($mail_result) {
	header("Location: thanks.php?c_id=".$data['center_id']."&o_id=".$data['num']);
	exit;
} else {
	header("Location: thanks.php");
	exit;
}
?>