<?php

use \console\traits\MigrationTrait;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%lib_related_assignments}}`.
 */
class m200302_053117_create_lib_related_assignments_table extends Migration
{
    use MigrationTrait;
    
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%lib_related_assignments}}', [
            'book_id' => $this->integer()->notNull(),
            'related_id' => $this->integer()->notNull(),
        ], $this->getTableOptions());

        $this->addPrimaryKey('{{%pk-lib_related_assignments}}', '{{%lib_related_assignments}}', ['book_id', 'related_id']);

        $this->createIndex('{{%idx-lib_related_assignments-book_id}}', '{{%lib_related_assignments}}', 'book_id');
        $this->createIndex('{{%idx-lib_related_assignments-related_id}}', '{{%lib_related_assignments}}', 'related_id');

        $this->addForeignKey('{{%fk-lib_related_assignments-book_id}}', '{{%lib_related_assignments}}', 'book_id', '{{%lib_books}}', 'id', 'CASCADE', 'RESTRICT');
        $this->addForeignKey('{{%fk-lib_related_assignments-related_id}}', '{{%lib_related_assignments}}', 'related_id', '{{%lib_books}}', 'id', 'CASCADE', 'RESTRICT');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%lib_related_assignments}}');
    }
}
