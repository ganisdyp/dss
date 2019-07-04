<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Custprojrel;

/**
 * CustprojrelSearch represents the model behind the search form of `app\models\Custprojrel`.
 */
class CustprojrelSearch extends Custprojrel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rel_id', 'deleted', 'project_id', 'customer_id'], 'integer'],
            [['date_assigned'], 'safe'],
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
        $query = Custprojrel::find();

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
            'rel_id' => $this->rel_id,
            'date_assigned' => $this->date_assigned,
            'deleted' => $this->deleted,
            'project_id' => $this->project_id,
            'customer_id' => $this->customer_id,
        ]);

        return $dataProvider;
    }
}
