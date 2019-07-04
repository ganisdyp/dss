<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truck".
 *
 * @property int $id
 * @property string $truck_no
 * @property string $remark
 *
 * @property SaleRecord[] $saleRecords
 * @property TruckExpense[] $truckExpenses
 */
class Truck extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'truck';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['truck_no'], 'required'],
            [['remark'], 'string'],
            [['truck_no'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'truck_no' => 'Truck',
            'remark' => 'Remark',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleRecords()
    {
        return $this->hasMany(SaleRecord::className(), ['truck_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTruckExpenses()
    {
        return $this->hasMany(TruckExpense::className(), ['truck_id' => 'id']);
    }
}
