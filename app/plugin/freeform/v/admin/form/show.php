<a class="admin_link" href="<?= BASE ?>admin/plugin/view/freeform/" >回到表单</a> 
<table>
    <?php foreach ($r as $k => $e): ?>
        <tr>
            <th width="200"><?= $k ?></th>
            <td><?= nl2br($e) ?></td>
        </tr>
    <?php endforeach; ?>
</table>
