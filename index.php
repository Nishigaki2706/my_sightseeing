<?php
session_start();
$session_user = $_SESSION['USER'];
// ログインチェック
if (!$session_user) {
    header('Location:sign-in.php');
}else{
    header('Location:home.php');
}
?>