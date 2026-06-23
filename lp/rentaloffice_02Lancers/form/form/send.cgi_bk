#!/usr/bin/perl516

use CGI::Carp qw(fatalsToBrowser);
use Jcode;
require 'functions.cgi';
require 'config.cgi';

#POSTされたデータを取得
&getpost();

#Cookieの取得
*getCookieData = GetCookie();

if($form{'mode'} ne $null){
	if($form{'mode'} eq 'download' && $config{"password"} ne $form{'password'}){
		&downloadScreen();
	}
	elsif($form{'mode'} eq 'download' && $config{"password"} eq $form{'password'} && $config{"password"} ne $null && (-f $config{"log_file"})){
		&fileDownload();
	}
	elsif($form{'mode'} eq 'delete' && $config{"password"} ne $form{'password'}){
		&deleteScreen();
	}
	elsif($form{'mode'} eq 'delete' && $config{"password"} eq $form{'password'} && $config{"password"} ne $null && (-f $config{"log_file"})){
		&deleteComplate();
	}
	else {
		print "Content-type: text/html;charset=utf-8\n\n";
		print "ERROR CODE" . $error{"code"} . "<br>\n";
	}
}
else{
	#送信元ドメインのチェック
	&domaincheck();
	&confcheck();
	&spamcheck();
	#&javascript_check();
	#mailform 用環境変数の定義
	if($error{"code"} == 0){
		&serials();
		&expires_check;
		if($error_redirect){
			&refresh($config{"error_url"});
		}
		else {
			&envMailform();
			&logfileCreate();
			my($ip_address) = $ENV{'REMOTE_ADDR'};
			my(@addr) = split(/\./, $ip_address);
			my($packed_addr) = pack("C4", $addr[0], $addr[1], $addr[2], $addr[3]);
			my($name, $aliases, $addrtype, $length, @addrs);
			($name, $aliases, $addrtype, $length, @addrs) = gethostbyaddr($packed_addr, 2);
			if($config{"log_file"} ne $null && $config{"password"} ne $null){
				$envs .= "\n\n\[ LOG DOWNLOAD \] " . $config{"url"} . "?mode=download" . "\n";
				$envs .= "\[ LOG DELETE \] " . $config{"url"} . "?mode=delete" . "\n";
			}
			$envs .= "\[ HOST NAME \] " . $name . "\n";
			$envs .= "\[ IP ADDRESS \] " . $ENV{'REMOTE_ADDR'} . "\n";
			$envs .= "\[ USER AGENT \] " . $ENV{'HTTP_USER_AGENT'} . "\n";
			$envs .= "\[ HTTP REFERER \] " . $ENV{'HTTP_REFERER'} . "\n";
			if($config{"posted_body"} ne $null){
				$config{"body"} = $config{"posted_body"};
			}
			$config{"body"} .= $envs;
			$config{"body"} =~ s/<resbody>/$resbody/g;
			$config{"body"} =~ s/<date>/$form{'date'}/g;
			$config{"body"} =~ s/<serial>/$form{'serial'}/g;
			$config{'subject'} = &encodeJIS($config{'subject'});
			$config{'subject'} = Jcode->new($config{'subject'})->mime_encode;
			$config{"body"} = &encodeJIS($config{"body"});
			if($form{'email'} =~ /[^a-zA-Z0-9\.\@\-\_\+]/ || split(/\@/,$form{'email'}) != 2){
				$form{'email'} = $mailto[0];
			}
			
			$config{"fromname"} = &encodeJIS($config{"fromname"});
			$config{"fromname"} = "$config{'fromname'} <$config{'mailfrom'}>";
			$config{'fromname'} = Jcode->new($config{'fromname'})->mime_encode;
			for($cnt=0;$cnt<@mailto;$cnt++){
				&sendmail($mailto[$cnt],$form{'email'},$form{'email'},$config{"subject"},$config{"body"});
			}
			#if($config{"return_subject"} ne $null && $config{"return_body"} ne $null && $form{'email'} ne $mailto[0]){
			if($config{"return_subject"} ne $null && $config{"return_body"} ne $null){
				$config{"return_body"} =~ s/<resbody>/$resbody/g;
				$config{"return_body"} =~ s/<date>/$form{'date'}/g;
				$config{"return_body"} =~ s/<serial>/$form{'serial'}/g;

				#2010.07.26 start
				#2010.07.26 end				


				$config{"return_body"} = &encodeJIS($config{"return_body"});
				$config{"return_subject"} = &encodeJIS($config{"return_subject"});
				$config{'return_subject'} = Jcode->new($config{'return_subject'})->mime_encode;

				&sendmail($form{'email'},$config{"mailfrom"},$config{"fromname"},$config{"return_subject"},$config{"return_body"});
			}
			&refresh($config{"thanks_url"});
		}
	}
	else{
		print "Content-type: text/html;charset=utf-8\n\n";
		print "ERROR CODE" . $error{"code"} . "<br>\n";
		print $error{"info"};
	}
}
exit;