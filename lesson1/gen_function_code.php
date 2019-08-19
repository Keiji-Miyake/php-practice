<!doctype html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>関数コード生成フォーム</title>
</head>
<body>
<?php
// 洗濯リストの値を取得
$name = "param";
$selected_value = $_POST[$name];

// 定義済み変数を取得
$array = get_defined_functions();
asort($array["internal"]);

// 配列から洗濯リストを作成する
// パラメータ：配列／洗濯リスト／選択値
function disp_list($array, $name, $selected_value = " ") {
    echo '<select name="'. $name . '">';
    foreach($array as $key => $text) {
        echo '<option value="' . $text . '"' . (($selected_value == $text) ? " selected" : "") . '>' . $text . '</option>';
    }
    echo '</select>';
}

// 入力内容を処理する
$temp = '$temp = %s();';
$temp_url = "http://www.php.net/manual/ja/function.%s.php";
$temp_link = '<a href="%s" target="_blank">%s</a>';
if (isset($_POST["param"])) {
    $param = $_POST["param"];
    $result = sprintf($temp, $param);
    $result_url = sprintf($temp_url, str_replace("_", "_", $param));
    $result_link = sprintf($temp_link, $result_url, $param);
} else {
    $param = "";
}
?>
<form action="<?php echo $_SERVER["PHP_SELF"] ?>" method="post">
    <table cellpadding="10">
        <tr>
            <td>
                関数を選択：<br>
                <?php echo disp_list($array["internal"], $name, $selected_value); ?>
                <button type="submit" name="sub1">作成</button>
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td>
                作成されたコード：<br>
                <textarea name="ta1" cols="40" rows="3"><?php echo $result; ?></textarea>
                <p>PHPマニュアルへのリンク：<?php echo $result_link; ?></p>
            </td>
        </tr>
    </table>
</form>
</body>
</html>
