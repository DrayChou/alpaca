<div class="col50">
    <?= $content ?>
</div>
<div class="col50">
    <h3>公司动态</h3>
    <?= alpa('news', 5) ?>
</div>
<div class="clear"></div>
<h3>推荐产品</h3>
<?= alpa::tag('推荐', 10, 'list_product') ?>
<div class="clear"></div>