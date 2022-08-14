<?php

require_once  __DIR__.'/lib/mysqli.php';

function resetUserPass($link,$id,$mail,$pass){
    $sql = <<<EOT
        UPDATE users
        SET password = "$pass"
        WHERE id = "$id"
        AND mail = "$mail"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to register user').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id =  $_POST['id'];
    $mail =  $_POST['mail'];
    $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);
var_dump($pass);
        $link = dbConnect();
        resetUserPass($link,$id,$mail,$pass);
        mysqli_close($link);
        header("Location: login.php");
}
