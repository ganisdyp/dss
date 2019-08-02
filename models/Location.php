<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "location".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $rate_prefix
 * @property string $rate_number
 * @property int $deleted
 * @property int $plant_id
 */
class Location extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'location';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'plant_id'], 'required'],
            [['deleted', 'plant_id'], 'integer'],
            [['description'], 'string'],
            [['rate_number'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['rate_prefix'], 'string', 'max' => 10],
            [['id', 'plant_id'], 'unique', 'targetAttribute' => ['id', 'plant_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'rate_prefix' => 'Rate Prefix',
            'rate_number' => 'Rate Number',
            'deleted' => 'Deleted',
            'plant_id' => 'Plant ID',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlant()
    {
        return $this->hasOne(Plant::className(), ['id' => 'plant_id']);
    }
}
