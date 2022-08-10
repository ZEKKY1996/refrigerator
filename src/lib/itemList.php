<?php
function listItems($link):array{
    $items = [];
    $sql = <<<EOT
        SELECT
            id,
            name,
            volume,
            unit,
            parchase_date,
            limit_date
        FROM
            refrigerators
        ORDER BY
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
