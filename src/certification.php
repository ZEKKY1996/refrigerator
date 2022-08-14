<?php
session_start();
require_once  __DIR__.'/lib/mysqli.php';

function checkUserId($link,$id){
    $errors = [];
    $sql = <<<EOT
    SELECT id
    FROM users
    WHERE id = "$id"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to check user').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
    if(mysqli_num_rows($result) !== 1){
        $errors = '入力されたユーザーIDの登録情報が見つかりません。';
    }
    return $errors;
}

function getUserPass($link,$id){
    $errors = [];
    $sql = <<<EOT
    SELECT password
    FROM users
    WHERE id = "$id"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to get user pass').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
    $hashPass = mysqli_fetch_assoc($result);
    return $hashPass;
}

function setStartTime($link,$id,$startTime){
    $sql = <<<EOT
    UPDATE users
    SET status = "login",
        startTime = "$startTime"
    WHERE id = "$id"
    EOT;
    $result = mysqli_query($link ,$sql);
    if(!$result){
        error_log('Error: fail to get user pass').PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
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
    $_SESSION['start'] = time();
    $_SESSION['id'] = $_POST['id'];
    $pass = $_POST['pass'];
    $id = $_SESSION['id'];
    $startTime = date('Y-m-d H:i:s',$_SESSION['start']);
    $errors = validate($id,$pass);

    if(!count($errors)){
        $link = dbConnect();
        $errors = checkUserId($link,$id);

        if(!count($errors)){
            $hashPass = getUserPass($link,$id);
            if(password_verify($pass,$hashPass['password'])){
                setStartTime($link,$id,$startTime);
                mysqli_close($link);
                header("Location: index.php");
                exit();
            }else{
                $errors[] = 'パスワードに誤りがあります。';
            }
        }
        mysqli_close($link);
    }
}
session_destroy();
$title = 'ユーザー情報の入力';
$content = __DIR__.'/views/login.php';
include __DIR__.'/views/layout.php';
