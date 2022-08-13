<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';

$id = $_SESSION['id'];

function freezingItem($link,$id,$freezingItemIds){
    foreach($freezingItemIds as $freezingItemId){
        $sql = <<<EOT
            UPDATE $id
            SET freezing =
                CASE
                    WHEN freezing = 'on' THEN 'off'
                    ELSE 'on'
                END
            WHERE
                id = $freezingItemId
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to freezing item').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['chk'])){
        $freezingItemIds = $_POST['chk'];

        if(count($freezingItemIds)){
            $link = dbConnect();
            freezingItem($link,$id,$freezingItemIds);
            mysqli_close($link);
            header("Location: index.php");
        }
    }
}
$title = '入れかえるものを選択';
$error = '入れかえるものを選択してください。';
$content = __DIR__.'/views/freezing.php';
include __DIR__.'/views/layout.php';
