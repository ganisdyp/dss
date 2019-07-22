<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Truckexpense]].
 *
 * @see Truckexpense
 */
class TruckexpenseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Truckexpense[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Truckexpense|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
