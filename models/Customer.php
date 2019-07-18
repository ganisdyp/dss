<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "customer".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $phone1
 * @property string $phone2
 * @property int $deleted
 * @property string $date_created
 *
 * @property SaleRecord[] $saleRecords
 */
class Customer extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'customer';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['deleted'], 'integer'],
            [['date_created'], 'safe'],
            [['name', 'phone1', 'phone2'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Customer',
            'address' => 'Address',
            'phone1' => 'Phone1',
            'phone2' => 'Phone2',
            'deleted' => 'Deleted',
            'date_created' => 'Date Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleRecords()
    {
        return $this->hasMany(SaleRecord::className(), ['customer_id' => 'id']);
    }
}
