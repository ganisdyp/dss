<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Grade;

/**
 * GradeSearch represents the model behind the search form of `app\models\Grade`.
 */
class GradeSearch extends Grade
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'deleted'], 'integer'],
            [['name', 'charac_strength28', 'cement_type', 'specified_slump', 'coarse_agg_type', 'fine_agg_type', 'admixture'], 'safe'],
            [['mix_design_for_cal'], 'number'],
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
        $query = Grade::find()->where(['deleted'=>0])->orderBy(['name'=>'asc']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 15,
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
            'mix_design_for_cal' => $this->mix_design_for_cal,
            'deleted' => $this->deleted,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'charac_strength28', $this->charac_strength28])
            ->andFilterWhere(['like', 'cement_type', $this->cement_type])
            ->andFilterWhere(['like', 'specified_slump', $this->specified_slump])
            ->andFilterWhere(['like', 'coarse_agg_type', $this->coarse_agg_type])
            ->andFilterWhere(['like', 'fine_agg_type', $this->fine_agg_type])
            ->andFilterWhere(['like', 'admixture', $this->admixture]);

        return $dataProvider;
    }
}
