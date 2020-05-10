<?php for ( ; $startIDX < $endIDX; $startIDX++): ?>
    <div id="attention-note" class="attention-note" style="background: <?= $ads[$startIDX]['json_content']['background-color']; ?>" data-sh="#attention-note">
        <div class="container">
            <p class="note__txt">
                <svg width="20" height="18"><use href="/img/static/icons/<?= $ads[$startIDX]['json_content']['note__txt-svg']; ?>"></use></svg>
                <?= $ads[$startIDX]['json_content']['note__txt']; ?>
            </p>
        </div>
        <button class="note__close" type="button">
            <svg width="20" height="20">
                <use href="/img/static/icons/icons.svg#cross"></use>
            </svg>
        </button>
    </div>
<?php endfor; ?>