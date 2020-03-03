<?php

namespace library\repositories\Library;

use library\entities\Library\Book\AuthorAssignment;
use library\entities\Library\Book\Book;
use library\repositories\NotFoundException;

class BookRepository
{
    public function get($id): Book
    {
        if (!$book = Book::findOne($id)) {
            throw new NotFoundException('Book is not found.');
        }

        return $book;
    }

    public function existsByAuthor($id): bool
    {
        return AuthorAssignment::find()->andWhere(['author_id' => $id])->exists();
    }

    public function save(Book $book): void
    {
        if (!$book->save()) {
            throw new \RuntimeException('Saving error.');
        }
    }

    /**
     * @param Book $book
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove(Book $book): void
    {
        if (!$book->delete()) {
            throw new \RuntimeException('Removing error.');
        }
    }
}
