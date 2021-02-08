<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Profile;

/**
 * profileSearch represents the model behind the search form of `common\models\Profile`.
 */
class profileSearch extends Profile
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Phone_number', 'NIF'], 'integer'],
            [['First_name', 'Last_name', 'Email', 'Address', 'Birth_date', 'gender', 'postal_code'], 'safe'],
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
        $query = Profile::find();

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
            'Phone_number' => $this->Phone_number,
            'NIF' => $this->NIF,
            'Birth_date' => $this->Birth_date,
        ]);

        $query->andFilterWhere(['like', 'First_name', $this->First_name])
            ->andFilterWhere(['like', 'Last_name', $this->Last_name])
            ->andFilterWhere(['like', 'Email', $this->Email])
            ->andFilterWhere(['like', 'Address', $this->Address])
            ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'postal_code', $this->postal_code]);

        return $dataProvider;
    }
}
