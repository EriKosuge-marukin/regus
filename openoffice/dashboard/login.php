<?php
include_once(dirname(__FILE__).'/library/openClass.php');

if(isset($_SESSION['session_id'])){
	// header('Location: '.ROOT_URL.'menu.php');
	// ログアウト処理がないので一時的にセッション削除
	session_destroy();
	session_start();
}

$datas = array();

if(!empty($_POST)) {
	if(!empty($_POST['login_id']) && !empty($_POST['login_pass'])) $post = $_POST;

	if($post['login_id'] === LOGIN_ID && $post['login_pass'] === LOGIN_PW) {
		// セッションに保存
		$_SESSION['session_id'] = $post['login_id'];

		header('Location: menu.php');
		exit;
	} else {
		$script = '$(".err").html("ログインIDもしくはパスワードが間違っています。");';
		// 表示データのエスケープ
		foreach($post as $name=>$val) {
			$datas[$name] = GetEscapeHtmlText($val);
		}
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
<script>
$(function(){
	<?php echo $script ?>

	$('#login_id').keypress(function (e) {
		if (e.which == 13) {
			$("#login_pass").focus();
		}
	} );
});

function funcInputCheck() {
	var msg = "";
	if($("#login_id").val().length == 0){
		msg += "<p>ログインIDを入力してください</p>";
	}
	if($("#login_pass").val().length == 0){
		msg += "<p>パスワードを入力してください</p>";
	}
	if(msg) {
		$(".err").html(msg);
		return false;
	} else {
		return true;
	}
}
</script>
</head>

<body>
<?php include ('common/header.php'); ?>

<div id="login-page">
	<div class="container">
		<div class="form-login">
			<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>" method="post" name="login" onSubmit="return funcInputCheck();">
				<h2 class="form-login-heading">LOGIN</h2>
				<div class="err"></div>
				<div class="login-wrap">
					<input name="login_id" id="login_id" value="<?php echo $datas['login_id']; ?>" type="text" placeholder="ID">
					<input name="login_pass" id="login_pass" type="password" value=<?php echo $datas['login_pass']; ?>"" placeholder="パスワード">
					<p class="mgT40 txaC"><input type="submit" name="btn_submit" value="" class="btnLogin" /></p>
				</div>
			</form>
		</div>
	</div>
</div>

<?php include ('common/footer.php'); ?>
</body>
</html>
