<p class="line-height:1"><?php echo $_SESSION['id'];?> さん、こんにちは！今日は<?php echo date("Y年m月d日");?>です。</p>
<h1>冷蔵庫内容一覧</h1>
<a href="new.php" class="btn btn-primary mb-4">いれる</a>
<a href="selectUse.php" class="btn btn-primary mb-4">つかう</a>
<a href="selectDispose.php" class="btn btn-primary mb-4">すてる</a>
<a href="selectFreezing.php" class="btn btn-primary mb-4">冷蔵↔冷凍</a>

<table>
    <?php if(count($items)>0) :?>
        <tr>
            <th class="border text-center">品物</th>
            <th class="border text-center">数量</th>
            <th class="border text-center">購入日</th>
            <th class="border text-center">期限日</th>
        </tr>
        <?php foreach ($items as $item) :?>
            <?php if($item['freezing'] === 'on'):?>
                <tr class="text-primary">
            <?php elseif(strtotime($item['limit_date'])<strtotime(date("Y-m-d"))+5*60*60*24):?>
                <tr class="text-danger">
            <?php else :?>
                <tr>
            <?php endif;?>
                <td class="border text-center pl-1 pr-1 col-4">
                <?php echo escape($item['name']);?>
                </td>
                <td class="border text-right pl-1 pr-1">
                <?php echo escape($item['volume']).escape($item['unit']);?>
                </td>
                <td class="border text-center pl-1 pr-1">
                <?php echo escape($item['parchase_date']);?>
                </td>
                <td class="border text-center pl-1 pr-1">
                <?php echo escape($item['limit_date']);?>
                </td>
        </tr>
        <?php endforeach;?>
        <?php else:?>
            <h4>冷蔵庫がからっぽです</h4>
            <?php endif;?>
</table>
<div class="container d-flex">
    <p class="text-danger pr-4">赤：期限間近</p>
    <p class="text-primary">青：冷凍</p>
</div>
<a href="selectLogout.php" class="btn btn-primary mb-4">ログアウト</a>
