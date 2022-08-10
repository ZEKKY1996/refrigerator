<?php

require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

function deleteItem($link,$deleteItems){
    foreach($deleteItems as $deleteItem){
        echo var_dump($deleteItem);
        $sql = <<<EOT
            DELETE FROM refrigerators
            WHERE id = $deleteItem
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to delete item').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['chk'])){
        $deleteItems = $_POST['chk'];

        if(count($deleteItems)){
            $link = dbConnect();
            deleteItem($link,$deleteItems);
            mysqli_close($link);
            header("Location: index.php");
        }
    }
}
$title = '廃棄するものを選択';
$error = '廃棄する品物を選択してください。';
$content = __DIR__.'/views/dispose.php';
include __DIR__.'/views/layout.php';
