<?php
    session_start();
    session_regenerate_id(true);

try {
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

    $post = sanitize($_POST);

    $message = '';
    $message .= $post['name']."様\n\nこのたびはご注文ありがとうございました。\n\n";
    $message .= "ご注文商品\n";
    $message .= "---------------\n";

    $cart = $_SESSION['cart'];
    $quantity = $_SESSION['quantity'];
    $count = count($cart);

    $dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
    $dbh = new PDO($dsn,DB_USER,DB_PASS);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    for($i = 0;$i < $count;$i++) {
        $sql = 'SELECT name,price FROM mst_product WHERE code=?';
        $stmt = $dbh->prepare($sql);
        $data[0] = $cart[$i];
        $stmt->execute($data);

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);

        $name = $rec['name'];
        $price = $rec['price'];
        $prices[] = $price;
        $quant = $quantity[$i];
        $total = $price * $quant;

        $message .= $name.' ';
        $message .= $price.'円 x ';
        $message .= $quant.'個 = ';
        $message .= $total."円\n";
    }

    $sql = 'LOCK TABLES dat_sales WRITE,dat_sales_product WRITE,dat_member WRITE';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $lastmembercode = 0;
    if($post['regist'] == 1) {
        $sql = 'INSERT INTO dat_member (password,name,email,postal1,postal2,address,tel,sex,born) VALUES (?,?,?,?,?,?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = md5($post['pass']);
        $data[] = $post['name'];
        $data[] = $post['email'];
        $data[] = $post['postal'][0];
        $data[] = $post['postal'][1];
        $data[] = $post['address'];
        $data[] = $post['tel'];
        if($post['sex'] == 'man') {
            $data[] = 1;
        } else {
            $data[] = 2;
        }
        $data[] = $post['born'];
        $stmt->execute($data);

        $sql = 'SELECT LAST_INSERT_ID()';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $lastmembercode = $rec['LAST_INSERT_ID()'];
    }

    $sql = 'INSERT INTO dat_sales (code_member,name,email,postal1,postal2,address,tel) VALUE (?,?,?,?,?,?,?)';
    $stmt = $dbh->prepare($sql);
    $data = array();
    $data[] = $lastmembercode;
    $data[] = $post['name'];
    $data[] = $post['email'];
    $data[] = $post['postal'][0];
    $data[] = $post['postal'][1];
    $data[] = $post['address'];
    $data[] = $post['tel'];
    $stmt->execute($data);

    $sql = 'SELECT LAST_INSERT_ID()';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();
    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
    $lastcode = $rec['LAST_INSERT_ID()'];

    for($i = 0;$i < $count;$i++) {
        $sql = 'INSERT INTO dat_sales_product (code_sales,code_product,price,quantity) VALUES (?,?,?,?)';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $lastcode;
        $data[] = $cart[$i];
        $data[] = $prices[$i];
        $data[] = $quantity[$i];
        $stmt->execute($data);
    }

    $sql = 'UNLOCK TABLES';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $dbh = null;

    $message .= "送料は無料です。\n";
    $message .= "--------------------\n\n";
    $message .= "代金は以下の口座にお振込みください。\n";
    $message .= "ろくまる銀行 やさい支店 普通口座 1234567\n";
    $message .= "入金確認が取れ次第、梱包、発送させていただきます。\n\n";

    if($post['regist'] == 1) {
        $message .= "会員登録が完了いたしました。\n";
        $message .= "次回からメールアドレスとパスワードでログインしてください。\n";
        $message .= "ご注文が簡単にできるようになります。\n\n";
    }
    $message .= "□□□□□□□□□□□□□□□□\n";
    $message .= "　〜安心野菜のろくまる農園〜 \n\n";
    $message .= "〇〇県六丸郡六丸村 123-4\n";
    $message .= "電話 090-6060-xxxx\n";
    $message .= "メール info@rokumarunouen.co.jp\n";
    $message .= "□□□□□□□□□□□□□□□□\n";
    print nl2br($message); //テストコード
    $title = 'ご注文ありがとうございます。';
    $header = 'From:kmiyake+shop@bukkenking.com';
    $message = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    // mb_send_mail($post['email'], $title, $message, $header); // メール送信

    $title = 'お客様から注文がありました。';
    $header = 'From:'.$post['email'];
    $message = html_entity_decode($message, ENT_QUOTES, 'UTF-8');
    mb_language('Japanese');
    mb_internal_encoding('UTF-8');
    // mb_send_mail('kmiyake+shop@bukkenking.com', $title, $message, $header); // メール送信
} catch(Exception $e) {
    print 'ただいま障害により大変ご迷惑をおかけしております。';
    exit();
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注文完了</title>
</head>
<body>
    <h1>注文完了</h1>
    <p>
        <?php echo $post['name']; ?>様<br>
        ご注文ありがとうございました。<br>
        <?php echo $post['email']; ?>にメールを送りましたのでご確認ください。<br>
        商品は以下の住所に発送させていただきます。
    </p>
<?php if($post['regist'] == 1) { ?>
    <p>また、会員登録頂きありがとうございました。<br>次回よりメールアドレスとパスワードでログインしてください。<br>ご注文が簡単にできるようになります。</p>
<?php } ?>
    <p>
        <?php echo $post['postal'][0]; ?>-<?php echo $post['postal'][1]; ?><br>
        <?php echo $post['address']; ?><br>
        <?php echo $post['tel']; ?>
    </p>
    <div><a href="/shop">ショップに戻る</a></div>
</body>
</html>
