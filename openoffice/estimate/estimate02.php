<?php
include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err = array();

// データ格納用配列
$data = array();
$option = array();
$select = array();
$hidden = array();

$calc_first_data = array(); // 表示データ格納用配列(初期費用)
$calc_month_data = array(); // 表示データ格納用配列(月額)

if(isset($_POST['c_id']) && isset($_POST['o_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
	if($check_res['cnt'] != 1) $err['data'] = 'オフィスが見つかりません。';

	if(empty($err)) {
		$data = $dbClass->SelectOne("SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
		$option = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array('c_id'=>$_POST['c_id']));
		$select = $_POST;

		mb_convert_variables('SJIS', 'UTF-8', $data);
		mb_convert_variables('SJIS', 'UTF-8', $option);

		// 各項目の計算
		// 保証金
		$calc_first_data['security']['pri'] = $data['security_'.$select['use_month'].'mon'];
		$calc_first_data['security']['title'] = '保証金';

		// 入会金
		$calc_first_data['admission']['pri'] = $data['admission'];
		$calc_first_data['admission']['title'] = '入会金';

		// 電話(初期設定費)
		if(isset($select['op_tel'])) {
			$calc_first_data['op_tel_price']['pri'] = $option['op_tel_price']*$select['op_tel_cnt'];
			$calc_first_data['op_tel_price']['title'] = '電話(初期設定費)';
		}

		// FAX(初期設定費)
		if(isset($select['op_fax'])) {
			$calc_first_data['op_fax_price']['pri'] = $option['op_fax_price']*$select['op_fax_cnt'];
			$calc_first_data['op_fax_price']['title'] = 'FAX(初期設定費)';
		}

		// ドア付社名プレート
		if(isset($select['op_door'])) {
			$calc_first_data['op_door_price']['pri'] = $option['op_door_price'];
			$calc_first_data['op_door_price']['title'] = 'ドア付社名プレート';
		}

		// 共用部社名看板(作成費)
		if(isset($select['op_board'])) {
			$calc_first_data['op_board_price']['pri'] = $option['op_board_price'];
			$calc_first_data['op_board_price']['title'] = '共用部社名看板(作成費)';
		}

		// 鍵
		if(isset($select['op_key'])) {
			$calc_first_data['op_key_price']['pri'] = $option['op_key_price']*($select['op_key_cnt']-1);
			$calc_first_data['op_key_price']['title'] = '鍵';
			$calc_first_data['op_key_price']['cnt'] = $select['op_key_cnt'];
		}

		// セキュリティカード
		if(isset($select['op_security'])) {
			$calc_first_data['op_security_price']['pri'] = $option['op_security_price']*($select['op_security_cnt']-1);
			$calc_first_data['op_security_price']['title'] = 'セキュリティカード';
			$calc_first_data['op_security_price']['cnt'] = $select['op_security_cnt'];
		}

		// ビル用セキュリティカード
		if(isset($select['op_build'])) {
			$calc_first_data['op_build_price']['pri'] = $option['op_build_price']*($select['op_build_cnt']-1);
			$calc_first_data['op_build_price']['title'] = 'ビル用セキュリティカード';
			$calc_first_data['op_build_price']['cnt'] = $select['op_build_cnt'];
		}

		// 小計(初期費用)
		$calc_first_data['total']['pri'] = 0;
		$calc_first_data['total']['title'] = '小計';
		foreach($calc_first_data as $val) {
			$calc_first_data['total']['pri'] += $val['pri'];
		}

		// ご利用料
		$calc_month_data['price']['pri'] = $data['price_'.$select['use_month'].'mon'];
		$calc_month_data['price']['title'] = 'ご利用料';

		// 共益費
		$calc_month_data['public']['pri'] = $data['public'];
		$calc_month_data['public']['title'] = '共益費';

		// レンタル家具
		if(isset($select['op_rental'])) {
			$calc_month_data['op_rental_price']['pri'] = $option['op_rental_price']*$select['op_rental_cnt'];
			$calc_month_data['op_rental_price']['title'] = 'レンタル家具';
			$calc_month_data['op_rental_price']['cnt'] = $select['op_rental_cnt'];
		}

		// 電話(月額回線費)
		if(isset($select['op_tel'])) {
			$calc_month_data['op_tel_price_mon']['pri'] = $option['op_tel_price_mon']*$select['op_tel_cnt'];
			$calc_month_data['op_tel_price_mon']['title'] = '電話(月額回線費)';
			$calc_month_data['op_tel_price_mon']['cnt'] = $select['op_tel_cnt'];
		}

		// FAX(月額回線費)
		if(isset($select['op_fax'])) {
			$calc_month_data['op_fax_price_mon']['pri'] = $option['op_fax_price_mon']*$select['op_fax_cnt'];
			$calc_month_data['op_fax_price_mon']['title'] = 'FAX(月額回線費)';
			$calc_month_data['op_fax_price_mon']['cnt'] = $select['op_fax_cnt'];
		}

		// 電話対応(月額)
		if(isset($select['op_answer'])) {
			$calc_month_data['op_answer_price']['pri'] = $option['op_answer_price'];
			$calc_month_data['op_answer_price']['title'] = '電話対応(月額)';
		}

		// 共用部社名看板(月額掲載料)
		if(isset($select['op_board'])) {
			$calc_month_data['op_board_price_mon']['pri'] = $option['op_board_price_mon'];
			$calc_month_data['op_board_price_mon']['title'] = '共用部社名看板(月額掲載料)';
		}

		// 貸しロッカー
		if(isset($select['op_locker'])) {
			$calc_month_data['op_locker_price']['pri'] = $option['op_locker_price'];
			$calc_month_data['op_locker_price']['title'] = '貸しロッカー';
		}

		// 小計(初期費用)
		$calc_month_data['total']['pri'] = 0;
		$calc_month_data['total']['title'] = '小計';
		foreach($calc_month_data as $val) {
			$calc_month_data['total']['pri'] += $val['pri'];
		}

		// 退去料
		$exit_pri = $data['exit_pri'];

		// 契約月・2か月目以降の費用
		$total['first'] = $calc_first_data['total']['pri'] + $calc_month_data['total']['pri'];
		$total['after'] = $calc_month_data['total']['pri'];

		// hiddenで送る利用開始日と使用期間
		$hidden['start_date'] = $select['year'].'年'.$select['month'].'月'.$select['day'].'日';
		$hidden['use_month'] = $select['use_month'];
	}
} else {
	$err['data'] = '不正なページ移動です。';
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
<script type="text/javascript">
$(function(){
    $('input[name=btn_back]').click(function() {
        $('#back').submit();
    });

    $('input[name=btn_submit]').click(function() {
        $('#to_mail').submit();
    });
});
</script>

<div id="OPO_main">
	<ul id="stLst">
<li><a href="http://regus-openoffice.jp/">【個室レンタルオフィス】オープンオフィス HOME</a></li>
		<li><a href="../openoffice/<?php echo $option['url']; ?>"><?php echo $option['name']; ?></a></li>
		<li class="nw"><strong>オフィスのお見積り</strong></li>
	</ul>

	<form name="back" id="back" method="post" action="estimate.php">
	<?php foreach($select as $key=>$val): ?>
		<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>" />
	<?php endforeach; ?>
	</form>

	<div id="estDyna">
		<h1><?php echo $option['name']; ?></h1>
		<div id="estDynaIn">
			<p class="txaR mgB10"><a href="../openoffice/<?php echo $option['url']; ?>" class="over"><img src="../img_estimate/btn_otherroom.gif" alt="他のオフィスを見る"></a></p>
			<div class="esTtl">
				<div class="roomN roomNtttl"><span class="status">&nbsp;<?php echo $use_array[$data['use_flg']]; ?>&nbsp;</span>&nbsp;部屋番号：<?php echo $data['num']; ?></div>
				<div class="roomN">【<?php echo $type_array[$data['type_flg']]; ?>】  <?php echo $data['breadth']; ?>m&sup2;/ 約<?php echo $data['people']; ?>名様</div>
			</div>

			<form name="back" id="to_mail" method="post" action="estimate03.php">
				<input type="hidden" name="c_id" value="<?php echo $data['center_id']; ?>" />
				<input type="hidden" name="o_id" value="<?php echo $data['num']; ?>" />
				<input type="hidden" name="start_date" value="<?php echo $hidden['start_date']; ?>" />
				<input type="hidden" name="use_month" value="<?php echo $hidden['use_month']; ?>" />

				<h2 id="est">お見積り</h2>
				<div class="estFull mgB40 clearfix">
					<div class="flLHlf">
						<table class="estTable03">
							<tr>
								<td  class="ttl" colspan="2">初期費用</td>
							</tr>
							<?php foreach ($calc_first_data as $key=>$val): ?>
							<tr>
								<th<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['title']; ?></th>
								<td<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo price($val['pri']); ?>円</td>
								<input type="hidden" name="fir_<?php echo $key; ?>[title]" value="<?php echo $val['title']; ?>" />
								<input type="hidden" name="fir_<?php echo $key; ?>[pri]" value="<?php echo price($val['pri']); ?>" />
								<?php if(isset($val['cnt'])): ?><input type="hidden" name="fir_<?php echo $key; ?>[cnt]" value="<?php echo $val['cnt']; ?>" /><?php endif; ?>
							</tr>
							<?php endforeach; ?>
						</table>

						<table class="estTable04 mgT10">
							<tr>
								<td  class="ttl" colspan="2">退去時の費用</td>
							</tr>
							<tr>
								<th>退去料</th>
								<td><?php echo price($exit_pri); ?>円<input type="hidden" name="exit_pri" value="<?php echo price($exit_pri); ?>" /></td>
							</tr>
						</table>
					</div>

					<div class="flRHlf">
						<table class="estTable03">
							<tr>
								<td  class="ttl" colspan="2">毎月の費用</td>
							</tr>
							<?php foreach ($calc_month_data as $key=>$val): ?>
							<tr>
								<th<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['title']; ?></th>
								<td<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo price($val['pri']); ?>円</td>
								<input type="hidden" name="mon_<?php echo $key; ?>[title]" value="<?php echo $val['title']; ?>" />
								<input type="hidden" name="mon_<?php echo $key; ?>[pri]" value="<?php echo price($val['pri']); ?>" />
								<?php if(isset($val['cnt'])): ?><input type="hidden" name="mon_<?php echo $key; ?>[cnt]" value="<?php echo $val['cnt']; ?>" /><?php endif; ?>
							</tr>
							<?php endforeach; ?>
						</table>
						<p class="none txtred">※電話、FAXはこの他に通話料・通信料が別途かかります。</p>
					</div>
				</div><!--////-->
				<!--////-->

				<div class="set02bgred">
					<dl id="est02Cos">
						<dt>契約月の費用……………</dt><dd><?php echo price($total['first']); ?>円<input type="hidden" name="total_first" value="<?php echo price($total['first']); ?>" /></dd>
						<dt>2ヶ月目以降の費用……</dt><dd><?php echo price($total['after']); ?>円<input type="hidden" name="total_after" value="<?php echo price($total['after']); ?>" /></dd>
					</dl>
				</div>
				<p class="txtred txaR mgT10">表示は税抜となります。</p>
			</form>
			<?php if(empty($err)): ?>
			<div class="mgT40 txaC">
				<ul id="estBTNBox" class="clearfix">
					<li><input type="button" name="btn_back" class="est03back1" /></li>
					<li><input type="button" name="btn_submit" class="est01apply" /></li>
				</ul>
			</div>
			<?php endif; ?>
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