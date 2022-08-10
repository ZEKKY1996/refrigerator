<?php
$item = [
    'name' => '',
    'volume' => '',
    'unit' => '',
    'parchase_date' => '',
    'limit_date' => ''
];
$errors = [];

$title = '冷蔵庫に入れるものを入力';
$content = __DIR__.'/views/new.php';
include __DIR__.'/views/layout.php';
