<h1>新規会員登録</h1>
    <?php if(count($errors)) : ?>
    <ul class="text-danger">
        <?php foreach($errors as $error) : ?>
            <li><?php echo $error ?></li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <form action="confirm.php" method="POST">
        <div class="form-group">
            <label for="id">ユーザーID（半角英数字で入力してください）</label>
            <input type="text" pattern="^[a-zA-Z0-9]+$" id="id" name="id" value="<?php echo $id;?>" class="form-control">
        </div>
        <div class="form-group">
            <label for="pass">パスワード（半角英数字で入力してください）</label>
            <input type="password" id="pass" name="pass" class="form-control" pattern="^[a-zA-Z0-9]+$">
        </div>
        <div class="form-group">
            <label for="pass_conf">パスワード（確認用）</label>
            <input type="password" id="pass_conf" name="pass_conf" class="form-control" pattern="^[a-zA-Z0-9]+$">
        </div>
        <div>
            <button type="submit">登録する</button>
        </div>
    </form><br>
