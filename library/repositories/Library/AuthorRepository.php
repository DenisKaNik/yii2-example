<?php

namespace library\repositories\Library;

use library\entities\Library\Author;
use library\repositories\NotFoundException;

class AuthorRepository
{
    public function get($id): Author
    {
        if (!$author = Author::findOne($id)) {
            throw new NotFoundException('Author is not found.');
        }

        return $author;
    }

    public function save(Author $author): void
    {
        if (!$author->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Author $author
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Author $author): void
    {
        if (!$author->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
