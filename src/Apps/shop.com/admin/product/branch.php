<?php
session_start();
session_regenerate_id(true);
if(isset($_SESSION['login']) === false) {
    print 'ログインされていません。<br>';
    print '<a href="/login/">ログイン画面へ</a>';
    exit();
}

if(isset($_POST['detail']) === true) {
    if(isset($_POST['code'])===false) {
        header('Location: error.php');
        exit();
    }
    $code = $_POST['code'];
    header('Location: detail?code='.$code);
    exit();
}

if(isset($_POST['regist']) === true) {
    header('Location: regist');
    exit();
}

if(isset($_POST['edit']) === true) {
    if(!isset($_POST['code'])) {
        header('Location: error.php');
        exit();
    }
    $code = $_POST['code'];
    header('Location: edit?code='.$code);
    exit();
}

if(isset($_POST['delete']) === true) {
    if(!isset($_POST['code'])) {
        header('Location: error.php');
        exit();
    }
    $code = $_POST['code'];
    header('Location: delete?code='.$code);
    exit();
}
