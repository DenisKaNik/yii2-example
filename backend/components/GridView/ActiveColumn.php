<?php

namespace backend\components\GridView;

use backend\traits\ColumnTrait;
use yii\grid\Column;
use yii\helpers\Html;

class ActiveColumn extends Column
{
    use ColumnTrait;

    public $headerOptions = ['style' => 'width:110px;'];
    public $attribute = 'active';

    public function init()
    {
        if (!$this->enableSorting) {
            $this->headerOptions = ['style' => 'width:90px;'];
        }
    }

    protected function renderDataCellContent($model, $key, $index)
    {
        return $model->{$this->attribute}
            ? Html::tag('span', 'Yes', ['style' => 'color:blue;'])
            : Html::tag('span', 'No', ['style' => 'color:red;']);
    }
}
