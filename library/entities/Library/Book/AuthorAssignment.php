<?php

namespace library\entities\Library\Book;

use library\entities\Library\Author;
use yii\db\{
    ActiveQuery,
    ActiveRecord
};

/**
 * @property integer $book_id;
 * @property integer $author_id;
 */
class AuthorAssignment extends ActiveRecord
{
    public static function create($authorId): self
    {
        $assignment = new static();
        $assignment->author_id = $authorId;
        return $assignment;
    }

    public function isForAuthor($authorId): bool
    {
        return $this->author_id == $authorId;
    }

    public static function tableName(): string
    {
        return '{{%lib_author_assignments}}';
    }
    
    public function getAuthor(): ActiveQuery
    {
        return $this->hasOne(Author::class, ['id' => 'author_id']);
    }

    public function getBook()
    {
        return $this->hasOne(Book::class, ['id' => 'book_id']);
    }

    public function updateCntBooks(): void
    {
        $this->getAuthor()->one()->updateCntBook();
    }
}
