<?php
require_once  __DIR__ . '/lib/checkSession.php';
require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/lib/escape.php';
require_once  __DIR__ . '/lib/itemList.php';
require_once  __DIR__ . '/class/Refrigerator.php';

$id = $_SESSION['id'];

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['chk'])){
        $deleteItems = $_POST['chk'];

        if(count($deleteItems)){
            $link = dbConnect();
            $refrigerator = new Refrigerator();
            $refrigerator->deleteItem($link,$id,$deleteItems);
            mysqli_close($link);
            header("Location: index.php");
        }
    }
}
$title = 'すてるものを選択';
$error = 'すてるものを選択してください。';
$content = __DIR__ . '/views/selectDispose.php';
$table = __DIR__ . '/views/tableCheckBox.php';
include __DIR__ . '/views/layout.php';
