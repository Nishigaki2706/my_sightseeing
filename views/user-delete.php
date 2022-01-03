<?php
// 設定読み込み
include_once '../config.php';
session_start();
$session_user = $_SESSION['USER'];
$session_name = $_SESSION['USER']['name'];

// ログインチェック
if (!$session_user) {
    header('Location:sign-in.php');
}
if (isset($_POST['withdrawal'])) {
    // DB接続
    include_once 'dbconect.php';

    // ディレクトリのファイル削除
    // SQL文セット
    $dir_delete = $pdo->prepare("SELECT * FROM mypage WHERE user_id =:user_id");
    // プレイスホルダーに値セット
    $dir_delete->bindValue(":user_id", $session_user['user_id'],  PDO::PARAM_STR);
    // SQL実行
    $dir_delete->execute();
    // 削除したいデータ取得
    $dir_delete_result = $dir_delete->fetch();
    // 削除したいディレクトリファイルを削除
    unlink($dir_delete_result['spot_file_path']);

    //投稿削除
    // SQL文セット
    $delete = $pdo->prepare("DELETE FROM mypage WHERE user_id =:user_id");
    // プレイスホルダーに値セット
    $delete->bindValue(":user_id", $session_user['user_id'], PDO::PARAM_STR);
    // SQL実行
    $result_delete = $delete->execute();

    // 退会実行
    // SQL文セット
    $user_delete = $pdo->prepare("DELETE FROM users WHERE user_id = :user_id");
    // プレースホルダーに値セット
    $user_delete->bindValue(":user_id", $session_user['user_id'], PDO::PARAM_STR);
    // SQL実行
    $user_delete->execute();
    // 画面遷移
    header('Location:delete-comp-user.php');
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>
    <title>My観光ページ/退会画面</title>
    <meta name="description" content="My観光ページ/退会画面">
</head>
<body>
    <div class="delete-content">
        <h1>退会画面</h1>
        <p class="user_delete">退会しますか？</p>
        <form action="" method="post">
        <input type="submit" name="withdrawal" value="退会する">
    </form>
</div>
</body>
</html>