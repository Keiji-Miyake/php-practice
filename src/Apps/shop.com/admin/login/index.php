<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === true) {
    header('Location: ./');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>ログイン</title>
</head>
<body>
  <h1>ログイン</h1>
  <form action="confirm.php" method="post">
    <dl>
      <dt>ID</dt>
      <dd><input type="text" name="code"></dd>
      <dt>パスワード</dt>
      <dd><input type="password" name="pass"></dd>
    </dl>
    <div><button type="submit">ログイン</button></div>
  </form>
</body>
</html>
