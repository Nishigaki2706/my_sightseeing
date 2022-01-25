<?php
//////////////////////////////////
// 投稿内容編集画面
//////////////////////////////////
// 設定を読み込む
include_once '../config.php';
session_start();
$session_user = $_SESSION['USER'];
$session_name = $_SESSION['USER']['name'];
// ログインチェック
if (!$session_user) {
    header('Location:sign-in.php');
}
// 設定を読み込む
include_once '../config.php';
// DB接続
include_once 'dbconnect.php';
// idを取得し変更前のページを表示
$id = $_GET['id'];
// SQL文セット
$spot_registered = $pdo->prepare("SELECT * FROM mypage WHERE id=:id");
// プレイスホルダーに値セット
$spot_registered->bindValue(":id", $id, PDO::PARAM_STR);
// // SQL実行
$spot_registered->execute();
// データ取得
$result = $spot_registered->fetch();
// 編集完了ボタンが押された場合
if (isset($_POST['ok'])) 
{
    // 送信されたデータを変数に格納
    $spot_name = $_POST['spot_name'];
    $spot_place = $_POST['spot_place'];
    $spot_date = $_POST['spot_date'];
    $spot_image = $_FILES['spot_image'];
    $spot_thought = $_POST['spot_thought'];
    // バリデーション
    // 名前が入力されていない場合＆文字数
    if ($spot_name === '') {
        $error['name'] = "blank";
    }elseif(strlen($spot_name) > 30) {
        $error['name'] = "over";
    }
    // 場所が入力されていない場合＆文字数
    if ($spot_place === '') {
        $error['place'] = "blank";
    }elseif(strlen($spot_name) > 100) {
        $error['place'] = "over";
    }
    // 日付が入力されていない場合＆文字数
    if ($spot_date === '') {
        $error['date'] = "blank";
    }elseif(strlen($spot_date) > 100) {
        $error['date'] = "over";
    }
    // 日付が入力されていない場合＆文字数
    if ($spot_thought === '') {
        $error['thought'] = "blank";
    }elseif(strlen($spot_thought) > 200) {
        $error['thought'] = "over";
    }
    // ファイルの中身のデータを取得
    $filename = basename($spot_image['name']);
    $tmp_path = $spot_image['tmp_name'];
    $file_err = $spot_image['error'];
    $filesize = $spot_image['size'];
    // base64エンコード化して$img_srcに格納
    if (isset($_FILES['spot_image']['tmp_name'])) {
        $file_img = $_FILES['spot_image']['tmp_name'];
    $img_data = base64_encode(file_get_contents($file_img));
    $img_src = 'data: ' . mime_content_type($file_img) . ';base64,' . $img_data;
    }else {
        $error['no-picture'] = "empty";
    }
    // アップロードするディレクトを決める
    $upload_dir = '/tmp';
    // ファイル名に日付を含める
    $date_filename = date('YmdHis'). $filename;
    // ファイルパス
    $save_path = $upload_dir . $date_filename;
    // ファイルのバリデーション
    // ファイルサイズが1MB未満か
    if($filesize > 5242880 || $file_err == 2){
        $error['size-over'] = "over";
    }
    // 拡張子は画像形式か
    $check_ext = array('jpg', 'jpeg', 'png');
    $get_ext = pathinfo($filename, PATHINFO_EXTENSION);
    // 拡張子を小文字に変換しファイルチェック
    if(!in_array(strtolower($get_ext), $check_ext))
    {
        $error['no-picture'] = "empty"; 
    }
    if(is_uploaded_file($tmp_path)) 
    {
        // DB接続
        include_once 'dbconnect.php';
        // SQL文セット
        $query = $pdo->prepare("UPDATE mypage SET spot_name = :spot_name, spot_place =:spot_place, spot_date =:spot_date, file_name =:file_name, spot_file_path =:spot_file_path ,spot_dir_path =:spot_dir_path, spot_thought =:spot_thought, updated_at=NOW() WHERE id =:id");
        // プレースホルダーに値セット
        $query->bindValue(":spot_name", $spot_name, PDO::PARAM_STR);
        $query->bindValue(":spot_place", $spot_place, PDO::PARAM_STR);
        $query->bindValue(":spot_date", $spot_date, PDO::PARAM_STR);
        $query->bindValue(":file_name", $filename, PDO::PARAM_STR);
        $query->bindValue(":spot_file_path", $img_data, PDO::PARAM_STR);
        $query->bindValue(":spot_dir_path", $save_path, PDO::PARAM_STR);
        $query->bindValue(":spot_thought", $spot_thought, PDO::PARAM_STR);
        $query->bindValue(":id", $id, PDO::PARAM_STR);
        // SQL実行
        $edited = $query->execute();
        header('Location: home.php');
    }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
    <?php include_once('../views/common/head.php'); ?>  
    <title>編集画面</title>
    <meta name="description" content="投稿編集画面">
</head>
<body>
    <!-- ヘッダー -->
    <?php include_once('../views/common/header.php')?>
    <!-- サイドバー -->
    <div class="side-ber">
        <ul class="side">
            <li class="side-name"><a href="home.php">ホームに戻る</a></li>
            <li class="side-name"><a href="logout.php">ログアウトする</a></li>
        </ul>
    </div>
    <!-- 投稿編集画面 -->
    <div class="create-page">
            <form action="" method="post" enctype="multipart/form-data">
                <h1>Myページ編集</h1>
                <input type="text" class="place" name="spot_name" value="<?php echo htmlspecialchars($result['spot_name']); ?>">
                    <?php if((!empty($error['name']) && $error['name'] === "blank")) :?>
                        <p class="error">スポット名を入力してください。</p>
                    <?php endif ;?>
                    <?php if((!empty($error['name']) && $error['name'] === "over")) :?>
                        <p class="error">30文字以内で入力してください。</p>
                    <?php endif ;?>
                <input type="text" class="place" name="spot_place" value="<?php echo htmlspecialchars($result['spot_place']);?>">
                    <?php if((!empty($error['place']) && $error['place'] === "blank")) :?>
                        <p class="error">場所を入力してください。</p>
                    <?php endif ;?>
                    <?php if((!empty($error['place']) && $error['place'] === "over")) :?>
                        <p class="error">100文字以内で入力してください。</p>
                    <?php endif ;?>
                <input type="text" class="place" name="spot_date" value="<?php echo htmlspecialchars($result['spot_date']);?>">
                    <?php if((!empty($error['date']) && $error['date'] === "blank")) :?>
                        <p class="error">日付を入力してください。</p>
                    <?php endif ;?>
                    <?php if((!empty($error['date']) && $error['date'] === "over")) :?>
                        <p class="error">20文字以内で入力してください。</p>
                    <?php endif ;?>
                <input type="file" class="place" name="spot_image" value="<?php echo $result['spot_dir_path'];?>">
                    <?php if((!empty($error['no-picture']) && $error['no-picture'] === "empty")) :?>
                        <p class="error">画像ファイルを添付してください。</p>
                    <?php endif ;?>
                    <?php if((!empty($error['size-over']) && $error['size-over'] === "over")) :?>
                        <p class="error">ファイルサイズは5MB未満にしてください。</p>
                    <?php endif ;?>
                <input type="text" class="place" name="spot_thought" value="<?php echo htmlspecialchars($result['spot_thought']);?>">
                    <?php if((!empty($error['thought']) && $error['thought'] === "blank")) :?>
                            <p class="error">感想を入力してください。</p>
                    <?php endif ;?>
                    <?php if((!empty($error['thought']) && $error['thought'] === "over")) :?>
                            <p class="error">200文字以内で入力してください。</p>
                    <?php endif ;?>
                <button type="submit" name="ok">編集完了</button>
            </form>
        </div>
</body>
</html>