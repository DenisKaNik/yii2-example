<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class AuthorAssignmentFixture extends ActiveFixture
{
    public $modelClass = 'library\entities\Library\Book\AuthorAssignment';
    public $dataFile = '@common/fixtures/data/author_assignment.php';
}