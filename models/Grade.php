<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "grade".
 *
 * @property int $id
 * @property string $name
 * @property string $charac_strength28
 * @property string $cement_type
 * @property string $specified_slump
 * @property string $coarse_agg_type
 * @property string $fine_agg_type
 * @property string $admixture
 * @property string $mix_design_for_cal
 * @property int $deleted
 *
 * @property SaleRecord[] $saleRecords
 */
class Grade extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'grade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'charac_strength28', 'cement_type', 'specified_slump', 'coarse_agg_type', 'fine_agg_type', 'admixture'], 'required'],
            [['mix_design_for_cal'], 'number'],
            [['deleted'], 'integer'],
            [['name', 'charac_strength28', 'cement_type', 'specified_slump', 'coarse_agg_type', 'fine_agg_type', 'admixture'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Grade',
            'charac_strength28' => 'Charac Strength28',
            'cement_type' => 'Cement Type',
            'specified_slump' => 'Specified Slump',
            'coarse_agg_type' => 'Coarse Agg Type',
            'fine_agg_type' => 'Fine Agg Type',
            'admixture' => 'Admixture',
            'mix_design_for_cal' => 'Mix Design For Cal',
            'deleted' => 'Deleted',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleRecords()
    {
        return $this->hasMany(SaleRecord::className(), ['grade_id' => 'id']);
    }
}
