<?php
require_once  __DIR__.'/lib/mysqli.php';

function checkUser($link,$id){
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
    if(mysqli_num_rows($result) === 1){
        $error = '入力したユーザーIDは使用されています。';
        return $error;
    };
}

function validate($id,$pass,$passConf){
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

    if($pass != $passConf){
        $errors['pass_conf'] = '確認用パスワードに誤りがあります。'.PHP_EOL;
    }

    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id =  $_POST['id'];
    $pass = $_POST['pass'];
    $passConf = $_POST['pass_conf'];

    $errors = validate($id,$pass,$passConf);
    if(!count($errors)){
        $link = dbConnect();
        $errors['overlap'] = checkUser($link,$id);
        mysqli_close($link);
        if(!$errors['overlap']){
            $content = __DIR__.'/views/confirm.php';
            include __DIR__.'/views/layout.php';
        }else{
            $content = __DIR__.'/views/signUp.php';
            include __DIR__.'/views/layout.php';
        }
    }else{
        $content = __DIR__.'/views/signUp.php';
        include __DIR__.'/views/layout.php';
    }
}else{
    header("Location: login.php");
}
