<?php
$filename = 'count.txt';
$length = 8;
// ファイルが存在するか
if(!file_exists($filename)) {
    touch($filename);
    file_put_contents($filename, 0);
}
$fp = fopen($filename, 'r+');
$count = fgets($fp, $length);
//中身が空だったり、不正な値は弾く
if(empty($count) || !is_numeric($count)){
    file_put_contents($filename, 0);
}
//ファイルポインタを先頭に戻す
rewind($fp); // fseek($fp, 0, SEEK_SET); でもよい。 SEEK_CUR: 現在 SEEK_END: 終端
//ファイル書き込み
$count++;
fputs($fp, $count);
// ファイルを閉じる
flock($fp, LOCK_UN);
fclose($fp);
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
          <h1>アクセスカウンター</h1>
          <p>このページは<?php echo $count; ?>回目です</p>
        </div>
      </div>
    </main>
  </div>
</body>

</html>
