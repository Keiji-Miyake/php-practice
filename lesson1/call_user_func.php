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
function get_total_charge($kingaku) {
    $total = $kingaku * 1.08;
    return $total;
}

echo "<p>合計金額：" . call_user_func("get_total_charge", 10000);
echo "<p>合計金額：" . get_total_charge(10000);
?>
</body>
</html>
