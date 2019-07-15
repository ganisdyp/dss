<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "materialaudit".
 *
 * @property int $id
 * @property int $plant_id
 * @property string $volume
 * @property string $material_need
 * @property string $actual_use
 * @property string $difference_kg
 * @property string $difference_percent
 * @property string $date_calculated
 * @property string $display_date
 * @property int $is_holiday
 */
class Materialaudit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'materialaudit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plant_id', 'display_date'], 'required'],
            [['plant_id', 'is_holiday'], 'integer'],
            [['volume', 'material_need', 'actual_use', 'difference_kg', 'difference_percent'], 'number'],
            [['date_calculated', 'display_date'], 'safe'],
            [['plant_id', 'display_date'], 'unique', 'targetAttribute' => ['plant_id', 'display_date']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'plant_id' => 'Plant ID',
            'volume' => 'Volume',
            'material_need' => 'Material Need',
            'actual_use' => 'Actual Use',
            'difference_kg' => 'Difference Kg',
            'difference_percent' => 'Difference Percent',
            'date_calculated' => 'Date Calculated',
            'display_date' => 'Display Date',
            'is_holiday' => 'Is Holiday',
        ];
    }

    /**
     * {@inheritdoc}
     * @return MaterialauditQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MaterialauditQuery(get_called_class());
    }
}
