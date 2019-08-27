<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="/login/">ログイン画面へ</a>';
    exit();
}
else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br>';
    print '<br>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title>修正完了 | スタッフ情報</title>
</head>
<body>
<main>
    <h1>スタッフ修正完了画面</h1>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

    $post = sanitize($_POST);
    $code = $post['code'];
    $name = $post['name'];
    $pass = $post['pass'];

    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn,DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'UPDATE mst_staff SET name=?,password=? WHERE code=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $name;
    $data[] = $pass;
    $data[] = $code;
    $stmt->execute($data);

    $dbh = null;

}
catch(Exception $e) {
    // echo $e;
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <p>修正しました。</p>
    <a href="/staff">戻る</a>
</main>
</body>
</html>
