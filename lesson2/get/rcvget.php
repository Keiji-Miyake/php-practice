<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>GETデータ取得</title>
</head>
<body>
<?php
// 入力内容を表示する
echo '<P>入力内容 ($_GET) ：' . $_GET["text1"];

// URLパラメータを表示する
echo '<p>リンクから受け取ったパラメータ：' . $_GET["key"];
?>
<form action="" method="get">
    <table>
        <tr>
            <td><input type="text" name="text1"></td>
            <td><button type="submit" name="sub1">送信</button></td>
        </tr>
    </table>
</form>
<hr>
<a href="?key=PHP">URLパラメータ</a>
</body>
</html>
