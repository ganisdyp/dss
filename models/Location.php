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
            [['id', 'name'], 'required'],
            [['id', 'deleted'], 'integer'],
            [['description'], 'string'],
            [['rate_number'], 'number'],
            [['name'], 'string', 'max' => 255],
            [['rate_prefix'], 'string', 'max' => 10],
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
            'name' => 'Name',
            'description' => 'Description',
            'rate_prefix' => 'Rate Prefix',
            'rate_number' => 'Rate Number',
            'deleted' => 'Deleted',
        ];
    }
}
