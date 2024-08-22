<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tarefa".
 *
 * @property int $id
 * @property string $titulo
 * @property string|null $descricao
 * @property string|null $data_criacao
 */
class Tarefa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tarefa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo'], 'required'],
            [['descricao'], 'string'],
            [['data_criacao'], 'safe'],
            [['titulo'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'titulo' => 'Titulo',
            'descricao' => 'Descricao',
            'data_criacao' => 'Data Criacao',
        ];
    }
}
