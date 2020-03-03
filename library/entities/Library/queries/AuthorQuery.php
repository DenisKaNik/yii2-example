<?php

namespace library\entities\Library\queries;

use yii\db\ActiveQuery;

class AuthorQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }
}
