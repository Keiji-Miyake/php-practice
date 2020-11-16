<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="/admin/login">ログイン画面へ</a>';
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
    <title>一覧 | スタッフ</title>
</head>
<body>
<main>
    <h1>スタッフ一覧</h1>
<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');
    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name FROM mst_staff WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    print '<form action="branch.php" method="post">';
    while(true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC); //1レコード取り出す。
        if($rec === false) {
            break;
        }
        print '<label><input type="radio" name="code" value="'.$rec['code'].'">';
        print $rec['name'];
        print '</label><br>';
    }
    print '<button type="submit" name="detail">詳細</button>';
    print '<button type="submit" name="regist">登録</button>';
    print '<button type="submit" name="edit">修正</button>';
    print '<button type="submit" name="delete">削除</button>';
    print '</form>';
}
catch (Exception $e) {
    echo $e;
    print '只今障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <p><a href="/admin">トップページ</a></p>
</main>
</body>
</html>
