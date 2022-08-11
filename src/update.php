<?php

require_once  __DIR__.'/lib/mysqli.php';

function updateItem($link,$updateItemIds,$updateItemVolumes){
    for($i=0;$i<=count($updateItemIds);$i++){
        $sql = <<<EOT
            UPDATE refrigerators
            SET volume = volume - $updateItemVolumes[$i]
            WHERE id = $updateItemIds[$i]
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to create item').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
    $sql = <<<EOT
            DELETE FROM refrigerators
            WHERE volume = 0
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to create item').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
}
}

function validate($updateItemVolumes){
    $errors = [];
foreach($updateItemVolumes as $updateItemVolume){
    if(!strlen($updateItemVolume)){
        $errors[] = '数量を入力してください。'.PHP_EOL;
    }elseif(!is_float($updateItemVolume) | $updateItemVolume==0){
        $errors[] = '数量は小数第1位までの数値で入力してください。'.PHP_EOL;
    }
}
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $updateItemIds = $_POST['id'];
        $updateItemVolumes = $_POST['volume'];

    $errors = validate($updateItemVolumes);
    if(!count($errors)){
        $link = dbConnect();
        updateItem($link,$updateItemIds,$updateItemVolumes);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$content = __DIR__.'/views/consumption.php';
include __DIR__.'/views/layout.php';
