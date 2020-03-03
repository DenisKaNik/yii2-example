<?php

use \console\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%lib_author_assignments}}`.
 */
class m200302_064426_create_lib_author_assignments_table extends Migration
{
    use MigrationTrait;

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lib_author_assignments}}', [
            'book_id' => $this->integer()->notNull(),
            'author_id' => $this->integer()->notNull(),
        ], $this->getTableOptions());

        $this->addPrimaryKey('{{%pk-lib_author_assignments}}', '{{%lib_author_assignments}}', ['book_id', 'author_id']);

        $this->createIndex('{{%idx-lib_author_assignments-book_id}}', '{{%lib_author_assignments}}', 'book_id');
        $this->createIndex('{{%idx-lib_author_assignments-author_id}}', '{{%lib_author_assignments}}', 'author_id');

        $this->addForeignKey('{{%fk-lib_author_assignments-book_id}}', '{{%lib_author_assignments}}', 'book_id', '{{%lib_books}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-lib_author_assignments-author_id}}', '{{%lib_author_assignments}}', 'author_id', '{{%lib_authors}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lib_author_assignments}}');
    }
}
