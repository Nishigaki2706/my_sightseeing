<?php
// 環境変数設定
$host = getenv('DB_HOST');
$dbname = getenv('DB_NAME');
$password = getenv('DB_PASSWORD');
$user = getenv('DB_USER');

try {
    // DB接続
    $pdo = new PDO('mysql:dbname='. $dbname .';host='. $host .';' , $user , $password);
} catch (PDOException $e) {
    $msg = $e->getMessage();
}