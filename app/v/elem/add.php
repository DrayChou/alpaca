
<form method="POST" >
    <table class="table-add table" cellspacing=0 >
        <tr>
            <th>标题</th>
            <td>
                <input class="text" name="title" value="<?= isset($val['title']) ? $val['title'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['title']) ? $err['title'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>模块</th>
            <td>
                <input class="text" name="mod" value="<?= isset($val['mod']) ? $val['mod'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['mod']) ? $err['mod'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>关联ID</th>
            <td>
                <input class="text" name="rel_id" value="<?= isset($val['rel_id']) ? $val['rel_id'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['rel_id']) ? $err['rel_id'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>名称</th>
            <td>
                <input class="text" name="elem_name" value="<?= isset($val['elem_name']) ? $val['elem_name'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['elem_name']) ? $err['elem_name'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>内容</th>
            <td>
                <input class="text" name="elem_info" value="<?= isset($val['elem_info']) ? $val['elem_info'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['elem_info']) ? $err['elem_info'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>信息</th>
            <td>
                <input class="text" name="elem_info" value="<?= isset($val['elem_info']) ? $val['elem_info'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['elem_info']) ? $err['elem_info'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>发布时间</th>
            <td>
                <input class="text" name="post_time" value="<?= isset($val['post_time']) ? $val['post_time'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['post_time']) ? $err['post_time'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>更新时间</th>
            <td>
                <input class="text" name="update_time" value="<?= isset($val['update_time']) ? $val['update_time'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['update_time']) ? $err['update_time'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>用户ID</th>
            <td>
                <input class="text" name="user_id" value="<?= isset($val['user_id']) ? $val['user_id'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['user_id']) ? $err['user_id'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>用户</th>
            <td>
                <input class="text" name="user_name" value="<?= isset($val['user_name']) ? $val['user_name'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['user_name']) ? $err['user_name'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>排序</th>
            <td>
                <input class="text" name="order_by" value="<?= isset($val['order_by']) ? $val['order_by'] : '' ?>" >
            </td>
            <td>
                <span class="error" ><?= isset($err['order_by']) ? $err['order_by'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th></th><td><input type="submit" class="submit-button" value="确认提交" ></td>
        </tr>
    </table>
</form>