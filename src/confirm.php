<?php
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/class/Users.php';
require_once  __DIR__.'/class/Validate.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $id =  $_POST['id'];
    $mail =  $_POST['mail'];
    $pass = $_POST['pass'];
    $passConf = $_POST['pass_conf'];

    $validateUser = new Validate();
    $errors = $validateUser->validateUserInfo($id,$pass,$mail,$passConf);
    if(!count($errors)){
        $link = dbConnect();
        $user = new Users($id);
        $errors['overlap'] = $user->checkOverlapId($link,$id);
        mysqli_close($link);
        if(!$errors['overlap']){
            $content = __DIR__.'/views/confirm.php';
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
