<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$id = $_SESSION['id'];

function updateItem($link,$id,$updateItemIds,$updateItemVolumes){
    for($i=0;$i<=count($updateItemIds);$i++){
        $sql = <<<EOT
            UPDATE $id
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
            DELETE FROM $id
            WHERE volume <= 0
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
    }elseif($updateItemVolume < 0){
        $errors[] = '数量は小数第1位までの数値で入力してください。'.PHP_EOL;
    }
}
    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $updateItemIds = $_POST['id'];
        $updateItemVolumes = [];
        foreach($_POST['volume'] as $itemVolume){
            $updateItemVolumes[] = floor($itemVolume * 10)/10;
        }
    $errors = validate($updateItemVolumes);
    if(!count($errors)){
        $link = dbConnect();
        updateItem($link,$id,$updateItemIds,$updateItemVolumes);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$content = __DIR__.'/views/selectUse.php';
include __DIR__.'/views/layout.php';
