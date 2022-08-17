<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$id = $_SESSION['id'];

function deleteItem($link,$id,$deleteItems){
    foreach($deleteItems as $deleteItem){
        $sql = <<<EOT
            DELETE FROM $id
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
            deleteItem($link,$id,$deleteItems);
            mysqli_close($link);
            header("Location: index.php");
        }
    }
}
$title = 'すてるものを選択';
$error = 'すてるものを選択してください。';
$content = __DIR__.'/views/selectDispose.php';
$table = __DIR__.'/views/tableCheckBox.php';
include __DIR__.'/views/layout.php';
