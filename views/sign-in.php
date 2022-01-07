<?php
// サインイン・パスワード照合
session_start();
if (isset($_POST["sign-in"])) 
{
    $email = $_POST["email"];
    // バリデーション
    // メールアドレスが入力されていない場合
    if ($email === '') {
        $error['email'] = "blank";
    }
    // パスワードが入力されていない場合
    if ($_POST["password"] === '') {
        $error['password'] = "blank";
    }
    // パスワードをハッシュ化
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    // DB接続
    include_once 'dbconect.php';
    // SQL文セット
    $query = $pdo->prepare("SELECT * FROM users WHERE email = :email");
    // プレースホルダーに値セット
    $query->bindValue("email", $email, PDO::PARAM_STR);
    // SQL実行
    $query->execute();
    // データ取得
    $result = $query->fetch();
    if (empty($email || $_POST['password'])) {
        // メールアドレスが入力されていない場合
        if ($email === '') {
            $error['email'] = "blank";
        }
        // パスワードが入力されていない場合
        if ($_POST["password"] === '') {
            $error['password'] = "blank";
        }
    }else{
        // パスワード照合
        if (password_verify($_POST['password'], $result['password'])) 
        {
            // user_id取得
            $_SESSION['USER'] = $result;
            // nameを取得
            $_SESSION['USER']['name'] = $result['name'];
            // home.phpに遷移
            header('Location: home.php');
            exit;
        }else{
            $error['miss'] = 'miss';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../views/css/style.css">
    <title>ログイン画面</title>
</head>
<body>
    <div class="sign-up">
        <h1>ログイン画面</h1>
        <form action="sign-in.php" method="post">
            <?php if(!empty($error['miss']) && $error['miss'] === 'miss'):?>
                <p class="error">メールアドレスまたはパスワードが間違っています。</p>
            <?php endif;?>
            <input type="mail" class="register" name="email" placeholder="メールアドレスを入力してください">
            <?php if(!empty($error['email']) && $error['email'] === 'blank') :?>
                <p class="error">メールアドレスを入力してください。</p>
            <?php endif ;?>
            <input type="password" class="register" name="password" placeholder="パスワードを入力してください">
            <?php if(!empty($error['password']) && $error['password'] === 'blank') :?>
                <p class="error">パスワードを入力してください。</p>
            <?php endif ;?>
            <button type="submit" name="sign-in">ログイン</button>
            <a href="sign-up.php" class="register">登録</a>
        </form>
    </div>
</body>
</html>