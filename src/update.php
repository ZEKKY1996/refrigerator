<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';
require_once  __DIR__.'/class/Refrigerator.php';
require_once  __DIR__.'/class/Validate.php';

$id = $_SESSION['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $updateItemIds = $_POST['id'];
    $updateItemVolumes = [];
    $validate = new Validate();
    foreach($_POST['volume'] as $itemVolume){
        $errors['volume'] = $validate->validateVolume($itemVolume);
    }
    if(!count($errors)){
        foreach($_POST['volume'] as $itemVolume){
            $updateItemVolumes[] = floor($itemVolume * 10)/10;
        }
        $link = dbConnect();
        $refrigerator = new Refrigerator();
        $refrigerator->updateItem($link,$id,$updateItemIds,$updateItemVolumes);
        mysqli_close($link);
        header("Location: index.php");
    }
}
$title = 'つかうものを選択';
$table = __DIR__.'/views/tableCheckBox.php';
$content = __DIR__.'/views/selectUse.php';
include __DIR__.'/views/layout.php';
