<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォームのデータをまとめて処理する</title>
</head>
<body>
<?php
// FORMから送信されたデータを表示する
foreach($_POST as $idx => $val) {
    echo "<p>$idx = $val</p>";
}
?>
<form action="" method="post">
    <table>
        <tr>
            <td><input type="text" name="text1" id=""></td>
        </tr>
        <tr>
            <td><input type="text" name="text2" id=""></td>
        </tr>
        <tr>
            <td><input type="text" name="text3" id=""></td>
        </tr>
        <tr>
            <td><button type="submit" name="sub1">送信</button></td>
        </tr>
    </table>
</form>
</body>
</html>
