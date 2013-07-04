<div class="clear" ></div>
<table cellspacing="0" >
    <tr class="th" >
        <th>文件</th><th>修改时间</th><th>大小</th><th>操作</th>
    </tr>
    <?php
    $i = 0;
    if (isset($file)) {
        foreach ($file['name'] as $l => $v) {
            $i++;
            ?>
            <tr <?= ($i % 2) ? ' class="odd"' : '' ?> > 
                <td>
                    <img src="<?= BASE ?>static/img<?= $file['type'][$l] == 'dir' ? '/b_dir.png' : '/b_page.png' ?>" />
                    <a href="<?= $v ?>/" ><?= $v ?></a></td>
                <td><?= $file['time'][$l] ?></td>
                <td><?= $file['size'][$l] ?> k</td>
                <td> 
                </td> 
            </tr>  
        <?php
        }
    }
    $i = 0;
    ?>
</table>
