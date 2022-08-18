<?php
require_once  __DIR__.'/lib/checkSession.php';
require_once  __DIR__.'/lib/mysqli.php';
require_once  __DIR__.'/lib/escape.php';
require_once  __DIR__.'/lib/itemList.php';
require_once  __DIR__.'/class/Refrigerator.php';

$id = $_SESSION['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['chk'])){
        $freezingItemIds = $_POST['chk'];

        if(count($freezingItemIds)){
            $link = dbConnect();
            $refrigerator = new Refrigerator();
            $refrigerator->freezingItem($link,$id,$freezingItemIds);
            mysqli_close($link);
            header("Location: index.php");
        }
    }
}
$title = '入れかえるものを選択';
$error = '入れかえるものを選択してください。';
$content = __DIR__.'/views/selectFreezing.php';
$table = __DIR__.'/views/tableCheckBox.php';
include __DIR__.'/views/layout.php';
