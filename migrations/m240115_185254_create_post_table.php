<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%post}}`.
 */
class m240115_185254_create_post_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('post', [
            'id' => 'varchar(255) default (uuid_to_bin(uuid())) not null primary key',
            'title' => $this->string(),
            'body' => $this->text(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%post}}');
    }
}
