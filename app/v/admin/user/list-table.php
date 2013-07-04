<a class="admin_link" href="<?= BASE ?>admin/user/add/" >添加用户</a>
<div class="clear" ></div>
<table cellspacing=0 >
    <?php if (is_array($records)) { ?>
        <tr class="th" >
            <th>email</th>
            <th>用户名</th> 
            <th>发布时间</th>
            <th>更新时间</th>
            <th>级别</th>
            <th>
                操作
            </th>
        </tr>
        <?php
        $i = 0;
        foreach ($records as $r) {
            ?>
            <tr <?= ($i++ % 2) ? ' class="odd"' : '' ?> >
                <td><?= $r['email'] ?></td>
                <td><?= $r['username'] ?></td>
                <td><?= __time($r['post_time']) ?></td>
                <td><?= __time($r['update_time']) ?></td>
                <td><?= $r['level'] ?></td>
                <td>
                    <a href="<?= BASE ?>admin/user/edit/<?= $r['id'] ?>" >编辑</a> 
                    <a href="<?= BASE ?>admin/user/del/<?= $r['id'] ?>" >删除</a> 
                </td>
            </tr>
        <?php }
    }
    ?>
</table>
<?= $pagination ?>
