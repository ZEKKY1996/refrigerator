
<h1>冷蔵庫内容一覧</h1>
<a href="new.php" class="btn btn-primary mb-4">いれる</a>
<a href="select.php" class="btn btn-primary mb-4">つかう</a>
<a href="dispose.php" class="btn btn-primary mb-4">すてる</a>
<a href="" class="btn btn-primary mb-4">さがす</a>

<table>
    <?php if(count($items)>0) :?>
        <tr>
            <th class="border text-center">品物</th>
            <th class="border text-center">数量</th>
            <th class="border text-center">購入日</th>
            <th class="border text-center">期限日</th>
        </tr>
        <?php foreach ($items as $item) :?>
            <?php if(strtotime($item['limit_date'])<strtotime(date("Y-m-d"))+5*60*60*24):?>
            <tr class="text-danger">
            <?php else :?>
            <tr>
            <?php endif;?>
                <td class="border text-center pl-2 pr-2 col-3">
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
        <h4>冷蔵庫がからっぽです</h4>
    <?php endif;?>
</table>
