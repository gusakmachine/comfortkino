<?php
use backend\assets\ViewersAsset;

ViewersAsset::register($this);
?>
<div class="viewers-wrapper" data-element-name="<?= $element_name; ?>">
    <?php foreach ($model as $item): ?>
        <div class="viewers-item <?= ($item['name'] == $name)? 'selected-item' : '' ?>" style="background: <?= $item['name']; ?>" data-name="<?= $item['name']; ?>"></div>
    <?php endforeach;?>
</div>
