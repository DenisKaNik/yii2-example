<?php

namespace library\entities\Library\Book;

use library\entities\behaviors\MetaBehavior;
use library\entities\Library\Book\queries\BookQuery;
use library\entities\Meta;
use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use yii\behaviors\SluggableBehavior;
use yii\db\{
    ActiveQuery,
    ActiveRecord
};

/**
 * Class Book
 * This is the model class for table "{{%lib_books}}".
 *
 * @property int $id
 * @property string $name
 * @property string $isbn
 * @property string $slug
 * @property string|null $description
 * @property string $meta_json
 * @property int $active
 *
 * @property Meta $meta
 * @property AuthorAssignment[] $authorAssignments
 * @property RelatedAssignment[] $relatedAssignments
 */
class Book extends ActiveRecord
{
    public $meta;

    public static function create($name, $isbn, $slug, Meta $meta, $description = '', $active = 0): self
    {
        $book = new static();
        $book->name = $name;
        $book->isbn = $isbn;
        $book->slug = $slug;
        $book->description = $description;
        $book->active = $active;
        $book->meta = $meta;
        return $book;
    }

    public function edit($name, $isbn, $slug, Meta $meta, $description = '', $active = 0): void
    {
        $this->name = $name;
        $this->isbn = $isbn;
        $this->slug = $slug;
        $this->description = $description;
        $this->active = $active;
        $this->meta = $meta;
    }

    // Authors
    public function assignAuthor($id): void
    {
        $assignments = $this->authorAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForAuthor($id)) {
                return;
            }
        }
        $assignments[] = AuthorAssignment::create($id);
        $this->authorAssignments = $assignments;
    }

    public function revokeAuthor($id): void
    {
        $assignments = $this->authorAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForAuthor($id)) {
                unset($assignments[$i]);
                $this->authorAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeAuthors(): void
    {
        $this->authorAssignments = [];
    }
    // End Authors

    // Related books
    public function assignRelatedBook($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForBook($id)) {
                return;
            }
        }
        $assignments[] = RelatedAssignment::create($id);
        $this->relatedAssignments = $assignments;
    }

    public function revokeRelatedBook($id): void
    {
        $assignments = $this->relatedAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForBook($id)) {
                unset($assignments[$i]);
                $this->relatedAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment is not found.');
    }

    public function revokeRelateds(): void
    {
        $this->relatedAssignments = [];
    }
    // End Related books

    public function getSeoTitle(): string
    {
        return $this->meta->title ?: $this->getHeadingTile();
    }

    public function getHeadingTile(): string
    {
        return $this->title ?: $this->name;
    }

    ##########################

    public function getRelatedAssignments(): ActiveQuery
    {
        return $this->hasMany(RelatedAssignment::class, ['book_id' => 'id']);
    }

    public function getRelatedAssignmentsActive(): ActiveQuery
    {
        return $this->hasMany(self::class, ['id' => 'related_id'])->active()->via('relatedAssignments');
    }

    public function getAuthorAssignments(): ActiveQuery
    {
        return $this->hasMany(AuthorAssignment::class, ['book_id' => 'id']);
    }

    ##########################

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lib_books}}';
    }

    public function behaviors()
    {
        return [
            MetaBehavior::class,
            [
                'class' => SluggableBehavior::class,
                'attribute' => ['name', 'isbn'],
                'immutable' => true,
                'ensureUnique' => true,
            ],
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['authorAssignments', 'relatedAssignments'],
            ],
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL,
        ];
    }

    public function afterSave($insert, $changedAttributes): void
    {
        foreach (['active', 'authors'] as $keyChangedAttribute) {
            if (array_key_exists($keyChangedAttribute, $changedAttributes)) {
                foreach ($this->getAuthorAssignments()->all() as $authorAssignment) {
                    $authorAssignment->updateCntBooks();
                }
            }
        }

        parent::afterSave($insert, $changedAttributes);
    }

    public static function find(): BookQuery
    {
        return new BookQuery(static::class);
    }
}
