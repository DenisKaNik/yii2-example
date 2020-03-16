<?php

namespace library\readModels\Library;

use library\entities\Library\Book\Book;
use yii\data\{
    ActiveDataProvider,
    DataProviderInterface
};
use yii\db\ActiveQuery;

class BookReadRepository
{
    public function getAll(): DataProviderInterface
    {
        $query = Book::find()->active();
        return $this->getProvider($query);
    }

    public function find($id): ?Book
    {
        return Book::find()->active()->andWhere(['id' => $id])->one();
    }

    public function findBySlug($slug): ?Book
    {
        return Book::find()->active()->andWhere(['slug' => $slug])->one();
    }

    private function getProvider(ActiveQuery $query): ActiveDataProvider
    {
        return new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
                'attributes' => [
                    'id' => [
                        'asc' => ['id' => SORT_ASC],
                        'desc' => ['id' => SORT_DESC],
                    ],
                    'name' => [
                        'asc' => ['name' => SORT_ASC],
                        'desc' => ['name' => SORT_DESC],
                    ],
                ],
            ],
        ]);
    }
}
