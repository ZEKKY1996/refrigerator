<?php

class Refrigerator{
    public function __construct(){

    }
    public function insertItem($link,$id,$item){
        $sql = <<<EOT
            INSERT INTO $id (
                name,
                volume,
                unit,
                parchase_date,
                limit_date,
                freezing
            ) VALUES (
                "{$item['name']}",
                "{$item['volume']}",
                "{$item['unit']}",
                "{$item['parchase_date']}",
                "{$item['limit_date']}",
                "{$item['freezing']}"
            )
        EOT;
        $result = mysqli_query($link ,$sql);
        if(!$result){
            error_log('Error: fail to create item').PHP_EOL;
            echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
    public function deleteItem($link,$id,$deleteItems){
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
    public function freezingItem($link,$id,$freezingItemIds){
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
    function updateItem($link,$id,$updateItemIds,$updateItemVolumes){
        for($i=0;$i<=count($updateItemIds);$i++){
            $sql = <<<EOT
                UPDATE $id
                SET volume = volume - $updateItemVolumes[$i]
                WHERE id = $updateItemIds[$i]
            EOT;
            $result = mysqli_query($link ,$sql);
            if(!$result){
                error_log('Error: fail to create item').PHP_EOL;
                echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
            }
        }
        $sql = <<<EOT
                DELETE FROM $id
                WHERE volume <= 0
            EOT;
            $result = mysqli_query($link ,$sql);
            if(!$result){
                error_log('Error: fail to create item').PHP_EOL;
                echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
        }
    }
}
