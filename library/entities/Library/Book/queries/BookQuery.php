<?php

namespace library\entities\Library\Book\queries;

use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\library\entities\Library\Book\Book]].
 *
 * @see \library\entities\Library\Book\Book
 */
class BookQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => true]);
    }

    /**
     * {@inheritdoc}
     * @return \library\entities\Library\Book\Book[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \library\entities\Library\Book\Book|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
