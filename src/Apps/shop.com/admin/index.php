<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="./login">ログイン画面へ</a>';
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
    <title>トップページ</title>
</head>
<body>
    <h1>トップページ</h1>
    <ul>
        <li><a href="./staff">スタッフ情報</a></li>
        <li><a href="./product">商品情報</a></li>
        <li><a href="./order/download">注文ダウンロード</a></li>
        <li><a href="./logout">ログアウト</a></li>
    </ul>
</body>
</html>
