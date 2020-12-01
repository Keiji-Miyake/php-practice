<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="/login/">ログイン画面へ</a>';
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
    <title>修正 | スタッフ情報</title>
</head>
<body>
<main>
    <h1>スタッフ修正画面</h1>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$code = $_GET['code'];
$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
$dbh = new PDO($dsn,DB_USER,DB_PASS);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name FROM mst_staff WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $code;
$stmt->execute($data);

$rec = $stmt->fetch(PDO::FETCH_ASSOC);
$name = $rec['name'];

$dbh = null;
}
catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <form method="post" action="confirm.php">
        <input type="hidden" name="code" value="<?php echo $code; ?>">
        <dl>
            <dt>スタッフコード</dt>
            <dd><?php echo $code; ?></dd>
            <dt>スタッフ名</dt>
            <dd><input name="name" type="text" style="width:200px" value="<?php echo $name; ?>"></dd>
            <dt>パスワード</dt>
            <dd><input name="pass" type="password" style="width:100px;"></dd>
            <dt>パスワード（再入力）</dt>
            <dd><input name="pass2" type="password" style="width:100px;"></dd>
        </dl>
        <div>
            <button type="button" onclick="history.back()">戻る</button>
            <button type="submit">OK</button>
        </div>
    </form>
</main>
</body>
</html>
