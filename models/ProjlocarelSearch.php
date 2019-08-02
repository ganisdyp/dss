<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Projlocarel;

/**
 * ProjlocarelSearch represents the model behind the search form of `app\models\Projlocarel`.
 */
class ProjlocarelSearch extends Projlocarel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['rel_id', 'location_id', 'project_id', 'deleted'], 'integer'],
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
        $query = Projlocarel::find();

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
            'location_id' => $this->location_id,
            'project_id' => $this->project_id,
            'date_assigned' => $this->date_assigned,
            'deleted' => $this->deleted,
        ]);

        return $dataProvider;
    }
}
