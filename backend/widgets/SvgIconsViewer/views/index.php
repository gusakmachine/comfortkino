<?php
use backend\assets\ViewersAsset;

ViewersAsset::register($this);
?>
<div class="viewers-wrapper" data-element-name="<?= $element_name; ?>">
    <?php foreach ($svgIcons as $svgIcon): ?>
        <img class="viewers-item <?= ($svgIcon['name'] == $name)? 'selected-item' : '' ?>" src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@svg_icons') . $svgIcon['name']; ?>" alt="image" data-name="<?= $svgIcon['name']?>"/>
    <?php endforeach;?>
</div>
