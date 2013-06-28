
<form method="POST" ><table class="table-add table" cellspacing=0 >
  <tr>
    <th>email</th>
    <td>
      <input class="text" name="email" value="<?=isset($val['email'])?$val['email']:''?>" >
    </td>
    <td>
      <span class="error" ><?=isset($err['email'])?$err['email']:''?></span>
    </td>
  </tr>
  <tr>
    <th>用户名</th>
    <td>
      <input class="text" name="username" value="<?=isset($val['username'])?$val['username']:''?>" >
    </td>
    <td>
      <span class="error" ><?=isset($err['username'])?$err['username']:''?></span>
    </td>
  </tr>
  <tr>
    <th>密码</th>
    <td>
      <input class="password" name="password" value="<?=isset($val['password'])?$val['password']:''?>" >
    </td>
    <td>
      <span class="error" ><?=isset($err['password'])?$err['password']:''?></span>
    </td>
  </tr>
  <tr>
    <th></th><td><input type="submit" class="submit-button" value="确认提交" ></td>
  </tr>
</table></form>
