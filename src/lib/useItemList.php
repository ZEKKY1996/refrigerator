<?php
function useItem($link,$useItemIds){
    foreach($useItemIds as $useItemId){
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
            WHERE
                id = $useItemId
            ORDER BY
                limit_date ASC
        EOT;
        $results = mysqli_query($link,$sql);

        while($useItem = mysqli_fetch_assoc($results)){
            $useItems[]= $useItem;

        }
        mysqli_free_result($results);
    }
    return $useItems;
}


if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if(isset($_POST['chk'])){
        $useItemIds = $_POST['chk'];
        $link = dbConnect();
        $useItems = useItem($link,$useItemIds);
        $title = '使うものの数量を選択';

    }
}
