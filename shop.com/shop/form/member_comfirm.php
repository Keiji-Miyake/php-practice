<?php
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/config.php');
require_once($_SERVER['DOCUMENT_ROOT'] . '/common/functions.php');

session_start();
session_regenerate_id(true);
if(isset($_SESSION['member_login']) == false) {
    print '<p>ログインされていません。</p>';
    print '<a href="../">商品一覧へ</a>';
    exit();
}
$code = $_SESSION['member_code'];

$dsn = 'mysql:dbname='.DB_NAME.';host='.DB_HOST.';charset=utf8';
$dbh = new PDO($dsn,DB_USER,DB_PASS);
$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

$sql = 'SELECT name,email,postal1,postal2,address,tel FROM dat_member WHERE code=?';
$stmt = $dbh->prepare($sql);
$data[] = $code;
$stmt->execute($data);
$rec = $stmt->fetch(PDO::FETCH_ASSOC);

$dbh = null;

$name = $rec['name'];
$email = $rec['email'];
$postal1 = $rec['postal1'];
$postal2 = $rec['postal2'];
$address = $rec['address'];
$tel = $rec['tel'];
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
        <h1>注文確認</h1>
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
                    <?php echo $postal1; ?>-<?php echo $postal2; ?>
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
        <form action="member_done.php" method="post">
            <input type="hidden" name="name" value="<?php echo $name; ?>">
            <input type="hidden" name="email" value="<?php echo $email; ?>">
            <input type="hidden" name="postal[]" value="<?php echo $postal1; ?>">
            <input type="hidden" name="postal[]" value="<?php echo $postal2; ?>">
            <input type="hidden" name="address" value="<?php echo $address; ?>">
            <input type="hidden" name="tel" value="<?php echo $tel; ?>">
            <div>
                <button type="button" onclick="history.back();">戻る</button>
                <button type="submit">OK</button>
            </div>
        </form>
    </main>
</body>
</html>
