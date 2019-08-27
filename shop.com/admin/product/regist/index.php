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
    <title>新規登録 | 商品情報</title>
</head>
<body>
    <main>
        <h1>商品新規登録</h1>
        <form action="confirm.php" method="POST" enctype="multipart/form-data">
            <dl>
                <dt>商品名</dt>
                <dd><input name="name" type="text" style="width:200px"></dd>
                <dt>価格</dt>
                <dd><input name="price" type="text" style="width:50px;"></dd>
                <dt>画像1</dt>
                <dd><input name="photo1" type="file" style="width:400px;"></dd>
            </dl>
            <div>
                <button onclick="history.back()">戻る</button>
                <button type="submit">OK</button>
            </div>
        </form>
    </main>
</body>
</html>
