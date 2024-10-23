<?php
// POSTデータの取得
// HTMLでの特殊文字をエスケープ
// 送信されたデータが存在するかを確認し、なければ空文字
$name_sei = isset($_POST['name_sei']) ? htmlspecialchars($_POST['name_sei'], ENT_QUOTES, 'UTF-8') : '';
$name_mei = isset($_POST['name_mei']) ? htmlspecialchars($_POST['name_mei'], ENT_QUOTES, 'UTF-8') : '';
$kana_name_sei = isset($_POST['kana_name_sei']) ? htmlspecialchars($_POST['kana_name_sei'], ENT_QUOTES, 'UTF-8') : '';
$kana_name_mei = isset($_POST['kana_name_mei']) ? htmlspecialchars($_POST['kana_name_mei'], ENT_QUOTES, 'UTF-8') : '';
$com_name = isset($_POST['com_name']) ? htmlspecialchars($_POST['com_name'], ENT_QUOTES, 'UTF-8') : '';
$tel_num = isset($_POST['tel_num']) ? htmlspecialchars($_POST['tel_num'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8') : '';
$people_num = isset($_POST['people_num']) ? htmlspecialchars($_POST['people_num'], ENT_QUOTES, 'UTF-8') : '';
$inquiry_detail = isset($_POST['inquiry_detail']) ? htmlspecialchars($_POST['inquiry_detail'], ENT_QUOTES, 'UTF-8') : '';

?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ささえタイお問い合わせ確認</title>
    <link rel="stylesheet" href="css/confirm.css"> <!-- 外部CSSファイルの読み込み -->
</head>
<body>

<header>
    <div class="header-container">
        <!-- ロゴ -->
        <div class="logo-container">
            <a href="index.html">
                <img src="img/logo.png" alt="ささえタイのロゴ" class="logo">
            </a>
        </div>

        <!-- メニュー -->
        <nav class="menu-container">
            <ul class="menu">
                <li><a href="index.html#sasaetaitoha">ささえタイとは</a></li>
                <li><a href="index.html#kinouichiran">機能一覧</a></li>
                <li><a href="index.html#kigyouzyouhou">企業情報</a></li>
            </ul>
        </nav>

        <!-- 資料請求・お問い合わせボタン -->
        <a href="inquery.php" target="_blank" class="cta-button">資料請求・お問い合わせ</a>
    </div>
</header>

<h2>お問い合わせ内容確認</h2>

<form action="inquery3.php" method="post">
    <table>
        <tr>
            <td>氏名(漢字):</td>
            <td><?php echo $name_sei . ' ' . $name_mei; ?></td>
        </tr>

        <tr>
            <td>氏名(フリガナ):</td>
            <td><?php echo $kana_name_sei . ' ' . $kana_name_mei; ?></td>
        </tr>

        <tr>
            <td>会社名:</td>
            <td><?php echo $com_name; ?></td>
        </tr>

        <tr>
            <td>電話番号:</td>
            <td><?php echo $tel_num; ?></td>
        </tr>

        <tr>
            <td>メールアドレス:</td>
            <td><?php echo $email; ?></td>
        </tr>

        <tr>
            <td>利用予定人数:</td>
            <td><?php echo $people_num . '人'; ?></td>
        </tr>

        <tr>
            <td>お問い合わせ内容:</td>
            <td><?php echo nl2br($inquiry_detail); ?></td>
        </tr>
    </table>

    <!--確認ページへトークンをPOSTする、隠しフィールド「ticket」-->
    <input type="hidden" name="ticket" value="<?php echo htmlspecialchars($ticket, ENT_QUOTES, 'UTF-8'); ?>">

    <!-- ユーザーが確認後、POSTデータを送信 -->
    <div class="form-button">
        <input type="button" value="修正する" onclick="history.back()">
        <input type="submit" value="送信">
    </div>

    <!-- POSTデータをhiddenでsubmit.phpへ引き継ぐ -->
    <input type="hidden" name="name_sei" value="<?php echo $name_sei; ?>">
    <input type="hidden" name="name_mei" value="<?php echo $name_mei; ?>">
    <input type="hidden" name="kana_name_sei" value="<?php echo $kana_name_sei; ?>">
    <input type="hidden" name="kana_name_mei" value="<?php echo $kana_name_mei; ?>">
    <input type="hidden" name="com_name" value="<?php echo $com_name; ?>">
    <input type="hidden" name="tel_num" value="<?php echo $tel_num; ?>">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    <input type="hidden" name="people_num" value="<?php echo $people_num; ?>">
    <input type="hidden" name="inquiry_detail" value="<?php echo $inquiry_detail; ?>">
</form>

<footer>
    <div class="footer-container">
        copyright©2024&nbsp;NIPS Co.,Ltd.&nbsp;all&nbsp;rights&nbsp;reserved.
        <a class="pagetop" href="#">
            <img src="img/up_arrow.png" alt="トップへ戻る" class="up_arrow">
        </a>
    </div>
</footer>

</body>
</html>
