<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php
function f1($prm) {
    echo "<p>関数" . $prm . "が実行されました。";
}

function f2($prm) {
    echo "<p>関数" . $prm . "が実行されました。";
}

$num = 2;
echo call_user_func("f" . $num, $num);
?>
</body>
</html>
