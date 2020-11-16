<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) === true) {
    header('Location: ../');
    exit();
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>会員ログイン</title>
</head>
<body>
  <h1>ログイン</h1>
  <form action="confirm.php" method="post">
    <dl>
      <dt>登録メールアドレス</dt>
      <dd><input type="text" name="email"></dd>
      <dt>パスワード</dt>
      <dd><input type="password" name="pass"></dd>
    </dl>
    <div><button type="submit">ログイン</button></div>
  </form>
</body>
</html>
