<form method="POST" >
    <table class="table-add table" cellspacing=0 >
        <tr>
            <th>用户名</th>
            <td>
                <input class="text" name="username" type="text"  value="<?= isset($val['username']) ? $val['username'] : '' ?>" />
            </td>
            <td>
                <span class="error" >
                    <?= isset($err['username']) ? $err['username'] : '' ?>
                    <?= isset($err['info']) ? $err['info'] : '' ?>
                </span>
            </td>
        </tr>
        <tr>
            <th>密码</th>
            <td>
                <input class="text" name="password" type="password" value="<?= isset($val['password']) ? $val['password'] : '' ?>" />
            </td>
            <td>
                <span class="error" ><?= isset($err['password']) ? $err['password'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th></th><td><input type="hidden" name="some"  value="ok" /><input type="submit" class="submit-button" value="确认提交" ></td>
        </tr>
    </table>
</form>
