<?php
ob_start();
session_name("open_office");
session_start();

setlocale(LC_ALL, 'ja_JP.UTF-8');
mb_internal_encoding("UTF-8");
header('Content-Type: text/html; charset=utf8');

include_once (dirname(__FILE__).'/function.lib.php'); // 共通関数
include_once (dirname(__FILE__).'/const.php');

// DB接続情報
$config = array(
		'driver' => 'mysql',//mysql sqlsrv pgsql;
		'persistent' => false,
		'host' => 'localhost',
		'login' => 'open_office',
		'password' => 'nUy6fvGcwF5aW',
		'database' => 'open_office',
		'schema' => '',
		'encoding' => 'UTF8'//mysqlの場合UTF8
);

$DOCUMENT_ROOT=str_replace("\\","/",$_SERVER["DOCUMENT_ROOT"]);
$dir=str_replace("\\","/",dirname(__FILE__));
$configdir=str_replace($DOCUMENT_ROOT, "", $dir);
$configdir=str_replace(strrchr($configdir, "/"), "", $configdir);
define ('ROOT_URL', get_document_root_url().$configdir. "/");

extract($_REQUEST);

ini_set("display_errors", "Off");
?>