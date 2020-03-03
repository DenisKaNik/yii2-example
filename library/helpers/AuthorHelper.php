<?php

namespace library\helpers;

use library\entities\Library\Author;
use yii\helpers\{
    ArrayHelper,
    Html
};

class AuthorHelper
{
    public static function arrayList($ids = null)
    {
        $query = Author::find();

        if ($ids) {
            $query->where([
                'id' => $ids,
            ]);
        }

        return $query->orderBy('first_name')
            ->asArray()
            ->all();
    }

    public static function simpleListByAdmin()
    {
        return ArrayHelper::map(
            self::arrayList(),
            'id',
            function (array $author) {
                return ($author['first_name'] . ' ' . $author['last_name']) . ($author['active'] ? '' : ' (draft)');
            }
        );
    }

    public static function htmlListByAdmin($ids = null)
    {
        return ArrayHelper::map(
            self::arrayList($ids),
            'id',
            function (array $author) {
                return Html::a(
                    trim($author['first_name'] . ' ' . $author['last_name']),
                    ['/library/author/view', 'id' => $author['id']],
                    ['target' => '_blank']
                );
            }
        );
    }
}
