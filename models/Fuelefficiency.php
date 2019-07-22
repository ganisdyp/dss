<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuelefficiency".
 *
 * @property int $id
 * @property string $display_month
 * @property string $date_reported
 * @property string $litre_per_m3
 * @property string $rm_per_m3
 * @property string $summary_status
 * @property int $truck_id
 */
class Fuelefficiency extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuelefficiency';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['display_month', 'truck_id'], 'required'],
            [['display_month', 'date_reported'], 'safe'],
            [['litre_per_m3', 'rm_per_m3'], 'number'],
            [['truck_id'], 'integer'],
            [['display_month', 'truck_id'], 'unique', 'targetAttribute' => ['display_month', 'truck_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'display_month' => 'Display Month',
            'date_reported' => 'Date Reported',
            'litre_per_m3' => 'Litre Per M3',
            'rm_per_m3' => 'Rm Per M3',
            'truck_id' => 'Truck ID',
        ];
    }

    /**
     * {@inheritdoc}
     * @return FuelefficiencyQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuelefficiencyQuery(get_called_class());
    }
}
