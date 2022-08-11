<?php
$item = [
    'name' => '',
    'volume' => '',
    'unit' => '',
    'parchase_date' => '',
    'limit_date' => ''
];
$errors = [];

$title = 'いれるものを入力';
$content = __DIR__.'/views/new.php';
include __DIR__.'/views/layout.php';
