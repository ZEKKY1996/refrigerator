 <form action="createTable.php" method="POST">
        <h1>ユーザー情報の確認</h1>
        <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
        <input type="hidden" id="pass" name="pass" value="<?php echo $pass;?>">
        <p>下記のユーザー情報を登録します</p>
        <?php
        echo 'ユーザーID:  '.$id;?><br>
        <?php
        echo 'パスワード:  '.$pass.PHP_EOL;
        ?><br><br>
            <div>
               <button type="submit">登録</button>
            </div>
        </form><br>
