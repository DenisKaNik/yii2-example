<?php

namespace library\forms\manage\Library\Book;

use library\entities\Library\Book\Book;
use yii\base\Model;
use yii\helpers\ArrayHelper;

class RelatedsForm extends Model
{
    public $existing = [];
    protected $book;

    public function __construct(Book $book = null, $config = [])
    {
        if ($book) {
            $this->existing = ArrayHelper::getColumn($book->relatedAssignments, 'related_id');
            $this->book = $book;
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

    public function relatedsList(): array
    {
        return ArrayHelper::map(
            Book::find()
                ->where(['!=', 'id', $this->book ? $this->book->id : 0 ])
                ->orderBy('name')
                ->asArray()
                ->all(),
            'id',
            function (array $relateds) {
                return $relateds['name'] . ($relateds['active'] ? '' : ' (draft)');
            }
        );
    }
}
