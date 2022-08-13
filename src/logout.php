<?php
require_once  __DIR__.'/lib/checkSession.php';
unset($_SESSION['id']);
session_destroy();
header ("Location:login.php");
