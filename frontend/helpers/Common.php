<?php

namespace frontend\helpers;

use Yii;

class Common
{
    public static function isHomePage()
    {
        $actualRoute = Yii::$app->controller->getRoute();

        list($controller, $actionId) = Yii::$app->createController('');
        $actionId = !empty($actionId) ? $actionId : $controller->defaultAction;
        $defaultRoute = $controller->getUniqueId() . '/' . $actionId;

        return $actualRoute === $defaultRoute;
    }

    public static function stripTags($data)
    {
        foreach ($data as $k => $v) {
            if (is_array($v)) {
                $data[$k] = self::stripTags($v);
            } else {
                $data[$k] = trim(htmlentities(strip_tags($v), ENT_QUOTES, 'UTF-8'));
            }
        }

        return $data;
    }
}
