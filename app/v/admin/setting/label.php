
<div class="notice" >标签可在风格和排版中通过<font color="darkred" > &lt;?=alpa('标签名称')?></font> 进行调用</div>

<form method="POST" >
    <input type="hidden" name="mod" value="setting" >
    <div class="right col30" >
        <input type="submit" class="submit-button" value=" 确定保存 " >
    </div>
    <div class="clear" ></div>
    <table>
        <tr class="th" >
            <th>标签名称</th><th>值</th><th></th>
        </tr>
        <?php
        $i = 0;
        $setting = array_diff_key($setting, $config, array('default_template' => ''));
        if (isset($setting)) {
            foreach ($setting as $l => $v) {
                if (isset($v['type']) && $v['type'] != 'label')
                    continue;
                $i++;
                ?>
                <tr <?= ($i % 2) ? ' class="odd"' : '' ?> >
                    <td> <input type="text" size="20" name="var[<?= $i ?>][key]" value="<?= $l ?>"  /></td>
                    <td colspan="2" > <textarea  name="var[<?= $i ?>][val]" cols="60" rows="2" ><?= isset($setting[$l]['val']) ? $setting[$l]['val'] : '' ?></textarea></td> 
                </tr>
            <?php
            }
        }
        for ($j = 0; $j < 5; $j++) {
            $i++;
            ?>
            <tr <?= ($i % 2) ? ' class="odd"' : '' ?> >
                <td> <input type="text" size="20" name="var[<?= $i ?>][key]" value=""  /></td></td>
                <td colspan="2" ><textarea name="var[<?= $i ?>][val]" cols="60" rows="2" ></textarea></td> 
            </tr>
<?php } ?>
    </table>
    <div class="clear" ></div>

</form>
