<?php
session_start();
require_once  __DIR__.'/lib/mysqli.php';

function checkUser($link,$id,$pass){
    $errors = [];
    $sql = <<<EOT
    SELECT id
    FROM users
    WHERE id = "$id"
    AND password = "$pass"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to check user').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
    if(mysqli_num_rows($result) !== 1){
        $errors = 'ユーザーIDかパスワードに誤りがあります。';
    }
    return $errors;
}

function validate($id,$pass){
    $errors = [];

    if(!strlen($id)){
        $errors['id'] = 'ユーザーIDを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$id)){
        $errors['id'] = 'ユーザーIDは半角英数字で入力してください。'.PHP_EOL;
    }elseif(strlen($id)>20){
        $errors['id'] = 'ユーザーIDは20文字以内で入力してください。'.PHP_EOL;
    }

    if(!strlen($pass)){
        $errors['pass'] = 'パスワードを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$pass)){
        $errors['pass'] = 'パスワードは半角英数字で入力してください。'.PHP_EOL;
    }elseif(strlen($pass)>20){
        $errors['pass'] = 'パスワードは20文字以内で入力してください。'.PHP_EOL;
    }

    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['id'] =  $_POST['id'];
    $pass = $_POST['pass'];
    $id = $_SESSION['id'];
    $errors = validate($id,$pass);
    if(!count($errors)){
        $link = dbConnect();
        $errors = checkUser($link,$id,$pass);
        mysqli_close($link);
        if(!count($errors)){
            header("Location: index.php");
            exit();
        }
    }
}
session_destroy();
$title = 'ユーザー情報の入力';
$content = __DIR__.'/views/login.php';
include __DIR__.'/views/layout.php';
