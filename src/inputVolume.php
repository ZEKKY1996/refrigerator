<?php

namespace Refrigerator;

require_once __DIR__ . '/lib/checkSession.php';
require_once __DIR__ . '/lib/mysqli.php';
require_once __DIR__ . '/lib/escape.php';
require_once __DIR__ . '/lib/useItemList.php';


if (!isset($_POST['chk'])) {
    header("Location: selectUse.php");
}
else {
    require_once __DIR__ . '/lib/useItemList.php';
    $errors = [];
    $title = 'つかう数量を入力';
    $table = __DIR__ . '/views/tableInputVolume.php';
    $content = __DIR__ . '/views/use.php';
    include __DIR__ . '/views/layout.php';
}
