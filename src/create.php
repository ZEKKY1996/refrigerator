<?php

require_once  __DIR__ . '/lib/checkSession.php';
require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/class/Refrigerator.php';
require_once  __DIR__ . '/class/Validate.php';

$id = $_SESSION['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = [
        'name' => $_POST['name'],
        'volume' => floor((float)$_POST['volume'] * 10) / 10,
        'unit' => $_POST['unit'],
        'parchase_date' => $_POST['parchase_date'],
        'limit_date' => $_POST['limit_date'],
        'freezing' => $_POST['freezing']
    ];
    $validate = new Validate();
    $errors = $validate->validateItemInfo($item);
    if (!count($errors)) {
        $link = dbConnect();
        $refrigerator = new Refrigerator();
        $refrigerator->insertItem($link, $id, $item);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$content = __DIR__ . '/views/new.php';
include __DIR__ . '/views/layout.php';
