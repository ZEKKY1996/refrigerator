
<h1 class="h2 text-dark mt-4 mb-4">冷蔵↔冷凍に入れかえるものを選択</h1>
<?php if(isset($error)) :?>
    <p class="text-danger"><?php echo $error;?></p>
<?php endif;?>
<form action="freezing.php" method="POST">

<?php include $table;?>

<button type="submit" class="btn btn-primary mt-4">入れかえる</button>
</form>
<br>
<a href="index.php" class="btn btn-primary mt-4">一覧にもどる</a>
