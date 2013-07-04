
<div class="clear" ></div>
<table cellspacing=0 >
    <?php if (is_array($records)) { ?>
        <tr class="th" >
            <th>标题</th>
            <th>更新时间</th> 
            <th> </th> 
            <th>
                操作
            </th>
        </tr>
        <?php
        $i = 0;
        foreach ($records as $r) {
            $info = _decode($r['elem_info']);
            ?>
            <tr <?= ($i++ % 2) ? ' class="odd"' : '' ?> >
                <td><?= $r['elem_name'] ?></td>
                <td><?= __time($r['update_time']) ?></td> 
                <th><?= array_shift($info) ?></th> 
                <td>
                    <a href="<?= BASE ?>admin/plugin/view/freeform/view/<?= $r['id'] ?>/" >查看</a>
                    <a href="<?= BASE ?>admin/plugin/view/freeform/del/<?= $r['id'] ?>/" >删除</a>
                </td>
            </tr>
        <?php }
    }
    ?>
</table>
<?= $pagination ?>
