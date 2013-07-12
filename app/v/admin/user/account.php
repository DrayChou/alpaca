<form method="POST">
    <table class="table-add table" cellspacing=0>
        <tr>
            <th>email</th>
            <td>
                <input type="text" name="email" readonly="TRUE"
                       value="<?= isset($val['email']) ? $val['email'] : '' ?>">
            </td>
            <td>
                <span class="error"><?= isset($err['email']) ? $err['email'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>用户名</th>
            <td>
                <input type="text" name="username" readonly="TRUE"
                       value="<?= isset($val['username']) ? $val['username'] : '' ?>">
            </td>
            <td>
                <span class="error"><?= isset($err['username']) ? $err['username'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th>密码</th>
            <td>
                <input type="text" name="password" value="">
            </td>
            <td>
                <span class="error"><?= isset($err['password']) ? $err['password'] : '' ?></span>
            </td>
        </tr>
        <tr>
            <th></th>
            <td><input type="submit" class="submit-button" value="确认提交"></td>
        </tr>
    </table>
</form>
