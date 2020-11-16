<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>フォームのデータを配列で受け取る</title>
</head>
<body>
<?php
// 入力内容表示
if(isset($_POST["check1"])) {
    for ($i = 0; $i < count(@$_POST["check1"]); $i++) {
        echo '<p>' . $_POST["check1"][$i] . "が選択されました";
    }
}
?>
<form action="" method="post">
    <table>
        <tr>
            <td>
                <input type="checkbox" name="check1[]" value="PHP">PHP
                <input type="checkbox" name="check1[]" value="Perl">Perl
                <input type="checkbox" name="check1[]" value="ASP">ASP
                <input type="checkbox" name="check1[]" value="JSP">JSP
            </td>
        </tr>
        <tr>
            <td>
                <button type="submit" name="sub1">送信</button>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
