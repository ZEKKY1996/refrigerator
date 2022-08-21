<?php

namespace Refrigerator;

require_once  __DIR__ . '/lib/checkSession.php';
require_once  __DIR__ . '/lib/mysqli.php';
require_once  __DIR__ . '/lib/escape.php';
require_once  __DIR__ . '/lib/useItemList.php';
require_once  __DIR__ . '/class/Refrigerator.php';
require_once  __DIR__ . '/class/Validate.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $updateItemIds = $_POST['id'];
    $id = $_SESSION['id'];
    $updateItemVolumes = [];
    $validate = new Validate();
    foreach ($_POST['volume'] as $itemVolume) {
        $error = $validate->validateVolume((float)$itemVolume);
        if (isset($error)) {
            $errors[] = $error;
        }
    }
    if (!isset($errors)) {
        foreach ($_POST['volume'] as $itemVolume) {
            $updateItemVolumes[] = floor($itemVolume * 10) / 10;
        }
        $link = dbConnect();
        $refrigerator = new Refrigerator();
        $refrigerator->updateItem($link, $id, $updateItemIds, $updateItemVolumes);
        mysqli_close($link);
        header("Location: index.php");
    }
}
$title = 'つかう数量を選択';
$table = __DIR__ . '/views/tableInputVolume.php';
$content = __DIR__ . '/views/use.php';
include __DIR__ . '/views/layout.php';
