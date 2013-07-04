
<form method="POST" >
    <input type="hidden" name="mod" value="layout" >
    <table class="table-add table" cellspacing=0 >
        <tr>
            <th>名称</th>
            <td>
                <input type="text" name="elem_name" value="<?= isset($val['elem_name']) ? $val['elem_name'] : '' ?>" size="40" >
            </td>
            <td>
                <span class="error" ><?= isset($err['elem_name']) ? $err['elem_name'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>代码</th>
            <td>
                <textarea name="elem_info" cols="70" rows="17" ><?= isset($val['elem_info']) ? $val['elem_info'] : '' ?></textarea>
            </td>
            <td>
                <span class="error" ><?= isset($err['elem_info']) ? $err['elem_info'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th></th><td><input type="submit" class="submit-button" value="确认提交" ></td>
        </tr>
    </table>
</form>
