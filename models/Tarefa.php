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
 * @property string $status
 * @property string|null $data_vencimento
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
            [['titulo', 'user_id'], 'required'],
            [['descricao'], 'string'],
            [['data_criacao', 'data_vencimento'], 'safe'],
            [['titulo', 'status'], 'string', 'max' => 255],
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
            'status' => 'Status',
            'data_vencimento' => 'Data Vencimento',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
