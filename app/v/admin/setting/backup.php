<a class="admin_link" href="create/" >创建备份</a> 
<div class="clear" ></div>
<table cellspacing="0" >
    <tr class="th" >
        <th>序号</th><th>文件</th><th>操作</th>
    </tr>
    <?php
    $i = 0;
    if (isset($file)) {
        foreach ($file as $l => $v) {
            if (in_array($v, array('.', '..')))
                continue;

            $i++;
            ?>
            <tr <?= ($i % 2) ? ' class="odd"' : '' ?> >
                <td><?= $i ?></td> 
                <td><?= $v ?></td>
                <td> 
                    <a href="del/<?= $v ?>/"  title="删除" ><img src="<?= BASE ?>static/img/b_drop.png" /></a>
                    <a href="restore/<?= $v ?>/">恢复</a>
                </td> 
            </tr>  
        <?php
        }
    }
    $i = 0;
    ?>
</table>
