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
            //printf("%d Row inserted.\n", mysqli_affected_rows($link));
            mysqli_close($link);
            // リダイレクトで2重送信の防止
            header('Location: http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']);
        } else {
            printf("Error: %s\n", mysqli_sqlstate($link));
        }
        mysqli_close($link);

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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <header class="border-bottom my-5 pb-3">
            <h1 class="text-center">ひとこと掲示板</h1>
        </header>

        <h2 class="text-center">ひとこと</h2>
        <form class="border-bottom mb-5 pb-5" action="bbs.php" method="post">
            <div class="form-group">
                <label for="name">名前</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="山田　太郎" required>
            </div>
            <div class="form-group">
                <label for="comment">ひとこと</label>
                <input type="text" name="comment" id="comment" class="form-control" placeholder="ひとこと" required>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary" type="submit" name="register">Register</button>
            </div>
        </form>

        <?php
        // 投稿された内容を取得するSQLを作成して結果を取得
        $sql = "SELECT * FROM `post` ORDER BY `created_at` DESC";
        $result = mysqli_query($link, $sql);
        ?>

        <?php if ($result !== false && mysqli_num_rows($result)) : ?>
        <section class="list-group">
            <?php while ($post = mysqli_fetch_assoc($result)) : ?>
            <article class="list-group-item">
                <header class="mb-1">
                    <h3 class="h6 d-inline"><?php echo htmlspecialchars($post['name'], ENT_QUOTES, 'UTF-8') ?></h3> - <time class="small text-muted"><?php echo htmlspecialchars($post['created_at'], ENT_QUOTES, 'UTF-8'); ?></time>
                </header>
                <div class="body">
                    <p class="m-0"><?php echo htmlspecialchars($post['comment'], ENT_QUOTES, 'UTF-8') ?></p>
                </div>
            </article>
            <?php endwhile; ?>
        </section>
        <?php endif; ?>
    </div>

    <?php
    // 取得結果を開放して接続を閉じる
    mysqli_free_result($result);
    mysqli_close($link);
    ?>
</body>

</html>
