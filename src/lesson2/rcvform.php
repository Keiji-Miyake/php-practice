<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォームのデータを受け取る</title>
</head>
<body>
<?php
// 入力内容を表示する
echo "<p>入力内容：" . $_POST['text1'];
?>
<form methos="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
    <table>
        <tr>
            <td><input type="text" name="text1"></td>
            <td><button type="submit" name="sub1">送信</button></td>
        </tr>
    </table>
</form>
</body>
</html>
