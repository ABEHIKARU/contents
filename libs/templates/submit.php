<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ささえタイお問い合わせ完了</title>
	<link rel="stylesheet" href="css/submit.css"> <!-- 外部CSSファイルの読み込み -->
    
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

    <div class="container">
		<h2 class="ttl-cmn">お問い合わせ（<?php echo $result ? "完了" : "送信失敗"; ?>）</h2>
			<p><?php
				if($result) {
					echo '送信完了';
				}else{
					echo '<a href="inquery.php">送信失敗（入力ページへ）</a>';
				}
			?></p>
			<p><?php echo $message; ?></p>
			<?php if(!$result): ?>
			<p>送信失敗が継続する場合は、一度ブラウザを閉じてからやり直すとうまくいくことがあります。</p>
			<?php endif; ?>
	</div>
    
    <div class="button-container">
        <a href="index.html" class="back-button">トップページへ戻る</a>
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

