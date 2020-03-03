<?php

/* @var $this yii\web\View */
/* @var $model library\forms\manage\Library\AuthorForm */
/* @var $author library\entities\Library\Author */

$this->title = 'Update Author: ' . ($authorName = $author->first_name . ' ' . $author->last_name);
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $authorName, 'url' => ['view', 'id' => $author->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="author-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
