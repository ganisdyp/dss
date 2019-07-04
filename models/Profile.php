<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "profile".
 *
 * @property int $id
 * @property string $Name First Name
 * @property string $date_created
 * @property string $Status
 * @property int $user_id
 * @property string $Username
 * @property string $Password
 * @property int $Inactive
 * @property string $last_accessed
 * @property int $plant_id
 *
 * @property Plant $plant
 * @property User $user
 */
class Profile extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'profile';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'Name', 'user_id', 'Username', 'Password', 'plant_id'], 'required'],
            [['id', 'user_id', 'Inactive', 'plant_id'], 'integer'],
            [['date_created', 'last_accessed'], 'safe'],
            [['Status'], 'string'],
            [['Name'], 'string', 'max' => 100],
            [['Username', 'Password'], 'string', 'max' => 20],
            [['Username'], 'unique'],
            [['id', 'user_id', 'plant_id'], 'unique', 'targetAttribute' => ['id', 'user_id', 'plant_id']],
            [['plant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['plant_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'Name' => 'Name',
            'date_created' => 'Date Created',
            'Status' => 'Status',
            'user_id' => 'User ID',
            'Username' => 'Username',
            'Password' => 'Password',
            'Inactive' => 'Inactive',
            'last_accessed' => 'Last Accessed',
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
