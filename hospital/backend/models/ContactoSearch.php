<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Contacto;

/**
 * ContactoSearch represents the model behind the search form of `common\models\Contacto`.
 */
class ContactoSearch extends Contacto
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'id_Categoria', 'id_Utente', 'respondido'], 'integer'],
            [['nome', 'assunto', 'corpo', 'email', 'data_envio', 'data_respondido'], 'safe'],
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
        $query = Contacto::find();

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
            'id_Categoria' => $this->id_Categoria,
            'id_Utente' => $this->id_Utente,
            'data_envio' => $this->data_envio,
            'data_respondido' => $this->data_respondido,
            'respondido' => $this->respondido,
        ]);

        $query->andFilterWhere(['like', 'nome', $this->nome])
            ->andFilterWhere(['like', 'assunto', $this->assunto])
            ->andFilterWhere(['like', 'corpo', $this->corpo])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
