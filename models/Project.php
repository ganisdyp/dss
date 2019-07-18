<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "project".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $date_created
 * @property int $deleted
 * @property int $location_id
 *
 * @property Salerecord[] $salerecords
 */
class Project extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'location_id'], 'required'],
            [['date_created'], 'safe'],
            [['deleted', 'location_id'], 'integer'],
            [['name', 'description'], 'string', 'max' => 255],
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
            'date_created' => 'Date Created',
            'deleted' => 'Deleted',
            'location_id' => 'Location ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSalerecords()
    {
        return $this->hasMany(Salerecord::className(), ['project_id' => 'id']);
    }
}
