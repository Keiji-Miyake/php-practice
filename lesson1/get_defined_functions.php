<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>定義済みの関数名を表示する</title>
</head>
<body>
<?php
function func1() {}
function func2() {}
function func3() {}

$array = get_defined_functions();

// ユーザー定義関数名を表示する
echo "<p>ユーザー定義関数名を表示：</p>";
print_r($array["user"]);

// すべての関数名を表示する
echo "<p>関数名を表示：</p>";
print_r($array);
?>
</body>
</html>
