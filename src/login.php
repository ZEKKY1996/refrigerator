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
        <h1>ユーザー情報の入力</h1>
        <form action="" method="POST">
            <div>
                <label for="id">ユーザーID</label>
                <input type="text" id="id" name="id">
            </div>
            <div>
                <label for="pass">パスワード</label>
                <input type="password" id="pass" name="pass">
            </div>
            <div>
               <button type="submit">ログイン</button>
            </div>
        </form><br>
        <p><a href="sign_up.php">初めてご利用の方（新規会員登録）</a></p><br>
        <p><a href="">パスワードをお忘れの方</a></p>

    </body>
</html>
