<?php
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$title = '使うものを選択';
$content = __DIR__.'/views/use.php';
include __DIR__.'/views/layout.php';
