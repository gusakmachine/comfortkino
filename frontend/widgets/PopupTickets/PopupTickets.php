<?php

namespace frontend\widgets\PopupTickets;

use yii\base\Widget;

class PopupTickets extends Widget
{
    public function run() {
        return $this->render('index');
    }
}