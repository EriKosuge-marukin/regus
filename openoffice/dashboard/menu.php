<?php
include_once(dirname(__FILE__).'/library/openClass.php');
if(!isset($_SESSION['session_id'])){
	header('Location: '.ROOT_URL.'login.php');
	exit;
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

<body>
<?php include ('common/header.php'); ?>

<div id="login-page">
	<div class="container mgT100">
		<div class="menu">
			<h2 class="form-login-heading">メニューをお選びください。</h2>
			<div class="menu-wrap clearfix">
				<p class="button mgR20"><a href="office_list_01.php">オフィス情報の登録・更新・削除</a></p>
				<p class="buttonB"><a href="center_list.php">センター情報の登録・更新・削除</a></p>
			</div>
		</div>
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
