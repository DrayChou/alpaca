<table class="elem-list-table table-list table" cellspacing=0 >
<?php if(is_array($records )){?>
  <tr>
    <th>标题</th>
    <th>模块</th>
    <th>关联ID</th>
    <th>名称</th>
    <th>发布时间</th>
    <th>更新时间</th>
    <th>用户ID</th>
    <th>用户</th>
    <th>排序</th>
    <th>
      操作
    </th>
  </tr>
<?php foreach ($records as $r ){?>
  <tr>
    <td><?=$r['title']?></td>
    <td><?=$r['mod']?></td>
    <td><?=$r['rel_id']?></td>
    <td><?=$r['elem_name']?></td>
    <td><?=$r['post_time']?></td>
    <td><?=$r['update_time']?></td>
    <td><?=$r['user_id']?></td>
    <td><?=$r['user_name']?></td>
    <td><?=$r['order_by']?></td>
    <td>
      <a href="/elem/view/<?=$r['id']?>" >查看</a>
      <a href="/elem/edit/<?=$r['id']?>" >编辑</a> 
    </td>
  </tr>
<?php   }
}?>
</table>
<?=$pagination?>
