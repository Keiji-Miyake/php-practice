<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>繰り返し</title>
</head>
<body>
<?php
// 文字列を5階繰り返す
$i = 1;
while($i <= 5) {
    echo $i . "回目の表示<br>";
    $i++;
}

// 1 ~ 5までを表示する(for)
for($i = 1; $i <= 5; $i++) {
    echo $i . "回目の表示<br>";
}

// 九九
for ($i = 1; $i <= 9; $i++) {
    for ($j = 1; $j <= 9; $j++) {
        echo "$i x $j = " . $i * $j . "<br>";
    }
}
?>
</body>
</html>
