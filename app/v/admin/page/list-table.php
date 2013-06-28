
<div class="clear" ></div>
<div id="breadcrumb" > <?=admin_breadcrumb($rel_id);?>   <a href="<?=BASE?>admin/page/add/<?=$rel_id?>/" class="breadcrumb_action" >添加页面</a>  </div>
<form method="POST" >
<table cellspacing=0 >
<?php if(is_array($records )){?>
  <tr class="th" >
    <th width="10" ><input type="checkbox" onclick="$('.sid').attr('checked',this.checked);"/></th>
    <th width="250" >标题</th>
    <th width="20" ></th>
    <th width="150" >名称</th>
    <th>发布时间</th>
    <th>排序</th>
    <th>
      操作
    </th>
  </tr>
<?php 
  $i = 0;
  foreach ($records as $r ){
  $info = _decode($r['elem_info']);
  ?>
  <tr <?=($i++%2)?' class="odd"':''?> >
    <td><input type="checkbox" name="sid[]" value="<?=$r['id']?>" class="sid" /></td>
    <td>
      <?php if($r['mod']=='dir'){?>
      <a href="<?=BASE?>admin/page/index/<?=$r['id']?>/" title="浏览">
        <img src="<?=BASE?>static/img/b_<?=$r['mod']?>.png" /> <?=$r['title']?></a>
      <?php }
      else {?>
        <img src="<?=BASE?>static/img/b_<?=$r['mod']?>.png" /> <?=$r['title']?>
      <?php }?>
    </td>
    <td><a href="<?=BASE?>page/<?=$r['elem_name']?$r['elem_name']:$r['id']?>/" target="_blank" ><img src="<?=BASE?>static/img/b_find.png" /> </a></td>
    <td> <?=$r['elem_name']?$r['elem_name']:$r['id']?> </td>
    <td><?=__time($r['post_time'])?></td>
    <td><input type="text" name="order_by[<?=$r['id']?>]" value="<?=$r['order_by']?>" size="2" tabindex="<?=$i?>" /></td>
    <td>
      <a href="<?=BASE?>admin/page/edit/<?=$r['id']?>/" title="编辑" ><img src="<?=BASE?>static/img/b_edit.png" /></a>
      <a href="javascript:del(<?=$r['id']?>)" title="删除" ><img src="<?=BASE?>static/img/b_drop.png"/></a>
      <a href="<?=BASE?>admin/page/add/<?=$r['id']?>/" title="添加子页面"><img src="<?=BASE?>static/img/b_snewtbl.png"/></a> 
      <?php if(isset($info['dir'])&&$info['dir']){?>
      <a href="<?=BASE?>admin/page/index/<?=$r['id']?>/" title="浏览"><img src="<?=BASE?>static/img/b_dir.png"/></a>
      <?php }?>
    </td>
  </tr>
<?php   }
}?>
<tr class="odd" ><td colspan="8" height="5" ></td></tr>
<tr class="panel" >
  <td colspan="4" >操作:选中项 <a href="javascript:mdel();" >删除</a> , 移动到 <select id="moveto" onchange="move()" >
    <option value="" ></option>
    <option value="0" >根目录</option>
  <?php foreach($category as $k=>$v){?>
    <option value="<?=$k?>"><?=$v?></option>
  <?php }?>
  </select></td><td colspan="2" ><a href="javascript:$('form').submit();" >更新排序</a></td>
  <td colspan="2" ></td>
</tr>
</table>
</form>
<?=$pagination?>
