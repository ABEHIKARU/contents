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
    <title>ささえタイお問い合わせ送信フォーム</title>
    <link rel="stylesheet" href="css/sendform.css"> <!-- 外部CSSファイルの読み込み -->
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
            <a href="inquery2.php" target="_blank" class="cta-button">資料請求・お問い合わせ</a>
        </div>
    </header>

    <h2>資料請求・お問い合わせフォーム</h2>
    
    <form action="inquery2.php" method="post">
    <table>
        <tr>
            <td>氏名(漢字)&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="text" id="name_sei" name="name_sei" placeholder="姓" maxlength="20" required>
                <input type="text" id="name_mei" name="name_mei" placeholder="名" maxlength="20" required>
            </td>
        </tr>
        
        <tr>
            <td>氏名(フリガナ)&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="text" id="kana_name_sei" name="kana_name_sei" placeholder="セイ" maxlength="20" required>
                <input type="text" id="kana_name_mei" name="kana_name_mei" placeholder="メイ" maxlength="20" required>
            </td>
        </tr>

        <tr>
            <td>会社名&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="text" id="com_name" name="com_name" maxlength="100" required>
            </td>
        </tr>

        <tr>
            <td>電話番号(半角)&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="tel" id="tel_num" name="tel_num" maxlength="15" required>
            </td>
        </tr>

        <tr>
            <td>メールアドレス&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="email" id="email" name="email" placeholder="form@example.com" maxlength="100" required>
            </td>
        </tr>

        <tr>
            <td>利用予定人数&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <input type="text" id="people_num" name="people_num" maxlength="10" required>人
                <span>※おおよその人数で構いません</span>
            </td>
        </tr>

        <tr>
            <td>お問い合わせ内容&nbsp;<img src="img/hissu.png" class="hissu"></td>
            <td>
                <textarea id="inquiry_detail" name="inquiry_detail" maxlength="2000" required></textarea>
            </td>
        </tr>
        <tr>
			<td>認証キー&nbsp;<img src="img/hissu.png" class="hissu"></td>
			<td>
            <img id="captcha" src="securimage/securimage_show.php" alt="CAPTCHA Image">
            <!-- <div class="refreshimg"> -->
            <a id="different_img" href="#" onclick="document.getElementById('captcha').src = 'securimage/securimage_show.php?' + Math.random(); return false">（別の画像を表示）</a>
            <!-- </div> -->
            <p><span>表示されているキーワードを半角英数字でご記入ください。<br>大文字小文字はどちらでも（全て小文字で）大丈夫です。</span></p>
            <input type="text" name="captcha_code" id="captcha_code" size="15" maxlength="6" required>
            <input type="hidden" name="captcha_id" value="<?php echo $_SESSION['captcha_id']; ?>"> <!-- キャプチャIDを隠しフィールドに -->
            <div id="errorDispaly" style="color: red;">
                <!-- エラーメッセージの表示 -->
                <?php if (!empty($error)): // エラーがある場合 
                    foreach ($error as $err):
                    echo htmlspecialchars($err, ENT_QUOTES, 'UTF-8');
                    endforeach;
                    endif; 
                ?>
            </div>
			</td>
		</tr>
    </table>
    <!--確認ページへトークンをPOSTする、隠しフィールド「ticket」-->
    <input type="hidden" name="ticket" value="<?php echo htmlspecialchars($ticket, ENT_QUOTES, 'UTF-8'); ?>">
    <div class="form-button">
        <input type="submit" value="確認する">
    </div>
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
