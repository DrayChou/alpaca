
<div class="notice" >变量可在风格和排版中通过<font color="darkred" > &lt;?=alpa('变量名')?></font> 进行调用</div>

<form method="POST" >
<input type="hidden" name="mod" value="setting" >
<div class="right" >
<input type="submit" class="submit-button" value=" 确定保存 " >
</div>

<div class="clear" ></div>
<table cellspacing="0" >
  <tr class="th" >
    <th>系统变量</th><th>注释</th><th>值</th>
  </tr>
  <?php 
  $i = 0;  
  if(isset($config)){
    foreach($config as $l=>$v){
      $i++;
      ?>
  <tr <?=($i%2)?' class="odd"':''?> >
    <td><?=$l?></td> 
    <td><?=$v?></td>
    <td> <input type="text" size="40" name="setting[<?=$l?>]" value="<?=isset($setting[$l]['val'])?$setting[$l]['val']:''?>"  /></td> 
  </tr>  
<?php }}
$i=0;
?>
</table>
</form>
