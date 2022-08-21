<?php

namespace Refrigerator;

require_once  __DIR__ . '/lib/checkSession.php';
require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/lib/escape.php';
require_once  __DIR__ . '/lib/itemList.php';


$title = '冷蔵庫内容の一覧';
$content = __DIR__ . '/views/index.php';
$table = __DIR__ . '/views/table.php';
include __DIR__ . '/views/layout.php';
