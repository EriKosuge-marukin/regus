## 2009-08-07 mailform pro Ver.2.1.2 functions file

$about = 'メールフォームの関数用ファイル';

##モード設定 (0:デバッグ / 1:通常)
$config{"mode"} = 1;

##エラーコードの初期設定
$error{"code"} = 0;

##送信者を固定 (0:無効 / 1:固定) ジオシティーズの場合など
$config{'sender_fixed'} = 1;

##連続送信時間制限
$config{'seek'} = 0;

##シンプルメールヘッダ
#$config{'simple_header'} = 1;

## boundary
$config{'boundary'} = "------------boundary_" . time . "_" . $$;

##以下、初期設定項目の自動設定
@mailformENV = ('date','input_time','conversion_count','pv','unique','conversion_rate','http_referer','sitein_referrer','host_name','ip_add','user_agent');
@mailformENVname = ('POST DATE','INPUT TIME','CONVERSION','PAGE VIEW','UNIQUE USERS','CONVERSION RATE','REFERRER','SITE IN REFERRER','HOST NAME','IP ADDRESS','USER AGENT');

($sec,$min,$hour,$day,$mon,$year) = localtime(time);$mon++;$year += 1900;
$form{"date"} = sprintf("%04d-%02d-%02d %02d:%02d:%02d",$year,$mon,$day,$hour,$min,$sec);
$download_file_name = sprintf("%04d-%02d-%02d.csv",$year,$mon,$day,$hour,$min,$sec);

#@construct_utf = ("\xef\xbc\x8d","\xE3\x80\x9C");
@construct_utf = ("－","～");
@construct_jis = ("\x1b\x24B\x21\x5d\x1b\x28J","\x1b\x24B\x21A\x1b\x28J");
@construct_sjis = ("\x81\x7c","\x81\x60");

sub _LOAD {
	my($path) = @_;
	my(@loader) = ();
	flock(FH, LOCK_EX);
		open(FH,$path);
			@loader = <FH>;
		close(FH);
	flock(FH, LOCK_NB);
	$loader = join('',@loader);
	$loader =~ s/\r//ig;
	return $loader;
}

sub mfp_LoadLine {
	my($path) = @_;
	chmod 0777, $path;
	flock(FH, LOCK_EX);
		open(FH,$path);
			$str = <FH>;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, $path;
	return $str;
}
sub mfp_SaveLine {
	my($path,$str) = @_;
	chmod 0777, "${path}";
	flock(FH, LOCK_EX);
		open(FH,">${path}");
			print FH $str;
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, "${save}";
}
sub mfp_SaveAddLine {
	my($path,$str) = @_;
	chmod 0777, "${path}";
	flock(FH, LOCK_EX);
		open(FH,">>${path}");
			print FH $str . "\n";
		close(FH);
	flock(FH, LOCK_NB);
	chmod 0600, "${save}";
}
sub encodeJIS {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/$construct_utf[$cnt]/<\_hotfix${cnt}\_>/g;
	}
	Jcode::convert(\$str,'jis');
	$str = &charhotfix_unescape_jis($str);
	return $str;
}
sub encodeSJIS {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/$construct_utf[$cnt]/<\_hotfix${cnt}\_>/g;
	}
	Jcode::convert(\$str,'sjis');
	$str = &charhotfix_unescape_sjis($str);
	return $str;
}
sub charhotfix_unescape_jis {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/<\_hotfix${cnt}\_>/$construct_jis[$cnt]/g;
	}
	return $str;
}
sub charhotfix_unescape_sjis {
	my($str) = @_;
	for(my $cnt=0;$cnt<@construct_utf;$cnt++){
		$str =~ s/<\_hotfix${cnt}\_>/$construct_sjis[$cnt]/g;
	}
	return $str;
}

sub envMailform {
	$form{'pv'} = $getCookieData{"pv"};
	$form{'unique'} = &mfp_LoadLine($config{"conversion_file"});
	&mfp_SaveLine($config{"input_time_file"},&mfp_LoadLine($config{"input_time_file"}) + $form{'input_time'});
	if($form{'unique'} eq $null || $form{'unique'} < 1){
		$form{'unique'} = 1;
	}
	$form{'conversion_rate'} = $form{'conversion_count'} / $form{'unique'} * 100;
	$form{'conversion_rate'} = round($form{'conversion_rate'}, 3) . '%';
	
	$form{'conversion_count'} = $form{'conversion_count'} . " conversions";
	$form{'unique'} = $form{'unique'} . " users";
	$form{'pv'} = $form{'pv'} . " pageviews";
	$form{'input_time'} = $form{'input_time'} . " sec";
	
	my($ip_address) = $ENV{'REMOTE_ADDR'};
	my(@addr) = split(/\./, $ip_address);
	my($packed_addr) = pack("C4", $addr[0], $addr[1], $addr[2], $addr[3]);
	my($name, $aliases, $addrtype, $length, @addrs);
	($name, $aliases, $addrtype, $length, @addrs) = gethostbyaddr($packed_addr, 2);
	
	$form{'host_name'} = $name;
	$form{'ip_add'} = $ENV{'REMOTE_ADDR'};
	$form{'user_agent'} = $ENV{'HTTP_USER_AGENT'};
	
	for($cnt=0;$cnt<@mailformENV;$cnt++){
		$envs .= "\[ " . $mailformENVname[$cnt] . " \] " . $form{$mailformENV[$cnt]} . "\n";
		push @field, $mailformENVname[$cnt];
		push @csv, $form{$mailformENV[$cnt]};
		$config{"return_body"} =~ s/<${mailformENV[$cnt]}>/$form{$mailformENV[$cnt]}/g;
		$config{"posted_body"} =~ s/<${mailformENV[$cnt]}>/$form{$mailformENV[$cnt]}/g;
	}
	if($config{"log_file"} ne $null && $config{"password"} ne $null){
		$envs .= "\n\n\[ LOG DOWNLOAD \] " . $config{"url"} . "?mode=download" . "\n";
		$envs .= "\[ LOG DELETE \] " . $config{"url"} . "?mode=delete" . "\n";
	}
}
sub expires_check {
	if($config{"error_url"} ne $null){
		if($config{"expires"} ne $null && $config{"expires_break"} ne $null && ($config{"expires_break"} ge $form{"date"} || $form{"date"} ge $config{"expires"})){
			$error_redirect = 1;
		}
		elsif($config{"expires"} ne $null && $form{"date"} ge $config{"expires"}){
			$error_redirect = 1;
		}
		elsif($config{"expires_break"} ne $null && $config{"expires_break"} ge $form{"date"}){
			$error_redirect = 1;
		}
	}
}
sub serials {
	if(-f $config{"serial_file"}){
		$serial = &mfp_LoadLine($config{"serial_file"});
		$form{'conversion_count'} = $serial;
		if($config{"return_subject_serial_date"}){
			($sec,$min,$hour,$day,$mon,$year) = localtime(time);$mon++;$year += 1900;
			$subject_date = sprintf("%04d%02d%02d",$year,$mon,$day);
			$serial_number = sprintf("${subject_date}%04d",$serial);
		}
		else {
			$serial_number = sprintf("%04d",$serial);
		}
		
		if($config{"error_url"} ne $null && $config{"limit"} ne $null && $serial > $config{"limit"}){
			$error_redirect = 1;
		}
		else {
			push @field, "SERIAL";
			push @csv, $serial_number;
			$form{"serial"} = $serial_number;
			$config{"subject"} = "\[" . $serial_number . "\] " . $config{"subject"};
			if($config{"return_subject_serial"}){
				$config{"return_subject"} = "\[" . $serial_number . "\] " . $config{"return_subject"};
			}
			if($config{"thanks_serial"}){
				$config{"thanks_url"} .= "?${serial_number}";
			}
			$serial++;
			&mfp_SaveLine($config{"serial_file"},$serial);
		}
	}
}

sub domaincheck {
	if(index($ENV{'HTTP_REFERER'},$config{"domain"}) > -1 && $config{"domain"} != 0){
		$error{"code"} = 1;
		$error{"info"} .= "指定ドメイン以外から送信されようとしています。 $config{'domain'} / $ENV{'HTTP_REFERER'}<br>\n";
	}
}
sub confcheck {
	if(@mailto < 1){
		$error{"code"} = 2;
		$error{"info"} .= "メールアドレスが正しく設定されていません。<br>\n";
	}
	if($config{"thanks_url"} eq $null){
		$error{"code"} = 2;
		$error{"info"} .= "コンフィグが正しく設定されていません。<br>\n";
	}
}
sub javascript_check {
	if(!$form{"javascript_flag"}){
		$error{"code"} = 5;
		$error{"info"} .= "Javascriptが有効ではありません。<br>\n";
	}
}
sub spamcheck {
	if($config{"english_spam"}){
		$error{"code"} = 3;
		$error{"info"} .= "全ての入力内容が英文で記述されております。<br>\n";
	}
	if($config{"link_spam_count"} && !($config{"link_spam"})){
		$error{"code"} = 4;
		$error{"info"} .= "入力された内容に\[\/URL\]が含まれています。<br>\n";
	}
}
sub getpost {
	if ($ENV{'REQUEST_METHOD'} eq "POST") {
		read(STDIN, $buffer, $ENV{'CONTENT_LENGTH'});
	}
	else {
		$buffer = $ENV{'QUERY_STRING'};
	}
	#$charcode = getcode(\$buffer);
	## vcard
	if($config{"vCard"}){
		$vCard = &_LOAD('vcard.vcf.cgi');
	}
	##
	@pairs = split(/&/, $buffer);
	foreach $pair (@pairs) {
		($name, $value) = split(/=/, $pair);
		$name =~ tr/+/ /;
		$name =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ tr/+/ /;
		$value =~ s/%([a-fA-F0-9][a-fA-F0-9])/pack("C", hex($1))/eg;
		$value =~ s/\\n/\n/g;
		if($name ne $null && $name ne "Submit" && $name ne "confirm_email" && $name ne "x" && $name ne "y" && $name ne "must_id" && $name ne "input_time" && $name ne "javascript_flag" && $name ne "http_referer" && $name ne "mailform_confirm_mode" && index($name,'[unjoin]') == -1 && $name ne "sitein_referrer"){
			if($name ne $prevName){
				$crr = "";
				if(index($value,"\n") > -1){
					$crr = "\n";
				}
				if($value ne $null){
					$resbody .= "\n\[ ${name} \]${crr} ${value} ${crr}";
					$config{"body"} .= "\n\[ ${name} \]${crr}${value}${crr}";
				}
				#$config{"return_body"} =~ s/<${name}>/$value/g;
				#$config{"posted_body"} =~ s/<${name}>/$value/g;
				$value =~ s/\,//ig;
				push @field, $name;
				push @csv, $value;
				$repchar{$name} .= $value;
			}
			else{
				$repchar{$name} .= $value;
				$resbody .= " ${value} ";
				$config{"body"} .= " ${value} ";
				$csv[-1] .= " ${value}";
			}
			if(!($value !~ /[\x80-\xff]/)){
				$config{"english_spam"} = 0;
			}
			if($value =~ /\[\/url\]/si){
				$config{"link_spam_count"} = 1;
			}
			if($value =~ /\[\/link\]/si){
				$config{"link_spam_count"} = 1;
			}
			if(index($name,'(必須)') > -1){
				$config{"link_spam_count"} = 1;
			}
			$prevName = $name;
		}
		$form{$name} = $value;
	}
	foreach $key(keys(%repchar)){
		$config{"return_body"} =~ s/<${key}>/$repchar{$key}/g;
		$config{"posted_body"} =~ s/<${key}>/$repchar{$key}/g;
		if($config{"vCard"}){
			$vCard =~ s/<${key}>/$repchar{$key}/g;
		}
	}
}

sub logfileCreate {
	if($config{"log_file"} ne $null && $config{"password"} ne $null){
		$size = -s $config{"log_file"};
		## double quot escape proccess
		$csv = join("_%%csv%%_",@csv);
		$csv =~ s/\"/\\\"/ig;
		@csv = split(/_%%csv%%_/,$csv);
		##
		if(-f $config{"log_file"} && $size > 0){
			chmod 0777, $config{"log_file"};
			my($put_field) = "\"" . join("\",\"",@csv) . "\"\n";
			$put_field = &encodeSJIS($put_field);
			flock(FH, LOCK_EX);
				open(FH,">>".$config{"log_file"});
					print FH $put_field;
				close(FH);
			flock(FH, LOCK_NB);
			chmod 0600, $config{"log_file"};
		}
		else{
			my($put_field) = "\"" . join("\",\"",@field) . "\"\n";
			$put_field .= "\"".  join("\",\"",@csv) . "\"\n";
			$put_field = &encodeSJIS($put_field);
			flock(FH, LOCK_EX);
				open(FH,">".$config{"log_file"});
					print FH $put_field;
				close(FH);
			flock(FH, LOCK_NB);
			chmod 0600, $config{"log_file"};
		}
	}
}

sub downloadScreen {
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile download</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">mode::logfile download</h1>\n";
	print "\t\t<form name=\"getLogs\" action=\"?mode=download\" method=\"POST\">\n";
	print "\t\t\tPASSWORD <input type=\"password\" name=\"password\" style=\"ime-mode: disabled;width: 300px;\"><input type=\"hidden\" name=\"mode\" value=\"download\"><input type=\"hidden\" name=\"config\" value=\"$form{'config'}\"><input type=\"submit\" value=\"GET LOG FILE\">\n";
	print "\t\t</form>$form{'password'}</body></html>\n";
}

sub deleteScreen {
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile delete</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">mode::logfile delete</h1>\n";
	print "\t\t<form name=\"getLogs\" action=\"\" method=\"POST\">\n";
	print "\t\t\tPASSWORD <input type=\"password\" name=\"password\" style=\"ime-mode: disabled;width: 300px;\"><input type=\"hidden\" name=\"mode\" value=\"delete\"><input type=\"hidden\" name=\"config\" value=\"$form{'config'}\"><input type=\"submit\" value=\"DELETE LOG FILE\">\n";
	print "\t\t</form>$form{'password'}</body></html>\n";
}

sub deleteComplate {
	unlink $config{"log_file"};
	print "Content-type: text/html\n\n";
	print "<html>\n";
	print "\t<head>\n";
	print "\t\t<title>mode::logfile delete success</title>\n";
	print "\t\t<style type=\"text/css\">\n";
	print "\t\t<!--\n";
	print "\t\t* {\n";
	print "\t\t\tfont-family: \"Arial\", \"Helvetica\", \"sans-serif\";font-size: 12px;\n";
	print "\t\t}\n";
	print "\t\t-->\n";
	print "\t\t</style>\n";
	print "\t</head>\n";
	print "\t<body>\n";
	print "\t\t<h1 style=\"font-size: 21px;color: #232323;\">logfile delete success</h1>\n";
	print "\t\t</body></html>\n";
}

sub fileDownload {
	chmod 0777, $config{"log_file"};
	print "Content-type: application/octet-stream; name=\"${log_file}\"\n";
	print "Content-Disposition: attachment; filename=\"${download_file_name}\"\n\n";
	open(IN,$config{"log_file"});
	print <IN>;
	chmod 0600, $config{"log_file"};
}

sub refresh {
	my($refreshurl) = @_;
	if(index($refreshurl,'http') == -1){
		$uri = (split(/send\.cgi/,$ENV{'SCRIPT_NAME'}))[0];
		if(index($ENV{'SERVER_PROTOCOL'},'HTTPS') > -1){
			$refreshurl = 'https://' . $ENV{'SERVER_NAME'} . $uri . $refreshurl;
		}
		else {
			$refreshurl = 'http://' . $ENV{'SERVER_NAME'} . $uri . $refreshurl;
		}
	}
	print "Location: ${refreshurl}\n\n";
}

sub sendmail {
	my($mailto,$mailfrom,$fromname,$subject,$body,$flag) = @_;
	my($sendmail) = $config{"sendmail"};
	if($config{'sender_fixed'}){
		$mailfrom = $config{"mailfrom"};
		$fromname = $config{"mailfrom"};
		sleep($config{'seek'});
	}
	
	if($config{'utf8'}){
		$subject = "=?$config{'charset'}?B?" . encode_base64($subject) . '?=';
		$subject =~ s/\n//ig;
		$fromname = "=?$config{'charset'}?B?" . encode_base64($fromname) . '?=' . "<${mailfrom}>";
		$fromname =~ s/\n//ig;
	}
	else {
		$fromname = &encodeJIS($fromname);
		$fromname = Jcode->new($fromname)->mime_encode;
		$fromname = "${fromname} <${mailfrom}>";
		$subject = &encodeJIS($subject);
		$subject = Jcode->new($subject)->mime_encode;
		$body = &encodeJIS($body);
	}
	
	$attvCard = "";
	if($config{"vCard"} && $flag){
		use MIME::Base64;
		$attvCard = "--$config{'boundary'}\n";
		$attvCard .= "Content-Type: application/octet-stream; name=\"vCard.vcf\"\n";
		$attvCard .= "Content-Transfer-Encoding: base64\n";
		$attvCard .= "Content-Disposition: attachment; filename=\"vCard.vcf\"\n";
		$attvCard .= "\n";
		$attvCard .= encode_base64($vCard) . "\n";
		$attvCard .= "\n";
	}
	
	if($config{"mode"}){
		if($config{'simple_header'}){
			open(MAIL,"| $sendmail -t");
				print MAIL "MIME-Version: 1.0\n";
				print MAIL "Content-Type: Multipart/Mixed; boundary=\"$config{'boundary'}\"\n";
				print MAIL "Content-Transfer-Encoding:Base64\n";
				print MAIL "To: $mailto\n";
				print MAIL "From: $fromname\n";
				print MAIL "Subject: $subject\n\n";
				print MAIL "--$config{'boundary'}\n";
				print MAIL "$body\n${attvCard}";
			close(MAIL);
		}
		else {
			open(MAIL,"| $sendmail -f $mailfrom -t");
				print MAIL "MIME-Version: 1.0\n";
				print MAIL "Content-Type: Multipart/Mixed; boundary=\"$config{'boundary'}\"\n";
				print MAIL "Content-Transfer-Encoding:Base64\n";
				print MAIL "From: $fromname\n";
				print MAIL "To: $mailto\n";
				print MAIL "Errors-To: $mailto\n";
				print MAIL "Subject: $subject\n";
				print MAIL "--$config{'boundary'}\n";
				print MAIL "Content-type:text/plain; charset=$config{'charset'}\n";
				print MAIL "Content-Transfer-Encoding:7bit\n";
				print MAIL "X-Mailer:SYNCK GRAPHICA MAILFORM\n\n";
				print MAIL "$body\n${attvCard}";
			close(MAIL);
		}
	}
	else{
		flock(FH, LOCK_EX);
			open(FH,">${mailto}\.eml");
				print FH "To: $mailto\n";
				print FH "Errors-To: $mailto\n";
				print FH "From: $fromname\n";
				print FH "Subject: $subject\n";
				print FH "MIME-Version:1.0\n";
				print FH "Content-type:text/plain; charset=$config{'charset'}\n";
				print FH "Content-Transfer-Encoding:7bit\n";
				print FH "X-Mailer:SYNCK GRAPHICA MAILFORM\n\n";
				print FH "$body\n${attvCard}";
			close(FH);
		flock(FH, LOCK_NB);
	}
}
sub GetCookie {
	my($cookie) = $ENV{'HTTP_COOKIE'};
	my(@cookie) = split(/\&/,$cookie);
	my(@cookies) = ();
	for(my($cnt)=0;$cnt<@cookie;$cnt++){
		my($name, $value) = split(/=/,$cookie[$cnt]);
		$cookies{$name} = $value;
	}
	return *cookies;
}
sub round {
	my ($num, $decimals) = @_;
	my ($format, $magic);
	$format = '%.' . $decimals . 'f';
	$magic = ($num > 0) ? 0.5 : -0.5;
	sprintf($format, int(($num * (10 ** $decimals)) + $magic) / (10 ** $decimals));
}
sub debuglog {
	my ($print) = @_;
	flock(FH, LOCK_EX);
		open(FH,">>debug.txt");
			print FH $print;
		close(FH);
	flock(FH, LOCK_NB);
}
