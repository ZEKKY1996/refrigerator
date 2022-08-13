<?php
session_start();
if (!count($_SESSION)) {
    header("Location: login.php");
}
