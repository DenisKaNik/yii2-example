<?php

namespace library\useCases\Library;

use library\entities\Meta;
use library\repositories\Library\BookRepository;

class BookService
{
    private $books;

    public function __construct(BookRepository $books)
    {
        $this->books = $books;
    }

    public function edit($id, $jsonData)
    {
        $book = $this->books->get($id);
        $book->edit(
            $jsonData['name'] ?? $book->name,
            $jsonData['isbn'] ?? $book->isbn,
            $jsonData['slug'] ?? $book->slug,
            new Meta(
                $jsonData['meta_title'] ?? $book->meta->title,
                $jsonData['meta_description'] ?? $book->meta->description,
                $jsonData['meta_keywords'] ?? $book->meta->keywords
            ),
            $jsonData['description'] ?? $book->description,
            $jsonData['active'] ?? $book->active);
        $this->books->save($book);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $this->books->remove(
            $this->books->get($id)
        );
    }
}
