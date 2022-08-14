<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';

function logout($link,$id){
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

$id = $_SESSION['id'];
$link = dbConnect();
logout($link,$id);

unset($_SESSION['id']);
session_destroy();
header ("Location:login.php");
