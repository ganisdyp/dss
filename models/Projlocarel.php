<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "proj_loca_rel".
 *
 * @property int $rel_id
 * @property int $location_id
 * @property int $project_id
 * @property string $date_assigned
 * @property int $deleted
 */
class Projlocarel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public $project;

    public static function tableName()
    {
        return 'proj_loca_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['location_id', 'project_id'], 'required'],
            [['location_id', 'project_id', 'deleted'], 'integer'],
            [['date_assigned'], 'safe'],
            [['location_id', 'project_id'], 'unique', 'targetAttribute' => ['location_id', 'project_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rel_id' => 'Rel ID',
            'location_id' => 'Location ID',
            'project_id' => 'Project ID',
            'date_assigned' => 'Date Assigned',
            'deleted' => 'Deleted',
        ];
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLocation()
    {
        return $this->hasOne(Location::className(), ['id' => 'location_id']);
    }
}
