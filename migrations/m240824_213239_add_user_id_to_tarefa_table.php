<?php

use yii\db\Migration;

/**
 * Class m240824_213239_add_user_id_to_tarefa_table
 */
class m240824_213239_add_user_id_to_tarefa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%tarefa}}', 'user_id', $this->integer()->notNull());

        $this->addForeignKey(
            'fk-tarefa-user_id',
            '{{%tarefa}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk-tarefa-user_id', '{{%tarefa}}');
        $this->dropColumn('{{%tarefa}}', 'user_id');
    }
}
