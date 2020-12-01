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
    <title>詳細 | 商品情報</title>
</head>
<body>
<main>
    <h1>商品情報詳細</h1>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$code = $_GET['code'];
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
$dbh = new PDO($dsn,DB_USER,DB_PASS);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,price,photo1 FROM mst_product WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $rec['name'];
$price = $rec['price'];
$photo1 = $rec['photo1'];

$dbh = null;
}
catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <dl>
        <dt>商品コード</dt>
        <dd><?php echo $code; ?></dd>
        <dt>商品名</dt>
        <dd><?php echo $name; ?></dd>
        <dt>価格</dt>
        <dd><?php echo $price; ?>円</dd>
        <?php if($photo1 !== '') { ?>
        <dt>画像</dt>
        <dd><img src="/admin/uploads/product/<?php echo $photo1; ?>" alt=""></dd>
        <?php } ?>
    </dl>
    <div>
        <button type="button" onclick="history.back()">戻る</button>
    </div>
</main>
</body>
</html>
