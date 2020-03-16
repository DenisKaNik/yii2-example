<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class BookFixture extends ActiveFixture
{
    public $modelClass = 'library\entities\Library\Book\Book';
    public $dataFile = '@common/fixtures/data/book.php';
}