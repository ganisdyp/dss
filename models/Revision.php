<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "revision".
 *
 * @property int $id
 * @property string $batch_no
 * @property string $delivery_order_no
 * @property string $m3
 * @property string $summary_status
 * @property string $date_created
 * @property int $plant_id
 * @property int $customer_id
 * @property int $grade_id
 * @property string $special_condition
 * @property string $remark
 * @property int $deleted
 * @property int $truck_id
 * @property int $driver_id
 * @property string $display_date
 * @property int $project_id
 *
 * @property Customer $customer
 * @property Driver $driver
 * @property Grade $grade
 * @property Plant $plant
 * @property Project $project
 * @property Truck $truck
 */
class Revision extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'revision';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['batch_no', 'delivery_order_no', 'plant_id', 'customer_id', 'grade_id', 'truck_id', 'driver_id', 'display_date', 'project_id'], 'required'],
            [['batch_no', 'delivery_order_no', 'plant_id', 'customer_id', 'grade_id', 'deleted', 'truck_id', 'driver_id', 'project_id'], 'integer'],
            [['m3'], 'number'],
            [['summary_status', 'special_condition', 'remark'], 'string'],
            [['date_created', 'display_date'], 'safe'],
            [['customer_id'], 'exist', 'skipOnError' => true, 'targetClass' => Customer::className(), 'targetAttribute' => ['customer_id' => 'id']],
            [['driver_id'], 'exist', 'skipOnError' => true, 'targetClass' => Driver::className(), 'targetAttribute' => ['driver_id' => 'id']],
            [['grade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Grade::className(), 'targetAttribute' => ['grade_id' => 'id']],
            [['plant_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plant::className(), 'targetAttribute' => ['plant_id' => 'id']],
            [['project_id'], 'exist', 'skipOnError' => true, 'targetClass' => Project::className(), 'targetAttribute' => ['project_id' => 'id']],
            [['truck_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truck::className(), 'targetAttribute' => ['truck_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'batch_no' => 'Batch No',
            'delivery_order_no' => 'D/O No',
            'm3' => 'M3',
            'summary_status' => 'Status',
            'date_created' => 'Date Created',
            'plant_id' => 'Plant ID',
            'customer_id' => 'Customer ID',
            'grade_id' => 'Grade ID',
            'special_condition' => 'Special Condition',
            'remark' => 'Remark',
            'deleted' => 'Deleted',
            'truck_id' => 'Truck ID',
            'driver_id' => 'Driver ID',
            'display_date' => 'Display Date',
            'project_id' => 'Project ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCustomer()
    {
        return $this->hasOne(Customer::className(), ['id' => 'customer_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDriver()
    {
        return $this->hasOne(Driver::className(), ['id' => 'driver_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGrade()
    {
        return $this->hasOne(Grade::className(), ['id' => 'grade_id']);
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
    public function getProject()
    {
        return $this->hasOne(Project::className(), ['id' => 'project_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTruck()
    {
        return $this->hasOne(Truck::className(), ['id' => 'truck_id']);
    }

    /**
     * {@inheritdoc}
     * @return RevisionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new RevisionQuery(get_called_class());
    }
}
