<?php
include_once(dirname(__FILE__).'/library/openClass.php');
include(dirname(__FILE__)."/library/Validate.php");

if(!isset($_SESSION['session_id'])){
	header('Location: '.ROOT_URL.'login.php');
	exit;
}

if(isset($_SESSION['message'])) {
	$message = $_SESSION['message'];
	unset($_SESSION['message']);
}

$dbClass = new openClass($config);
$err = array(); // エラー内容格納用配列
$datas = array(); // 表示データ格納用配列

// 新規・修正の確認
$new_flg = true; // 新規の場合true
if(isset($_REQUEST['c_id'])) {
	$new_flg = false;
	// IDの整合性チェック
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_center WHERE center_id = :c_id", array("c_id"=>$_REQUEST['c_id']));
	if($check_res['cnt'] != 1) $err["check"] = "存在しないIDが指定されました。";
	else $id = $_REQUEST['c_id'];
}

// メイン処理
if(empty($err)) {
	// 登録処理
	if(!empty($_POST)) {
		$datas = $_POST;

		// エラーチェック
		if($new_flg) {
			if(empty($_POST['center_id'])) {
				$err['center_id'] = "センターIDを入力してください。";
			} elseif($err_mes=Validate::AlphaNumberSymbol($_POST['center_id'], 'センターID', '-_')) {
				$err['center_id'] = $err_mes;
			} else{
				$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_center WHERE center_id = :c_id", array("c_id"=>$_POST['center_id']));
				if($check_res['cnt'] >= 1) $err['center_id'] = "既に使用されているセンターIDです。";
			}
		}

		if(empty($_POST['name'])) $err['name'] = "センター名を入力してください。";

		if(empty($_POST['url'])) $err['url'] = "センターページURLを入力してください。";

		// 正数値チェック(以下チェックボックスと値段)
		if(isset($_POST['op_rental_flg']) && $err_mes=Validate::Required($_POST['op_rental_price'], 'レンタル家具の料金')) $err['op_rental_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_rental_price'], 'レンタル家具の料金')) $err['op_rental_price'] = $err_mes;

		if(isset($_POST['op_tel_flg']) && $err_mes=Validate::Required($_POST['op_tel_price'], '電話の初期設定費')) $err['op_tel_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_tel_price'], '電話の初期設定費')) $err['op_tel_price'] = $err_mes;
		if(isset($_POST['op_tel_flg']) && $err_mes=Validate::Required($_POST['op_tel_price_mon'], '電話の月額回線費')) $err['op_tel_price_mon'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_tel_price_mon'], '電話の月額回線費')) $err['op_tel_price_mon'] = $err_mes;

		if(isset($_POST['op_fax_flg']) && $err_mes=Validate::Required($_POST['op_fax_price'], 'FAXの初期設定費')) $err['op_fax_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_fax_price'], 'FAXの初期設定費')) $err['op_fax_price'] = $err_mes;
		if(isset($_POST['op_fax_flg']) && $err_mes=Validate::Required($_POST['op_fax_price_mon'], 'FAXの月額回線費')) $err['op_fax_price_mon'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_fax_price_mon'], 'FAXの月額回線費')) $err['op_fax_price_mon'] = $err_mes;

		if(isset($_POST['op_answer_flg']) && $err_mes=Validate::Required($_POST['op_answer_price'], '電話対応の料金')) $err['op_answer_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_answer_price'], '電話対応の料金')) $err['op_answer_price'] = $err_mes;

		if(isset($_POST['op_door_flg']) && $err_mes=Validate::Required($_POST['op_door_price'], 'ドア付社名プレート(作成費)の料金')) $err['op_door_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_door_price'], 'ドア付社名プレート(作成費)の料金')) $err['op_door_price'] = $err_mes;

		if(isset($_POST['op_board_flg']) && $err_mes=Validate::Required($_POST['op_board_price'], '共用部社名看板の初作成費')) $err['op_board_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_board_price'], '共用部社名看板の初作成費')) $err['op_board_price'] = $err_mes;
		if(isset($_POST['op_board_flg']) && $err_mes=Validate::Required($_POST['op_board_price_mon'], '共用部社名看板の月額回線費')) $err['op_board_price_mon'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_board_price_mon'], '共用部社名看板の月額回線費')) $err['op_board_price_mon'] = $err_mes;

		if(isset($_POST['op_key_flg']) && $err_mes=Validate::Required($_POST['op_key_price'], '鍵(2つめ以上の場合)の料金')) $err['op_key_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_key_price'], '鍵(2つめ以上の場合)の料金')) $err['op_key_price'] = $err_mes;

		if(isset($_POST['op_security_flg']) && $err_mes=Validate::Required($_POST['op_security_price'], 'セキュリティカード(2つめ以上の場合)の料金')) $err['op_security_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_security_price'], 'セキュリティカード(2つめ以上の場合)の料金')) $err['op_security_price'] = $err_mes;

		if(isset($_POST['op_build_flg']) && $err_mes=Validate::Required($_POST['op_build_price'], 'ビル用セキュリティカード(2つめ以上の場合)の料金')) $err['op_build_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_build_price'], 'ビル用セキュリティカード(2つめ以上の場合)の料金')) $err['op_build_price'] = $err_mes;

		if(isset($_POST['op_locker_flg']) && $err_mes=Validate::Required($_POST['op_locker_price'], '貸しロッカーの料金')) $err['op_locker_price'] = $err_mes;
		elseif($err_mes=Validate::Number($_POST['op_locker_price'], '貸しロッカーの料金')) $err['op_locker_price'] = $err_mes;

		// flgデータに数値を代入 空文字を削除
		$flg_arr = array(
				'op_rental_flg',
				'op_tel_flg',
				'op_fax_flg',
				'op_answer_flg',
				'op_door_flg',
				'op_board_flg',
				'op_key_flg',
				'op_security_flg',
				'op_build_flg',
				'op_locker_flg'
			);

		foreach($datas as $key=>$val) {
			if(mb_substr($key, -4) == "_flg") {
				$datas[$key] = 1;
			} elseif($val == "") {
				$datas[$key] = null;
			}
		}

		foreach($flg_arr as $val) {
			if(!isset($datas[$val])) $datas[$val] = 0;
		}

		// 登録実行処理
		if(empty($err)) {
			if($new_flg) {
				$dbClass->beginTransaction();
				try{
					$dbClass->InsertNoCatch('m_center', $datas);

					$dbClass->commit();

					$_SESSION['message'] = "登録が完了しました。";
					header("Location: ".ROOT_URL."center_detail.php?c_id=".$datas['center_id']);
					exit;
				} catch (Exception $e) {
					$dbClass->rollBack();
					$err['data'] = "データの新規作成に失敗しました。";
				}
			} else {
				unset($datas["c_id"]);

				$dbClass->beginTransaction();
				try{
					$dbClass->UpdateNoCatch('m_center', $datas, 'center_id = :c_id', array('c_id'=>$id));

					$dbClass->commit();

					$_SESSION['message'] = "更新が完了しました。";
					header("Location: ".ROOT_URL."center_detail.php?c_id=".$id);
					exit;
				} catch (Exception $e) {
					$dbClass->rollBack();
					$err['data'] = "データの更新に失敗しました。";
				}
			}
		}
	// 修正時の初期値設定
	} elseif(!$new_flg) {
		$datas = $dbClass->SelectOne("SELECT * FROM m_center WHERE center_id = :c_id", array("c_id"=>$_REQUEST['c_id']));
	}

	// 表示データのエスケープ
	foreach($datas as $key=>$val) {
		$datas[$key] = GetEscapeHtmlText($val);
	}
}
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Openoffece WEBサイト更新システム</title>
<link rel="stylesheet" href="css/normalize.css" type="text/css" media="all">
<link rel="stylesheet" href="css/style.css" type="text/css" media="all">
<link rel="stylesheet" href="css/layout.css" type="text/css" media="all">

<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
$(function(){
<?php foreach($err as $key=>$val): ?>
$('input[name=<?php echo $key; ?>]').css( "background-color", "rgb(252, 216, 217)" );
<?php endforeach; ?>
});
</script>
</head>

<body>
<?php include ('common/header.php'); ?>

<div id="login-page">
	<div class="BoxCen clearfix">
		<div class="flR"><p class="btnDelete btnBack"><a href="center_list.php">センター 一覧に戻る</a></p></div>
	</div>

	<div class="err">
	<?php
		if(!empty($err)) {
			foreach($err as $val) {
				echo '<p>'.$val.'</p>';
			}
		}

		if(!empty($message)) echo '<p>'.$message.'</p>';
	?>
	</div>

	<div class="menu">
		<h2 class="form-login-heading">センター情報を設定してください</h2>
		<div class="center1-wrap clearfix">
			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="center">
				<table class="offDtail">
				<?php if($new_flg): ?>
					<tr>
						<th>センターID</th>
						<td><input type="text" name="center_id" class="nor3" value="<?php echo $datas['center_id']; ?>" /></td>
					</tr>
				<?php else: ?>
					<tr>
						<th>センターID</th>
						<td><?php echo $id; ?></td>
						<input type="hidden" name="c_id" value="<?php echo $id; ?>" />
					</tr>
				<?php endif; ?>
					<tr>
						<th>センター名</th>
						<td><input type="text" name="name" class="nor5" value="<?php echo $datas['name']; ?>" /></td>
					</tr>
					<tr>
						<th>センターページURL</th>
						<td>http://www.openoffice.co.jp/openoffice/<input type="text" name="url" class="nor3" value="<?php echo $datas['url']; ?>" /></td>
					</tr>
				</table>

				<p class="centName">対応可能なオプションと料金</p>

				<dl class="cenDtl01">
					<dt><input type="checkbox" name="op_rental_flg" id="checkbox01" <?php echo ($datas["op_rental_flg"]==1)? 'checked="checked"':''; ?> /> レンタル家具</dt>
					<dd><input type="text" name="op_rental_price" class="nor3" value="<?php echo $datas['op_rental_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_tel_flg" id="checkbox02" <?php echo ($datas["op_tel_flg"]==1)? 'checked="checked"':''; ?> /> 電話</dt>
					<dd>初期設定費 <input type="text" name="op_tel_price" class="nor3" value="<?php echo $datas['op_tel_price']; ?>" /> 円<hr>月額回線費 <input type="text" name="op_tel_price_mon" class="nor3" value="<?php echo $datas['op_tel_price_mon']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_fax_flg" id="checkbox03" <?php echo ($datas["op_fax_flg"]==1)? 'checked="checked"':''; ?> /> FAX</dt>
					<dd>初期設定費 <input type="text" name="op_fax_price" class="nor3" value="<?php echo $datas['op_fax_price']; ?>" /> 円<hr>月額回線費 <input type="text" name="op_fax_price_mon" class="nor3" value="<?php echo $datas['op_fax_price_mon']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_answer_flg" id="checkbox04" <?php echo ($datas["op_answer_flg"]==1)? 'checked="checked"':''; ?> /> 電話対応</dt>
					<dd><input type="text" name="op_answer_price" class="nor3" value="<?php echo $datas['op_answer_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_door_flg" id="checkbox05" <?php echo ($datas["op_door_flg"]==1)? 'checked="checked"':''; ?> />ドア付社名プレート（作成費）</dt>
					<dd><input type="text" name="op_door_price" class="nor3" value="<?php echo $datas['op_door_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_board_flg" id="checkbox06" <?php echo ($datas["op_board_flg"]==1)? 'checked="checked"':''; ?> /> 共用部社名看板</dt>
					<dd>初作成費 <input type="text" name="op_board_price" class="nor3" value="<?php echo $datas['op_board_price']; ?>" /> 円<hr>月額回線費 <input type="text" name="op_board_price_mon" class="nor3" value="<?php echo $datas['op_board_price_mon']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_key_flg" id="checkbox07" <?php echo ($datas["op_key_flg"]==1)? 'checked="checked"':''; ?> /> 鍵（2つめ以上の場合）</dt>
					<dd><input type="text" name="op_key_price" class="nor3" value="<?php echo $datas['op_key_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_security_flg" id="checkbox08" <?php echo ($datas["op_security_flg"]==1)? 'checked="checked"':''; ?> /> セキュリティカード（2つめ以上の場合）</dt>
					<dd><input type="text" name="op_security_price" class="nor3" value="<?php echo $datas['op_security_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_build_flg" id="checkbox09" <?php echo ($datas["op_build_flg"]==1)? 'checked="checked"':''; ?> /> ビル用セキュリティカード（2つめ以上の場合）</dt>
					<dd><input type="text" name="op_build_price" class="nor3" value="<?php echo $datas['op_build_price']; ?>" /> 円</dd>

					<dt><input type="checkbox" name="op_locker_flg" id="checkbox10" <?php echo ($datas["op_locker_flg"]==1)? 'checked="checked"':''; ?> /> 貸しロッカー</dt>
					<dd class="none"><input type="text" name="op_locker_price" class="nor3" value="<?php echo $datas['op_locker_price']; ?>" /> 円</dd>
				</dl>

				<?php if($new_flg || !empty($id)): ?>
				<div class="cffReNewB"><p class="btnReNew btnOffReNew"><a href="javascript:void(0)" onclick="document.center.submit();return false;">更新</a></p></div>
				<?php endif; ?>
			</form>
		</div><!--/center1-wra--//-->
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
