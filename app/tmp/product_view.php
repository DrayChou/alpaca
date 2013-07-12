<div class="col33">
    <div class="padding"><img src="<?= $pic ?>" width=100%/></div>
</div>
<div class="col66">
    <div class="padding">
        <h1><?= $title ?></h1>
        型号: <?= $xinghao ?> <br/>
        价格: <?= $price ?>
    </div>
</div>
<div class="clear"></div>
<div>   <?= $content ?> </div>
<ul class="elem-list">
    <?php
    if (is_array($pages)) {
        foreach ($pages as $r) {
            ?>
            <li><a href="<?= $r['page'] ?>"><?= $r['title'] ?></a></li>
        <?php
        }
    }
    ?>
</ul>
<?= isset($pagination) ? $pagination : '' ?>
