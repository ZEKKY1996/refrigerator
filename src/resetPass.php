<?php

namespace Refrigerator;

require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/class/Users.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id =  $_POST['id'];
    $mail =  $_POST['mail'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT);
    $link = dbConnect();
    $user = new Users();
    $user->resetUserPass($link, $id, $mail, $pass);
    mysqli_close($link);
    header("Location: login.php");
}
