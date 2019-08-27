<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) === false) {
    print 'ようこそゲスト様<br>';
    print '<a href="/shop/member/login/">会員ログイン</a>';
}
else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="/shop/member/logout">ログアウト</a>';
    print '<br>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>一覧 | 商品</title>
</head>
<body>
<main>
    <h1>商品一覧</h1>
<?php

    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT code,name,price FROM mst_product WHERE 1';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    while(true) {
        $rec = $stmt->fetch(PDO::FETCH_ASSOC); //1レコード取り出す。
        if($rec === false) {
            break;
        }
        print '<a href="product.php?procode='.$rec['code'].'">';
        print $rec['name'].'---';
        print $rec['price'].'円';
        print '</a>';
        print '<br>';
    }
}
catch (Exception $e) {
    echo $e;
    print '只今障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <div><a href="./cart">カートを見る</a></div>
</main>
</body>
</html>
