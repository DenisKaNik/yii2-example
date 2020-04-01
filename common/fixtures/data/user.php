<?php

return [
    [
        'id' => 1,
        'username' => 'admin',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('password_0'),
        'password_reset_token' => null,
        'email' => 'admin@server.com',
        'status' => 10,
        'created_at' => $time = time(),
        'updated_at' => $time,
        'verification_token' => null,
    ],
    [
        'id' => 2,
        'username' => 'operator',
        'auth_key' => Yii::$app->security->generateRandomString(),
        'password_hash' => Yii::$app->security->generatePasswordHash('password_1'),
        'password_reset_token' => null,
        'email' => 'operator@server.com',
        'status' => 10,
        'created_at' => $time,
        'updated_at' => $time,
        'verification_token' => null,
    ],
];
