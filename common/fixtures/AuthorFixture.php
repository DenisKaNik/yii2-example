<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class AuthorFixture extends ActiveFixture
{
    public $modelClass = 'library\entities\Library\Author';
    public $dataFile = '@common/fixtures/data/author.php';
}