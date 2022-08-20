<?php
require_once  __DIR__ . '/lib/checkSession.php';
require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/class/Session.php';

$id = $_SESSION['id'];
$link = dbConnect();
$log = new Session();
$log->logout($link,$id);

unset($_SESSION['id']);
session_destroy();
header ("Location:login.php");
