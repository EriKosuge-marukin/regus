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

// 削除処理
if(isset($_POST["del"])) {
	$dbClass->beginTransaction();
	try{
		if($dbClass->DeleteNoCatch("m_center", "center_id = :c_id", array("c_id"=>$_POST["del"]))) {
			$dbClass->commit();
			$_SESSION["message"] = "センターの削除が完了しました。";
			header("Location: ".ROOT_URL."center_list.php");
			exit;
		}
	} catch (Exception $e) {
		$dbClass->rollBack();
		$script = 'alert("データの削除に失敗しました。");';
	}
}

$datas = $dbClass->Select('SELECT center_id, name FROM m_center ORDER BY center_id');
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
<?php echo $script; ?>

function fncDelCheck(id) {
	if(window.confirm('センターに関連したオフィス情報もすべて削除されます。\nよろしいですか？')){
		fncDelSubmit(id);
	}
}

function fncDelSubmit(id) {
	$('<input>').attr({
	    type: 'hidden',
	    name: 'del',
	    value: id
	}).appendTo('#del_form');

	$('#del_form').submit();
}
</script>
</head>

<body>
<?php include ('common/header.php'); ?>

<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="del_form" id="del_form"></form>

<div id="login-page">
	<div class="boxList clearfix">
		<div class="flR2"><p class="btnDelete btnMenu"><a href="menu.php">メニューへ戻る</a></p></div>
		<div class="flR"><p class="btnNew"><a href="center_detail.php">新規登録</a></p></div>
	</div>

	<div class="err">
	<?php
		if(!empty($message)) echo '<p>'.$message.'</p>';
	?>
	</div>

	<div class="menu">
		<h2 class="form-login-heading">更新するセンターをお選びください</h2>
		<div class="list-wrap clearfix">
			<?php foreach($datas as $val): ?>
			<div class="center1">
				<dl>
					<dt><?php echo $val['name']; ?></dt>
					<dd>
						<p class="btnReNew"><a href="center_detail.php?c_id=<?php echo $val['center_id']; ?>">更新</a></p>
						<p class="btnDelete"><a href="javascript:void(0)" onclick="fncDelCheck('<?php echo $val['center_id']; ?>');">削除</a></p>
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
