<?php
session_start();
if (isset($_SESSION['user'])) {
  // ログイン済みの場合はリダイレクト
  header("Location: home.php");
}
// DBとの接続
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHPの会員登録機能</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <main class="main">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <?php
          if (isset($_POST['signup'])) {
            $username = $mysqli->real_escape_string($_POST['username']);
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->real_escape_string($_POST['password']);
            $password = password_hash($password, PASSWORD_DEFAULT);

            $query = "INSERT INTO users(username,email,password) VALUES('$username', '$email', '$password')";

            if ($mysqli->query($query)) {
              echo '<div class="alert alert-success" role="alert">登録しました</div>';
            } else {
              echo '<div class="alert alert-danger" role="alert">エラーが発生しました</div>';
            }
          }
          ?>

          <h1>会員登録フォーム</h1>
          <form action="" method="post">
            <div class="form-group">
              <input type="text" class="form-control" name="username" value="" placeholder="ユーザー名" required>
            </div>
            <div class="form-group">
              <input type="email" class="form-control" name="email" placeholder="メールアドレス" required>
            </div>
            <div class="form-group">
              <input type="password" class="form-control" name="password" placeholder="パスワード" required />
            </div>
            <button type="submit" class="btn btn-default" name="signup">会員登録する</button>
            <a href="index.php">ログインはこちら</a>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>

</html>