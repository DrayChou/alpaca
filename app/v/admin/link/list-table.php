<div class="notice">菜单可在风格和排版中通过<font color="darkred"> &lt;?=alpa('菜单名')?&gt;</font> 进行调用</div>
<a class="admin_link" href="<?=BASE?>admin/page/link/add/" >创建菜单</a> 
<div class="clear" ></div>
<table cellspacing=0 >
<?php if(is_array($records )){?>
  <tr class="th" >
    <th>菜单名</th>
    <th>修改时间</th>
    <th>
      操作
    </th>
  </tr>
<?php
  $i = 0;
  foreach ($records as $r ){
  ?>
  <tr <?=($i++%2)?' class="odd"':''?> >
    <td><?=$r['elem_name']?></td>
    <td><?=__time($r['update_time'])?></td>
    <td>  
    
      <a href="<?=BASE?>admin/page/link/edit/<?=$r['id']?>/" title="编辑" ><img src="<?=BASE?>static/img/b_edit.png"></a> 
      <a href="javascript:del(<?=$r['id']?>)" title="删除" ><img src="<?=BASE?>static/img/b_drop.png"></a>
    </td>
  </tr>
<?php  }
}?>
</table>
<?=$pagination?>
