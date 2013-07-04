<form method="POST" >
    <input type="hidden" name="mod" value="link" >
    <table cellspacing="0" >
        <tr>
            <td colspan="2" >菜单名称 &nbsp; 
                <input type="text" name="elem_name" value="<?= isset($val['elem_name']) ? $val['elem_name'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['title']) ? $err['title'] : '' ?></span></td><td><input type="submit" class="submit-button" value="更新菜单" >
            </td>
        </tr>
    </table>
    <table cellspacing="0" >
        <tr class="th" >
            <th>链接名称</th><th>url地址</th><th>排序</th><th>新窗口 <a title="选中后，链接将在新页面打开" class="tip" >?</a></th><th></th>
        </tr>
        <?php
        $i = 0;
        if (isset($links)) {
            foreach ($links as $l) {
                $i++;
                ?>
                <tr <?= ($i % 2) ? ' class="odd"' : '' ?> >
                    <td> <input type="text" name="info[<?= $i ?>][label]" value="<?= $l['label'] ?>" /> </td> 
                    <td> <input type="text" size="30" name="info[<?= $i ?>][link]" value="<?= isset($l['link']) ? $l['link'] : '' ?>"  /></td> 
                    <td> <input type="text" size="4" name="info[<?= $i ?>][order]" value="<?= intval($l['order']) ? $l['order'] : '' ?>"  /></td> 
                    <td> <input name="info[<?= $i ?>][blank]" value="1" type="checkbox" <?= intval($l['blank']) ? 'checked="TRUE"' : '' ?> /></td>
                    <td> <a onclick="$(this).parent().parent().remove();" >删</a></td>
                </tr>
            <?php }
        } ?>
<?php for ($j = $i + 1; $j < $i + 5; $j++): ?>
            <tr <?= ($j % 2) ? ' class="odd"' : '' ?> >
                <td><input type="text" name="info[<?= $j ?>][label]" >  </td> 
                <td><input type="text" size="30"  name="info[<?= $j ?>][link]" ></td> 
                <td><input type="text" size="4" name="info[<?= $j ?>][order]" value=""  /></td> 
                <td><input name="info[<?= $j ?>][blank]" value="1" type="checkbox" ></td>
                <td></td>
            </tr>
<?php endfor; ?>
    </table>
</form>
