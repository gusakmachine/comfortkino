<?php
for ($i = 0, $startIDX = 0; ; $i++) {
    while ($i < count($ads) && $ads[$i]['type']['name'] == $ads[$startIDX]['type']['name'])
        $i++;

    echo $this->render($ads[$startIDX]['type']['name'], [
        'ads' => $ads,
        'startIDX' => $startIDX,
        'endIDX' => $i,
    ]);

    if ($i == count($ads))
        break;

    $startIDX = $i;
}