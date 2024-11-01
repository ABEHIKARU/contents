<?php

	session_start();    //セッションを開始

	require 'libs/functions.php';   //テンプレートエンジンの読み込み

	//画像認証ライブラリの読み込み(securimage)
	include_once('securimage/securimage.php');
	$securimage = new Securimage();

	//POSTされたデータをチェック
	$_POST = checkInput($_POST);

	//固定トークンを確認（CSRF対策）
	if(isset($_POST['ticket'], $_SESSION['ticket'])){
		$ticket = $_POST['ticket'];
		if($ticket !== $_SESSION['ticket']){
			die('不正アクセスの疑いがあります。');
		}
	}else{
		die('不正アクセスの疑いがあります。');
	}

	//POSTされたデータを変数に格納
	$name_sei = isset($_POST['name_sei']) ? $_POST['name_sei'] : NULL;
	$name_mei = isset($_POST['name_mei']) ? $_POST['name_mei'] : NULL;
	$kana_name_sei = isset($_POST['kana_name_sei']) ? $_POST['kana_name_sei'] : NULL;
	$kana_name_mei = isset($_POST['kana_name_mei']) ? $_POST['kana_name_mei'] : NULL;
	$com_name = isset($_POST['com_name']) ? $_POST['com_name'] : NULL;
	$tel_num = isset($_POST['tel_num']) ? $_POST['tel_num'] : NULL;
	$email = isset($_POST['email']) ? $_POST['email'] : NULL;
	$people_num = isset($_POST['people_num']) ? $_POST['people_num'] : NULL;
	$inquiry_detail = isset($_POST['inquiry_detail']) ? $_POST['inquiry_detail'] : NULL;

	//$ppchk = isset($_POST['privacy_policy']) ? $_POST['privacy_policy'] : NULL;
	//if($ppchk=1){
	//	$privacy_policy = "checked";
	//}
	// $privacy_policy = "checked";

	//以下は画像認証用データ
	$captcha_code = isset($_POST['captcha_code']) ? $_POST['captcha_code'] : NULL;

	//POSTされたデータを整形（前後にあるホワイトスペースを削除）
	$name_sei = trim($name_sei);
	$name_mei = trim($name_mei);
	$kana_name_sei = trim($kana_name_sei);
	$kana_name_mei = trim($kana_name_mei);
	$com_name = trim($com_name);
	$tel_num = trim($tel_num);
	$email = trim($email);
	$people_num = trim($people_num);
	$inquiry_detail = trim($inquiry_detail);
	$captcha_code = trim($captcha_code);

	//エラーメッセージを保存する配列の初期化
	$error = array();

	//画像認証のチェック
	if(mb_strlen($captcha_code) <> 6){
		$error[] = '*画像認証の確認キーワードは6文字で入力してください。';
	}else if ($securimage->check($captcha_code) == false) {
		$error[] = '*画像認証の確認キーワードが誤っています。';
	}

	//チェックの結果にエラーがあった場合は、テンプレートの表示に必要な入力されたデータとエラーメッセージを配列「$data」に代入し、display()関数でsendform.phpを表示
	if(count($error) > 0){
		//エラーがあった場合
		$data = array();
		$data['error'] = $error;
		$data['name_sei'] = $name_sei;
		$data['name_mei'] = $name_mei;
		$data['kana_name_sei'] = $kana_name_sei;
		$data['kana_name_mei'] = $kana_name_mei;
		$data['com_name'] = $com_name;
		$data['tel_num'] = $tel_num;
		$data['email'] = $email;
		$data['people_num'] = $people_num;
		$data['inquiry_detail'] = $inquiry_detail;
		$data['ticket'] = $ticket;
		display('sendform.php', $data);
	}else{
		//エラーがなかった場合
		//POSTされたデータをセッション変数に保存
		$_SESSION['name_sei'] = $name_sei;
		$_SESSION['name_mei'] = $name_mei;
		$_SESSION['kana_name_sei'] = $kana_name_sei;
		$_SESSION['kana_name_mei'] = $kana_name_mei;
		$_SESSION['com_name'] = $com_name;
		$_SESSION['tel_num'] = $tel_num;
		$_SESSION['email'] = $email;
		$_SESSION['people_num'] = $people_num;
		$_SESSION['inquiry_detail'] = $inquiry_detail;

		//確認画面を表示
		$data = array();
		$data['name_sei'] = $name_sei;
		$data['name_mei'] = $name_mei;
		$data['kana_name_sei'] = $kana_name_sei;
		$data['kana_name_mei'] = $kana_name_mei;
		$data['com_name'] = $com_name;
		$data['tel_num'] = $tel_num;
		$data['email'] = $email;
		$data['people_num'] = $people_num;
		$data['inquiry_detail'] = $inquiry_detail;
		$data['ticket'] = $ticket; // CSRFトークンを再度渡す
		display('confirm.php', $data);
	}

?>
