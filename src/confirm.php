<?php
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>ログイン画面</title>
        <header>冷蔵庫管理アプリ</header>
    </head>
    <body>
        <h1>ユーザー情報の確認</h1>
        <p>下記のユーザー情報を登録します</p>
        <?php
        echo 'ユーザーID:  '.$_POST['id'];?><br>
        <?php
        echo 'パスワード:  '.$_POST['pass'].PHP_EOL;
        ?><br><br>
        <form action="" method="POST">
            <div>
               <button type="submit">登録</button>
            </div>
        </form><br>

    </body>
</html>
