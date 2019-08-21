<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>配列のデータを受け取る</title>
</head>
<body>
<?php
var_dump(get_magic_quotes_gpc());
// 配列を定義する
$array = array(
    "menu"  => "カレー",
    "price" => "380",
    "date"  => "2005/01/01"
);

// FORMから送信された配列を取得する
echo '<p>配列の内容（エンコードした場合）：';
print_r(unserialize(base64_decode($_POST["ar_enc"])));
echo '<p>配列の内容（そのまま渡すと失敗）：';
print_r($_POST["ar"]);

?>
<form action="" method="post">
    <button type="submit">送信</button>
    <input type="hidden" name="ar" value="<?php echo $array; ?>">
    <input type="hidden" name="ar_enc" value="<?php echo base64_encode(serialize($array)); ?>">
</form>
</body>
</html>
