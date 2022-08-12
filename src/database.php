<?php

require_once  __DIR__.'/lib/mysqli.php';

function dropTable($link){
    $dropTableSql = 'DROP TABLE IF EXISTS refrigerators;';
    $result = mysqli_query($link,$dropTableSql);
    if($result){
        echo 'テーブルを削除しました。'.PHP_EOL.PHP_EOL;
    }else{
        echo 'Error: テーブルの削除に失敗しました。'.PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

function createTable($link){
    $createTableSql = <<<EOT
        CREATE TABLE refrigerators (
            id INTEGER AUTO_INCREMENT NOT NULL PRIMARY KEY,
            name VARCHAR(50) NOT NULL,
            volume FLOAT NOT NULL,
            unit VARCHAR(10),
            parchase_date DATE,
            limit_date DATE,
            freezing VARCHAR(10)
        ) DEFAULT CHARACTER SET=utf8mb4;
    EOT;
    $result = mysqli_query($link,$createTableSql);
    if($result){
        echo 'テーブルを作成しました。'.PHP_EOL.PHP_EOL;
    }else{
        echo 'Error: テーブルの作成に失敗しました。'.PHP_EOL;
        echo 'Debugging error:'.mysqli_error($link).PHP_EOL;
    }
}

$link = dbConnect();
dropTable($link);
createTable($link);
mysqli_close($link);
