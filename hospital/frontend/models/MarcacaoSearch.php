<?php

namespace frontend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use frontend\models\Marcacao;

/**
 * MarcacaoSearch represents the model behind the search form of `frontend\models\Marcacao`.
 */
class MarcacaoSearch extends Marcacao
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Aceitar', 'id_especialidade', 'id_Utente', 'id_Medico'], 'integer'],
            [['date', 'tempo'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Marcacao::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'tempo' => $this->tempo,
            'Aceitar' => $this->Aceitar,
            'id_especialidade' => $this->id_especialidade,
            'id_Utente' => $this->id_Utente,
            'id_Medico' => $this->id_Medico,
        ]);

        return $dataProvider;
    }
}
