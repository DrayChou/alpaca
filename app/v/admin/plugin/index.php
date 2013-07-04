
<div class="clear" ></div>
<table cellspacing="0" >
    <tr class="th" >
        <th>序号</th><th>文件</th><th></th><th>操作</th>
    </tr>
    <?php
    $i = 0;
    if (isset($file)) {
        foreach ($file as $l => $v) {
            if (in_array($v['name'], array('.', '..')))
                continue;

            $i++;
            ?>
            <tr <?= ($i % 2) ? ' class="odd"' : '' ?> >
                <td><?= $i ?></td> 
                <td><?= $v['name'] ?></td>
                <td><?= $v['installed'] ? '<a href="../view/' . $v['name'] . '" >访问</a>' : '未安装' ?></td>
                <td> 
                    <?php if ($v['installed']) { ?>
                        <a href="../remove/<?= $v['name'] ?>/">卸载</a>
                    <?php } else {
                        ?>
                        <a href="../install/<?= $v['name'] ?>/">安装</a>
        <?php } ?>
                </td> 
            </tr>  
        <?php
        }
    }
    $i = 0;
    ?>
</table>
