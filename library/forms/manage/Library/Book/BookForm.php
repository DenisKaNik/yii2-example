<?php

namespace library\forms\manage\Library\Book;

use library\entities\Library\Book\Book;
use library\forms\CompositeForm;
use library\forms\manage\MetaForm;
use library\validators\SlugValidator;

/**
 * Class BookForm
 * @package library\forms\manage\Library
 * @property AuthorsForm $authors
 * @property RelatedsForm $relateds
 */

class BookForm extends CompositeForm
{
    public $name;
    public $isbn;
    public $slug;
    public $description;
    public $active;

    private $_book;

    public function __construct(Book $book = null, $config = [])
    {
        if ($book) {
            $this->name = $book->name;
            $this->isbn = $book->isbn;
            $this->slug = $book->slug;
            $this->description = $book->description;
            $this->active = $book->active;
            $this->meta = new MetaForm($book->meta);
            $this->_book = $book;

            $this->authors = new AuthorsForm($book);
            $this->relateds = new RelatedsForm($book);
        } else {
            $this->meta = new MetaForm();
            $this->authors = new AuthorsForm();
            $this->relateds = new RelatedsForm();
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'isbn'], 'required'],
            ['active', 'integer'],
            [['name', 'slug'], 'string', 'max' => 255],
            ['description', 'string'],
            ['isbn', 'string', 'max' => 17, 'min' => 17],
            ['slug', SlugValidator::class],
            [['name', 'isbn', 'slug'], 'unique', 'targetClass' => Book::class, 'filter' => $this->_book ? ['<>', 'id', $this->_book->id] : null],
        ];
    }

    public function internalForms(): array
    {
        return ['authors', 'relateds', 'meta'];
    }
}
