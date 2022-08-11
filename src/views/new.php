
<h1 class="h2 text-dark mt-4 mb-4">いれるものを入力</h1>
<form action="create.php" method="POST">
    <?php if(count($errors)) : ?>
        <ul class="text-danger">
            <?php foreach($errors as $error) : ?>
                <li><?php echo $error ?></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <div class="form-group">
        <label for="name">品物名</label>
        <input type="text" id="name" name="name" class="form-control" value="<?php echo $item['name']?>">
    </div>
    <div class="form-group">
        <label for="volume">数量</label>
        <input type="number" id="volume" name="volume" class="form-control" min="0.1" step="0.1" value="<?php echo $item['volume']?>">
    </div>
    <div class="form-group">
        <label for="unit">単位</label>
        <input type="text" id="unit" name="unit" class="form-control" value="<?php echo $item['unit']?>">
    </div>
    <div class="form-group">
        <label for="parchase_date">購入日</label>
        <input type="date" id="parchase_date" name="parchase_date" class="form-control" value="<?php echo $item['parchase_date']?>">
    </div>
        <div class="form-group">
        <label for="limit_date">期限日</label>
        <input type="date" id="limit_date" name="limit_date" class="form-control" value="<?php echo $item['limit_date']?>">
    </div>
    <div>
        <button type="submit" class="btn btn-primary">いれる</button>
    </div>
</form><br>
