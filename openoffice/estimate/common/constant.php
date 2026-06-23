<?php
header("Content-Type:text/html; charset=SJIS");

// 部屋の状態
$use_array = array(
		'0' => '即入居可',
		'1' => '利用中',
		'2' => '予約受付中',
);

// 部屋の位置
$type_array = array(
		'0' => '窓側',
		'1' => '通路側'
);

// オプションの有無
$option_array = array(
		'0' => false,
		'1' => true
);

// 値段表示用関数
function price($num) {
	return number_format($num);
}

// エスケープ用関数(textarea用：SJIS)
function escapeText($str) {
	return htmlentities($str, ENT_QUOTES, 'SJIS');
}

// エスケープ用関数(その他：SJIS)
function escapeOther($str) {
	return nl2br(htmlentities($str, ENT_QUOTES, 'SJIS'));
}
?>