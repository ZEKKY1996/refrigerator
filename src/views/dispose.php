
<h1 class="h2 text-dark mt-4 mb-4">廃棄するものを選択</h1>
<?php if(isset($error)) :?>
    <p class="text-danger"><?php echo $error;?></p>
<?php endif;?>
<table>
    <?php if(count($items)>0) :?>
        <tr>
            <th class="border text-center"> </th>
            <th class="border text-center">品物</th>
            <th class="border text-center">数量</th>
            <th class="border text-center">購入日</th>
            <th class="border text-center">期限日</th>
        </tr>
        <?php foreach ($items as $item) :?>
            <tr>
                <td class="border text-center pl-2 pr-2">
                    <form action="delete.php" method="POST">
                    <input type="checkbox" name="chk[]" value="<?php echo $item['id'];?>">

                </td>
                <td class="border text-center pl-2 pr-2">
                <?php echo escape($item['name']);?>
                </td>
                <td class="border text-right pl-2 pr-2">
                <?php echo escape($item['volume']).escape($item['unit']);?>
                </td>
                <td class="border text-center pl-2 pr-2">
                <?php echo escape($item['parchase_date']);?>
                </td>
                <td class="border text-center pl-2 pr-2">
                <?php echo escape($item['limit_date']);?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <h4>冷蔵庫が空っぽです</h4>
    <?php endif;?>
</table>
<button type="submit" class="btn btn-primary mt-4">廃棄する</button>
</form>
<br>
<a href="index.php" class="btn btn-primary mt-4">一覧にもどる</a>
