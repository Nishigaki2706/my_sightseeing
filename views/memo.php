<?php
// $spot_register = [
//     ['spot_image' => 'IMG_0306.jpeg',
//     'spot_name' => '西武ドーム',
//     'spot_place' => '埼玉県',
//     'spot_date' => '5月30日',
//     'spot_thought' => '日本ハムが勝った!!! うれしいでーーーーーーーーす!! I`m so fun!! aaaaaaaaaaaaaaaaaaaaaaaa',
//     ],
//     [
//     'spot_image' => 'tokyoyakeiIMGL31731929_TP_V.jpg',
//     'spot_name' => '東京駅',
//     'spot_place' => '東京都',
//     'spot_date' => '7月30日',
//     'spot_thought' => '綺麗な夜景でした！',
//     ],
//     [
//     'spot_image' => 'redstYT037_TP_V4.jpg',
//     'spot_name' => '立山',
//     'spot_place' => '富山県',
//     'spot_date' => '8月7日',
//     'spot_thought' => '山登り大変でした。',
//     ],
//     [
//     'spot_image' => 'redstYT040_TP_V4.jpg',
//     'spot_name' => '剣岳',
//     'spot_place' => '富山県',
//     'spot_date' => '8月9日',
//     'spot_thought' => '綺麗な景色でした！',
//     ],
//     [
//     'spot_image' => 'isezakiijinkaiIMGP3709267_TP_V4.jpg',
//     'spot_name' => '渋谷区',
//     'spot_place' => '東京都',
//     'spot_date' => '7月10日',
//     'spot_thought' => 'たくさん歩きました！',
//     ]
// ];


// register.php 
// <div class="edit"><a href="edit.php?id=<?php echo $spot_registers["id"];?>">編集</a></div>


<!-- // ?id=<?php echo $spot_register["user_id"] ;?> -->
<?php
// sign-in.php
// パスワード照合
if (password_verify($_POST['password'], $result['password'])) 
{
    // usersテーブルとmypageテーブルを結合
    // DB接続
    include_once 'dbconect.php';
    // SQL文セット
    $spot_register = $pdo->prepare("SELECT * FROM users U INNER JOIN mypage M ON U.user_id = M.user_id");
    // SQL実行
    $spot_register->execute();
    // user_id取得
    $_SESSION['USER'] = $spot_register['user_id'];
    // 
    $_SESSION['USER']['name'] = $spot_register['name'];
    // // user_id取得
    // $_SESSION['USER'] = $spot_register['user_id'];
    // home.phpに遷移
    // header('Location: home.php');
    exit;
}else{
    $error['miss'] = 'miss';
}



// sign-in.php 12/30 0:11
// パスワード照合
if (password_verify($_POST['password'], $result['password'])) 
{
    // usersテーブルとmypageテーブルを結合
    // DB接続
    include_once 'dbconect.php';
    // SQL文セット
    $spot_register = $pdo->prepare("SELECT * FROM users U INNER JOIN mypage M ON U.user_id = M.user_id");
    // SQL実行
    $spot_register->execute();
    // データ取得
    $result1 = $spot_register->fetch();
    // $_SESSIONにデータ格納
    $_SESSION['USER'] = $result1;
    // name取得
    $_SESSION['USER']['name'] = $result1['name'];
    // 投稿データ
    $_SESSION['USER']['spots'] = array();
    $_SESSION['USER']['spots'] = $result1;

    echo ('<pre>');
    var_dump($_SESSION['USER']['spots']);
    echo('</pre>');

    // home.phpに遷移
    header('Location: home.php');
    exit;

// home.php 12/30 0:11
    session_start();
$session_user = $_SESSION['USER'];
$session_name = $_SESSION['USER']['name'];
//$session_spots = $_SESSION['spots'];
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
//$spot_register = null;
//$empty[]='';
var_dump($session_user['user_id']);
echo "<br>";
//var_dump($session_spots);
echo "<br>";
// 設定を読み込む
include_once '../config.php';
if (empty($session_user)) {
}else{
    //usersテーブルとmypageテーブルを結合
    // DB接続
    $empty['no_content'] = 'empty'; 
    include_once 'dbconect.php';
    // SQL文セット
    $spot_register = $pdo->prepare("SELECT * FROM users U INNER JOIN mypage M ON U.user_id = M.user_id");
    // SQL実行
    $spot_register->execute();

    // user_idから投稿内容を取得
    // DB接続
    include_once 'dbconect.php';
    // SQL文セット
    $spot_register = $pdo->prepare("SELECT * FROM mypage WHERE user_id = :user_id");
    // プレースホルダーに値セット
    $spot_register->bindValue(":user_id", $session_user['user_id'], PDO::PARAM_STR);
    // SQL実行
    $spot_register->execute();
// if ($spot_register === '') {
//    $empty['no_content'] = 'empty';
}

// if (empty($spot_register)) {
//     $empty['no_content'] = 'empty'; 
// }