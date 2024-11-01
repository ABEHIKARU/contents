<?php
	session_start();    //セッションを開始

	require 'libs/functions.php';   //テンプレートエンジンの読み込み

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

	//変数にセッション変数の値を代入
	$name_sei = $_SESSION['name_sei'];
	$name_mei = $_SESSION['name_mei'];
	$kana_name_sei = $_SESSION['kana_name_sei'];
	$kana_name_mei = $_SESSION['kana_name_mei'];
	$com_name = $_SESSION['com_name'];
	$tel_num = $_SESSION['tel_num'];
	$email = $_SESSION['email'];
	$people_num = $_SESSION['people_num'];
	$inquiry_detail = $_SESSION['inquiry_detail'];

	//メール：件名
	$subject = 'ささえタイHPからのお問い合わせ';
	//メール本文
	//$body = 'コンタクトページからの問い合わせ'. "\n\n" . $body;
	// メール本文の初期化
	$mailbody = '';
	$mailbody = $mailbody . '■氏名（漢字）' . "\n\n" . $name_sei . $name_mei . "\n\n";
	$mailbody = $mailbody . '■氏名（フリガナ）' . "\n\n" . $kana_name_sei . $kana_name_mei . "\n\n";
	$mailbody = $mailbody . '■会社名' . "\n\n" . $com_name . "\n\n";
	$mailbody = $mailbody . '■電話番号' . "\n\n" . $tel_num . "\n\n";
	$mailbody = $mailbody . '■E-mail' . "\n\n" . $email . "\n\n";
	$mailbody = $mailbody . '■利用予定人数' . "\n\n" . $people_num . "\n\n";
	$mailbody = $mailbody . '■お問い合わせ内容' . "\n\n" . $inquiry_detail . "\n\n";

	//以下は PHPMailer を使って HTML メールを送信する場合
	//$body = 'コンタクトページからの問い合わせ'. "<br>" . h($_SESSION['body']);

	//--------sendmail------------

	//メールの宛先
	$mailTo = 'eigyo@nipssc.co.jp';

	//Return-Pathに指定するメールアドレス
	$returnMail = 'sc@nipssc.co.jp';

	//mbstringの日本語設定
	mb_language('ja');
	mb_internal_encoding('UTF-8');

	//From ヘッダーを作成
	//返信先をフォームに入力されたアドレスではなくシステムセンターのアドレスに設定(SPAM判定対応)
	$fullName = $name_sei . ' ' . $name_mei; // 姓と名を連結
	$header = 'From: ' . mb_encode_mimeheader($fullName). ' <' . $returnMail. '>';

	//メールの送信、セーフモードがOnの場合は第5引数が使えない
	if(ini_get('safe_mode')){
		$result = mb_send_mail($mailTo, $subject, $mailbody, $header);
	}else{
		$result = mb_send_mail($mailTo, $subject, $mailbody, $header, '-f'. $returnMail);
	}

	//送信結果により表示するメッセージの変数を初期化
	$message = '';

	//メール送信の結果判定
	if($result) {
		$message = 'お問い合わせありがとうございます。送信完了いたしました。';
		//成功した場合はセッションを破棄
		$_SESSION = array();   //空の配列を代入し、すべてのセッション変数を消去 
		session_destroy();   //セッションを破棄
	}else{
		$message = '申し訳ございませんが、送信に失敗しました。しばらくしてもう一度お試しになるか、お電話にてご連絡ください。';
	}

	$data = array();
	$data['message'] = $message;
	$data['result'] = $result;
	display('submit.php', $data);

?>