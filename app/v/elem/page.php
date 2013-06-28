

<h1><?=isset($r['title'])?$r['title']:'' ?></h1>
<div>
  <?=isset($r['elem_info'])?$r['elem_info']:''?>
</div>


<ul class="elem-list" >
<?php 
if(is_array($records )){
foreach ($records as $r ){ ?>
  <li>
    <div><a href="/page/<?=$r['elem_name']?$r['elem_name']:$r['id']?>/" ><?=$r['title']?></a></div>
    <div>发布时间 <?=__time($r['post_time'])?></div>
    <div>更新时间 <?=__time($r['update_time'])?></div>
  </li>
<?php   }
}?>
</ul>
<?=isset($pagination)?$pagination:''?>

