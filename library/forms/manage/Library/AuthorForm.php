<?php

namespace library\forms\manage\Library;

use library\entities\Library\Author;
use library\forms\CompositeForm;
use library\forms\manage\MetaForm;
use library\validators\SlugValidator;

class AuthorForm extends CompositeForm
{
    public $first_name;
    public $last_name;
    public $slug;
    public $active;

    private $_author;

    public function __construct(Author $author = null, $config = [])
    {
        if ($author) {
            $this->first_name = $author->first_name;
            $this->last_name = $author->last_name;
            $this->slug = $author->slug;
            $this->active = $author->active;
            $this->meta = new MetaForm($author->meta);
            $this->_author = $author;
        } else {
            $this->meta = new MetaForm();
        }

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['first_name', 'last_name'], 'required'],
            ['active', 'integer'],
            [['first_name', 'last_name', 'slug'], 'string', 'max' => 255],
            ['slug', SlugValidator::class],
            ['slug', 'unique', 'targetClass' => Author::class, 'filter' => $this->_author ? ['<>', 'id', $this->_author->id] : null],
        ];
    }

    public function internalForms(): array
    {
        return ['meta'];
    }
}
