<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Salerecord;

/**
 * SalerecordSearch represents the model behind the search form of `app\models\Salerecord`.
 */
class SalerecordSearch extends Salerecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'batch_no', 'delivery_order_no', 'plant_id', 'customer_id', 'grade_id', 'deleted', 'truck_id', 'driver_id'], 'integer'],
            [['m3'], 'number'],
            [['summary_status', 'date_created', 'special_condition', 'remark','display_date'], 'safe'],
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
      //  $query = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])->orderBy(['plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','location_id'=>'asc','batch_no'=>'asc']);
        $query = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])->orderBy(['batch_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 100,
            ],
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
            'batch_no' => $this->batch_no,
            'delivery_order_no' => $this->delivery_order_no,
            'm3' => $this->m3,
            'date_created' => $this->date_created,
            'plant_id' => $this->plant_id,
            'customer_id' => $this->customer_id,
            'grade_id' => $this->grade_id,
            'deleted' => $this->deleted,
            'truck_id' => $this->truck_id,
          //  'location_id' => $this->location_id,
            'driver_id' => $this->driver_id,
            'display_date' => $this->display_date,
        ]);

        $query->andFilterWhere(['like', 'summary_status', $this->summary_status])
            ->andFilterWhere(['like', 'special_condition', $this->special_condition])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
