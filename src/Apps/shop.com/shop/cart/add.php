<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) === false) {
    print 'ようこそゲスト様';
    print '<a href="member/login/">会員ログイン</a>';
}
else {
    print 'ようこそ';
    print $_SESSION['member_name'];
    print '様';
    print '<a href="member/logout">ログアウト</a>';
    print '<br>';
}
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
<main>
    <h1>カート</h1>
<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

try {
    $code = $_GET['procode'];
    if(isset($_SESSION['cart'])) {
        $cart = $_SESSION['cart'];
        $quantity = $_SESSION['quantity'];
        if(in_array($code, $cart)) {
            print '<p>その商品はすでにカートに入っています。</p>';
            print '<div><a href="/shop">商品一覧に戻る</a></div>';
            exit();
        }
    }
    $cart[] = $code;
    $quantity[] = 1;
    $_SESSION['cart'] = $cart;
    $_SESSION['quantity'] = $quantity;
}
catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <p>カートに追加しました。</p>
    <div><a href="/shop">商品一覧に戻る</a></div>
</main>
</body>
</html>
