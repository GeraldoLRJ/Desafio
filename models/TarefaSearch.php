<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tarefa;

/**
 * TarefaSearch represents the model behind the search form of `app\models\Tarefa`.
 */
class TarefaSearch extends Tarefa
{
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['titulo', 'descricao', 'data_criacao', 'status', 'data_vencimento'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
        $query = Tarefa::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'data_criacao' => $this->data_criacao,
            'data_vencimento' => $this->data_vencimento,
        ]);

        $query->andFilterWhere(['like', 'titulo', $this->titulo])
            ->andFilterWhere(['like', 'descricao', $this->descricao])
            ->andFilterWhere(['like', 'status', $this->status]);

        return $dataProvider;
    }
}
