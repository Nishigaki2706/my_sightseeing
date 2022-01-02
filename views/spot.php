<?php
// 設定読み込み
include_once '../config.php';
    session_start();
    $session_user = $_SESSION['USER'];
    $session_name = $_SESSION['USER']['name'];
if (isset($_POST['ok'])) 
{
    $spot_name = $_POST['spot_name'];
    $spot_place = $_POST['spot_place'];
    $spot_date = $_POST['spot_date'];
    $spot_image = $_FILES['spot_image'];
    $spot_thought = $_POST['spot_thought'];
    // 画像ファイル('spot_image)の中身のデータを取得
    $filename = basename($spot_image['name']);
    $tmp_path = $spot_image['tmp_name'];
    $file_err = $spot_image['error'];
    $filesize = $spot_image['size'];
    // アップロードするディレクトを決める
    $upload_dir = 'img/img-up/';
    // ファイル名に日付を含める
    $date_filename = date('YmdHis'). $filename;
    // ファイルパス
    $save_path = $upload_dir . $date_filename;
    // ファイルのバリデーション
    // ファイルサイズが1MB未満か
    if($filesize > 5242880 || $file_err == 2){
    echo 'ファイルサイズは5MB未満にしてください。';
    echo "<br>";
    }
    // 拡張子は画像形式か
    $check_ext = array('jpg', 'jpeg', 'png');
    $get_ext = pathinfo($filename, PATHINFO_EXTENSION);
    // 拡張子を小文字に変換しファイルチェック
    if(!in_array(strtolower($get_ext), $check_ext))
    {
        echo '画像ファイルを添付してください。';
        echo "<br>";
    }
    if(is_uploaded_file($tmp_path)) 
    {
        if(move_uploaded_file($tmp_path, $save_path))
        {
            // DB接続
            include_once 'dbconect.php';
            // SQL文セット
            $query = $pdo->prepare("INSERT INTO mypage(user_id, spot_name, spot_place, spot_date, file_name, spot_file_path, spot_thought)VALUES(:user_id, :spot_name, :spot_place, :spot_date, :file_name, :spot_file_path, :spot_thought)");
            // プレースホルダーに値セット
            $query->bindValue(":user_id", $session_user['user_id'], PDO::PARAM_STR);
            $query->bindValue(":spot_name", $spot_name, PDO::PARAM_STR);
            $query->bindValue(":spot_place", $spot_place, PDO::PARAM_STR);
            $query->bindValue(":spot_date", $spot_date, PDO::PARAM_STR);
            $query->bindValue(":file_name", $filename, PDO::PARAM_STR);
            $query->bindValue(":spot_file_path", $save_path, PDO::PARAM_STR);
            $query->bindValue(":spot_thought", $spot_thought, PDO::PARAM_STR);
            // SQL実行
            $result = $query->execute();
                if ($result === true) 
                {
                // ホーム画面に遷移
                header('Location: index.php');
                exit;
                }
        }
    }else{
        echo 'エラーです。';
    }
}else{
    echo 'エラー';
}

?>
<!DOCTYPE html>
<html lang="ja">
<head>
<?php include_once('../views/common/head.php'); ?>
    <title>Myページ作成画面</title>
    <meta name="description" content="Myページ作成画面です">
</head>
<body>
    <div class="container">
        <!-- ヘッダー -->
        <?php include_once('../views/common/header.php')?>
        <!-- サイドバー -->
        <div class="side-ber">
            <ul class="side">
                <li class="side-name"><a href="index.php">ホームに戻る</a></li>
                <li class="side-name"><a href="logout.php">ログアウトする</a></li>
            </ul>
        </div>
        <!-- Myページ作成画面 -->
        <div class="create-page text-center">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Myページ作成</h1>
                <input type="text" class="place" name="spot_name" placeholder="お気に入りスポット名" required>
                <input type="text" class="place" name="spot_place" placeholder="どこにありましたか？" required>
                <input type="text" class="place" name="spot_date" placeholder="いつ行きましたか？" required>
                <input type="file" class="place" name="spot_image" placeholder="写真はありますか？" accept="image/*" >
                <input type="text" class="place" name="spot_thought" placeholder="どんな感じでしたか？" required>
                <button type="submit" name="ok">完成!!</button>
            </form>
        </div>
    </div>
</body>
</html>