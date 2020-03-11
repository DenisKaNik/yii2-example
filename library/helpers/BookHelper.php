<?php

namespace library\helpers;

use library\entities\Library\Book\Book;
use yii\helpers\ArrayHelper;

class BookHelper
{
    public static function listAuthors(Book $book)
    {
        return implode(
            ', ',
            AuthorHelper::simpleListByPublic(
                ArrayHelper::getColumn(
                    $book->authorAssignments,
                    'author_id'
                )
            )
        );
    }
}
