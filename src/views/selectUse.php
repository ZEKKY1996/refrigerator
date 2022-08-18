
<h1 class="h2 text-dark mt-4 mb-4">つかうものを選択</h1>
<?php if(isset($errors)) :?>
    <p class="text-danger"><?php echo $errors['volume'];?></p>
<?php endif;?>
<form action="inputVolume.php" method="POST">

<?php include $table;?>

<button type="submit" class="btn btn-primary mt-4">えらぶ</button>
</form>
<br>
<a href="index.php" class="btn btn-primary mt-4">一覧にもどる</a>
