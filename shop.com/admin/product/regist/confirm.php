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
    <title>確認 | 商品情報</title>
</head>
<body>
    <main>
        <h1>商品新規登録録確認</h1>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$post = sanitize($_POST);
$name = $post['name'];
$price = $post['price'];
$photo1 = $_FILES['photo1'];

if($name === '')
{
    print '商品名が入力されていません。<br>';
}
else
{
    print '商品名：';
    print $name;
    print '<br>';
}

if(preg_match('/\A[1-9][0-9]+\z/', $price) === 0)
{
    print '価格を正しく入力してください。<br>';
}
else
{
    print '価格：';
    print $price;
    print '円<br>';
}

if($photo1['size'] > 0)
{
    if($photo1['size'] > 1000000) {
        print '画像が大きすぎます';
    } else {
        move_uploaded_file($photo1['tmp_name'],'../../uploads/product/'.$photo1['name']);
        print '<img src="/admin/uploads/product/'.$photo1['name'].'">';
        print '<br>';
    }
}

if($name === '' || preg_match('/\A[1-9][0-9]+\z/', $price) === 0 || $photo1['size'] > 1000000)
{
    print '<form>';
    print '<button type="button" onclick="history.back()">戻る</button>';
    print '</form>';
}
else
{
    print '上記の商品を追加します。';
    print '<form method="post" action="done.php">';
    print '<input type="hidden" name="name" value="'.$name.'">';
    print '<input type="hidden" name="price" value="'.$price.'">';
    print '<input type="hidden" name="photo1" value="'.$photo1['name'].'">';
    print '<br>';
    print '<button type="button" onclick="history.back()">戻る</button>';
    print '<button type="submit">OK</button>';
    print '</form>';
}
?>
    </main>
</body>
</html>
