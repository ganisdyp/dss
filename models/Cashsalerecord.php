<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cashsalerecord".
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
 */
class Cashsalerecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cashsalerecord';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['batch_no', 'delivery_order_no', 'plant_id', 'customer_id', 'grade_id', 'truck_id', 'driver_id', 'display_date', 'project_id'], 'required'],
            [['batch_no', 'plant_id', 'customer_id', 'grade_id', 'deleted', 'truck_id', 'driver_id', 'project_id'], 'integer'],
            [['m3'], 'number'],
            [['delivery_order_no','summary_status', 'special_condition', 'remark'], 'string'],
            [['date_created', 'display_date'], 'safe'],
            [['delivery_order_no'], 'string', 'max' => 100],
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
            'delivery_order_no' => 'Delivery Order No',
            'm3' => 'M3',
            'summary_status' => 'Summary Status',
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
     * {@inheritdoc}
     * @return CashsalerecordQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CashsalerecordQuery(get_called_class());
    }
}
