<?php
    use yii\helpers\Url;

    $menuItems = [
        ['label' => 'Movie Theaters', 'url' => ['/movie-theaters/index']],
        ['label' => 'Ads', 'url' => ['/ads/index']],
        ['label' => 'Sessions', 'url' => ['/sessions/index']],
        ['label' => 'Movies', 'url' => ['/movies/index']],
    ];
?>

<?php foreach ($menuItems as $item): ?>
    <a href="<?= Url::toRoute([$item['url'][0]]); ?>"><?= $item['label']; ?></a>
    <br />
<?php endforeach; ?>