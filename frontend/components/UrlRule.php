<?php

namespace frontend\components;

use Yii;
use yii\web\UrlRuleInterface;

class UrlRule implements UrlRuleInterface
{
    public function createUrl ($manager, $route, $params)
    {
        return false;
    }

    public function parseRequest ($manager, $request)
    {
        if(substr($request->pathInfo, -1) == '/') {
            return false;
        }
        
        $url = trim($request->pathInfo, '/');
        $path = explode('/', $url);

        // check url api
        if (isset($path[0]) && $path[0] === 'api') {
            Yii::$app->controllerNamespace = 'api\controllers';
        }

        return false;
    }
}
