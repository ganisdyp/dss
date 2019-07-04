<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "driver".
 *
 * @property int $id
 * @property string $name Driver
 * @property string $remark Remark
 * @property string $employee_id
 *
 * @property SaleRecord[] $saleRecords
 */
class Driver extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'driver';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'name'], 'required'],
            [['id'], 'integer'],
            [['remark'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['employee_id'], 'string', 'max' => 45],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Driver',
            'remark' => 'Remark',
            'employee_id' => 'Employee ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleRecords()
    {
        return $this->hasMany(SaleRecord::className(), ['driver_id' => 'id']);
    }
}
