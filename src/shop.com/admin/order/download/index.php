<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="/admin/login">ログイン画面へ</a>';
    exit();
}
else {
    print $_SESSION['staff_name'];
    print 'さんログイン中<br>';
    print '<br>';
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ダウンロード | オーダー</title>
</head>
<body>
<main>
    <h1>ダウンロード</h1>
    <p>ダウンロードしたい注文日を選んでください。</p>
    <form action="done.php" method="post">
        <select name="year">
            <option value="2018">2018</option>
            <option value="2019">2019</option>
            <option value="2020">2020</option>
            <option value="2021">2021</option>
        </select>年
        <select name="month">
            <option value="01">01</option>
            <option value="02">02</option>
            <option value="03">03</option>
            <option value="04">04</option>
            <option value="05">05</option>
            <option value="06">06</option>
            <option value="07">07</option>
            <option value="08">08</option>
            <option value="09">09</option>
            <option value="10">10</option>
            <option value="11">11</option>
            <option value="12">12</option>
        </select>月
        <select name="day">
<?php for($i = 1;$i < 32;$i++): ?>
            <option value="<?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?>"><?php echo str_pad($i, 2, "0", STR_PAD_LEFT); ?></option>
<?php endfor; ?>
        </select>
        <button type="submit">ダウンロードへ</button>
    </form>
</main>
</body>
</html>
