<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォームのデータを受け取る</title>
</head>
<body>
<?php
// 入力内容を表示する
echo '<p>入力内容：' . $_POST["text1"] . '</p>';
?>
<form action="" method="post">
    <table>
        <tr>
            <td><input type="text" name="text1" id=""></td>
            <td><button type="submit" name="sub1">送信</button></td>
        </tr>
    </table>
</form>
</body>
</html>
