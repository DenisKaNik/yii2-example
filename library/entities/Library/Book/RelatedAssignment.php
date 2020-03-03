<?php

namespace library\entities\Library\Book;

use yii\db\ActiveRecord;

/**
 * @property integer $book_id;
 * @property integer $related_id;
 */
class RelatedAssignment extends ActiveRecord
{
    public static function create($bookId): self
    {
        $assignment = new static();
        $assignment->related_id = $bookId;
        return $assignment;
    }

    public function isForBook($id): bool
    {
        return $this->related_id == $id;
    }

    public static function tableName(): string
    {
        return '{{%lib_related_assignments}}';
    }
}
