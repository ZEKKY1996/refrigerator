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
            <input type="hidden" name="chk[]" value="<?php echo escape($useItem['id']);?>">
            <input type="hidden" name="id[]" value="<?php echo escape($useItem['id']);?>">
            <td class="border border-right-0 text-center pl-2 pr-2 form-group col-4">
                <input type="number" name="volume[]" min="0" max="<?php echo escape($useItem['volume']);?>" step ="0.1" value="0" class="form-control">
            </td>
            <input type="hidden" name="unit[]" value="<?php echo escape($useItem['unit']);?>">
            <td class="border border-left-0 text-center pl-2 pr-2">
            <?php echo escape($useItem['unit']);?>
            </td>
            <input type="hidden" name="name[]" value="<?php echo escape($useItem['name']);?>">
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
