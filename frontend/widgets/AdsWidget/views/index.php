<?php
for ($i = 0, $startIDX = 0; ; $i++) {
    while ($i < count($ads) && $ads[$i]['render_file_name'] == $ads[$startIDX]['render_file_name'])
        $i++;

    echo $this->render($ads[$startIDX]['render_file_name'], [
        'ads' => $ads,
        'startIDX' => $startIDX,
        'endIDX' => $i,
    ]);

    if ($i == count($ads))
        break;

    $startIDX = $i;
}