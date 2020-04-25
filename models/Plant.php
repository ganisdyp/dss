<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "plant".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property int $deleted
 * @property string $plant_prefix
 *
 * @property Profile[] $profiles
 * @property SaleRecord[] $saleRecords
 */
class Plant extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plant';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'plant_prefix'], 'required'],
            [['deleted'], 'integer'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['plant_prefix'], 'string', 'max' => 11],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Plant Name',
            'description' => 'Description',
            'deleted' => 'Deleted',
            'plant_prefix' => 'Plant Prefix',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProfiles()
    {
        return $this->hasMany(Profile::className(), ['plant_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSaleRecords()
    {
        return $this->hasMany(SaleRecord::className(), ['plant_id' => 'id']);
    }
}
