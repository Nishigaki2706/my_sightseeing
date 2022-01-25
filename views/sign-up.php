<?php
//////////////////////////////////
// 会員登録画面
//////////////////////////////////
session_start();

// 環境変数設定
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$password = getenv('DB_PASSWORD');
$user = getenv('DB_USER');

if (isset($_POST["sign-up"])) 
{
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);
    // バリデーション
    // 名前が入力されていない場合＆文字数
    if ($name === '') {
        $error['name'] = "blank";
    }elseif(strlen($name) > 50) {
        $error['name'] = "over";
    }
    // パスワードが入力されていない場合＆文字数
    if ($_POST["password"] === '') {
        $error['password'] = "blank";
    }elseif(strlen($_POST['password']) < 4) {
        $error['password'] = "not_enough";
    }elseif(strlen($_POST['password']) > 60) {
        $error['password'] = "over";
    }
    // メールアドレス重複チェック
    try {
        // DB接続
        $check_pdo = new PDO('mysql:dbname='. $dbname .';host='. $host .';' , $user , $password);
    } catch (PDOException $e) {
        $msg = $e->getMessage();
    }
    // SQL文セット
    $query = $check_pdo->prepare("SELECT * FROM users WHERE email = :email");
    // プリペアドステートメントセット
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    // SQL実行
    $query->execute();
    // データ取得
    $checked = $query->fetch();
    // 重複チェック＆未入力チェック＆文字数
    if ($email === "") {
        $error['email'] = "blank"; 
    }elseif (strlen($email) > 228) {
        $error['email'] = "over";
    }elseif ($checked > 0){
        $error['email'] = 'duplicate';
    }else{
    // DB接続
    include_once 'dbconect.php';
    // SQL文セット
    $query = $pdo->prepare("INSERT INTO users(name, email ,password) VALUES (:name, :email, :password)");
    // プレイスホルダーの値セット
    $query->bindValue(':name', $name, PDO::PARAM_STR);
    $query->bindValue(':email', $email, PDO::PARAM_STR);
    $query->bindValue(':password', $password_hash, PDO::PARAM_STR);
    // SQL実行
    $result = $query->execute();
    var_dump($result);
    // ログイン画面に遷移
    header('Location: sign-in.php');
    exit;
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
    <title>会員登録</title>
</head>
<body>
    <div class="sign-up">
        <h1>会員登録</h1>
        <form action="sign-up.php" method="post">
            <input type="text" class="register" name="name" placeholder="名前を入力してください">
            <?php if(!empty($error['name']) && $error['name'] === 'blank') :?>
                <p class="error">名前を入力してください。</p>
            <?php elseif(!empty($error['name']) && $error['name'] === 'over') :?>
                <p class="error">名前は50文字以内で入力してください。</p>
            <?php endif ;?>
            <input type="mail" class="register" name="email" placeholder="メールアドレスを入力してください">
            <?php if(!empty($error['email']) && $error['email'] === 'blank') :?>
                <p class="error">メールアドレスを入力してください。</p>
            <?php elseif(!empty($error['email']) && $error['email'] === 'over') :?>
                <p class="error">メールアドレスは228文字以内で入力してください。</p>
            <?php elseif(!empty($error['email']) && $error['email'] === 'duplicate') :?>
                <p class="error">このメールアドレスは既に登録されています。</p>
            <?php endif ;?>    
            <input type="password" class="register" name="password" placeholder="パスワードを入力してください">
            <?php if(!empty($error["password"]) && $error['password'] === 'blank') :?>
                <p class="error">パスワードを入力してください</p>
            <?php elseif(!empty($error['password']) && $error['password'] === 'not_enough') :?>
                <p class="error">パスワードは4文字以上で入力してください。</p>
            <?php elseif(!empty($error['password']) && $error['password'] === 'over') :?>
                <p class="error">パスワードは60文字以内で入力してください。</p>
            <?php endif ;?>
            <button type="submit" name="sign-up">登録</button>
            <a href="sign-in.php" class="register">ログイン</a>
        </form>
    </div>
</body>
</html>