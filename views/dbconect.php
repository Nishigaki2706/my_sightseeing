<?php
try {
    // DB接続
    $pdo = new PDO('mysql:dbname=sightseeing;host=localhost;charset=utf8mb4', 'root' , '');
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo $msg;
}