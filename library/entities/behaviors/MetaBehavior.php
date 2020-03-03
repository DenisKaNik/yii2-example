<?php

namespace library\entities\behaviors;

use library\entities\Meta;
use yii\base\{
    Behavior,
    Event
};
use yii\db\ActiveRecord;
use yii\helpers\Json;

class MetaBehavior extends Behavior
{
    public $attribute = 'meta';
    public $jsonAttribute = 'meta_json';

    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'onAfterFind',
            ActiveRecord::EVENT_BEFORE_INSERT => 'onBeforeSave',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'onBeforeSave',
        ];
    }

    public function onAfterFind(Event $event)
    {
        $model = $event->sender;
        $meta = Json::decode($model->getAttribute($this->jsonAttribute));
        $model->{$this->attribute} = new Meta(
            $meta['title'] ?? null,
            $meta['description'] ?? null,
            $meta['keywords'] ?? null
        );
    }

    public function onBeforeSave(Event $event)
    {
        $model = $event->sender;
        $model->setAttribute('meta_json', Json::encode([
            'title' => $model->{$this->attribute}->title,
            'description' => $model->{$this->attribute}->description,
            'keywords' => $model->{$this->attribute}->keywords,
        ]));
    }
}
