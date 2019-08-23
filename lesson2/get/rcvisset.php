<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>データ入力時のみデータを受け取る</title>
</head>
<body>
<?php
// 入力内容を表示する
$text1 = !empty($_POST["text1"]) ? $_POST["text1"] : "未入力です。";
var_dump($_POST["text1"]);
echo '<p>入力内容:' . $text1;

?>
<form action="" method="post">
    <table>
        <tr>
            <td><input type="text" name="text1" id=""></td>
        </tr>
        <tr>
            <td><button type="submit" name="sub1">送信</button></td>
        </tr>
    </table>
</form>
</body>
</html>
