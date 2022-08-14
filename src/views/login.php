<h1>ユーザー情報の入力</h1>
    <form action="certification.php" method="POST">
    <?php if(count($errors)) : ?>
        <ul class="text-danger">
            <?php foreach($errors as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
        <div class="form-group">
            <label for="id">ユーザーID（半角英数字で入力してください）</label>
            <input type="text" id="id" name="id" class="form-control" pattern="^[a-zA-Z0-9]+$" value="<?php echo $id;?>">
        </div>
        <div class="form-group">
            <label for="pass">パスワード（半角英数字で入力してください）</label>
            <input type="password" id="pass" name="pass"  class="form-control" pattern="^[a-zA-Z0-9]+$">
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">ログイン</button>
        </div>
    </form><br>
    <p class="mt-4"><a href="exportUserInfo.php">初めてご利用の方（新規会員登録）</a></p><br>
    <p><a href="forgetPass.php">パスワードをお忘れの方</a></p>
