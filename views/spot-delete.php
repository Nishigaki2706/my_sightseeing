<?php
// 投稿した観光スポットの削除
session_start();
$session_user = $_SESSION['USER'];
$session_name = $_SESSION['USER']['name'];
// ログインチェック
if (!$session_user) {
    header('Location:sign-in.php');
}
// DB接続
include_once 'dbconect.php';
// ディレクトリのファイル削除
// SQL文セット
$dir_delete = $pdo->prepare("SELECT * FROM mypage WHERE id =:id");
// プレイスホルダーに値セット
$dir_delete->bindValue(":id", $_GET["id"]);
// SQL実行
$dir_delete->execute();
// 削除したいデータ取得
$dir_delete_result = $dir_delete->fetch();
// 削除したいディレクトリファイルを削除
unlink($dir_delete_result['spot_file_path']);

// 対象のレコードを削除
// SQL文セット
$delete = $pdo->prepare("DELETE FROM mypage WHERE id =:id");
// プレイスホルダーに値セット
$delete->bindValue("id", $_GET["id"]);
// SQL実行
$result_delete = $delete->execute();
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>
    <title>My観光ページ</title>
    <meta name="description" content="投稿削除画面">
</head>
<body>
    <div class="spot_delete">
        <p class="comp_delete">削除が完了しました。</p>
        <a href="home.php">ホーム画面へ</a>
    </div>
</body>
</html>