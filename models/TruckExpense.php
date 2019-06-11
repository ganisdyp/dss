<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck_expense".
 *
 * @property int $id
 * @property string $date_reported
 * @property string $expenditure
 * @property string $reason
 * @property int $truck_id
 *
 * @property Truck $truck
 */
class TruckExpense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'truck_expense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['date_reported'], 'safe'],
            [['expenditure', 'reason', 'truck_id'], 'required'],
            [['expenditure'], 'number'],
            [['reason'], 'string'],
            [['truck_id'], 'integer'],
            [['truck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truck::className(), 'targetAttribute' => ['truck_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_reported' => 'Date Reported',
            'expenditure' => 'Expenditure',
            'reason' => 'Reason',
            'truck_id' => 'Truck ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTruck()
    {
        return $this->hasOne(Truck::className(), ['id' => 'truck_id']);
    }
}
