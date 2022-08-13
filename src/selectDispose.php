<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$title = 'すてるものを選択';
$content = __DIR__.'/views/dispose.php';
include __DIR__.'/views/layout.php';
