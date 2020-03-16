<?php
namespace common\fixtures;

use yii\test\ActiveFixture;

class UserFixture extends ActiveFixture
{
    public $modelClass = 'library\entities\User\User';
    public $dataFile = '@common/fixtures/data/user.php';
}