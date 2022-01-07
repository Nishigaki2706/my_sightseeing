<?php
try {
    // DB接続
    $pdo = new PDO('mysql:dbname=sightseeing;host=localhost;charset=utf8mb4', 'b73dd47eda3ad6' , 'f90edf03');
} catch (PDOException $e) {
    $msg = $e->getMessage();
    echo $msg;
}