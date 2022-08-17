<p class="line-height:1"><?php echo $_SESSION['id'];?> さん、こんにちは！今日は<?php echo date("Y年m月d日");?>です。</p>
<h1>冷蔵庫内容一覧</h1>
<a href="new.php" class="btn btn-primary mb-4">いれる</a>
<a href="selectUse.php" class="btn btn-primary mb-4">つかう</a>
<a href="selectDispose.php" class="btn btn-primary mb-4">すてる</a>
<a href="selectFreezing.php" class="btn btn-primary mb-4">冷蔵↔冷凍</a>

<?php include $table;?>

<a href="selectLogout.php" class="btn btn-primary mb-4">ログアウト</a>
