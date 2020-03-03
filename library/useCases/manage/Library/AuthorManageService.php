<?php

namespace library\useCases\manage\Library;

use library\entities\Meta;
use library\entities\Library\Author;
use library\forms\manage\Library\AuthorForm;
use library\repositories\Library\{
    AuthorRepository,
    BookRepository
};

class AuthorManageService
{
    private $authors;
    private $books;

    public function __construct(AuthorRepository $authors, BookRepository $books)
    {
        $this->authors = $authors;
        $this->books = $books;
    }

    public function create(AuthorForm $form): Author
    {
        $author = Author::create(
            $form->first_name,
            $form->last_name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
            $form->active
        );
        $this->authors->save($author);
        return $author;
    }

    public function edit($id, AuthorForm $form): void
    {
        $author = $this->authors->get($id);
        $author->edit(
            $form->first_name,
            $form->last_name,
            $form->slug,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
            $form->active
        );
        $this->authors->save($author);
    }

    /**
     * @param $id
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $author = $this->authors->get($id);
        if ($this->books->existsByAuthor($author->id)) {
            throw new \DomainException('Unable to remove author with books.');
        }
        $this->authors->remove($author);
    }
}
