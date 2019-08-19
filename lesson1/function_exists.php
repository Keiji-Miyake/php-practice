<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>定義済み関数</title>
</head>
<body>
<?php
// ユーザー関数が定義済みか調べる
// 関数を定義する
function abc() {}

// 調べる関数
$string = "abc";

// 関数が定義済みかどうか調べる
if (function_exists($string)) {
    echo "<p>関数は存在します：" . $string;
} else {
    echo "<p>関数は存在しません：" . $string;
}

// PHP関数が定義済みか調べる
// 調べる関数
$string = "decbin";

// 関数が定義済みか調べる
if (function_exists($string)) {
    echo "<p>関数は存在します：" . $string;
} else {
    echo "<p>関数は存在しません：" . $string;
}
?>
</body>
</html>
