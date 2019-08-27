<?php
session_start();
$_SESSION = array();
if (isset($_COOKIE[session_name()]) === true)
{
    setcookie(session_name(), '', time() - 42000, '/');
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>カート</title>
</head>
<body>
  <h1>カート</h1>
  <p>カートを空にしました。</p>
  <div><a href="/shop">トップページへ</a></div>
</body>
</html>
