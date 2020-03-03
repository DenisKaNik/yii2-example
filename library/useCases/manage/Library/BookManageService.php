<?php

namespace library\useCases\manage\Library;

use library\entities\Library\Book\Book;
use library\entities\Meta;
use library\repositories\Library\{
    AuthorRepository,
    BookRepository
};
use library\forms\manage\Library\Book\BookForm;
use library\services\TransactionManager;

class BookManageService
{
    private $books;
    private $authors;
    private $transaction;

    public function __construct(
        BookRepository $books,
        AuthorRepository $authors,
        TransactionManager $transaction
    )
    {
        $this->books = $books;
        $this->authors = $authors;
        $this->transaction = $transaction;
    }

    /**
     * @param BookForm $form
     * @return Book
     * @throws \Exception
     */
    public function create(BookForm $form): Book
    {
        $book = Book::create(
            $form->name,
            $form->isbn,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
            $form->description,
            $form->active
        );

        foreach ($form->authors->existing as $authorId) {
            $authorAssign = $this->authors->get($authorId);
            $book->assignAuthor($authorAssign->id);
        }

        foreach ($form->relateds->existing as $bookId) {
            $bookAssign = $this->books->get($bookId);
            $book->assignRelatedBook($bookAssign->id);
        }

        $this->transaction->wrap(function () use ($book, $form) {
            $this->books->save($book);
        });

        return $book;
    }

    /**
     * @param $id
     * @param BookForm $form
     * @throws \Exception
     */
    public function edit($id, BookForm $form): void
    {
        $book = $this->books->get($id);
        $book->edit(
            $form->name,
            $form->isbn,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
            $form->description,
            $form->active
        );

        $this->transaction->wrap(function () use ($book, $form) {
            $book->revokeAuthors();
            $book->revokeRelateds();
            $this->books->save($book);

            foreach ($form->authors->existing as $authorId) {
                $authorAssign = $this->authors->get($authorId);
                $book->assignAuthor($authorAssign->id);
            }

            foreach ($form->relateds->existing as $bookId) {
                $bookAssign = $this->books->get($bookId);
                $book->assignRelatedBook($bookAssign->id);
            }

            $this->books->save($book);
        });
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
