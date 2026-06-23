<?php
include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err = array();
$select_cnt = 30; // selectタグのループ回数

if(isset($_REQUEST['c_id']) && isset($_REQUEST['o_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_REQUEST['c_id'], 'o_id'=>$_REQUEST['o_id']));
	if($check_res['cnt'] != 1) $err['data'] = 'オフィスが見つかりません。';

	if(empty($err)) {
		$data = $dbClass->SelectOne("SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_REQUEST['c_id'], 'o_id'=>$_REQUEST['o_id']));
		$option = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array('c_id'=>$_REQUEST['c_id']));

		mb_convert_variables('SJIS', 'UTF-8', $data);
		mb_convert_variables('SJIS', 'UTF-8', $option);

		if($data['period_flg'] != 0 || $data['period_flg'] != 2) {
			$s_date_arr = explode('-', mb_substr($data['period_sta'], 0, 10));
			$s_date = $s_date_arr[0].'年'.$s_date_arr[1].'月'.$s_date_arr[2].'日';
		}
		if($data['period_flg'] != 0 || $data['period_flg'] != 1) {
			$e_date_arr = explode('-', mb_substr($data['period_end'], 0, 10));
			$e_date = $e_date_arr[0].'年'.$e_date_arr[1].'月'.$e_date_arr[2].'日';
		}

		switch($data['period_flg']) {
			case 0:
				break;
			case 1:
				$date = $s_date.'～';
				break;
			case 2:
				$date = '～'.$e_date;
				break;
			case 3:
				$date = $s_date.'～'.$e_date;
				break;
			case 4:
				$date = '～'.$e_date.'  '.$s_date.'～';
				break;
		}

		// 見積もり画面から戻ってきたときの処理
		if(!empty($_POST)) {
			$set_data = $_POST;
		}
	}
} else {
	$err['data'] = '不正なページ移動です。';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!--#include virtual="/openoffice/ssi/headtagmanager.html" -->
<!--#include virtual="/openoffice/ssi/header_estimate.html" -->
<!--#include virtual="/openoffice/ssi/header.html" -->
<hr />
</div>
<!--header//-->
<script type="text/javascript" src="./js/estimate.js"></script>

<div id="OPO_main">
	<ul id="stLst">
<li><a href="http://regus-openoffice.jp/">【個室レンタルオフィス】オープンオフィス HOME</a></li>
		<li><a href="../openoffice/<?php echo $option['url']; ?>"><?php echo $option['name']; ?></a></li>
		<li class="nw"><strong>オフィスのお見積り</strong></li>
	</ul>

	<div id="estDyna">
		<h1><?php echo $option['name']; ?></h1>
		<div id="estDynaIn">
			<p class="txaR mgB10"><a href="../openoffice/<?php echo $option['url']; ?>" class="over"><img src="../img_estimate/btn_otherroom.gif" alt="他のオフィスを見る"></a></p>
			<div class="esTtl">
				<div class="roomN roomNtttl"><?php /*<span class="status">&nbsp;<? php echo $use_array[$data['use_flg']]; ? >&nbsp;</span>&nbsp;*/?>部屋番号：<?php echo $data['num']; ?></div>
				<div class="roomN">【<?php echo $type_array[$data['type_flg']]; ?>】  <?php echo $data['breadth']; ?>m&sup2;/ 約<?php echo $data['people']; ?>名様</div>
			</div>

			<div class="estFull mgT20 mgB40 clearfix">
				<div class="flL"><img src="../img_estimate/ws/<?php echo $data['image_path']; ?>" alt="写真：内部" width="351" height="263"></div>
				<div class="flR">
					<p><?php echo $data['description']; ?></p>
					<p class="confirmPrice"><a href="/openoffice/form/form.php" class="over"><img src="../img_estimate/btn_confirmprice.jpg" alt="空室・金額を確認する"></a></p>
				</div>
			</div><!--////-->

			<!--////-->
		</div><!--/estDynaIn//-->

		<div class="estWide">
			<p class="mgB20 both">水道光熱費（24時間季節に関係なく空調費用も含む）・インターネット回線の利用料・共用部の清掃・ごみ処理費・ビル管理諸費・空調や照明設備のメンテナンス費用なども共益費に含まれています。</p>
			<ul class="roomPic">
				<li><img src="../img_estimate/ws/img_room_t_01.jpg" alt=""></li>
				<li><img src="../img_estimate/ws/img_room_t_02.jpg" alt=""></li>
				<li><img src="../img_estimate/ws/img_room_t_03.jpg" alt=""></li>
			</ul>
		</div><!--/estWide//-->

	</div><!--/estDyna//-->
</div>
<!--#include virtual="/openoffice/ssi/leftnavi.html" -->
<!--#include virtual="/openoffice/ssi/footer.html" -->
<!--#include virtual="/openoffice/ssi/accesslogger.html" -->
</div>
<!--#include virtual="/openoffice/ssi/footertag.html" -->
</body>
</html>