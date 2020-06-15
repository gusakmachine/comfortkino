<?php
use backend\assets\ImagesAsset;

ImagesAsset::register($this);
/* @var $current_color string */
/* @var $input_id string */
?>

<div class="viewers-wrapper" data-element-id="#<?= $input_id; ?>">
    <?php foreach ($model as $item): ?>
        <div class="viewers-item <?= ($item['color'] == $current_color)? 'selected-item' : '' ?>"
             style="background: <?= $item['color']; ?>;" data-name="<?= $item['color']; ?>"></div>
    <?php endforeach;?>
</div>