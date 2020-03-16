<?php

namespace common\fixtures;

use yii\test\ActiveFixture;

class RelatedAssignmentFixture extends ActiveFixture
{
    public $modelClass = 'library\entities\Library\Book\RelatedAssignment';
    public $dataFile = '@common/fixtures/data/related_assignment.php';
}