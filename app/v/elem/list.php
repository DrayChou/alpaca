<ul class="elem-list" >
<?php 
if(is_array($records )){
foreach ($records as $r ){ ?>
  <li>
    <div>标题 <?=$r['title']?></div>
    <div>模块 <?=$r['mod']?></div>
    <div>关联ID <?=$r['rel_id']?></div>
    <div>名称 <?=$r['elem_name']?></div>
    <div>内容 <?=$r['elem_info']?></div>
    <div>信息 <?=$r['elem_info']?></div>
    <div>发布时间 <?=$r['post_time']?></div>
    <div>更新时间 <?=$r['update_time']?></div>
    <div>用户ID <?=$r['user_id']?></div>
    <div>用户 <?=$r['user_name']?></div>
    <div>排序 <?=$r['order_by']?></div>
    <div>
      <a href="/elem/view/<?=$r['id']?>" >查看</a>
      <a href="/elem/edit/<?=$r['id']?>" >编辑</a> 
    </div>
  </li>
<?php   }
}?>
</ul>
<?=isset($pagination)?$pagination:''?>