<?php
session_start();
include_once 'dbconnect.php';
if (!isset($_SESSION['user'])) {
  header("Location: index.php");
}

// ユーザーIDからユーザー名を取り出す
$query = 'SELECT * FROM users WHERE user_id="' . $_SESSION['user'] . '"';
$result = $mysqli->query($query);
if (!$result) {
  print('クエリが失敗しました。' . $mysqli->error);
  $mysqli->close();
  exit();
}

// ユーザー情報の取り出し
while ($row = $result->fetch_assoc()) {
  $username = $row['username'];
  $email = $row['email'];
}

$result->close();
?>
<!DOCTYPE html>
<html lang="ja">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>PHPのマイページ機能</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
  <div class="container">
    <main class="main">
      <div class="row">
        <div class="col-xs-6 col-xs-offset-3">
          <h1>プロフィール</h1>
          <ul>
            <li>名前：<?php echo $username; ?></li>
            <li>メールアドレス：<?php echo $email; ?></li>
          </ul>
          <a href="logout.php?logout">ログアウト</a>
        </div>
      </div>
    </main>
  </div>
</body>

</html>