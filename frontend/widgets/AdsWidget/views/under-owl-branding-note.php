<?php for ( ; $startIDX < $endIDX; $startIDX++): ?>
    <?php $ads[$startIDX]['json_content'] = json_decode($ads[$startIDX]['json_content'], true); ?>
    <div class="branding-note">
        <img width="20" height="20" src="/img/static/icons/<?= $ads[$startIDX]['json_content']['branding-note__svg']; ?>">
        <p class="branding-note__link"><?= $ads[$startIDX]['json_content']['branding-note__link']; ?></p>
    </div>
<?php endfor; ?>