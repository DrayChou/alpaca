<a class="admin_link" href="<?= BASE ?>admin/template/layout/add/" >添加排版</a> 
<div class="clear" ></div>
<table cellspacing=0 >
    <?php if (is_array($records)) { ?>
        <tr class="th" >
            <th>标题</th>
            <th>更新时间</th> 
            <th>
                操作
            </th>
        </tr>
        <?php
        $i = 0;
        foreach ($records as $r) {
            ?>
            <tr <?= ($i++ % 2) ? ' class="odd"' : '' ?> >
                <td><?= $r['elem_name'] ?></td>
                <td><?= __time($r['update_time']) ?></td> 
                <td>
                    <a href="<?= BASE ?>admin/template/layout/edit/<?= $r['id'] ?>/" title="编辑" ><img src="<?= BASE ?>static/img/b_edit.png"></a>
                    <a href="<?= BASE ?>admin/template/layout/replicate/<?= $r['id'] ?>/" title="复制" ><img src="<?= BASE ?>static/img/copy.gif"></a>
                    <a href="javascript:del(<?= $r['id'] ?>)"  title="删除" ><img src="<?= BASE ?>static/img/b_drop.png"></a>
                </td>
            </tr>
        <?php }
    }
    ?>
</table>
<?= $pagination ?>
