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
        $this->getDb()->createCommand('CREATE EXTENSION IF NOT EXISTS "uuid-ossp";')->execute();
        $this->createTable('post', [
            'id' => 'uuid PRIMARY KEY DEFAULT uuid_generate_v4()',
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
