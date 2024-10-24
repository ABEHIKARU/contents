<?php
	//セッションを開始
	session_start();

	//セッションIDを変更（セッションハイジャック対策）
	session_regenerate_id(TRUE);

	//テンプレートエンジン functions.php の読み込み
	require 'libs/functions.php';

	//テンプレートに渡す変数の初期化
	$data = array(); //配列を初期化

	//初回以外ですでにセッション変数に値が代入されていれば、その値を。そうでなければNULLで初期化
	$data['name_sei'] = isset($_SESSION['name_sei']) ? $_SESSION['name_sei'] : NULL;
	$data['name_mei'] = isset($_SESSION['name_mei']) ? $_SESSION['name_mei'] : NULL;
	$data['kana_name_sei'] = isset($_SESSION['kana_name_sei']) ? $_SESSION['kana_name_sei'] : NULL;
	$data['kana_name_mei'] = isset($_SESSION['kana_name_mei']) ? $_SESSION['kana_name_mei'] : NULL;
	$data['com_name'] = isset($_SESSION['com_name']) ? $_SESSION['com_name'] : NULL;
	$data['tel_num'] = isset($_SESSION['tel_num']) ? $_SESSION['tel_num'] : NULL;
	$data['email'] = isset($_SESSION['email']) ? $_SESSION['email'] : NULL;
	$data['people_num'] = isset($_SESSION['people_num']) ? $_SESSION['people_num'] : NULL;
	$data['inquiry_detail'] = isset($_SESSION['inquiry_detail']) ? $_SESSION['inquiry_detail'] : NULL;

	//CSRF対策の固定トークンを生成
	if(!isset($_SESSION['ticket'])){
		//$_SESSION['ticket']がセットされていなければ、トークンを生成して代入
		$_SESSION['ticket'] = sha1(uniqid(mt_rand(), TRUE));
	}

	// CSRF対策の固定トークンを生成
    // $_SESSION['ticket'] = sha1(uniqid(mt_rand(), TRUE));

	//トークンの値を配列に代入してテンプレートに渡す（隠しフィールドに挿入）
	$data['ticket'] = $_SESSION['ticket'];

	//入力ページのテンプレートにデータを渡して表示
	display('sendform.php', $data);

?>


<!-- 実行用リンク -->
<!-- http://localhost/sasaetai/inquery.php -->

<!-- 認証画像確認用 -->
<!-- http://localhost/sasaetai/securimage/securimage_show.php -->
