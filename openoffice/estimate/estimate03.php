<?php
include_once(dirname(__FILE__).'/../dashboard/library/openClass.php');
include_once(dirname(__FILE__).'/common/constant.php');

header("Content-Type:text/html; charset=SJIS");

$dbClass = new openClass($config);
$err = array();

// データ格納用配列
$data = array();
$option = array();
$hidden = array();
$mail = array();

if(isset($_POST['c_id']) && isset($_POST['o_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
	if($check_res['cnt'] != 1) $err['data'] = 'オフィスが見つかりません。';

	if(empty($err)) {
		$data = $dbClass->SelectOne("SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id", array('c_id'=>$_POST['c_id'], 'o_id'=>$_POST['o_id']));
		$option = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array('c_id'=>$_POST['c_id']));

		mb_convert_variables('SJIS', 'UTF-8', $data);
		mb_convert_variables('SJIS', 'UTF-8', $option);

		// 確認画面から戻ってきた場合の処理
		if(isset($_POST['back'])) {
			$hidden = $_POST;
			unset($hidden['c_id'], $hidden['o_id']);
			foreach($hidden as $key=>$val) {
				if(empty($val)) {
					unset($hidden[$key]);
				} elseif(mb_substr($key, 0, 3) == 'fr_') {
					$mail[$key] = $val;
					unset($hidden[$key]);
				}
			}
		} else {
			$hidden = $_POST;
			unset($hidden['c_id'], $hidden['o_id']);
			foreach($hidden as $key=>$val) {
				if(!is_array($val)) {
					$hidden['other'][$key] = $val;
					unset($hidden[$key]);
				}
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
<script type="text/javascript" src="./js/estimate.js"></script>
<script type="text/javascript">
	function fnGetAddress(postcode, pref, city){
		postcode=postcode.replace("-","");
		if(postcode.length==3 || postcode.length==7){
			$.ajax({
				type: "POST",
				url: "postal/get_address.php",
				data: {
					"postcode": postcode
				},
				dataType: "json"
			}).success(function( res ) {
				$("#"+pref).val(res["pref"]);
				$("#"+city).val(res["city"]+res["town"]);
			});
		}else if(postcode.length<3){
			$("#"+pref).val("");
			$("#"+city).val("");
		}
	}
	</script>
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
				<div class="roomN roomNtttl"><span class="status">&nbsp;<?php echo $use_array[$data['use_flg']]; ?>&nbsp;</span>&nbsp;部屋番号：<?php echo $data['num']; ?></div>
				<div class="roomN">【<?php echo $type_array[$data['type_flg']]; ?>】  <?php echo $data['breadth']; ?>m&sup2;/ 約<?php echo $data['people']; ?>名様</div>
			</div>

			<h2 id="est">お申し込みフォーム</h2>
			<p>以下の情報を入力の上、確認画面へ進んでください。送信後、入力したメールアドレス宛に確認メールが届きます。</p>
			<form name="send_mail" method="post" action="confirm.php" onSubmit="return funcInputCheck03();">
				<?php foreach($hidden as $key=>$val): ?>
					<?php foreach($val as $key2=>$val2): ?>
				<input type="hidden" name="<?php echo $key; ?>[<?php echo $key2; ?>]" value="<?php echo $val2; ?>" />
					<?php endforeach; ?>
				<?php endforeach; ?>
				<input type="hidden" name="c_id" value="<?php echo $data['center_id']; ?>" />
				<input type="hidden" name="o_id" value="<?php echo $data['num']; ?>" />
				<div class="estFull mgB40 clearfix">
					<table class="estTable05">
						<tr>
							<th>社名<br><span class="estAppNote">社名の無い方は個人名をご入力ください</span></th>
							<td><input type="text" name="fr_comp_name" class="nor" value="<?php echo $mail['fr_comp_name']; ?>" /></td>
						</tr>
						<tr>
							<th>担当者名</th>
							<td><input type="text" name="fr_resp_name" class="nor" value="<?php echo $mail['fr_resp_name']; ?>" /></td>
						</tr>
						<tr>
							<th>メールアドレス</th>
							<td><input type="text" name="fr_mail" class="nor" value="<?php echo $mail['fr_mail']; ?>" /></td>
						</tr>
						<tr>
							<th>電話番号　<span class="estAppNote">(例) 0345667777</span></th>
							<td><input type="text" name="fr_tel" class="nor" value="<?php echo $mail['fr_tel']; ?>" /></td>
						</tr>
						<tr>
							<th>住所<br>
							<span class="estAppNote">住所は全角文字でご入力ください</span></th>
							<td>
								<dl id="inputtable">
									<dt>郵便番号</dt><dd> <input type="text" id="fr_add01" name="fr_address[]" class="nor2" value="<?php echo $mail['fr_address'][0]; ?>"  onkeyup="fnGetAddress(this.value,'fr_add02' ,'fr_add03')" /></dd>
									<dt>都道府県</dt><dd> <input type="text" id="fr_add02" name="fr_address[]" class="nor2" value="<?php echo $mail['fr_address'][1]; ?>" /></dd>
									<dt>市区町村・番地</dt><dd> <input type="text" id="fr_add03" name="fr_address[]" class="nor3" value="<?php echo $mail['fr_address'][2]; ?>" /></dd>
									<dt>アパート・建物名</dt><dd> <input type="text" name="fr_address[]" class="nor3" value="<?php echo $mail['fr_address'][3]; ?>" /></dd>
								</dl>
							</td>
						</tr>
						<tr>
							<th>ご質問、ご意見等ございましたら、
							こちらへご入力ください。
							</th>
							<td><textarea name="fr_opinion" class="nor4"  cols="50" rows="5"/><?php echo $mail['fr_opinion']; ?></textarea></td>
						</tr>
					</table>

					<div id="pdf">
						<ul id="pdfUL">
							<li><a href="GlobalJapanese201411150.pdf" target="_blank">契約条件</a></li>
							<li><a href="Regus_House_Rules_628_1041_20150501.pdf" target="_blank">利用規約</a></li>
						</ul>
					</div>

					<ul id="conCheck">
						<li>
							<input type="checkbox" name="check1" value="" id="checkboxA01"<?php echo (isset($_POST['back']))? ' checked':''; ?> />
							<label for="checkboxA01" class="checkbox">契約条件及び利用規約を承諾しました。</label>
						</li>
						<li>
							<input type="checkbox" name="check2" value="" id="checkboxA02"<?php echo (isset($_POST['back']))? ' checked':''; ?> />
							<label for="checkboxA02" class="checkbox">本契約はオープンオフィスからの承諾メールをもって成立することに合意しました。</label>
						</li>
						<li>
							<input type="checkbox" name="check3" value="" id="checkboxA03"<?php echo (isset($_POST['back']))? ' checked':''; ?> />
							<label for="checkboxA03" class="checkbox">本契約成立後48時間以内にキャンセルができることを確認しました。</label>
						</li>
					</ul>
				</div><!--////-->
				<!--////-->
				<?php if(empty($err)): ?>
				<p class="mgT40 txaC"><input type="submit" name="btn_submit" value="" class="est01confirm" /></p>
				<?php endif; ?>
			</form>
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