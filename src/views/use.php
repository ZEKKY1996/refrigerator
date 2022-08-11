<h1 class="h2 text-dark mt-4 mb-4">つかう数量を入力</h1>
<?php if(isset($error)) :?>
    <p class="text-danger"><?php echo $error;?></p>
<?php endif;?>
<form action="update.php" method="POST">
<table>
    <?php if(count($useItems)>0) :?>
        <tr>
            <th class="border border-right-0 text-right">つかう数量</th>
            <th class="border border-left-0 text-center"></th>
            <th class="border text-center">品物</th>
            <th class="border text-center">数量</th>
        </tr>
        <?php foreach ($useItems as $useItem) :?>
            <tr>
                <input type="hidden" name="id[]" value="<?php echo escape($useItem['id']);?>">
                <td class="border border-right-0 text-center pl-2 pr-2 form-group col-4">
                    <input type="number" name="volume[]" min="0" max="<?php echo escape($useItem['volume']);?>" step ="0.1" value="0" class="form-control">
                </td>
                <td class="border border-left-0 text-center pl-2 pr-2">
                <?php echo escape($useItem['unit']);?>
                </td>
                <td class="border text-center pl-2 pr-2">
                <?php echo escape($useItem['name']);?>
                </td>
                <td class="border text-right pl-2 pr-2">
                <?php echo escape($useItem['volume']).escape($useItem['unit']);?>
                </td>
            </tr>
        <?php endforeach;?>
    <?php else:?>
        <h4>冷蔵庫がからっぽです</h4>
    <?php endif;?>
</table>
<button type="submit" class="btn btn-primary mt-4">つかう</button>
</form>
<br>
<a href="select.php" class="btn btn-primary mt-4">えらぶ画面にもどる</a>
<a href="index.php" class="btn btn-primary mt-4">一覧にもどる</a>
