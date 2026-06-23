<?php
session_start();

$sequence = filter_input(INPUT_POST, "sequence", FILTER_SANITIZE_SPECIAL_CHARS);

if (is_null($sequence) && filter_input(INPUT_GET, "page", FILTER_SANITIZE_SPECIAL_CHARS) == "thanks" && $_SESSION["unique_key"] == filter_input(INPUT_GET, "key", FILTER_SANITIZE_SPECIAL_CHARS)) {
    $sequence = "thanks";
    session_destroy();
} else {
    if (is_null($_SESSION["unique_key"]) || $_SESSION["unique_key"] != filter_input(INPUT_POST, "unique_key", FILTER_SANITIZE_SPECIAL_CHARS)) {
        $unique_key = md5(uniqid());
        $_SESSION["unique_key"] = $unique_key;
        $sequence = NULL;
    } else {
        $unique_key = $_SESSION["unique_key"];
    }
    require_once "./parameters.php";
    $error = array();
    for ($i = 0; $i < count($requireTag); $i++) {
        $error[$requireTag[$i]] = false;
    }
    $error["emailCheck"] = false;
}

$isAdminSend = true;

if ($sequence == "confirm") {
    for ($i = 0; $i < count($checkTag); $i++) {
        if(is_array($_POST[$checkTag[$i]])){
            $_SESSION[$checkTag[$i]] = array();
            foreach($_POST[$checkTag[$i]] as $key=>$value){
                $_SESSION[$checkTag[$i]][$key] = filter_var($value, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }else{
            $_SESSION[$checkTag[$i]] = filter_input(INPUT_POST, $checkTag[$i], FILTER_SANITIZE_SPECIAL_CHARS);
        }
    }
    $errorCount = 0;
    for ($i = 0; $i < count($requireTag); $i++) {
        if(is_array($_SESSION[$requireTag[$i]])){
            if(count($_SESSION[$requireTag[$i]]) == 0){
                $error[$requireTag[$i]] = true;
                $errorCount++;
            }
        }else{
            if ($_SESSION[$requireTag[$i]] == "") {
                $error[$requireTag[$i]] = true;
                $errorCount++;
            }
        }
    }

    if ($_SESSION["email"] != "") {
        if (!filter_var($_SESSION["email"], FILTER_VALIDATE_EMAIL)) {
            $error["emailCheck"] = true;
            $errorCount++;
        }
    }

    if ($errorCount > 0) {
        $sequence = NULL;
    }
}else if($sequence == "send"){
    mb_language("japanese");
    mb_internal_encoding("UTF-8");
    require_once "./PHPMailer/class.phpmailer.php";

    $weekday = array("日","月","火","水","木","金","土");
    $currentDate = date("Y年m月d日") . "(" . $weekday[date("w")] . ")";

    require_once "./mailConfig.php";

    $adminMail = new PHPMailer();
    $adminMail->isSendmail();
    $adminMail->From = $from;
    $adminMail->FromName = mb_encode_mimeheader(mb_convert_encoding($fromName, "JIS", "UTF-8"));
    foreach($to as $value){
        $adminMail->addAddress($value);
    }
    $adminMail->Subject = mb_encode_mimeheader(mb_convert_encoding($adminSubject, "JIS", "UTF-8"));
    $adminMail->CharSet = "iso-2022-jp";
    $adminMail->Encoding = "7bit";
    $adminMail->Body = str_replace("\r\n", "\n", mb_convert_encoding($adminBody, "JIS", "UTF-8"));
    $isAdminSend = $adminMail->send();

    if($isAdminSend){
        header("Location: ./?page=thanks&key=" . $_SESSION["unique_key"]);
        exit;
    }
}

require_once "./template/header.php";
if($sequence == "confirm" || !$isAdminSend){
    require_once "./template/bodyConfirm.php";
}else if($sequence == "thanks"){
    require_once "./template/bodyThanks.php";
}else{
    require_once "./template/bodyForm.php";
}
require_once "./template/footer.php";