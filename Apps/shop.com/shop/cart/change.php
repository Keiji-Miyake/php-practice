<?php
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
    require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

    session_start();
    session_regenerate_id(true);

    $post = sanitize($_POST);

    $count = intval($post['count']);
    for($i=0;$i<$count;$i++) {
        if(preg_match('/\A[0-9]+\z/', $post['quantity'.$i]) === 0) {
            print '<p>数量に誤りがあります。</p>';
            print '<div><a href="/shop/cart">カートに戻る</a></div>';
            exit();
        }
        if($post['quantity'.$i] < 1 || 10 < $post['quantity'.$i]) {
            print '<p>終了は必ず１個以上、１０個までです。</p>';
            print '<div><a href="/shop/cart">カートに戻る</a></div>';
            exit();
        }
        $quantity[] = $post['quantity'.$i];
    }

    $cart = $_SESSION['cart'];

    if(isset($_POST['delete'])) {
        $deleteNo = intval($_POST['delete']);
        for($i = $count;0 < $i;$i--) {
            if($deleteNo === $i) {
                array_splice($cart, $i, 1);
                array_splice($quantity, $i, 1);
            }
        }
    }

    $_SESSION['cart'] = $cart;
    $_SESSION['quantity'] = $quantity;
    header('Location:/shop/cart');
    exit();
?>
