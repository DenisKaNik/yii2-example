<?php

/* @var $this yii\web\View */
/* @var $model library\forms\manage\Library\Book\BookForm */
/* @var $book library\entities\Library\Book\Book */

$this->title = 'Update Book: ' . $book->name;
$this->params['breadcrumbs'][] = ['label' => 'Books', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $book->name, 'url' => ['view', 'id' => $book->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="book-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
