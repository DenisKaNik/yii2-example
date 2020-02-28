<?php

use console\traits\MigrationTrait;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    use MigrationTrait;

    public function up()
    {
        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $this->getTableOptions());

        $this->batchInsert('{{%user}}',
            [
                'id',
                'username',
                'auth_key',
                'password_hash',
                'email',
                'created_at',
                'updated_at',
            ],
            [
                [
                    1,
                    'admin',
                    'g4ShovKAfIQzy_E9GoDZI2WvVwNAmNyn',
                    Yii::$app->security->generatePasswordHash('hBcv1hCezw'),
                    'admin@server.com',
                    $time = time(),
                    $time,
                ],
                [
                    2,
                    'operator',
                    'g4ShovKAfIQzy_E9GoDZI2WvVwNAmNyn',
                    Yii::$app->security->generatePasswordHash('x8hH3YLFBh'),
                    'operator@server.com',
                    $time,
                    $time,
                ],
            ]
        );
    }

    public function down()
    {
        $this->dropTable('{{%user}}');
    }
}
