<?php
ob_start();
session_start();
if (isset($_SESSION['user'])) {
  header('Location: home.php');
}
include_once 'dbconnect.php';
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHPのログイン機能</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <main class="main">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <?php
          // ログインボタンがクリックされたときに下記を実行
          if (isset($_POST['login'])) {
            $email = $mysqli->real_escape_string($_POST['email']);
            $password = $mysqli->real_escape_string($_POST['password']);

            // クエリの実行
            $query = "SELECT * FROM users WHERE email='$email'";
            $result = $mysqli->query($query);
            if (!$result) {
              print('クエリーが失敗しました。' . $mysqli->error);
              $mysqli->close();
              exit();
            }

            // パスワード（暗号化済み）とユーザーIDの取り出し
            while ($row = $result->fetch_assoc()) {
              $db_hashed_pwd = $row['password'];
              $user_id = $row['user_id'];
            }

            // データベースの切断
            $result->close();

            // ハッシュ化されたパスワードがマッチするかどうかを確認
            if (password_verify($password, $db_hashed_pwd)) {
              $_SESSION['user'] = $user_id;
              header("Location: home.php");
              exit;
            } else {
              echo '<div class="alert alert-danger" role="alert">メールアドレスとパスワードが一致しません</div>';
            }
          }
          ?>
          <h1>ログインフォーム</h1>
          <form action="" method="post">
            <div class="form-group">
              <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
              <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" name="login">ログインする</button>
              <a href="register.php">会員登録はこちら</a>
            </div>
          </form>
        </div>
      </div>
    </main>
  </div>
</body>

</html>