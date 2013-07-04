
<ul class="product-elem-list" >
    <?php
    if (is_array($pages)) {
        foreach ($pages as $r) {
            ?>
            <li>
                <div>
                    <a href="<?= $r['page'] ?>" ><img src="<?= $r['pic'] ?>" /></a>
                </div> 
                <div>
                    <a href="<?= $r['page'] ?>" ><b><?= $r['title'] ?></b></a>
                </div>
                <div>
        <?= $r['xinghao'] ?>
                </div>
                <div>
                    ￥ <?= $r['price'] ?>
                </div>

            </li>
        <?php }
    }
    ?>
</ul>
