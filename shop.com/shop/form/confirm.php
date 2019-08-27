<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

$post = sanitize($_POST);
$flag = false;
$errors = [];

$name = $post['name'];
$email = $post['email'];
$postal = $post['postal'];
$address = $post['address'];
$tel = $post['tel'];
$regist = $post['regist'];
$pass = $post['pass'];
$pass2 = $post['pass2'];
$sex = $post['sex'];
$birth = $post['born'];

if($name === '') {
    $flag = true;
    $errors[] = 'お名前が入力されていません。';
}

if(preg_match('/\A[\w\-\+\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) === 0) {
    $flag = true;
    $errors[] = 'メールアドレスを正確に入力してください。';
}

if(preg_match('/\A[0-9]+\z/', $postal[0]) === 0) {
    $flag = true;
    $errors[] = '郵便番号は半角数字で入力してください。';
}
if(preg_match('/\A[0-9]+\z/', $postal[1]) === 0) {
    $flag = true;
    $errors[] = '郵便番号は半角数字で入力してください。';
}

if($address === '') {
    $flag = true;
    $errors[] = '住所が入力されていません。';
}

if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) === 0) {
    $flag = true;
    $errors[] = '電話番号を正確に入力してください。';
}

if($regist == 1) {
    if($pass === '') {
        $flag = true;
        $errors[] = 'パスワードが入力されていません。';
    }

    if($pass !== $pass2) {
        $flag = true;
        $errors[] = 'パスワードが一致しません。';
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>注文フォーム確認</title>
</head>
<body>
    <main>
<?php if($flag): ?>
<?php foreach($errors as $key => $error): ?>
    <p><?php echo $error; ?></p>
<?php endforeach; ?>
    <div><button onclick="history.back();">戻る</button></div>
<?php else: ?>
        <h1>注文確認</h1>
        <form action="done.php" method="post">
            <table>
                <tr>
                    <th>お名前 </th>
                    <td><?php echo $name; ?></td>
                </tr>
                <tr>
                    <th>メールアドレス</th>
                    <td><?php echo $email; ?></td>
                </tr>
                <tr>
                    <th>郵便番号</th>
                    <td>
                        <?php echo $postal[0]; ?>-<?php echo $postal[1]; ?>
                    </td>
                </tr>
                <tr>
                    <th>住所</th>
                    <td><?php echo $address; ?></td>
                </tr>
                <tr>
                    <th>電話番号</th>
                    <td><?php echo $tel; ?></td>
                </tr>
            </table>
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="postal[]" value="<?php echo $postal[0]; ?>">
            <input type="hidden" name="postal[]" value="<?php echo $postal[1]; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
<?php if($regist == 1): ?>
            <table>
                <tr>
                    <th>性別</th>
                    <td><?php echo $sex === 'man' ? "男性" : "女性"; ?></td>
                </tr>
                <tr>
                    <th>生まれ年</th>
                    <td><?php echo $birth; ?>年代</td>
                </tr>
            </table>
            <input type="hidden" name="regist" value="<?php echo $regist; ?>">
            <input type="hidden" name="pass" value="<?php echo $pass; ?>">
            <input type="hidden" name="sex" value="<?php echo $sex; ?>">
            <input type="hidden" name="born" value="<?php echo $birth; ?>">
<?php endif; ?>
            <div>
                <button type="button" onclick="history.back();">戻る</button>
                <button type="submit">OK</button>
            </div>
        </form>
<?php endif; ?>
    </main>
</body>
</html>
