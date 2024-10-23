<?php
// POSTデータの取得
$name_sei = isset($_POST['name_sei']) ? htmlspecialchars($_POST['name_sei'], ENT_QUOTES, 'UTF-8') : '';
$name_mei = isset($_POST['name_mei']) ? htmlspecialchars($_POST['name_mei'], ENT_QUOTES, 'UTF-8') : '';
$kana_name_sei = isset($_POST['kana_name_sei']) ? htmlspecialchars($_POST['kana_name_sei'], ENT_QUOTES, 'UTF-8') : '';
$kana_name_mei = isset($_POST['kana_name_mei']) ? htmlspecialchars($_POST['kana_name_mei'], ENT_QUOTES, 'UTF-8') : '';
$com_name = isset($_POST['com_name']) ? htmlspecialchars($_POST['com_name'], ENT_QUOTES, 'UTF-8') : '';
$tel_num = isset($_POST['tel_num']) ? htmlspecialchars($_POST['tel_num'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$people_num = isset($_POST['people_num']) ? htmlspecialchars($_POST['people_num'], ENT_QUOTES, 'UTF-8') : '';
$inquiry_detail = isset($_POST['inquiry_detail']) ? htmlspecialchars($_POST['inquiry_detail'], ENT_QUOTES, 'UTF-8') : '';

// メール送信先の設定
$to = "habe@nipssc.co.jp"; // 実際の宛先に置き換える
$subject = "お問い合わせがありました";

// メール本文の作成
$message = "
以下の内容でお問い合わせがありました。\n\n
氏名（漢字）: $name_sei $name_mei\n
氏名（フリガナ）: $kana_name_sei $kana_name_mei\n
会社名: $com_name\n
電話番号: $tel_num\n
メールアドレス: $email\n
利用予定人数: $people_num 人\n
お問い合わせ内容:\n $inquiry_detail
";

// メールヘッダーの設定
$headers = "From: " . $email . "\r\n" .
           "Reply-To: " . $email . "\r\n" .
           "Content-Type: text/plain; charset=UTF-8";

// メール送信処理
if (mail($to, $subject, $message, $headers)) {
    echo "<h2>お問い合わせありがとうございました。</h2>";
    echo "<p>内容を確認し、後ほど担当者よりご連絡いたします。</p>";
} else {
    echo "<h2>メール送信に失敗しました。</h2>";
    echo "<p>申し訳ございませんが、再度お試しください。</p>";
}

?>
