<?php
function listItems($link):array{
    $items = [];
    $sql = <<<EOT
        SELECT
            *
        FROM
            refrigerators
        ORDER BY
            freezing ASC,
            limit_date ASC
    EOT;
    $results = mysqli_query($link,$sql);

    while($item = mysqli_fetch_assoc($results)){
        $items[]= $item;
    }
    mysqli_free_result($results);

    return $items;
}

$link = dbConnect();
$items = listItems($link);
