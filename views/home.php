<?php
//////////////////////////////////
// ホーム画面
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
$spot_register = $pdo->prepare("SELECT * FROM users U INNER JOIN mypage M ON U.user_id = M.user_id");
// SQL実行
$spot_register->execute();
// user_idから投稿内容を取得
// DB接続
include_once 'dbconnect.php';
// SQL文セット
$spot_register = $pdo->prepare("SELECT * FROM mypage WHERE user_id = :user_id");
// プレースホルダーに値セット
$spot_register->bindValue(":user_id", $session_user['user_id'], PDO::PARAM_STR);
// SQL実行
$spot_register->execute();
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>
    <title>My観光ページ</title>
    <meta name="description" content="ホーム画面">
</head>
<body>
    <!-- ヘッダー -->
    <?php include_once('../views/common/header.php')?>
    <!-- サイドバー -->
    <div class="side-ber">
        <ul class="side">
            <li class="side-name"><a href="#top">トップに戻る</a></li>
            <li class="side-name"><a href="spot.php">Myページを作る</a></li>
            <li class="side-name"><a href="all-user-spot.php">全てのユーザーの投稿</a></li>
            <li class="side-name"><a href="logout.php">ログアウトする</a></li>
            <li class="side-name"><a href="user-delete.php">退会する</a></li>
        </ul>
    </div>
    <!-- メインビジュアル -->
    <div class="bg-loop" id="top"></div>
    <!-- MYページ -->
    <div class="sample">Myページ</div>
        <div class="content">
            <div class="place">
                <?php foreach ($spot_register as $spot_registers) : ?>
                    <?php include('../views/common/register.php'); ?>                    
                <?php endforeach; ?>
                <div class="no_posts" onclick="frameClick();">
                    <div class="add">Myページを作る</div>
                </div>
            </div>
        </div>
</body>
</html>