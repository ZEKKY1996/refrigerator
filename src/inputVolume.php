<?php

require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/useItemList.php';


if(!count($_POST['chk'])){
    header("Location: selectUse.php");
}else{
    require_once  __DIR__.'/lib/useItemList.php';
    $title = 'つかう数量を入力';
    $content = __DIR__.'/views/use.php';
    include __DIR__.'/views/layout.php';
}
