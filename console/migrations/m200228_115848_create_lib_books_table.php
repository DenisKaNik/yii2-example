<?php

use console\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%lib_books}}`.
 */
class m200228_115848_create_lib_books_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lib_books}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'isbn' => $this->char(17)->notNull(),
            'slug' => $this->string()->notNull(),
            'description' => $this->text(),
            'meta_json' => 'JSON NOT NULL',
            'active' => $this->smallInteger(1)->unsigned()->notNull()->defaultValue(0),
        ]);

        $this->createIndex('{{%idx-lib_books-slug}}', '{{%lib_books}}', 'slug', true);
        $this->createIndex('{{%idx-lib_books-isbn}}', '{{%lib_books}}', 'isbn', true);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lib_books}}');
    }
}
