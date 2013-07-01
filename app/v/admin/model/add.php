<?php
    $option = array(
     'text'=>'文本',
     'mtext' =>'多行文本',
     'rte' =>'富文本',
     'pic' =>'图片',
     'radio' =>'单选',
     'checkbox' =>'多选'
    );
?>    
<script>

$(function(){
  $(".input-type").change(function(){ 
      if($(this).val()=='radio'||$(this).val()=='checkbox'){
        $(this).next().fadeIn();
      }
      else {
        $(this).next().fadeOut();
      }
    });
  $('.once').one("focus",function(){$(this).val('');});
  
  $(".input-ename").focus(function(){$(this).css('height','50px');});
  $(".input-ename").blur(function(){$(this).css('height','18px');});
});
</script>
<form method="POST" >
<input type="hidden" name="mod" value="model" >
<table  cellspacing="0" >
  <tr>
    <td colspan="2" >原型名称 &nbsp; 
      <input type="text" name="title" value="<?=isset($val['title'])?$val['title']:''?>"  size="12"  >
    </td>
    <td>
      <span class="error" ><?=isset($err['title'])?$err['title']:''?></span>
    </td>
  </tr>
</table>
<div class="info">  
</div>
<table  cellspacing="0" >
  <tr class="th" >
     <th width=20 ></th><th>项目名称</th><th>文字标签</th><th width="50%" >类别</th><th>排序</th><th></th>
  </tr> 
    <tr>
      <td> <a title="此行为每个模型必备字段，系统默认，不能删除。 只可以修改标签名" >注</a></td>
      <td> <input type="text" value="title" disabled="true" size="12"  /></td> 
      <td><input type="text" name="title_label" value="<?=isset($val['title_label'])?$val['title_label']:'标题'?>" /></td> 
      <td><select readonly="true" ><option>文本</option></select> </td> 
      <td><input type="text" size="4" value="0" disabled="true" /> </td> 
      <td></td>
     </tr>
<?php
$i = 1;  
if(isset($val['fields'])){
  foreach($val['fields'] as $l){
    $i++;
    ?>
    <tr <?=($i%2)?'':' class="odd"'?> >
      <td></td>
      <td> <input type="text" name="fields[<?=$i?>][name]" value="<?=$l['name']?>" size="12" /> </td> 
      <td> <input type="text" name="fields[<?=$i?>][label]" value="<?=$l['label']?>" /> </td> 
      <td>
        <select name="fields[<?=$i?>][model]" class="input-type"  > 
         <?php foreach($option as $k=>$v){?>  <option value="<?=$k?>" <?=$l['model']==$k?'selected="TRUE"':''?>><?=$v?></option> <?php }?>
        </select>
        <textarea <?=($l['model']=='radio'||$l['model']=='checkbox')?'':'style="display:none;"'?> class="input-ename"  name="fields[<?=$i?>][enum]" ><?=isset($l['enum'])?$l['enum']:"选项1\n选项2\n选项3"?></textarea> 
      </td> 
      <td> <input type="text" size="4" name="fields[<?=$i?>][order]" value="<?=isset($l['order'])?$l['order']:''?>"  /></td> 
      <td> <a onclick="$(this).parent().parent().remove();" title="删除" ><img src="<?=BASE?>static/img/b_drop.png"/></a></td>
     </tr>
      <?php }}?>
      <?php for($j=$i+1;$j<$i+8;$j++):?>
    <tr <?=($j%2)?'':' class="odd"'?> >
          <td></td>
          <td>
                <input type="text" name="fields[<?=$j?>][name]"  size="12"  > 
          </td> 
          <td>
                <input type="text" name="fields[<?=$j?>][label]" > 
          </td> 
          <td>

            <select name="fields[<?=$j?>][model]" class="input-type" >
              <?php foreach($option as $k=>$v){?> <option value="<?=$k?>" ><?=$v?></option> <?php }?> 
            </select>
 
     <textarea style="display:none;" name="fields[<?=$j?>][enum]" class="input-ename"  >选项1
选项2
选项3</textarea> 
    
    
          </td> 
          <td> <input type="text" size="4" name="fields[<?=$j?>][order]" value=""  /></td> <td></td>
        </tr>
      <?php endfor;?>
    <tr>
    <th></th><td><input type="submit" class="submit-button" value="更新" ></td>
  </tr>
</table></form>
