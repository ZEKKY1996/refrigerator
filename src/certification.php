<?php
session_start();
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/class/Users.php';
require_once  __DIR__.'/class/Session.php';
require_once  __DIR__.'/class/Validate.php';

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $_SESSION['id'] = $_POST['id'];
    $pass = $_POST['pass'];
    $id = $_SESSION['id'];
    $validate = new Validate();
    $errors = $validate->validateLoginUserInfo($id,$pass);

    if(!count($errors)){
        $link = dbConnect();
        $user = new Users($id);
        $errors = $user->checkExistId($link,$id);
            if(!count($errors)){
                $hashPass = $user->getUserPass($link,$id);
                if(password_verify($pass,$hashPass['password'])){
                    $errors = $user->checkUserLog($link,$id);
                    if(!count($errors)){
                        $_SESSION['sessionTime'] = time();
                        $sessionTime = $_SESSION['sessionTime'];
                        $session = new Session();
                        $session->setSessionTime($link,$id,$sessionTime);
                        mysqli_close($link);
                        header("Location: index.php");
                        exit();
                    }
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
