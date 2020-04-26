<?php

use yii\db\Migration;

/**
 * Class m200425_175311_create_table_notebook
 */
class m200425_175311_create_table_notebook extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%notebook}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'name' => $this->string(255),
            'phone' => $this->string(50),
            'email' => $this->string(50)
        ], $tableOptions);

        $this->addForeignKey('fk_user', '{{%notebook}}', 'user_id', '{{%user}}', 'id', 'cascade', 'cascade');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_user', '{{%notebook}}');
        $this->dropTable('{{%notebook}}');
    }

}
