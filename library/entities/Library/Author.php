<?php

namespace library\entities\Library;

use library\entities\behaviors\MetaBehavior;
use library\entities\Library\queries\AuthorQuery;
use library\entities\Meta;
use library\readModels\Library\AuthorReadRepository;
use yii\behaviors\SluggableBehavior;
use yii\db\ActiveRecord;

/**
 * Class Author
 * This is the model class for table "{{%lib_authors}}".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $slug
 * @property int $cnt_books
 * @property int $active
 * @property Meta $meta
 *
 * @package library\entities\Library
 */
class Author extends ActiveRecord
{
    public $meta;

    public static function create($first_name, $last_name, $slug, Meta $meta, $active = 0): self
    {
        $author = new static();
        $author->first_name = $first_name;
        $author->last_name = $last_name;
        $author->slug = $slug;
        $author->active = $active;
        $author->meta = $meta;
        return $author;
    }

    public function edit($first_name, $last_name, $slug, Meta $meta, $active = 0): void
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->slug = $slug;
        $this->active = $active;
        $this->meta = $meta;
    }

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->first_name . ' ' . $this->last_name;
    }

    public static function tableName(): string
    {
        return '{{%lib_authors}}';
    }

    public function behaviors()
    {
        return [
            MetaBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => ['first_name', 'last_name'],
                'immutable' => true,
                'ensureUnique' => true,
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public static function find(): AuthorQuery
    {
        return new AuthorQuery(static::class);
    }

    public function updateCntBook(): void
    {
        $this->cnt_books = self::setCntBooks();
        $this->save();
    }

    public function setCntBooks(): int
    {
        return (new AuthorReadRepository())->getBooksCnt($this);
    }

    public function afterSave($insert, $changedAttributes): void
    {
        $this->updateAttributes([
            'cnt_books' => self::setCntBooks(),
        ]);
    }
}
