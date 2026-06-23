<?php
include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err = array();

$data = array();
$option = array();

if(isset($_REQUEST['c_id']) && isset($_REQUEST['o_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_REQUEST['c_id'], 'o_id'=>$_REQUEST['o_id']));
	if($check_res['cnt'] != 1) $err['data'] = '不正なデータを参照しました。';

	if(empty($err)) {
		$data = $dbClass->SelectOne("SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_REQUEST['c_id'], 'o_id'=>$_REQUEST['o_id']));
		$option = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array('c_id'=>$_REQUEST['c_id']));

		mb_convert_variables('SJIS', 'UTF-8', $data);
		mb_convert_variables('SJIS', 'UTF-8', $option);
	}
} else {
	$err['data'] = 'メールの送信に失敗しました。';
}
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<!--#include virtual="/OPENOFFICE/ssi/headtagmanager.html" -->
<!--#include virtual="/OPENOFFICE/ssi/header_estimate.html" -->
<!--#include virtual="/OPENOFFICE/ssi/header.html" -->
<hr />
</div>
<!--header//-->
<div id="OPO_main">
	<ul id="stLst">
<li><a href="http://regus-openoffice.jp/">【個室レンタルオフィス】オープンオフィス HOME</a></li>
		<li><a href="../openoffice/<?php echo $option['url']; ?>"><?php echo $option['name']; ?></a></li>
		<li class="nw"><strong>オフィスのお見積り</strong></li>
	</ul>


	<div id="estDyna">
		<h1><?php echo $option['name']; ?></h1>
		<div id="estDynaIn">
			<div class="esTtl">
				<div class="roomN roomNtttl"><?php /*<span class="status">&nbsp;<? php echo $use_array[$data['use_flg']]; ? >&nbsp;</span>&nbsp;*/?>部屋番号：<?php echo $data['num']; ?></div>
				<div class="roomN">【<?php echo $type_array[$data['type_flg']]; ?>】  <?php echo $data['breadth']; ?>m&sup2;/ 約<?php echo $data['people']; ?>名様</div>
			</div>

			<?php if(empty($err)): ?>
			<h2 id="est">お申し込み完了</h2>
			<p class="mgT50">この度は、オープンオフィスのご契約にお申し込み頂きまして、誠にありがとうございます。</p>
			<p class="mgT20">ご登録して頂きましたメールアドレスにオフィス契約のお申し込み受付完了のメールを<br>
			お送りさせて頂きました。</p><p class="txaL mgT30"><a href="http://regus-openoffice.jp/" class="over"><img src="../img_estimate/btn_backtop.gif" alt="topへ戻る"></a></p>
			<div class="estFull mgB40 clearfix"></div><!--////-->
			<?php else: ?>
			<h2 id="est"><?php echo $err['data']; ?></h2>
			<?php endif; ?>
			<!--////-->
		</div><!--/estDynaIn//-->
	</div><!--/estDyna//-->
</div>
<!--#include virtual="/OPENOFFICE/ssi/leftnavi.html" -->
<!--#include virtual="/OPENOFFICE/ssi/footer.html" -->
<!--#include virtual="/OPENOFFICE/ssi/accesslogger.html" -->
</div>
<!--#include virtual="/OPENOFFICE/ssi/footertag.html" -->
</body>
</html>