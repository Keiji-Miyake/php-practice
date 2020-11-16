<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>完了 | スタッフ登録</title>
</head>
<body>
<main>
    <h1>スタッフ登録完了画面</h1>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

    $post = sanitize($_POST);
    $name = $post['name'];
    $pass = $post['pass'];

    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn,DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'INSERT INTO mst_staff(name,password) VALUES (?,?)';
    $stmt = $dbh->prepare($sql);
    $data[] = $name;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

    print $name;
    print 'さんを追加しました。<br>';
}
catch(Exception $e) {
    // echo $e;
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <a href="/staff">戻る</a>
</main>
</body>
</html>
