<!doctype html>
<html lang="js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>関数</title>
</head>
<body>
<?php
// パラメータなし
function disp_err_message() {
    echo "<p>エラーが発生しました。</p>";
}
disp_err_message();

// パラメータを使う
function disp_message($string) {
    echo "<p><b> $string </b></p>";
}
disp_message("エラーです");

// 値を返す
function get_message($code) {
    switch ($code) {
        case 0:
            $message = "正常終了";
            break;
        case 1:
            $message = "エラー";
            break;
        default:
            $message = "エラー";
    }
    return $message;
}
echo "<p>終了メッセージ：". get_message(1);

// パラメータの既定値がある
function get_ref_message($code = 0) {
    switch ($code) {
        case 0:
            $message = "正常終了";
            break;
        case 1:
            $message = "エラー";
            break;
    }
    return $message;
}
// パラメータを指定して呼び出す
echo "<p>終了メッセージ：" . get_ref_message(1);
// パラメータを省略して呼び出す
echo "<p>終了メッセージ：" . get_ref_message();
?>
</body>
</html>
