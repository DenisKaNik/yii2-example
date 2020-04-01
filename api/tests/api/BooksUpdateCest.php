<?php

namespace api\tests\api;

use api\tests\ApiTester;
use common\fixtures\UserFixture;
use Yii;

class BooksUpdateCest
{
    private static $bookId = 5;

    public function _fixtures(): array
    {
        return [
            'user' => [
                'class' => UserFixture::class,
                'dataFile' => codecept_data_dir() . 'user.php'
            ]
        ];
    }

    public function success(ApiTester $I): void
    {
        $I->sendPOST('/oauth2/token', [
            'grant_type' => 'password',
            'username' => 'erau',
            'password' => 'password_0',
            'client_id' => 'testclient',
            'client_secret' => 'testpass'
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseJsonMatchesJsonPath('$.access_token');

        $access_token = json_decode($I->grabResponse())->access_token;

        $I->sendPUT('/v1/books/'.self::$bookId.'?accessToken='.$access_token, json_encode([
            'name' => $name = 'test-name',
            'isbn' => $isbn = '978-5-4370-0087-0',
            'slug' => $slug = 'test-slug',
            'description' => $description = 'test-description',
        ]));

        $I->seeResponseCodeIs(204);

        $I->sendGET('/v1/books/'.self::$bookId, [
            'accessToken' => $access_token,
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson([
            'id' => self::$bookId,
            'name' => $name,
            'isbn' => $isbn,
            'description' => $description,
            '_links' => [
                'public' => ['href' => Yii::$app->get('frontendUrlManager')->createAbsoluteUrl(["/book/{$slug}"])],
            ],
        ]);
    }
}
