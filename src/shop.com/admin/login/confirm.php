<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$post = sanitize($_POST);

$code = $post['code'];
$pass = $post['pass'];

$pass = md5($pass);

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn, DB_USER, DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = 'SELECT name FROM mst_staff WHERE code=? AND password=?';
    $stmt = $dbh->prepare($sql);
    $data[] = $code;
    $data[] = $pass;
    $stmt->execute($data);

    $dbh = null;

    $rec = $stmt->fetch(PDO::FETCH_ASSOC);

    if($rec === false) {
        print 'スタッフコードかパスワードがまたはパスワードが間違っています。<br>';
        print '<a href="/login">戻る</a>';
    } else {
        session_start();
        $_SESSION['login'] = 1;
        $_SESSION['staff_code'] = $code;
        $_SESSION['staff_name'] = $rec['name'];
        header('Location: /admin');
        exit();
    }
} catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
