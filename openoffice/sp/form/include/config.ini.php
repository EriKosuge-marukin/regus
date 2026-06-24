<?php
ob_start();
session_name("open_office_form");
session_start();

setlocale(LC_ALL, 'ja_JP.shift_jis');
mb_internal_encoding("shift_jis");
header('Content-Type: text/html; charset=shift_jis');

extract($_REQUEST);

ini_set("display_errors", "Off");
?>