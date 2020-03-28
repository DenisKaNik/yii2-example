<?php

namespace api\controllers;

use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\controllers
 */

class SiteController extends Controller
{
    /**
     * @return array
     */
    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
