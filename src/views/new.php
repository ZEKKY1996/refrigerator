<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="stylesheets/css/app.css">
        <title>冷蔵庫登録画面</title>
        <header>冷蔵庫管理アプリ</header>
    </head>
    <body>
        <h1>冷蔵庫に入れるものを入力</h1>
        <form action="create.php" method="POST">
            <?php if(count($errors)) : ?>
                <ul>
                    <?php foreach($errors as $error) : ?>
                        <li><?php echo $error ?></li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
            <div>
                <label for="name">商品名</label>
                <input type="text" id="name" name="name" value="<?php echo $item['name']?>">
            </div>
            <div>
                <label for="volume">数量</label>
                <input type="number" id="volume" name="volume" min="0.1" step="0.1" value="<?php echo $item['volume']?>">
            </div>
            <div>
                <label for="unit">単位</label>
                <input type="text" id="unit" name="unit" value="<?php echo $item['unit']?>">
            </div>
            <div>
                <label for="parchase_date">購入日</label>
                <input type="date" id="parchase_date" name="parchase_date" value="<?php echo $item['parchase_date']?>">
            </div>
             <div>
                <label for="limit_date">期限日</label>
                <input type="date" id="limit_date" name="limit_date" value="<?php echo $item['limit_date']?>">
            </div>
            <div>
               <button type="submit">登録</button>
            </div>
        </form><br>

    </body>
</html>
