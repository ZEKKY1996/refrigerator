<?php

require_once  __DIR__.'/lib/mysqli.php';

function createItem($link,$item){
    $sql = <<<EOT
        INSERT INTO refrigerators (
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

function validate($item){
    $errors = [];

    if(!strlen($item['name'])){
        $errors['name'] = '品物名を入力してください。'.PHP_EOL;
    }elseif(strlen($item['name'])>50){
        $errors['name'] = '品物名は50文字以内で入力してください。'.PHP_EOL;
    }

    if(!strlen($item['volume'])){
        $errors['volume'] = '数量を入力してください。'.PHP_EOL;
    }elseif(!is_float($item['volume']) | $item['volume']==0){
        $errors['volume'] = '数量は小数第1位までの数値で入力してください。'.PHP_EOL;
    }
    if(!strlen($item['unit'])){
        $errors['unit'] = '単位を入力してください。'.PHP_EOL;
    }elseif(strlen($item['unit'])>10){
        $errors['unit'] = '単位は10文字以内で入力してください。'.PHP_EOL;
    }
    $parchase_date = explode('-',$item['parchase_date']);
    if(!strlen($item['parchase_date'])){
        $errors['parchase_date'] = '購入日を入力してください。'.PHP_EOL;
    }elseif(count($parchase_date)!==3){
        $errors['parchase_date'] = '購入日を正しい形式で入力してください。'.PHP_EOL;
    }elseif(!checkdate($parchase_date[1],$parchase_date[2],$parchase_date[0])){
        $errors['parchase_date'] = '購入日を正しい日付で入力してください。'.PHP_EOL;
    }
    $limit_date = explode('-',$item['limit_date']);
    if(!strlen($item['limit_date'])){
        $errors['limit_date'] = '期限日を入力してください。'.PHP_EOL;
    }elseif(count($parchase_date)!==3){
        $errors['parchase_date'] = '期限日を正しい形式で入力してください。'.PHP_EOL;
    }elseif(!checkdate($limit_date[1],$limit_date[2],$limit_date[0])){
        $errors['limit_date'] = '期限日を正しい日付で入力してください。'.PHP_EOL;
    }elseif($item['limit_date']<$item['parchase_date']){
        $errors['limit_date'] = '期限日は購入日以降の日付としてください。'.PHP_EOL;
    }
    return $errors;
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $item = [
        'name' => $_POST['name'],
        'volume' => floor((float)$_POST['volume']*10)/10,
        'unit' => $_POST['unit'],
        'parchase_date' => $_POST['parchase_date'],
        'limit_date' => $_POST['limit_date'],
        'freezing' => $_POST['freezing']
    ];

    $errors = validate($item);
    if(!count($errors)){
        $link = dbConnect();
        createItem($link,$item);
        mysqli_close($link);
        header("Location: index.php");
    }
}

$content = __DIR__.'/views/new.php';
include __DIR__.'/views/layout.php';
