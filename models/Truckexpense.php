<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "truckexpense".
 *
 * @property int $id
 * @property string $date_reported
 * @property string $display_date DATE
 * @property string $spare_part_service SPARE PART & SERVICE
 * @property string $cost RM
 * @property string $series_no SERIES NO.
 * @property string $reason REASON / DETAIL
 * @property string $warranty WARRANTY
 * @property string $remark REMARKS
 * @property int $truck_id TRUCK NO.
 */
class Truckexpense extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'truckexpense';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['display_date', 'cost', 'reason', 'truck_id'], 'required'],
            [['id', 'truck_id'], 'integer'],
            [['date_reported', 'display_date'], 'safe'],
            [['spare_part_service', 'series_no', 'reason', 'warranty', 'remark'], 'string'],
            [['cost'], 'number'],
            [['id', 'truck_id'], 'unique', 'targetAttribute' => ['id', 'truck_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'date_reported' => 'Date Reported',
            'display_date' => 'DATE',
            'spare_part_service' => 'SPARE PART & SERVICE',
            'cost' => 'RM',
            'series_no' => 'SERIES NO.',
            'reason' => 'REASON / DETAIL',
            'warranty' => 'WARRANTY',
            'remark' => 'REMARKS',
            'truck_id' => 'TRUCK NO.',
        ];
    }

    /**
     * {@inheritdoc}
     * @return TruckexpenseQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TruckexpenseQuery(get_called_class());
    }
}
