<h1><?= $title ?></h1>
<div><?= $content ?> </div>
<ul class="elem-list">
    <?php
    if (is_array($pages)) {
        foreach ($pages as $r) {
            ?>
            <li><a href="<?= $r['page'] ?>"><?= $r['title'] ?></a>
                <span class="date"><?= __time($r['post_time']) ?></span>
            </li>
        <?php
        }
    }
    ?>
</ul>
<?= isset($pagination) ? $pagination : '' ?>
