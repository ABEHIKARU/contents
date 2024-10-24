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
            <td><?php echo $inquiry_detail; ?></td>
        </tr>
    </table>

    <div class="form-button">
    <form action="inquery.php" method="post">
		<div class="form-button1">
			<button type="submit">修正する</button>
		</div>
	</form>

    <form action="inquery3.php" method="post">
		<div class="form-button2">
			<input type="hidden" name="ticket" value="<?php echo $ticket; ?>">
			<button type="submit">送信</button>
		</div>
	</form>
    </div>

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
