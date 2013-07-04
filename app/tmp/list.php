<?php
if (is_array($pages) && !empty($pages)) {
    foreach ($pages as $r) {
        ?>
        <li>
            <a href="<?= $r['page'] ?>/" ><?= $r['title'] ?></a>
        </li>
    <?php
    }
}?>