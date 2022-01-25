<?php
//////////////////////////////////
// 全ユーザーの投稿を見れる画面
//////////////////////////////////
session_start();
$session_user = $_SESSION['USER'];
$session_name = $_SESSION['USER']['name'];
// 設定を読み込む
include_once '../config.php';
// ログインチェック
if (!$session_user) {
    header('Location:sign-in.php');
}
// usersテーブルとmypageテーブルを結合
// DB接続
include_once 'dbconnect.php';
// SQL文セット
$all_spot_register = $pdo->prepare("SELECT * FROM users U INNER JOIN mypage M ON U.user_id = M.user_id");
// SQL実行
$all_spot_register->execute();

// 全投稿idを取得
// SQL文セット
$all_spot_register = $pdo->prepare("SELECT * FROM mypage WHERE id");
// SQL文実行
$all_spot_register->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>
    <title>My観光ページ/全ての投稿</title>
    <meta name="description" content="ホーム画面">
</head>
<body>
    <!-- ヘッダー -->
    <?php include_once('../views/common/header.php')?>
    <!-- サイドバー -->
    <div class="side-ber">
        <ul class="side">
            <li class="side-name"><a href="spot.php">Myページを作る</a></li>
            <li class="side-name"><a href="home.php">myページに戻る</a></li>
            <li class="side-name"><a href="logout.php">ログアウトする</a></li>
        </ul>
    </div>
    <!-- 全ユーザーの投稿 -->
    <div class="all-user-content">
        <div class="all-user-place">
            <?php foreach ($all_spot_register as $all_spot_registers) : ?>
                <?php include('../views/common/all-user-registers.php'); ?>                    
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>