// オプション選択画面用
function funcInputCheck01() {
	var msg = "";
	if(
		$("select[name='year']").val().length == 0 ||
		$("select[name='month']").val().length == 0 ||
		$("select[name='day']").val().length == 0
	){
		msg += "利用開始年月日を選択してください。\n";
	}
	if(
		$("input[name='op_key']").is(':checked') &&
		$("select[name='op_key_cnt']").val().length == 0
	){
		msg += "鍵の個数を選択してください。\n";
	}
	if(
		$("input[name='op_build']").is(':checked') &&
		$("select[name='op_build_cnt']").val().length == 0
	){
		msg += "ビル用セキュリティカードの枚数を選択してください。\n";
	}
	if(
		$("input[name='op_security']").is(':checked') &&
		$("select[name='op_security_cnt']").val().length == 0
	){
		msg += "セキュリティカードの枚数を選択してください。\n";
	}
	if(
		$("input[name='op_rental']").is(':checked') &&
		$("select[name='op_rental_cnt']").val().length == 0
	){
		msg += "レンタル家具の個数を選択してください。\n";
	}
	if(
		$("input[name='op_tel']").is(':checked') &&
		$("select[name='op_tel_cnt']").val().length == 0
	){
		msg += "電話の個数を選択してください。\n";
	}
	if(
		$("input[name='op_fax']").is(':checked') &&
		$("select[name='op_fax_cnt']").val().length == 0
	){
		msg += "FAXの個数を選択してください。\n";
	}
	if(msg) {
		alert(msg);
		return false;
	} else {
		return true;
	}
}

// メール入力画面用
function funcInputCheck03() {
	var msg = "";

	if($("input[name='fr_comp_name']").val().length == 0) {
		msg += "社名を入力してください。\n";
	}

	if($("input[name='fr_resp_name']").val().length == 0) {
		msg += "担当者名を入力してください。\n";
	}

	if($("input[name='fr_mail']").val().length == 0) {
		msg += "メールアドレスを入力してください。\n";
	} else if(!$("input[name='fr_mail']").val().match(/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/)) {
		msg += "メールアドレスが正しくありません。\n";
	}

	if($("input[name='fr_tel']").val().length == 0) {
		msg += "電話番号を入力してください。\n";
	}

	if($("#fr_add01").val().length == 0) {
		msg += "郵便番号を入力してください。\n";
	}

	if($("#fr_add02").val().length == 0) {
		msg += "都道府県を入力してください。\n";
	}

	if($("#fr_add03").val().length == 0) {
		msg += "市区町村・番地を入力してください。\n";
	}

	if(
		!($("input[name='check1']").is(':checked') &&
		$("input[name='check2']").is(':checked') &&
		$("input[name='check3']").is(':checked'))
	){
		msg += "確認項目に未チェックの項目があります。\n";
	}

	if(msg) {
		alert(msg);
		return false;
	} else {
		return true;
	}
}