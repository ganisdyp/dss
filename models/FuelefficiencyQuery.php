<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Fuelefficiency]].
 *
 * @see Fuelefficiency
 */
class FuelefficiencyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Fuelefficiency[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Fuelefficiency|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
