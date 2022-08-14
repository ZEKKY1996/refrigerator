<?php

require_once  __DIR__.'/lib/mysqli.php';

function registerUser($link,$id,$mail,$pass){
    $sql = <<<EOT
        INSERT INTO users (
            id,
            mail,
            password,
            status,
            sessionTime
        ) VALUES (
            "$id",
            "$mail",
            "$pass",
            "logout",
            0
        )
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to register user').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

function createTable($link,$id){
    $sql = <<<EOT
        CREATE TABLE $id (
            id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            volume FLOAT NOT NULL,
            unit VARCHAR(10),
            parchase_date DATE,
            limit_date DATE,
            freezing VARCHAR(10)
        ) DEFAULT CHARACTER SET=utf8mb4;
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to create table').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id =  $_POST['id'];
    $mail =  $_POST['mail'];
    $pass = password_hash($_POST['pass'],PASSWORD_DEFAULT);

        $link = dbConnect();
        registerUser($link,$id,$mail,$pass);
        createTable($link,$id);
        mysqli_close($link);
        header("Location: login.php");
}
