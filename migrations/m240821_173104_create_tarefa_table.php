<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%tarefa}}`.
 */
class m240821_173104_create_tarefa_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%tarefa}}', [
            'id' => $this->primaryKey(),
            'titulo' => $this->string()->notNull(),
            'descricao' => $this->text(),
            'data_criacao' => $this->timestamp()->defaultExpression('CURRENT_TIMESTAMP')
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%tarefa}}');
    }
}
