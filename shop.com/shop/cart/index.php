<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) === false) {
    print 'ようこそゲスト様';
    print '<a href="member/login/">会員ログイン</a>';
}  else {
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
if(isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
    $quantity = $_SESSION['quantity'];
    $count = count($cart);
} else {
    $count = 0;
}

if($count === 0) {
    print '<p>カートに商品が入っていません。</p>';
    print '<div><a href="/shop">商品一覧へ戻る</a></div>';
    exit();
}

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
try {
    $dbh = new PDO($dsn,DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    foreach($cart as $key => $val) {
        $sql = 'SELECT code,name,price,photo1 FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $val;
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $pro_name[] = $rec['name'];
        $pro_price[] = $rec['price'];

        if($rec['photo1'] === '') {
            $pro_photo1[] = '';
        } else {
            $pro_photo1[] = '<img src="/admin/uploads/product/'.$rec['photo1'].'">';
        }
    }
    $dbh = null;
}
catch (Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}
?>
    <h2>カートの中身</h2>
    <form action="./change.php" method="post">
    <table border="1">
        <thead>
            <tr>
                <th>商品</th>
                <th>商品画像</th>
                <th>価格</th>
                <th>数量</th>
                <th>小計</th>
                <th>削除</th>
            </tr>
        </thead>
        <tbody>
        <?php for($i=0;$i<$count;$i++): ?>
            <tr>
                <td><?php echo $pro_name[$i]; ?></td>
                <td><?php echo $pro_photo1[$i]; ?></td>
                <td><?php echo $pro_price[$i]; ?> 円</td>
                <td><input type="text" name="quantity<?php echo $i; ?>" value="<?php echo $quantity[$i]; ?>"></td>
                <td><?php echo $pro_price[$i] * $quantity[$i]; ?> 円</td>
                <td><input type="checkbox" name="delete" value="<?php echo $i; ?>"></td>
            </tr>
        <?php endfor; ?>
        </tbody>
    </table>
    <div>
        <input type="hidden" name="count" value="<?php echo $count; ?>">
        <button type="submit">数量変更</button>
        <button type="button" onclick="history.back()">戻る</button>
        <a href="/shop/cart/clear.php">カートを空にする</a>
    </div>
    </form>
    <div><a href="/shop/form">ご購入手続きへ進む</a></div>

<?php if(isset($_SESSION['member_login']) == true) { ?>
    <div><a href="../form/member_comfirm.php">会員かんたん注文へ進む</a></div>
<?php } ?>
</main>
</body>
</html>
