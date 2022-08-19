<h1 class="h2 text-dark mt-4 mb-4">つかう数量を入力</h1>
<?php if(isset($errors)) :?>
    <?php foreach($errors as $error):?>
    <p class="text-danger"><?php echo $error;?></p>
    <?php endforeach;?>
<?php endif;?>
<form action="update.php" method="POST">

<?php include $table;?>

<button type="submit" class="btn btn-primary mt-4">つかう</button>
</form>
<br>
<a href="selectUse.php" class="btn btn-primary mt-4">えらぶ画面にもどる</a>
<a href="index.php" class="btn btn-primary mt-4">一覧にもどる</a>
