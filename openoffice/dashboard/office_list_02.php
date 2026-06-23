<?php
include_once(dirname(__FILE__).'/library/openClass.php');
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

// idの整合性チェック
if(isset($_REQUEST['c_id'])) {
	$check_res = $dbClass->SelectOne("SELECT COUNT(*) AS cnt, name FROM m_center WHERE center_id = :c_id", array("c_id"=>$_REQUEST['c_id']));
	if($check_res['cnt'] != 1) $err["check"] = "存在しないIDが指定されました。";
	else $id = $_REQUEST['c_id'];
} else {
	$err["check"] = "不正なページ移動です。";
}

// 一覧取得
if(empty($err)) {
	// 削除処理
	if(isset($_POST["del"])) {
		$dbClass->beginTransaction();
		try{
			if($dbClass->DeleteNoCatch("m_office", "center_id = :c_id AND num = :o_id", array("c_id"=>$_POST["c_id"], "o_id"=>$_POST["del"]))) {
				$dbClass->commit();
				$_SESSION["message"] = "オフィスの削除が完了しました。";
				header("Location: ".ROOT_URL."office_list_02.php?c_id=".$_POST["c_id"]);
				exit;
			}
		} catch (Exception $e) {
			$dbClass->rollBack();
			$script = 'alert("データの削除に失敗しました。");';
		}
	}

	$datas = $dbClass->Select("SELECT num FROM m_office WHERE center_id = :c_id", array('c_id'=>$_REQUEST['c_id']));
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
</head>

<script src="js/jquery-1.11.3.min.js" type="text/javascript"></script>
<script type="text/javascript">
function fncDelCheck(num) {
	if(window.confirm('選択したオフィスを削除します。\nよろしいですか？')){
		fncDelSubmit(num);
	}
}

function fncDelSubmit(num) {
	$('<input>').attr({
	    type: 'hidden',
	    name: 'del',
	    value: num
	}).appendTo('#office_form_del');

	$('#office_form_del').submit();
}
</script>

<body>
<?php include ('common/header.php'); ?>

<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="office_form_del" id="office_form_del">
	<input type="hidden" name="c_id" value="<?php echo $id; ?>" />
</form>

<div id="login-page">
	<div class="BoxCen clearfix">
		<div class="flL"><p><?php echo $check_res['name']; ?></p></div>
		<div class="flR2"><p class="btnDelete btnMenu"><a href="office_list_01.php">センター 一覧に戻る</a></p></div>
		<div class="flR"><p class="btnNew"><a href="office_detail.php?c_id=<?php echo $id; ?>">新規登録</a></p></div>
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
		<h2 class="form-login-heading">更新するオフィスをお選びください</h2>
		<div class="list-wrap clearfix">
			<?php foreach($datas as $val): ?>
			<div class="center1">
				<dl>
					<dt><?php echo $val['num']; ?></dt>
					<dd>
						<p class="btnReNew"><a href="office_detail.php?c_id=<?php echo $id; ?>&o_id=<?php echo $val['num']; ?>">更新</a></p>
						<p class="btnDelete"><a href="javascript:void(0)"  onclick="fncDelCheck('<?php echo $val['num']; ?>');">削除</a></p>
					</dd>
				</dl>
			</div>
			<?php endforeach; ?>
		</div><!--/center1-wra--//-->
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
