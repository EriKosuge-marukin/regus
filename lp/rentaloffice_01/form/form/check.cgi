#!/usr/bin/perl516

require 'config.cgi';

$config{"url"} =~ s/check\.cgi//g;

$error_flag = 0;
@sendmails = ('/lib/sendmail','/usr/bin/sendmail','/usr/sbin/sendmail','/usr/lib/sendmail','/usr/local/sbin/sendmail','/usr/local/lib/sendmail');
$hit = `find \`perl -e 'print "@INC"'\` -name 'Jcode.pm' -print`;
if($hit eq $null && !(-f 'Jcode.pm')){
	$error = <<'	__error_body__';
			<dt>【致命的】Jcodeがたぶんインストールされていません</dt>
			<dd>
				日本語文字コード変換モジュール「Jcode」がインストールされていません。
				<a href="http://search.cpan.org/" target="_blank">CPAN</a>から「Jcode」で検索するとJcodeが出てくると思うので、クリックして右側にあるDownloadからダウンロードしてください。
				圧縮形式が.tar.gzというタイプの圧縮ファイルのため、<a href="http://www.vector.co.jp/soft/win95/util/se166893.html" target="_blank">Lhaca</a>などの解凍ソフトで解凍してね。
				で、解凍するとゴチャゴチャファイルがあるんですが「Jcode.pm」と「Jcodeフォルダ」をsend.cgiと同じ階層にアップすればOKです。
			</dd>
	__error_body__
	$error_message .= $error;
}
@stat = stat 'send.cgi';
$permission = substr((sprintf "%03o", $stat[2]), -3);
if($permission ne '755'){
	$error = <<'	__error_body__';
			<dt>【警告】send.cgiのパーミッションが755ではありません。</dt>
			<dd>
				send.cgiのパーミッションが755ではありません。ただ、サーバの種類によっては必ずしも755がCGIの実行権限とは限らないので、よくわからない場合はサーバ会社に聞いてみてください。
				FFFTPでパーミッションを変更するには、send.cgiを右クリックして「属性変更」から755にしてください。
			</dd>
	__error_body__
	$error_message .= $error;
}
@stat = stat $config{"log_file"};
$permission = substr((sprintf "%03o", $stat[2]), -3);
if($permission ne '777' && -f $config{"log_file"}){
	$error = <<"	__error_body__";
			<dt>【注意】ログファイル「$config{'log_file'}」のパーミッションが777ではありません</dt>
			<dd>
				サーバの種類によってはログに追記できない可能性があります。この注意が出てても基本的には動きます。
			</dd>
	__error_body__
	$error_message .= $error;
}
@stat = stat $config{"serial_file"};
$permission = substr((sprintf "%03o", $stat[2]), -3);
if($permission ne '777'){
	$error = <<"	__error_body__";
			<dt>【注意】通し番号用ファイル「$config{'serial_file'}」のパーミッションが777ではありません</dt>
			<dd>
				サーバの種類によってはログを更新できない可能性があります。この注意が出てても基本的には動きます。
			</dd>
	__error_body__
	$error_message .= $error;
}
@stat = stat $config{"input_time_file"};
$permission = substr((sprintf "%03o", $stat[2]), -3);
if($permission ne '777'){
	$error = <<"	__error_body__";
			<dt>【注意】入力平均時間記録用ファイル「$config{'input_time_file'}」のパーミッションが777ではありません</dt>
			<dd>
				サーバの種類によってはログを更新できない可能性があります。この注意が出てても基本的には動きます。
			</dd>
	__error_body__
	$error_message .= $error;
}
@stat = stat $config{"conversion_file"};
$permission = substr((sprintf "%03o", $stat[2]), -3);
if($permission ne '777'){
	$error = <<"	__error_body__";
			<dt>【注意】ユニークユーザ数保存ファイル「$config{'conversion_file'}」のパーミッションが777ではありません</dt>
			<dd>
				サーバの種類によってはログを更新できない可能性があります。この注意が出てても基本的には動きます。
			</dd>
	__error_body__
	$error_message .= $error;
}
if(@mailto < 1){
	$error = <<'	__error_body__';
			<dt>【致命的】mailtoが設定されていません</dt>
			<dd>
				設置者に届くメールアドレスですね。config.cgiの中の19行目くらいにある@mailtoというくだりなんですが、そこにメールアドレスを設定してください。
				ひとつだけ設定する場合は<input type="text" value="@mailto = ('xxxxx@example.jp');" style="width: 200px;" />というカンジで複数設置する場合は<input type="text" value="@mailto = ('xxxxx@example.jp','yyyyy@example.jp');" style="width: 320px;" />というようにシングルクォーテーション（'）でくくられたメールアドレスをカンマ（,）で区切って入力してね。
			</dd>
	__error_body__
	$error_message .= $error;
}
if($config{"log_file"} eq $null){
	$error = <<'	__error_body__';
			<dt>【確認】ログファイルの書き出しは有効になっていません</dt>
			<dd>
				送信履歴をCSVファイルとして保存する機能は有効になっていません。ただ、この機能はサーバ上に個人情報を保管するというリスクがあるため、リスク管理はしっかりと。
				ファイル名の拡張子を.datや.csvとしている場合、http経由での保護をhtaccessなどで掛けない限り情報漏洩の危険に晒される事になります。
				サーバがhtaccessの許可をしているサーバであれば同梱の「htaccess.txt」を「.htaccess」としてアップロードして特定拡張子へのhttp経由でのファイルへのアクセスを防ぐこともできます。
			</dd>
	__error_body__
	$error_message .= $error;
}
elsif($config{"password"} eq $null){
	$error = <<'	__error_body__';
			<dt>【確認】ログファイルの書き出しは有効になっていません</dt>
			<dd>
				パスワードが入力されていないためログファイルの書き出しは有効になっていません。ログファイルへの書き出しを有効にする場合はパスワードを設定してください。
				ただ、この機能はサーバ上に個人情報を保管するというリスクがあるため、リスク管理はしっかりと。
				ファイル名の拡張子を.datや.csvとしている場合、http経由での保護をhtaccessなどで掛けない限り情報漏洩の危険に晒される事になります。
				サーバがhtaccessの許可をしているサーバであれば同梱の「htaccess.txt」を「.htaccess」としてアップロードして特定拡張子へのhttp経由でのファイルへのアクセスを防ぐこともできます。
			</dd>
	__error_body__
	$error_message .= $error;
}
else {
	$error = <<"	__error_body__";
			<dt>【警告】ログファイルのセキュリティを確認してください</dt>
			<dd>
				ログファイルへの送信履歴の書き出しが有効になっています。http経由でアクセスできる場合があるため、アクセスできるかどうかを確認してください。
				<a href="$config{'url'}$config{'log_file'}">ここをクリック</a>してログファイルが見える又はダウンロードできた場合、セキュリティ上かなり危険です。ホントヤバいです。
				拡張子をcgiに変更するか、拡張子を.datや.csvとしている場合、http経由での保護をhtaccessなどで掛けない限り情報漏洩の危険に晒される事になります。
				サーバがhtaccessの許可をしているサーバであれば同梱の「htaccess.txt」を「.htaccess」としてアップロードして特定拡張子へのhttp経由でのファイルへのアクセスを防ぐこともできます。
			</dd>
	__error_body__
	$error_message .= $error;
}
if($config{"thanks_url"} eq 'http://cgi.synck.com/mailform/pro2.0.9/thanks.html'){
	$error = <<'	__error_body__';
			<dt>【致命的】サンクスページが標準状態デスヨッ！！</dt>
			<dd>
				サンクスページが標準の状態デス。ぜひあなたが作った美麗なサンクスページのURLを書けばいいじゃない。
				極力httpから書いたほうがいいです。
			</dd>
	__error_body__
	$error_message .= $error;
}



$form_enabled = "display: block;";
for($cnt=0;$cnt<@sendmails;$cnt++){
	if(-f $sendmails[$cnt]){
		$sendmail = $sendmails[$cnt];
	}
}
if($config{"sendmail"} ne $sendmail && $sendmail ne $null){
	$error = <<"	__error_body__";
			<dt>【警告】sendmailのパスが多分ちがうよっ！</dt>
			<dd>
				このサーバのsendmailのパスはたぶんだけど<input type="text" value="${sendmail}" style="width: 150px;" />こうっ！！馬鹿っ！<br />
				※基本的にサーバ推奨のsendmailのパス書いてあればOKです。上記と食い違っててもOKです。
			</dd>
	__error_body__
	$error_message .= $error;
}
elsif($sendmail eq $null){
	$error = <<"	__error_body__";
			<dt>【確認】sendmailのパス検出に失敗・・・</dt>
			<dd>
				ごめん・・・。和田も頑張ったんだけどさ・・・。そう人生うまくいくもんじゃないよね・・・。探したよ！必死に！交差点でも 夢の中でも こんなとこにいるはずもないのに・・・。ということで、ホントごめん・・・。サーバ会社の人に聞いてみてくださいはい・・・。生まれてきてごめんなさい・・・。
			</dd>
	__error_body__
	$error_message .= $error;
}

## LF UTF
flock(FH, LOCK_EX);
	open(FH,'./config.cgi');
		@cgi = <FH>;
	close(FH);
flock(FH, LOCK_NB);
$cgi = join('',@cgi);
if(index($cgi,"\r") > -1){
	$error = <<"	__error_body__";
			<dt>【警告】config.cgiに改行コードCRが含まれているかも</dt>
			<dd>config.cgiに改行コードCRが含まれているかもしれません。TeraPadなどのテキストエディタでソースコード、改行コードを確認してください。</dd>
	__error_body__
	$error_message .= $error;
}

if($error_message ne $null){
	$error_message = "<dl id=\"error\">" . $error_message . "</dl>";
}
else {
	$error_message = '<p>問題ないんじゃない？</p>';
}
print "Pragma: no-cache\n";
print "Cache-Control: no-cache\n";
print "Content-type: text/html; charset=UTF-8\n\n";
$html = <<"__print_body__";
<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ja" lang="ja">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta http-equiv="Content-Script-Type" content="text/javascript" />
		<meta http-equiv="Content-Style-Type" content="text/css" />
		<title>Mailform Pro check 1.0</title>
		<meta name="revisit_after" content="7 days" />
		<meta name="robots" content="ALL" />
		<meta http-equiv="pragma" content="no-cache" />
		<style type="text/css">
			* {
				padding: 0px;
				margin: 0px;
			}
			p {
				font-size: 12px;
				line-height: 1.5em;
				font-family: "ＭＳ Ｐゴシック","Hiragino Kaku Gothic Pro W3","ヒラギノ角ゴ Pro W3","Osaka";
			}
			body {
				text-align: center;
			}
			div#wrapper {
				width: 800px;
				margin: 0px auto 0px auto;
			}
			div#inbox {
				padding: 10px;
				text-align: left;
			}
			dl#error {
				padding: 10px;
				border: solid 1px #FF0000;
				background-color: #FFEEEE;
			}
			dl#error dt {
				font-size: 14px;
				color: #FF0000;
			}
			dl#error dd {
				font-size: 12px;
				line-height: 1.5em;
				padding: 5px 10px 10px 5px;
			}
		</style>
	</head>
	<body>
		<div id="wrapper">
			<div id="inbox">
				<h1>Mailform Pro check 1.0.2</h1>
				<p>メールフォームプロ 2.1.3用のチェッカーです。各種モジュール等のチェックを行います。</p>
				${error_message}
			</div>
		</div>
	</body>
</html>
__print_body__
print $html;
exit;
