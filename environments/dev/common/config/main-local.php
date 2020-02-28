<?php

if (!function_exists('env')) {
    require(__DIR__ . '/../../vendor/autoload.php');
    require(__DIR__ . '/../helpers/EnvHelper.php');

    $dotenv = Dotenv\Dotenv::createImmutable(dirname(dirname(__DIR__)));
    $dotenv->load();

    // unset env by $_SERVER
    array_map(function($key) {
        unset($_SERVER[$key]);
    }, array_keys($_ENV));
}

require_once(__DIR__.'/functions-local.php');

return [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host='.env('DB_HOST', 'localhost').';port='.env('DB_PORT', '3306').';dbname='.env('DB_NAME'),
            'username' => env('DB_USR'),
            'password' => env('DB_PWD'),
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];
