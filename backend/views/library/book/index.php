<?php

use backend\components\GridView\ActiveColumn;
use library\helpers\AuthorHelper;
use yii\helpers\{
    ArrayHelper,
    Html
};
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $book \library\entities\Library\Book\Book */

$this->title = 'Books';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="book-index">
    <p>
        <?= Html::a('Create Book', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <div class="box">
        <div class="box-body">

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'name',
                    'isbn',
                    'slug',
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
                    ['class' => ActiveColumn::class],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>

        </div>
    </div>

</div>
