<a class="admin_link"  href="<?= BASE ?>admin/model/add/" >创建数据模型</a> 
<div class="clear" ></div>
<table cellspacing=0 >
    <?php if (is_array($records)) { ?>
        <tr class="th" >
            <th>名称</th>
            <th>修改时间</th>
            <th>
                操作
            </th>
        </tr>
        <?php
        $i = 0;
        foreach ($records as $r) {
            ?>
            <tr <?= ($i++ % 2) ? ' class="odd"' : '' ?> >
                <td><?= $r['title'] ?></td>
                <td><?= __time($r['update_time']) ?></td>
                <td>  
                    <a href="<?= BASE ?>admin/model/edit/<?= $r['id'] ?>/" title="编辑" ><img src="<?= BASE ?>static/img/b_edit.png" /></a>
                    <a href="javascript:del(<?= $r['id'] ?>)" title="删除" ><img src="<?= BASE ?>static/img/b_drop.png"/></a>
                    <a href="<?= BASE ?>admin/model/template/<?= $r['id'] ?>/" >创建模板</a>
                </td>
            </tr>
        <?php }
    }
    ?>
</table>
<?= $pagination ?>
