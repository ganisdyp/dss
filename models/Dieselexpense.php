<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "dieselexpense".
 *
 * @property int $id
 * @property string $litre LITRES
 * @property string $cost RM
 * @property string $date_reported
 * @property string $remark REMARKS
 * @property int $deleted
 * @property int $truck_id TRUCK NO.
 * @property string $display_date DATE
 */
class Dieselexpense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dieselexpense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['litre', 'cost'], 'number'],
            [['date_reported', 'display_date'], 'safe'],
            [['remark'], 'string'],
            [['truck_id'], 'integer'],
            [['truck_id', 'display_date'], 'required'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'litre' => 'LITRES',
            'cost' => 'RM',
            'date_reported' => 'Date Reported',
            'remark' => 'REMARKS',
            'truck_id' => 'TRUCK NO.',
            'display_date' => 'DATE',
        ];
    }

    /**
     * {@inheritdoc}
     * @return DieselexpenseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new DieselexpenseQuery(get_called_class());
    }
}
