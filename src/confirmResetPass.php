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
    if(mysqli_num_rows($result) !== 1){
        $error = '入力したユーザーIDが見つかりません';
        return $error;
    };
}

function validate($id,$pass,$mail,$passConf){
    $errors = [];

    if(!strlen($id)){
        $errors['id'] = 'ユーザーIDを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^[a-zA-Z0-9]+$/',$id)){
        $errors['id'] = 'ユーザーIDは半角英数字で入力してください。'.PHP_EOL;
    }elseif(strlen($id)>20){
        $errors['id'] = 'ユーザーIDは20文字以内で入力してください。'.PHP_EOL;
    }

    if(!strlen($mail)){
        $errors['mail'] = 'メールアドレスを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+([a-zA-Z0-9\._-]+)+$/',$mail)){
        $errors['mail'] = '正しいメールアドレスを入力してください。'.PHP_EOL;
    }

    if(!strlen($pass)){
        $errors['pass'] = 'パスワードを入力してください。'.PHP_EOL;
    }elseif(!preg_match('/^(?=.+\d)(?=.*[A-Za-z])[0-9A-Za-z]{4,12}$/',$pass)){
        $errors['pass'] = 'パスワードは1つ以上の数字とアルファベットをいれて4字～12字で入力してください。'.PHP_EOL;
    }

    if($pass != $passConf){
        $errors['pass_conf'] = '確認用パスワードに誤りがあります。'.PHP_EOL;
    }

    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id =  $_POST['id'];
    $mail =  $_POST['mail'];
    $pass = $_POST['pass'];
    $passConf = $_POST['pass_conf'];

    $errors = validate($id,$pass,$mail,$passConf);
    if(!count($errors)){
        $link = dbConnect();
        $errors['unset'] = checkUser($link,$id);
        mysqli_close($link);
        if(!$errors['unset']){
            $content = __DIR__.'/views/confirmResetPass.php';
            include __DIR__.'/views/layout.php';
        }else{
            $content = __DIR__.'/views/exportUserInfo.php';
            include __DIR__.'/views/layout.php';
        }
    }else{
        $content = __DIR__.'/views/exportUserInfo.php';
        include __DIR__.'/views/layout.php';
    }
}else{
    header("Location: login.php");
}
