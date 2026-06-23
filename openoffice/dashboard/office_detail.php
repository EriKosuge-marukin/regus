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

$new_flg = true; // 新規の場合true

// 2桁に数字を直す関数
function digitTwo($num) {
	return sprintf('%02d', $num);
}

if(isset($_REQUEST['c_id'])) {
	// IDの整合性チェック
	$check_res1 = $dbClass->SelectOne("SELECT COUNT(*) AS cnt, name FROM m_center WHERE center_id = :c_id", array("c_id"=>$_REQUEST['c_id']));
	if($check_res1['cnt'] != 1) $err["check"] = "存在しないセンターIDが指定されました。";
	else $id = $_REQUEST['c_id'];

	// 新規・修正の確認
	if(empty($err) && isset($_REQUEST['o_id'])) {
		$new_flg = false;
		$check_res2 = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE  center_id = :c_id AND num = :o_id", array("c_id"=>$_REQUEST['c_id'], "o_id"=>$_REQUEST['o_id']));
		if($check_res2['cnt'] != 1) $err["check"] = "存在しないオフィス番号が指定されました。";
		else $o_num = $_REQUEST['o_id'];
	}

} else {
	$err['check'] = '不正なページ移動です。';
}

// メイン処理
if(empty($err)) {
	// 登録処理
	if(!empty($_POST)) {
		$datas = $_POST;

		// エラーチェック
		// 新規必須項目
		if($new_flg) {
			// オフィス番号
			if($err_mes=Validate::Required($_POST['num'], 'オフィス番号')) {
				$err['num'] = $err_mes;
			} else {
				$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt FROM m_office WHERE  center_id = :c_id AND num = :o_id", array("c_id"=>$id, "o_id"=>$_POST['num']));
				if($check_res['cnt'] >= 1) $err['num'] = '既に使用されているオフィス番号です。';
			}

			// オフィス画像有無
			if(empty($_FILES['file_input']['name'])) $err['file_text']  = "オフィス画像が設定されていません。";
		}

		// 可能期間判定用配列
		$period_arr = array(
				'1'=>array('period_sta_y1'=>'ご利用可能期間-開始年','period_sta_m1'=>'ご利用可能期間-開始月','period_sta_d1'=>'ご利用可能期間-開始日'),
				'2'=>array('period_end_y2'=>'ご利用可能期間-終了年','period_end_m2'=>'ご利用可能期間-終了月','period_end_d2'=>'ご利用可能期間-終了日'),
				'3'=>array('period_sta_y3'=>'ご利用可能期間-開始年','period_sta_m3'=>'ご利用可能期間-開始月','period_sta_d3'=>'ご利用可能期間-開始日',
					'period_end_y3'=>'ご利用可能期間-終了年','period_end_m3'=>'ご利用可能期間-終了月','period_end_d3'=>'ご利用可能期間-終了日'),
				'4'=>array('period_end_y4'=>'ご利用可能期間-終了年','period_end_m4'=>'ご利用可能期間-終了月','period_end_d4'=>'ご利用可能期間-終了日',
					'period_sta_y4'=>'ご利用可能期間-開始年','period_sta_m4'=>'ご利用可能期間-開始月','period_sta_d4'=>'ご利用可能期間-開始日')
				);
		$emp_date_flg = true; // 日付入力エラー判別フラグ(false:エラー)
		if($_POST['period_flg'] != 0) {
			foreach($period_arr[$_POST['period_flg']] as $key=>$val) {
				if(empty($_POST[$key])) {
					// 選択した可能期間の要素が空だった場合エラー
					$err[$key] = $val."を入力してください。";
					$emp_date_flg = false;
				}
			}
			// 可能期間データの生成(日付型チェック)
			if($emp_date_flg) {
				$per_num = $_POST['period_flg'];
				if($_POST['period_flg'] != 2) {
					$datas['period_sta'] = $_POST['period_sta_y'.$per_num].'-'.digitTwo($_POST['period_sta_m'.$per_num]).'-'.digitTwo($_POST['period_sta_d'.$per_num]);
					if($err_mes=Validate::Date($datas['period_sta'], 'ご利用可能期間-開始', '-')) $err['period_sta'] = $err_mes;
				}
				if($_POST['period_flg'] != 1) {
					$datas['period_end'] = $_POST['period_end_y'.$per_num].'-'.digitTwo($_POST['period_end_m'.$per_num]).'-'.digitTwo($_POST['period_end_d'.$per_num]);
					if($err_mes=Validate::Date($datas['period_end'], 'ご利用可能期間-終了', '-')) $err['period_end'] = $err_mes;
				}
			}
		}

		// 正数値要素名格納用配列
		$num_arr = array(
				'price_1mon'=>'ご利用料(1ヶ月)',
				'price_6mon'=>'ご利用料(6ヶ月)',
				'price_12mon'=>'ご利用料(12ヶ月)',
				'price_24mon'=>'ご利用料(24ヶ月)',
				'public'=>'共益費',
				'admission'=>'入会金',
				'security_1mon'=>'保証金(1ヶ月)',
				'security_6mon'=>'保証金(6ヶ月)',
				'security_12mon'=>'保証金(12ヶ月)',
				'security_24mon'=>'保証金(24ヶ月)',
				'exit_pri'=>'退去料'
				);
		// 必須・正数型チェック
		foreach($num_arr as $key=>$val) {
			if($err_mes=Validate::Required($_POST[$key], $val)) $err[$key] = $err_mes;
			elseif($err_mes=Validate::Number($_POST[$key], $val)) $err[$key] = $err_mes;
		}

		// 広さ(必須・小数点)
		if($err_mes=Validate::Required($_POST['breadth'], '広さ')) $err['breadth'] = $err_mes;
		elseif($err_mes=Validate::Numeric($_POST['breadth'], '広さ', 3)) $err['breadth'] = $err_mes;

		// ご利用人数(必須)
		if($err_mes=Validate::Required($_POST['people'], 'ご利用人数')) $err['people'] = $err_mes;

		// フロア(必須)
		if($err_mes=Validate::Required($_POST['floor'], 'フロア')) $err['floor'] = $err_mes;

		// オフィスの説明文(必須・300文字以内)
		if($err_mes=Validate::Required($_POST['description'], 'オフィスの説明文')) $err['description'] = $err_mes;
		elseif($err_mes=Validate::MaxLength($_POST['description'], 300, 'オフィスの説明文')) $err['description'] = $err_mes;

		// ファイルの確認(ファイル形式・大きさなど)
		if(!empty($_FILES['file_input']['name'])) {
			$type = @exif_imagetype($_FILES['file_input']['tmp_name']);
			$files = array(IMAGETYPE_GIF, IMAGETYPE_JPEG, IMAGETYPE_PNG);
			if (!in_array($type, $files, true)) {
				$err['file_text'] = "オフィス画像はJPEG/PNG/GIFのいずれかの形式にしてください。";
			}

			if($_FILES['upfile']['error'] == "UPLOAD_ERR_INI_SIZE") $err['file_text'] = "オフィス画像のサイズが大きすぎます。";
		}

		// 登録実行処理
		if(empty($err)) {
			$regist_arr = $datas; // 登録データ用配列
			$regist_arr['center_id'] = $datas['c_id'];

			// ご利用可能期間の削除
			foreach($period_arr as $key=>$val) {
				foreach($val as $key2=>$val2) {
					unset($regist_arr[$key2]);
				}
			}
			unset($regist_arr['c_id']);

			// ファイル名の生成
			if(!empty($_FILES['file_input']['name'])) {
				$regist_arr['image_path'] = $datas['c_id'].'o'.$datas['num'].image_type_to_extension($type);
				if (!move_uploaded_file($_FILES['file_input']['tmp_name'], dirname(__FILE__).'/../img_estimate/ws/'.$regist_arr['image_path'])) {
					$err['data'] = 'オフィス画像の保存に失敗しました。';
				}
			}

			if(empty($err)) {
				$dbClass->beginTransaction();
				try{
					if($new_flg) {
						$dbClass->InsertNoCatch('m_office', $regist_arr);
						$dbClass->commit();
						$_SESSION['message'] = "登録が完了しました。";
					} else {
						unset($regist_arr['center_id'], $regist_arr['num'], $regist_arr['o_id']);
						$dbClass->UpdateNoCatch('m_office', $regist_arr, 'center_id = :c_id AND num = :o_id', array('c_id'=>$id, 'o_id'=>$o_num));
						$dbClass->commit();
						$_SESSION['message'] = "更新が完了しました。";
					}
					header('Location: '.ROOT_URL.'office_detail.php?c_id='.$id.'&o_id='.$datas['num']);
					exit;
				} catch (Exception $e) {
					$dbClass->rollBack();
					$err['data'] = "データの更新に失敗しました。";
				}
			}
		}
	// 修正時の初期値設定
	} elseif(!$new_flg) {
		$datas = $dbClass->SelectOne(
				"SELECT * FROM m_office WHERE center_id = :c_id AND num = :o_id",
				array("c_id"=>$_REQUEST['c_id'], "o_id"=>$_REQUEST['o_id'])
			);
		if(!empty($datas['period_sta'])) {
			$sta_date = explode('-', mb_substr($datas['period_sta'], 0, 10));
			$datas['period_sta_y'.$datas['period_flg']] = $sta_date[0];
			$datas['period_sta_m'.$datas['period_flg']] = $sta_date[1];
			$datas['period_sta_d'.$datas['period_flg']] = $sta_date[2];
		}

		if(!empty($datas['period_end'])) {
			$end_date = explode('-', mb_substr($datas['period_end'], 0, 10));
			$datas['period_end_y'.$datas['period_flg']] = $end_date[0];
			$datas['period_end_m'.$datas['period_flg']] = $end_date[1];
			$datas['period_end_d'.$datas['period_flg']] = $end_date[2];
		}
	}

	// 表示データのエスケープ
	foreach($datas as $key=>$val) {
		if($key == 'description') $datas[$key] = GetEscapeInputVal($val);
		else $datas[$key] = GetEscapeHtmlText($val);
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
function fnSetFileName(id, value){
	$("#"+id).val(value.split(/(\\|\/)/g).pop())
}

$(function(){
	<?php foreach($err as $key=>$val): ?>
		<?php if($key == "period_sta" || $key == "period_end"): ?>
	$('input[name=<?php echo $key.'_y'.$datas['period_flg']; ?>]').css( "background-color", "rgb(252, 216, 217)" );
	$('input[name=<?php echo $key.'_m'.$datas['period_flg']; ?>]').css( "background-color", "rgb(252, 216, 217)" );
	$('input[name=<?php echo $key.'_d'.$datas['period_flg']; ?>]').css( "background-color", "rgb(252, 216, 217)" );
		<?php elseif($key == "description"): ?>
	$('textarea[name=<?php echo $key; ?>]').css( "background-color", "rgb(252, 216, 217)" );
		<?php else: ?>
	$('input[name=<?php echo $key; ?>]').css( "background-color", "rgb(252, 216, 217)" );
		<?php endif; ?>
	<?php endforeach; ?>
	});
</script>
</head>

<body>
<?php include ('common/header.php'); ?>

<div id="login-page">
	<div class="BoxCen clearfix">
		<div class="flL"><p><?php echo $check_res1['name']; ?></p></div>
		<div class="flR"><p class="btnDelete btnBack"><a href="office_list_02.php?c_id=<?php echo $id; ?>">オフィス一覧に戻る</a></p></div>
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
		<h2 class="form-login-heading">オフィス情報を設定してください</h2>
		<div class="center1-wrap clearfix">
			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="office" enctype="multipart/form-data">
				<table class="offDtail">
					<input type="hidden" name="c_id" value="<?php echo $id; ?>" />

					<?php if($new_flg): ?>
					<tr>
						<th>オフィス番号</th>
						<td><input type="text" name="num" value="<?php echo $datas['num']; ?>" class="nor" /></td>
					</tr>
					<?php else: ?>
					<tr>
						<th>オフィス番号</th>
						<td>
							<?php echo $o_num; ?>
							<input type="hidden" name="num" value="<?php echo $datas['num']; ?>" />
							<input type="hidden" name="o_id" value="<?php echo $o_num; ?>" />
						</td>
					</tr>
					<?php endif; ?>
					<tr>
						<th>フロア</th>
						<td><input type="text" name="floor" value="<?php echo $datas['floor']; ?>" class="nor2" /> F</td>
					</tr>
					<tr>
						<th>利用状況</th>
						<td>
							<ul class="offDtail01B">
								<li>
									<input type="radio" name="use_flg" value="0" <?php echo ($new_flg || $datas['use_flg'] == 0)? 'checked="checked"':''; ?> id="radioRsv01" />
									<label for="radioRsv01" class="radio">即入居可</label>
								</li>
								<li>
									<input type="radio" name="use_flg" value="1" <?php echo ($datas['use_flg'] == 1)? 'checked="checked"':''; ?> id="radioRsv02" />
									<label for="radioRsv02" class="radio">利用中</label>
								</li>
								<li>
									<input type="radio" name="use_flg" value="2" <?php echo ($datas['use_flg'] == 2)? 'checked="checked"':''; ?> id="radioRsv03" />
									<label for="radioRsv03" class="radio">予約受付可</label>
								</li>
							</ul>
						</td>
					</tr>
					<tr>
						<th>ご利用可能期間</th>
						<td>
							<dl class="inputtable">
								<dt><input type="radio" name="period_flg" value="0" <?php echo ($new_flg || $datas['period_flg'] == 0)? 'checked="checked"':''; ?> checked id="radio01" /></dt>
								<dd><p>表示しない</p></dd>

								<dt><input type="radio" name="period_flg" <?php echo ($datas['period_flg'] == 1)? 'checked="checked"':''; ?> value="1" id="radio02" /></dt>
								<dd>
									<p><input type="text" name="period_sta_y1" value="<?php echo $datas['period_sta_y1']; ?>" class="nor3" /> 年  <input type="text" name="period_sta_m1" value="<?php echo $datas['period_sta_m1']; ?>" class="nor2" /> 月  <input type="text" name="period_sta_d1" value="<?php echo $datas['period_sta_d1']; ?>" class="nor2" /> 日から利用可</p>
								</dd>

								<dt><input type="radio" name="period_flg" <?php echo ($datas['period_flg'] == 2)? 'checked="checked"':''; ?> value="2" id="radio03" /></dt>
								<dd>
									<p><input type="text" name="period_end_y2" value="<?php echo $datas['period_end_y2']; ?>" class="nor3" /> 年  <input type="text" name="period_end_m2" value="<?php echo $datas['period_end_m2']; ?>" class="nor2" /> 月  <input type="text" name="period_end_d2" value="<?php echo $datas['period_end_d2']; ?>" class="nor2" /> 日まで利用可</p>
								</dd>

								<dt><input type="radio" name="period_flg" <?php echo ($datas['period_flg'] == 3)? 'checked="checked"':''; ?> value="3" id="radio05" /></dt>
								<dd>
									<p class="mgB5"><input type="text" name="period_sta_y3" value="<?php echo $datas['period_sta_y3']; ?>" class="nor3" /> 年  <input type="text" name="period_sta_m3" value="<?php echo $datas['period_sta_m3']; ?>" class="nor2" /> 月  <input type="text" name="period_sta_d3" value="<?php echo $datas['period_sta_d3']; ?>" class="nor2" /> 日から</p>
									<p><input type="text" name="period_end_y3" value="<?php echo $datas['period_end_y3']; ?>" class="nor3" /> 年  <input type="text" name="period_end_m3" value="<?php echo $datas['period_end_m3']; ?>" class="nor2" /> 月  <input type="text" name="period_end_d3" value="<?php echo $datas['period_end_d3']; ?>" class="nor2" /> 日まで利用可</p>
								</dd>

								<dt><input type="radio" name="period_flg" <?php echo ($datas['period_flg'] == 4)? 'checked="checked"':''; ?> value="4" id="radio01" /></dt>
								<dd class="none">
									<p class="mgB5"><input type="text" name="period_end_y4" value="<?php echo $datas['period_end_y4']; ?>" class="nor3" /> 年  <input type="text" name="period_end_m4" value="<?php echo $datas['period_end_m4']; ?>" class="nor2" /> 月  <input type="text" name="period_end_d4" value="<?php echo $datas['period_end_d4']; ?>" class="nor2" /> 日まで利用可</p>
									<p><input type="text" name="period_sta_y4" value="<?php echo $datas['period_sta_y4']; ?>" class="nor3" /> 年  <input type="text" name="period_sta_m4" value="<?php echo $datas['period_sta_m4']; ?>" class="nor2" /> 月  <input type="text" name="period_sta_d4" value="<?php echo $datas['period_sta_d4']; ?>" class="nor2" /> 日から利用可</p>
								</dd>
							</dl>
						</td>
					</tr>

					<tr>
						<th><p>ご利用料</p></th>
						<td>
							<dl class="offFee"><dt>1ヶ月</dt><dd><input type="text" name="price_1mon" value="<?php echo $datas['price_1mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>6ヶ月</dt><dd><input type="text" name="price_6mon" value="<?php echo $datas['price_6mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>12ヶ月</dt><dd><input type="text" name="price_12mon" value="<?php echo $datas['price_12mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>24ヶ月</dt><dd><input type="text" name="price_24mon" value="<?php echo $datas['price_24mon']; ?>" class="nor3" /> 円</dd></dl>
						</td>
					</tr>

					<tr>
						<th><p>共益費</p></th>
						<td><input type="text" name="public" value="<?php echo $datas['public']; ?>" class="nor3" /> 円</td>
					</tr>

					<tr>
						<th><p>入会金</p></th>
						<td><input type="text" name="admission" value="<?php echo $datas['admission']; ?>" class="nor3" /> 円</td>
					</tr>

					<tr>
						<th><p>保証金</p></th>
						<td>
							<dl class="offFee"><dt>1ヶ月</dt><dd><input type="text" name="security_1mon" value="<?php echo $datas['security_1mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>6ヶ月</dt><dd><input type="text" name="security_6mon" value="<?php echo $datas['security_6mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>12ヶ月</dt><dd><input type="text" name="security_12mon" value="<?php echo $datas['security_12mon']; ?>" class="nor3" /> 円</dd></dl>
							<dl class="offFee"><dt>24ヶ月</dt><dd><input type="text" name="security_24mon" value="<?php echo $datas['security_24mon']; ?>" class="nor3" /> 円</dd></dl>
						</td>
					</tr>

					<tr>
						<th><p>退去料</p></th>
						<td><input type="text" name="exit_pri" value="<?php echo $datas['exit_pri']; ?>" class="nor3" /> 円</td>
					</tr>

					<tr>
						<th><p>オフィスタイプ</p></th>
						<td>
							<ul class="offDtail01">
								<li>
									<input type="radio" name="type_flg" value="0" <?php echo ($new_flg || $datas['type_flg'] == 0)? 'checked="checked"':''; ?> id="radioPosi01" />
									<label for="radioPosi01" class="radio">窓側</label>
								</li>
								<li>
									<input type="radio" name="type_flg" value="1" <?php echo ($datas['type_flg'] == 1)? 'checked="checked"':''; ?> id="radioPosi02" />
									<label for="radioPosi02" class="radio">通路側</label>
								</li>
							</ul>
						</td>
					</tr>

					<tr>
						<th><p>広さ</p></th>
						<td><input type="text" name="breadth" value="<?php echo $datas['breadth']; ?>" class="nor3" /> m&sup2;</td>
					</tr>

					<tr>
						<th><p>ご利用人数</p></th>
						<td><input type="text" name="people" value="<?php echo $datas['people']; ?>" class="nor3" /> 名様</td>
					</tr>

					<tr>
						<th><p>オフィスの説明文</p></th>
						<td><textarea name="description" class="nor4" cols="50" rows="5"/><?php echo $datas['description']; ?></textarea></td>
					</tr>

					<tr>
						<th><p>オフィス画像</p></th>
						<td>
							<div style="display: none;"><input type="file" id="file_input" name="file_input" onchange="fnSetFileName('file_text', this.value);"/></div>
							<input type="text" name="file_text" id="file_text" class="nor5" disabled="disabled" />
							<div class="offflLBtn05"><p class="btnDelete btnRefer"><a href="javascript:void(0)" onclick="$('#file_input').trigger('click');">参照</a></p></div>
						</td>
					</tr>
				</table>

				<?php if(($new_flg && !empty($id)) || (!empty($id) && !empty($o_num))): ?>
				<div class="cffReNewB"><p class="btnReNew btnOffReNew"><a href="javascript:void(0)" onclick="document.office.submit();return false;">更新</a></p></div>
				<?php endif; ?>
			</form>
		</div><!--/center1-wra--//-->
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
