<?php

use yii\db\Migration;

/**
 * Class m200425_191536_change_email_col_from_user
 */
class m200425_191536_change_email_col_from_user extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->alterColumn('{{%user}}', 'email', $this->string(255)->null());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->alterColumn('{{%user}}', 'email', $this->string(255)->notNull()->unique());
    }

}
