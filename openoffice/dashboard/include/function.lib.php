<?php
require_once('config.ini.php');

function ve($data){
	echo "<pre>";
	var_export($data);
	echo "</pre>";
}
function vd($data){
	echo "<pre>";
	var_dump($data);
	echo "</pre>";
}

/**
 * ドキュメントルートURLを取得します。
 * @return string ドキュメントルートURL
 */
function get_document_root_url(){
	$script  = ($_SERVER["SERVER_PORT"] == 443 ? 'https://' : 'http://'); // scheme
	$script .= $_SERVER["SERVER_NAME"];	// host
	$script .= ($_SERVER["SERVER_PORT"] == 80 ? '' : ':' . $_SERVER["SERVER_PORT"]);  // port
	return $script;
}

function strToHex($string){
	$hex='';
	for ($i=0; $i < strlen($string); $i++){
		$hex .= dechex(ord($string[$i]));
	}
	return $hex;
}

function hexToStr($hex){
	$string='';
	for ($i=0; $i < strlen($hex)-1; $i+=2){
		$string .= chr(hexdec($hex[$i].$hex[$i+1]));
	}
	return $string;
}

function fileErrorCodeToMessage($code)
{
	switch ($code) {
		case UPLOAD_ERR_INI_SIZE:
			$message = "アップロードされたファイルは、php.ini の upload_max_filesize ディレクティブの値を超えています。";
			break;
		case UPLOAD_ERR_FORM_SIZE:
			$message = "アップロードされたファイルは、HTML フォームで指定された MAX_FILE_SIZE を超えています。";
			break;
		case UPLOAD_ERR_PARTIAL:
			$message = "アップロードされたファイルは一部のみしかアップロードされていません。";
			break;
		case UPLOAD_ERR_NO_FILE:
			$message = "ファイルはアップロードされませんでした。";
			break;
		case UPLOAD_ERR_NO_TMP_DIR:
			$message = "テンポラリフォルダがありません。";
			break;
		case UPLOAD_ERR_CANT_WRITE:
			$message = "ディスクへの書き込みに失敗しました。";
			break;
		case UPLOAD_ERR_EXTENSION:
			$message = "PHP の拡張モジュールがファイルのアップロードを中止しました。";
			break;
		default:
			$message = "不明のアップロードエラー。";
			break;
	}
	return $message;
}

/**
 * HTML出力用にテキストをエスケープ（htmlentities(), nl2br()）
 * @static
 * @param string $txt 文字列
 * @return string エスケープされた文字列
 */
function GetEscapeHtmlText($txt){
	return nl2br(htmlentities($txt, ENT_QUOTES, mb_internal_encoding()));
}

/**
 * input内のvalue出力用にテキストをエスケープ（htmlentities()）
 * @static
 * @param string $txt 文字列
 * @return string エスケープされた文字列
 */
function GetEscapeInputVal($txt){
	return htmlentities($txt, ENT_QUOTES, mb_internal_encoding());
}

/**
 * 日付と時刻が1つになったデータから、日付と時刻を分けて取り出す
 * @param string $value 検査したい値
 * @param integer $flg 0:日付を返す 1:時刻を返す
 * @param string $separate 日付の区切り文字（デフォは「-」）
 * @return string 日付または時刻を返す
 */
function Date_Time($value, $flg, $separate="-"){

	$ret = "";

	switch ($flg) {
		case 0:
			//日付を返す
			$ret = substr($value,0,10);

			if($separate != "-"){
				$ret = str_replace("-", $separate, $ret);
			}
			return $ret;

			break;
		case 1:
			//時刻を返す
			$ret = substr($value,11,8);
			return $ret;

			break;
	}
}

/**
 * 文字列の前後中間の余分なスペースを取る
 * 且つ全角スペースは半角スペースに変換して処理する
 * @param string $pLine
 * @return string
 */
function myTrim($pLine){
	$return="";
	if($pLine!=""){
		//配列の上限設定 (全角スペースは半角に変換)
		$pLine=str_replace("　", " ", $pLine);
		$myDataLine = explode(" ",$pLine);

		//文字列を配列に格納
		foreach ($myDataLine as $line) {
			if($line!=""){
				$return.=$line." ";
			}
		}
	}
	return trim($return);
}

/**
 * 日付データ(例　2015-10-10 10:10:10)をYYYYMMDDに変換する
 * （ＣＳＶファイル名付加等に使用）
 * @param string $orgDate
 * @return string
 */
function dateConv($orgDate){
	$convDate = substr($orgDate, 0,4);
	$convDate .= substr($orgDate, 5,2);
	$convDate .= substr($orgDate, 8,2);
	return $convDate;
}

function StringConv($strTarget){

	$StringConv="";

	//空文字とNull対応
	if(strlen($strTarget)){
		// 		$zenkaku="";
		// 		$hankaku="";
		// 		$singleString="";

		//全角では困る文字列を変数 $zenkaku に代入する
		// 		$zenkaku = $zenkaku."ＡＢＣＤＥＦＧＨＩＪＫＬＭＮＯＰＱＲＳＴＵＶＷＸＹＺ";
		// 		$zenkaku = $zenkaku."ａｂｃｄｅｆｇｈｉｊｋｌｍｎｏｐｑｒｓｔｕｖｗｘｙｚ";
		// 		$zenkaku = $zenkaku."１２３４５６７８９０";
		// 		$zenkaku = $zenkaku."！＃＄％＆・（）＊＋，－．／：；＜＝＞？［\］＾＿｛｜｝～＠　｀”";

		$strTarget=mb_convert_kana($strTarget, "as");

		//半角では困る文字列を変数 $hankaku に代入する
		// 		$hankaku = "｡｢｣､･ｦｧｨｩｪｫｬｭｮｯｱｲｳｴｵｶｷｸｹｺｻｼｽｾｿﾁﾂﾃﾄﾅﾆﾇﾈﾉﾊﾋﾌﾍﾎﾏﾑﾒﾓﾔﾕﾖﾗﾘﾙﾚﾛﾜﾝﾞﾟｰ㈱㈲";

		$strTarget=mb_convert_kana($strTarget, "K");
		$strTarget = str_replace("㈱", "(株)", $strTarget);
		$strTarget = str_replace("㈲", "(有)", $strTarget);

		//変換しなおされた文字列を返す
		$StringConv = $strTarget;
	}
	return $StringConv;
}

//一次元配列をカンマ区切りの文字列にする 例)$arr→[A][B][C] ==> A,B,C
function arr_string($arr){

	$ret = "";

	if(count($arr) == 0){
		return "";
	}elseif (count($arr) == 1){
		return $arr[0];
	}else{
		for($i=0;$i<count($arr);$i++){
			if($i == 0){
				$ret = $arr[0];
			}else{
				$ret .= "," . $arr[$i];
			}
		}
		return $ret;
	}

}

?>