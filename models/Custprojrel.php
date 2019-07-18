<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cust_proj_rel".
 *
 * @property int $rel_id
 * @property string $date_assigned
 * @property int $deleted
 * @property int $project_id
 * @property int $customer_id
 */
class Custprojrel extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cust_proj_rel';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_id', 'customer_id'], 'required'],
            [['date_assigned'], 'safe'],
            [['deleted', 'project_id', 'customer_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'rel_id' => 'Rel ID',
            'date_assigned' => 'Date Assigned',
            'deleted' => 'Deleted',
            'project_id' => 'Project ID',
            'customer_id' => 'Customer ID',
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
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }
}
