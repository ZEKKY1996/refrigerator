<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <link rel="stylesheet" href="stylesheets/css/app.css">
        <title><?php echo $title;?></title>
        <header class="container"><a href="index.php">冷蔵庫管理アプリ</a></header>
        <p class="container">今日は<?php echo date("Y年m月d日");?>です。</p>
    </head>
    <body>
        <div class="container">
            <?php include $content;?>
        </div>

    </body>
