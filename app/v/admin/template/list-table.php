<div class="notice" >更多风格请访问 <a href="http://alpaca.b24.cn"  target=_blank >http://alpaca.b24.cn</a> </div>
<a class="admin_link" href="<?=BASE?>admin/template/add/" >添加风格</a> 
<div class="clear" ></div>
<table cellspacing=0 >
<?php if(is_array($records )){?>
  <tr class="th" >
    <th>标题</th>
    <th>更新时间</th>
    <th>
      操作
    </th>
  </tr>
<?php 
$i=0;
foreach ($records as $r ){
  ?>
  <tr <?=($i++%2)?' class="odd"':''?> >
    <td><?=$r['title']?></td>
    <td><?=__time($r['update_time'])?></td>
    <td>  
      <a href="<?=BASE?>admin/template/edit/<?=$r['id']?>/" title="编辑" ><img src="<?=BASE?>static/img/b_edit.png"></a> 
       <a href="javascript:del(<?=$r['id']?>)"  title="删除" ><img src="<?=BASE?>static/img/b_drop.png" /></a>

      <?php if($default == $r['id'] ) {?>
       [ 默认 ]
      <?php  }
      else {?>
        <a href="<?=BASE?>admin/template/defa/<?=$r['id']?>/" >设为默认</a> 
      <?php  } ?>
    </td>
  </tr>
<?php   }
}?>
</table>
<?=$pagination?>
