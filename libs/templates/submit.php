<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ささえタイお問い合わせ完了</title>
    
<body>
    <div class="container">
        <?php if ($data['result']) : ?>
            <p class="message-success"><?php echo htmlspecialchars($data['message']); ?></p>
        <?php else : ?>
            <p class="message-error"><?php echo htmlspecialchars($data['message']); ?></p>
        <?php endif; ?>

        <div class="button-container">
            <a href="index.html" class="back-button">トップページへ戻る</a>
        </div>
    </div>
</body>
</html>

