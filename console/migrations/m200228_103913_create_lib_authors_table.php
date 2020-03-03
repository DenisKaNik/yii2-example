<?php

use console\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%lib_authors}}`.
 */
class m200228_103913_create_lib_authors_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lib_authors}}', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string()->notNull(),
            'last_name' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
            'cnt_books' => $this->integer()->unsigned()->notNull()->defaultValue(0),
            'meta_json' => 'JSON NOT NULL',
            'active' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0),
        ], $this->getTableOptions());

        $this->createIndex('{{%idx-lib_authors-slug}}', '{{%lib_authors}}', 'slug', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lib_authors}}');
    }
}
