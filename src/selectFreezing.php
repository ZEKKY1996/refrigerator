<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$title = '冷蔵↔冷凍に入れかえるものを選択';
$content = __DIR__.'/views/freezing.php';
include __DIR__.'/views/layout.php';
