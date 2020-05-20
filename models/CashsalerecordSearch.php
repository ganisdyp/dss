<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cashsalerecord;
use app\models\Profile;
/**
 * CashsalerecordSearch represents the model behind the search form of `app\models\Cashsalerecord`.
 */
class CashsalerecordSearch extends Cashsalerecord
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'batch_no', 'plant_id', 'customer_id', 'grade_id', 'deleted', 'truck_id', 'driver_id', 'project_id'], 'integer'],
            [['delivery_order_no', 'summary_status', 'date_created', 'special_condition', 'remark', 'display_date'], 'safe'],
            [['m3'], 'number'],
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
    public function search($params,$plant = null,$date = null, $summary_status = null)
    {
        $this->load($params);
        $profile = new Profile();


        if($plant != null){
            $plant_id = $plant;
        }else {
            $plant_id = $profile->findByUserId(Yii::$app->user->identity->getId())->plant_id;
        }

        if(Yii::$app->user->identity->getRole() == 1){ // If Plant Admin
            $plant_id = $profile->findByUserId(Yii::$app->user->identity->getId())->plant_id;
        }

        if($date != null){

        }else {
            $date = date('Y-m-d');
        }
        //  $query = Salerecord::find()->where(['display_date'=>date('Y-m-d'),'deleted'=>0])->orderBy(['plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','location_id'=>'asc','batch_no'=>'asc']);

        if($summary_status == null) {
            $query = Cashsalerecord::find()->where(['display_date' => $date, 'deleted' => 0, 'plant_id' => $plant_id])->orderBy(['delivery_order_no' => 'asc', 'plant_id' => 'asc', 'customer_id' => 'asc', 'grade_id' => 'asc', 'project_id' => 'asc']);
        }else{
            $query = Cashsalerecord::find()->where(['display_date'=>$date,'deleted'=>0,'plant_id'=>$plant_id,'summary_status'=>$summary_status])->orderBy(['batch_no'=>'asc','plant_id'=>'asc','customer_id'=>'asc','grade_id'=>'asc','project_id'=>'asc']);

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
            'batch_no' => $this->batch_no,
            'm3' => $this->m3,
            'date_created' => $this->date_created,
            'plant_id' => $this->plant_id,
            'customer_id' => $this->customer_id,
            'grade_id' => $this->grade_id,
            'deleted' => $this->deleted,
            'truck_id' => $this->truck_id,
            'driver_id' => $this->driver_id,
            'display_date' => $this->display_date,
            'project_id' => $this->project_id,
        ]);

        $query->andFilterWhere(['like', 'delivery_order_no', $this->delivery_order_no])
            ->andFilterWhere(['like', 'summary_status', $this->summary_status])
            ->andFilterWhere(['like', 'special_condition', $this->special_condition])
            ->andFilterWhere(['like', 'remark', $this->remark]);

        return $dataProvider;
    }
}
