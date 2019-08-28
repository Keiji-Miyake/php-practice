<?php
require_once 'vendor/autoload.php';

// Valitronインスタンス作成
$v = new Valitron\Validator($_POST);

// 必須項目チェック
$v->rule('required', ['name', 'email', 'password']);
// emailチェック
$v->rule('email', 'email');
// パスワードチェック
$v->rule('equals', 'password', 'password_again');

// エラーメッセージを日本語化する
$v->labels(array(
    'name' => '名前',
    'email' => 'メールアドレス',
    'password' => 'パスワード'
));

// バリデーションを実行
if ($v->validate()) {
    echo "エラーなし！＼(^o^)／";
    // print_r($v->data());
} else {
    // echo $v->errors()['name'][0];

    foreach ($v->errors() as $error) {
        // var_dump($error);
        foreach ($error as $value) {
            // var_dump($value);
            echo $value;
        }
    }
}
?>
<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ログイン | 会員登録とログイン機能</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<header class="header"></header>
<main class="main container-fluid">
    <div class="row flex-xl-nowrap">
        <article class="article col-12 bd-content">
            <form action="" method="post">
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="email" class="form-control" id="name" name="name" placeholder="山田　太郎">
                </div>
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="example@example.com">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="password_again">Password</label>
                    <input type="password" class="form-control" id="password_again" name="password_again" placeholder="password_again">
                </div>
                <div class="form-group form-check">
                    <input type="checkbox" class="form-check-input" id="check">
                    <label class="form-check-label" for="check">Check me out</label>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </article>
    </div>
</main>
<footer class="footer"></footer>
</body>
</html>
