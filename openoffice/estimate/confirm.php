<?php
include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err = array();

// データ格納用配列
$data = array();
$option = array();
$price_fir = array();
$price_mon = array();
$mail = array();
$other = array();
$posts = array();

if(isset($_POST['c_id']) && isset($_POST['o_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
	if($check_res['cnt'] != 1) $err['data'] = 'オフィスが見つかりません。';

	if(empty($err)) {
		$data = $dbClass->SelectOne("SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
		$option = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array('c_id'=>$_POST['c_id']));

		mb_convert_variables('SJIS', 'UTF-8', $data);
		mb_convert_variables('SJIS', 'UTF-8', $option);

		$posts = $_POST;
		foreach($posts as $key=>$val) {
			if(mb_substr($key, 0, 4) == 'fir_') {
				$price_fir[$key] = $val;
			} elseif(mb_substr($key, 0, 4) == 'mon_') {
				$price_mon[$key] = $val;
			} elseif(mb_substr($key, 0, 3) == 'fr_') {
				$mail[$key] = $val;
			} elseif($key == 'other') {
				$other = $val;
			}
		}

		// 入力データのエスケープ
		foreach($mail as $key=>$val) {
			if(is_array($val)) {
				foreach($val as $key2=>$val2) {
					$mail[$key][$key2] = escapeOther($val2);
				}
			} elseif($key == 'fr_opinion') {
				$mail[$key] = escapeText($val);
			} else {
				$mail[$key] = escapeOther($val);
			}
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
        $('#send_mail').submit();
    });
});
</script>

<div id="OPO_main">
	<ul id="stLst">
<li><a href="http://regus-openoffice.jp/">【個室レンタルオフィス】オープンオフィス HOME</a></li>
		<li><a href="../openoffice/<?php echo $option['url']; ?>"><?php echo $option['name']; ?></a></li>
		<li class="nw"><strong>オフィスのお見積り</strong></li>
	</ul>

	<form name="back" id="back" method="post" action="estimate03.php">
	<?php
		foreach($posts as $key=>$val) {
			if(is_array($val)) {
				foreach($val as $key2=>$val2) {
					echo '<input type="hidden" name="'.$key.'['.$key2.']" value="'.$val2.'" />';
				}
			} else {
				echo '<input type="hidden" name="'.$key.'" value="'.$val.'" />';
			}
		}
	?>
		<input type="hidden" name="back" value="" />
	</form>

	<div id="estDyna">
		<h1><?php echo $option['name']; ?></h1>
			<div id="estDynaIn">
				<div class="esTtl">
					<div class="roomN roomNtttl"><?php /*<span class="status">&nbsp;<? php echo $use_array[$data['use_flg']]; ? >&nbsp;</span>&nbsp;*/?>部屋番号：<?php echo $data['num']; ?></div>
					<div class="roomN">【<?php echo $type_array[$data['type_flg']]; ?>】  <?php echo $data['breadth']; ?>m&sup2;/ 約<?php echo $data['people']; ?>名様</div>
				</div>

				<h2 id="est">お申し込みフォームご確認</h2>
				<p>内容をご確認のうえ、契約申込のボタンを押して下さい。</p>
				<form name="send_mail" method="post" action="sendmail.php" id="send_mail">
					<div class="estFull mgB40 clearfix">
						<input type="hidden" name="c_id" value="<?php echo $data['center_id']; ?>" />
						<input type="hidden" name="o_id" value="<?php echo $data['num']; ?>" />
						<table class="estTable06">
							<tr>
								<th>社名</th>
								<td><?php echo $mail['fr_comp_name']; ?></td>
							</tr>
							<tr>
								<th>担当者名</th>
								<td><?php echo $mail['fr_resp_name']; ?></td>
							</tr>
							<tr>
								<th>メールアドレス</th>
								<td><?php echo $mail['fr_mail']; ?></td>
							</tr>
							<tr>
								<th>電話番号</th>
								<td><?php echo $mail['fr_tel']; ?></td>
							</tr>
							<tr>
								<th>住所</th>
								<td>
								&#12306;<?php echo $mail['fr_address'][0]; ?><br />
								<?php echo $mail['fr_address'][1].$mail['fr_address'][2].$mail['fr_address'][3]; ?>
								</td>
							</tr>
							<tr>
								<th>ご質問、ご意見等ございましたら、
								こちらへご入力ください。
								</th>
								<td><?php echo $mail['fr_opinion']; ?></td>
							</tr>
						</table>

						<?php
							foreach($mail as $key=>$val) {
								if(is_array($val)) {
									foreach($val as $key2=>$val2) {
										echo '<input type="hidden" name="'.$key.'['.$key2.']" value="'.$val2.'" />';
									}
								} else {
									echo '<input type="hidden" name="'.$key.'" value="'.$val.'" />';
								}
							}
						?>

						<?php foreach($other as $key=>$val): ?>
						<input type="hidden" name="<?php echo $key; ?>" value="<?php echo $val; ?>" />
						<?php endforeach; ?>

						<h2 id="est">お見積り</h2>
						<div class="estFull mgB40 clearfix">
							<div class="flLHlf">
								<table class="estTable03">
									<tr>
										<td  class="ttl" colspan="2">初期費用</td>
									</tr>
									<?php foreach ($price_fir as $key=>$val): ?>
									<tr>
										<th<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['title']; ?></th>
										<td<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['pri']; ?>円</td>
										<input type="hidden" name="<?php echo $key; ?>[title]" value="<?php echo $val['title']; ?>" />
										<input type="hidden" name="<?php echo $key; ?>[pri]" value="<?php echo $val['pri']; ?>" />
										<?php if(isset($val['cnt'])): ?><input type="hidden" name="<?php echo $key; ?>[cnt]" value="<?php echo $val['cnt']; ?>" /><?php endif; ?>
									</tr>
									<?php endforeach; ?>
								</table>
								<table class="estTable04 mgT10">
									<tr>
										<td  class="ttl" colspan="2">退去時の費用</td>
									</tr>
									<tr>
										<th>退去料</th>
										<td><?php echo $other['exit_pri']; ?>円</td>
									</tr>
								</table>
							</div>

							<div class="flRHlf">
								<table class="estTable03">
									<tr>
										<td  class="ttl" colspan="2">毎月の費用</td>
									</tr>
									<?php foreach ($price_mon as $key=>$val): ?>
									<tr>
										<th<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['title']; ?></th>
										<td<?php echo ($val['title']=='小計')? ' class="sum"':''; ?>><?php echo $val['pri']; ?>円</td>
										<input type="hidden" name="<?php echo $key; ?>[title]" value="<?php echo $val['title']; ?>" />
										<input type="hidden" name="<?php echo $key; ?>[pri]" value="<?php echo $val['pri']; ?>" />
										<?php if(isset($val['cnt'])): ?><input type="hidden" name="<?php echo $key; ?>[cnt]" value="<?php echo $val['cnt']; ?>" /><?php endif; ?>
									</tr>
									<?php endforeach; ?>
								</table>
								<p class="none txtred">※電話、FAXはこの他に通話料・通信料が別途かかります。</p>
							</div>
						</div>
						<div class="set02bgred">
							<dl id="est02Cos">
								<dt>契約月の費用……………</dt><dd><?php echo $other['total_first']; ?>円</dd>
								<dt>2ヶ月目以降の費用……</dt><dd><?php echo $other['total_after']; ?>円</dd>
							</dl>
						</div>
						<p class="txtred txaR mgT10">表示は税抜となります。</p>
					</div><!--////-->
					<!--////-->
				</form>
				<?php if(empty($err)): ?>
				<div class="mgT40 txaC">
					<ul id="estBTNBox" class="clearfix">
						<li><input type="button" name="btn_back" value="" class="est03back2" /></li>
						<li><input type="button" name="btn_submit" value="" class="est03send" /></li>
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