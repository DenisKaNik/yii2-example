<?php

use backend\components\DetailView\ActiveView;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $author library\entities\Library\Author */

$this->title = $author->first_name . ' ' . $author->last_name;
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="author-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $author->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $author->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="box">
        <div class="box-header with-border">Common</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $author,
                'attributes' => [
                    'id',
                    'first_name',
                    'last_name',
                    'slug',
                    'cnt_books',
                    [
                        'attribute' => 'active',
                        'format' => 'html',
                        'filter' => false,
                        'value' => function($author) {
                            return ActiveView::widget(['model' => $author]);
                        },
                    ],
                ],
            ]) ?>
        </div>
    </div>

    <div class="box">
        <div class="box-header with-border">SEO</div>
        <div class="box-body">
            <?= DetailView::widget([
                'model' => $author,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>

</div>
