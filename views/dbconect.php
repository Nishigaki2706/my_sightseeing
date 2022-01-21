<?php
// 環境変数設定
$host = getenv('DB_HOST');
$name = getenv('DB_NAME');
$password = getenv('DB_PASSWORD');
$user = getenv('DB_USER');

try {
    // DB接続
    $pdo = new PDO('mysql:dbname='. $name .';host='. $host .';' , $user , $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}