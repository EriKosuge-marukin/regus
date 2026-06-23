<?php
include_once(dirname(__FILE__).'/library/openClass.php');
if(!isset($_SESSION['session_id'])){
	header('Location: '.ROOT_URL.'login.php');
	exit;
}

$dbClass = new openClass($config);
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
</head>

<body>
<?php include ('common/header.php'); ?>

<div id="login-page">
	<div class="boxList clearfix">
		<div class="flR2"><p class="btnDelete btnMenu"><a href="menu.php">メニューへ戻る</a></p></div>
	</div>

	<div class="menu">
		<h2 class="form-login-heading">更新するセンターをお選びください</h2>
		<div class="list-wrap clearfix">
			<?php foreach($datas as $val): ?>
			<div class="centerSelect">
				<dl>
					<dt><?php echo $val['name']; ?></dt>
					<dd><p class="btnReNew"><a href="office_list_02.php?c_id=<?php echo $val['center_id']; ?>">選択</a></p></dd>
				</dl>
			</div>
			<?php endforeach; ?>
		</div><!--/center1-wra--//-->
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
