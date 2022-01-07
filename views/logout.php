<?php
session_start();
$_SESSION = array();
session_destroy();

?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>
    <meta name="description" content="ホーム画面">
    <title>ログアウト</title>
</head>
<body>
    <div class="logout">
        <div class="logout_title">My観光ページ</div>
        <h1>ログアウトしました。</h1>
        <h2>またお待ちしております。</h2>
        <div class="login"><a href="sign-in.php">ログイン</a></div>
    </div>

</body>
</html>