<?php

use backend\components\DetailView\ActiveView;
use library\helpers\AuthorHelper;
use yii\helpers\{
    ArrayHelper,
    Html
};
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $book library\entities\Library\Book\Book */

$this->title = $book->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="book-view">

    <p>
        <?= Html::a('Update', ['update', 'id' => $book->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $book->id], [
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
                'model' => $book,
                'attributes' => [
                    'id',
                    'name',
                    'isbn',
                    'slug',
                    'description:html',
                    [
                        'attribute' => 'authors',
                        'format' => 'raw',
                        'value' => function ($book) {
                            return implode(
                                '<br />',
                                AuthorHelper::htmlListByAdmin(
                                    ArrayHelper::getColumn(
                                        $book->authorAssignments,
                                        'author_id'
                                    )
                                )
                            );
                        },
                    ],
                    [
                        'attribute' => 'active',
                        'format' => 'html',
                        'filter' => false,
                        'value' => function($book) {
                            return ActiveView::widget(['model' => $book]);
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
                'model' => $book,
                'attributes' => [
                    'meta.title',
                    'meta.description',
                    'meta.keywords',
                ],
            ]) ?>
        </div>
    </div>

</div>
