<?php

namespace library\readModels\Library;

use library\entities\Library\Author;
use library\entities\Library\Book\Book;

class AuthorReadRepository
{
    public function getBooksCnt(Author $author = null)
    {
        return Book::find()
            ->active()
            ->joinWith('authorAssignments aa')
            ->andWhere(['aa.author_id' => $author->id])
            ->count();
    }
}
