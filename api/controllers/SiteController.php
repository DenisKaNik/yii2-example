<?php

namespace api\controllers;

use yii\rest\Controller;

/**
 * Class SiteController
 * @package api\controllers
 *
 * @OA\OpenApi(
 *     @OA\Info(
 *         version="1.0.0",
 *         title="Library API",
 *         description="HTTP JSON API"
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     type="oauth2",
 *     securityScheme="OAuth2",
 *     @OA\Flow(
 *         flow="password",
 *         tokenUrl="http://api.shop.dev/oauth2/token",
 *         scopes={}
 *     )
 * )
 *
 * @OA\SecurityScheme(
 *     type="http",
 *     securityScheme="bearerAuth",
 *     name="Bearer",
 *     bearerFormat="JWT"
 * )
 *
 * @OA\Server(
 *     url="{schema}://api.yii2-example.loc",
 *     description="OpenApi common parameters",
 *     @OA\ServerVariable(
 *         serverVariable="schema",
 *         enum={"http"},
 *         default="http"
 *     )
 * )
 *
 * @OA\Server(
 *     url="{schema}://api.yii2-example.loc/{version}",
 *     description="OpenApi by version",
 *     @OA\ServerVariable(
 *         serverVariable="schema",
 *         enum={"http"},
 *         default="http"
 *     ),
 *     @OA\ServerVariable(
 *         serverVariable="version",
 *         enum={"v1"},
 *         default="v1"
 *     )
 * )
 */

class SiteController extends Controller
{
    /**
     * @OA\Get(
     *     path="/",
     *     tags={"Info"},
     *     @OA\Response(
     *         response=200,
     *         description="API version",
     *         @OA\Schema(
     *             type="object",
     *             @OA\Property(
     *                 property="version",
     *                 type="string"
     *             )
     *         )
     *     )
     * )
     *
     * @return array
     */
    public function actionIndex(): array
    {
        return [
            'version' => '1.0.0',
        ];
    }
}
