<?php

use yii\db\Migration;

/**
 * Class m190222_192026_usuarios_email_unico.
 */
class m190222_192026_usuarios_email_unico extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->execute('ALTER TABLE usuarios ADD UNIQUE (email)');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->execute('alter table usuarios drop constraint usuarios_email_key');
    }
}
