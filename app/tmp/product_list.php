<h3><?=$title?></h3>
<div> <?=$content?> </div>
<ul class="top_tag" ><?=alpa::tags()?></ul>
<div class="clear"></div>
<ul class="product-elem-list" >
<?php
if(is_array( $pages ) && !empty( $pages )){
foreach ($pages as $r ){ ?>
  <li>
<div>
<a href="<?=$r['page']?>" ><img src="<?=$r['pic']?>" /></a></div> 
<div>
<a href="<?=$r['page']?>" ><b><?=$r['title']?></b></a>
</div>
<div>
<?=$r['xinghao']?>
</div>
<div>
￥ <?=$r['price']?>
</div>

</li>
<?php  }
}?>
</ul>
<div class="clear"></div>
<?=isset($pagination)?$pagination:''?>
