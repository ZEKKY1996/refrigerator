<?php
function listItems($link,$id){
    $items = [];
    $sql = <<<EOT
        SELECT
            *
        FROM
            $id
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
$id = $_SESSION['id'];
$link = dbConnect();
$items = listItems($link,$id);
