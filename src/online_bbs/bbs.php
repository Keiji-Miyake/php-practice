<?php

// データベースに接続
$link = mysqli_connect('db', 'dev', 'pass', 'oneline_bbs');
if (!$link) {
    die('データベースに接続できません：' . mysqli_connect_error());
}

$errors = array();

// POSTなら保存処理実行
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // 名前が正しく入力されているかチェック
    $name = null;
    if (!isset($_POST['name']) || !strlen($_POST['name'])) {
        $errors['name'] = '名前を入力してください';
    } else if (strlen($_POST['name']) > 40) {
        $errors['name'] = '名前は40文字以内で入力してください';
    }

    // ひとことが正しく入力されているかチェック
    $comment = null;
    if (!strlen($_POST['comment'])) {
        $errors['comment'] = 'ひとことを入力してください';
    } else if (strlen($_POST['comment']) > 200) {
        $errors['comment'] = 'ひとことは200文字以内で入力してください';
    }

    // エラーがなければ保存
    if (count($errors) === 0) {
        $name = mysqli_real_escape_string($link, $_POST['name']);
        $comment = mysqli_real_escape_string($link, $_POST['comment']);
        $created_at = date('Y-m-d H:i:s');
        $sql = <<<EOT
    INSERT INTO post (
        name,
        comment,
        created_at
    ) VALUES (
        "{$name}",
        "{$comment}",
        "{$created_at}"
    )
    EOT;
        if (mysqli_query($link, $sql)) {
            printf("%d Row inserted.\n", mysqli_affected_rows($link));
        } else {
            printf("Error: %s\n", mysqli_sqlstate($link));
        }
    }
} else {
    $result = mysqli_query($link, 'SELECT * FROM post;');
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ひとこと掲示板</title>
</head>
<body>
    <h1>ひとこと掲示板</h1>
    <?php if (count($errors)) : ?>
    <ul class="error_list">
        <?php foreach ($errors as $error) : ?>
            <li><?php echo htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form action="bbs.php" method="post">
        名前： <input type="text" name="name"><br>
        ひとこと： <input type="text" name="comment"><br>
        <button type="submit">送信</button>
    </form>

    <?php
    // 投稿された内容を取得するSQLを作成して結果を取得
    $sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
    $result = mysqli_query($link, $sql);
    ?>

    <?php if ($result !== false && mysqli_num_rows($result)): ?>
    <ul>
        <?php while ($post = mysqli_fetch_assoc($result)) : ?>
        <li>
            <?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?>:
            <?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8') ?>
            - <?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8') ?>
        </li>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>

    <?php
    // 取得結果を開放して接続を閉じる
    mysqli_free_result($result);
    mysqli_close($link);
    ?>
</body>
</html>
