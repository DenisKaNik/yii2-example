<?php

namespace api\tests\api;

use api\tests\ApiTester;
use common\fixtures\UserFixture;

class BooksListCest
{
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

        $I->sendGET('/v1/books', [
            'accessToken' => $access_token,
        ]);

        $I->seeResponseCodeIs(200);
        $I->seeResponseIsJson();
    }
}
