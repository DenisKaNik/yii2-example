<?php

namespace backend\components\DetailView;

use yii\base\Widget;
use yii\helpers\Html;

class ActiveView extends Widget
{
    public $model;
    private $attribute = 'active';

    public function run()
    {
        return $this->model->{$this->attribute}
            ? Html::tag('span', 'Yes', ['style' => 'color:blue;'])
            : Html::tag('span', 'No', ['style' => 'color:red;']);
    }
}
