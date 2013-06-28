
<form method="POST" >
<input type="hidden" name="mod" value="template" >
<table class="table-add table" cellspacing=0 >
  <tr>
    <th>标题</th>
    <td>
      <input type="text" name="title" value="<?=isset($val['title'])?$val['title']:''?>" size="40" >
    </td>
    <td>
      <span class="error" ><?=isset($err['title'])?$err['title']:''?></span>
    </td>
  </tr>
  </tr>
  <tr>
    <th>风格代码<br /> HTML+CSS</th>
    <td>
      <textarea class="text" name="elem_info" cols="70" rows="17" ><?=isset($val['elem_info'])?$val['elem_info']:''?></textarea>
    </td>
    <td>
      <span class="error" ><?=isset($err['elem_info'])?$err['elem_info']:''?></span>
    </td>
  </tr>
  <tr>
    <th></th><td><input type="submit" class="submit-button" value="确认提交" ></td>
  </tr>
</table></form>
