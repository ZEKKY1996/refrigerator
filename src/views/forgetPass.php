<h1>パスワードの再設定</h1>
    <?php if (count($errors)) : ?>
    <ul class="text-danger">
        <?php foreach ($errors as $error) : ?>
            <li><?php echo $error ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form action="confirmResetPass.php" method="POST">
        <div class="form-group">
            <label for="id">ユーザーID（半角英数字で入力してください）</label>
            <input type="text" pattern="^[a-zA-Z0-9]+$" id="id" name="id" value="<?php echo $id;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="mail">メールアドレス（xxx@yyyの形式で入力してください）</label>
            <input type="email" id="mail" name="mail" value="<?php echo $mail;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass">新しいパスワード（1つ以上の数字とアルファベットを入れて4字～12字で入力してください）</label>
            <input type="password" id="pass" name="pass" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass_conf">新しいパスワード（確認用）</label>
            <input type="password" id="pass_conf" name="pass_conf" class="form-control">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">登録する</button>
        </div>
    </form><br>
