<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Dieselexpense;

/**
 * DieselexpenseSearch represents the model behind the search form of `app\models\Dieselexpense`.
 */
class DieselexpenseSearch extends Dieselexpense
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'truck_id'], 'integer'],
            [['litre', 'cost'], 'number'],
            [['date_reported', 'remark', 'display_date'], 'safe'],
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
    public function search($params, $truck = null,$month = null)
    {
        if($truck==null) {
            $query = Dieselexpense::find()->select('sum(cost) as total_cost,truck_id')->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month])->orderBy(['display_date' => 'asc', 'id' => 'asc'])->groupBy('truck_id');
        }else {
            $query = Dieselexpense::find()->where(['DATE_FORMAT(display_date,"%Y-%m")' => $month, 'truck_id' => $truck])->orderBy(['display_date' => 'asc', 'id' => 'asc']);
        }
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
            'litre' => $this->litre,
            'cost' => $this->cost,
            'date_reported' => $this->date_reported,
            'truck_id' => $this->truck_id,
            'display_date' => $this->display_date,
        ]);

        $query->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
