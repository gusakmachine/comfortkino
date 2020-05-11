<?php for ( ; $startIDX < $endIDX; $startIDX++): ?>
    <div class="page-background" style="background-image: url(<?= Yii::getAlias('@backgrounds') . $ads[$startIDX]['json_content']['background_path'] ?>)"></div>
<?php endfor; ?>