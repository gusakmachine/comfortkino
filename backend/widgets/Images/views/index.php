<?php
use backend\assets\ImagesAsset;

ImagesAsset::register($this);
/* @var $input_id string */
?>

<div class="viewers-wrapper" data-element-id="<?= $input_id; ?>">
    <?php foreach ($model as $item): ?>
        <img class="viewers-item <?= ($item['name'] == $name)? 'selected-item' : '' ?>"
             src="<?= Yii::getAlias('@frontend_link') . Yii::getAlias('@svg') . $item['name']; ?>"
             data-name="<?= $item['name']; ?>"
        />
    <?php endforeach;?>
</div>

