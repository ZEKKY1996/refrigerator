 <form action="resetPass.php" method="POST">
        <h1>ユーザー情報の確認</h1>
        <input type="hidden" id="id" name="id" value="<?php echo $id;?>">
        <input type="hidden" id="mail" name="mail" value="<?php echo $mail;?>">
        <input type="hidden" id="pass" name="pass" value="<?php echo $pass;?>">
        <p>下記のユーザー情報を再設定します</p>
        <?php
        echo 'ユーザーID:  ' . $id;?><br>
        <?php
        echo 'メールアドレス:  ' . $mail;?><br>
        <?php
        echo 'パスワード:****' . PHP_EOL;
        ?><br><br>
            <div>
               <button type="submit" class="btn btn-primary">登録</button>
            </div>
        </form><br>
