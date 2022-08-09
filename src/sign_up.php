<?php
?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <title>新規登録画面</title>
        <header>冷蔵庫管理アプリ</header>
    </head>
    <body>
        <h1>新規会員登録</h1>
        <form action="confirm.php" method="POST">
            <div>
                <label for="id">ユーザーID</label>
                <input type="text" id="id" name="id">
            </div>
            <div>
                <label for="pass">パスワード</label>
                <input type="password" id="pass" name="pass">
            </div>
            <div>
                <label for="pass_conf">パスワード（確認用）</label>
                <input type="password" id="pass_conf" name="pass_conf">
            </div>
            <div>
               <button type="submit">登録する</button>
            </div>
        </form><br>

    </body>
</html>
