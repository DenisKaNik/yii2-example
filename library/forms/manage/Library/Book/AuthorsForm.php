<?php

namespace library\forms\manage\Library\Book;

use library\entities\Library\Book\Book;
use library\helpers\AuthorHelper;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class AuthorsForm extends Model
{
    public $existing = [];

    public function __construct(Book $book = null, $config = [])
    {
        if ($book) {
            $this->existing = ArrayHelper::getColumn($book->authorAssignments, 'author_id');
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['existing', 'default', 'value' => []],
        ];
    }

    public function authorsList(): array
    {
        return AuthorHelper::simpleListByAdmin();
    }
}
