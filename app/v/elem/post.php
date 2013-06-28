<form method="POST" >
<input type="hidden" name="mod" value="page" >
<input type="hidden" name="info[model]" value="<?=isset($val['info']['model'])?$val['info']['model']:''?>" >
<table class="table-add table" cellspacing=0 >
    <tr>
    <th><?=$cur_mod['title_label']?></th>
    <td>
      <input type="text" name="title" value="<?=isset($val['title'])?$val['title']:''?>" size="40" > 
      <span class="error" ><?=isset($err['title'])?$err['title']:''?></span>
    </td>
    <td>
    </td>
  </tr>
 
  <?php 
  if(isset($cur_mod['fields'][0])){
  $i = 1000;
  foreach($cur_mod['fields'] as $field){
    $i++;
    ?>
  <tr>
    <th><?=$field['label']?></th>
    <td>
      <?php 
      $fname = $field['name'];
      $fval = isset($val['info'][$fname])?$val['info'][$fname]:'';
      switch($field['model']){
        /*
        case 'pic':
          echo '<input type="hidden" name="info['.$fname.']" id="f'.$i.'_val" class="text" size="30" value="'.$fval.'" />
          <input type="file" name="filedata" class="upload" id="f'.$i.'" />
          <div id="f'.$i.'_preview" class="upload_preview" >'.($fval?'<img src="'.$fval.'" />':'').'</div>
          ';
          break;
        */
        case 'mtext':
          echo '<textarea type="text" name="info['.$fname.']" id="f'.$i.'"   class="text" cols="40" rows="5" />'.$fval.'</textarea>';
          break;
          
        case 'rte':
          echo '<textarea type="text" class="xheditor {skin:\'nostyle\',width:\'100%\',height:\'400px\',upImgUrl:\'/admin/page/upload/\',upImgExt:\'jpg,jpeg,gif,png\'}" name="info['.$fname.']" id="f'.$i.'"   class="text" cols="40" rows="5" />'.$fval.'</textarea>';
          break;
        
        default:
          echo '<input type="text" name="info['.$fname.']" id="f'.$i.'" size="40" value="'.$fval.'"/>';
          break;
      }
      ?>
    </td>
    <td>
    </td>
  </tr>
  <?php }}?>
  <tr>
    <th></th><td><input type="submit" class="submit-button" value="确认提交" ></td>
  </tr>
</table></form>
