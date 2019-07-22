<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Fuelefficiency;

/**
 * FuelefficiencySearch represents the model behind the search form of `app\models\Fuelefficiency`.
 */
class FuelefficiencySearch extends Fuelefficiency
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'truck_id'], 'integer'],
            [['display_month', 'date_reported'], 'safe'],
            [['litre_per_m3', 'rm_per_m3'], 'number'],
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
        $query = Fuelefficiency::find();

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
            'display_month' => $this->display_month,
            'date_reported' => $this->date_reported,
            'litre_per_m3' => $this->litre_per_m3,
            'rm_per_m3' => $this->rm_per_m3,
            'truck_id' => $this->truck_id,
        ]);

        return $dataProvider;
    }
}
