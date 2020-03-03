<?php

/* @var $this yii\web\View */
/* @var $model \library\forms\manage\Library\AuthorForm */

$this->title = 'Create Author';
$this->params['breadcrumbs'][] = ['label' => 'Authors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="author-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
