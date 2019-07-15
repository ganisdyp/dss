<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cementintake".
 *
 * @property int $id
 * @property string $display_date
 * @property string $date_created
 * @property string $silo1
 * @property string $silo2
 * @property string $silo3
 * @property string $summary_status
 * @property int $plant_id
 * @property int $is_holiday
 */
class Cementintake extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cementintake';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['display_date', 'plant_id'], 'required'],
            [['display_date', 'date_created'], 'safe'],
            [['silo1', 'silo2', 'silo3'], 'number'],
            [['summary_status'], 'string'],
            [['plant_id', 'is_holiday'], 'integer'],
            [['display_date', 'plant_id'], 'unique', 'targetAttribute' => ['display_date', 'plant_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'display_date' => 'Display Date',
            'date_created' => 'Date Created',
            'silo1' => 'Silo1',
            'silo2' => 'Silo2',
            'silo3' => 'Silo3',
            'summary_status' => 'Summary Status',
            'plant_id' => 'Plant ID',
            'is_holiday' => 'Is Holiday',
        ];
    }

    /**
     * {@inheritdoc}
     * @return CementintakeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CementintakeQuery(get_called_class());
    }
}
