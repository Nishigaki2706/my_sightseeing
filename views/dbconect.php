<?php
try {
    // DB接続
    $pdo = new PDO('mysql:dbname=heroku_252793a2f4f9597;host=us-cdbr-east-05.cleardb.net;' , 'b73dd47eda3ad6' , 'f90edf03');
} catch (PDOException $e) {
    $msg = $e->getMessage();
}