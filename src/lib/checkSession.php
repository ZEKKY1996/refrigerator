<?php
session_start();
require_once  __DIR__.'/mysqli.php';
function lostSessionLogout($link,$time){
    $sql = <<<EOT
    UPDATE users
    SET status = "logout",
        sessionTime = 0
    WHERE status = "login"
    AND sessionTime < $time - 900
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to get user pass').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}
function timeout($link,$id){
    $sql = <<<EOT
    UPDATE users
    SET status = "logout",
        sessionTime = 0
    WHERE id = "$id"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to get user pass').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

$link = dbConnect();
$time = time();
if (!count($_SESSION)) {
    lostSessionLogout($link,$time);
    mysqli_close($link);
    session_destroy();
    header("Location: login.php");
}else{
    $id = $_SESSION['id'];
    if($time - $_SESSION['sessionTime'] > 900){
        timeout($link,$id);
        mysqli_close($link);
        unset($_SESSION['id']);
        session_destroy();
        header ("Location:login.php");
    }
}
$_SESSION['sessionTime'] = time();
