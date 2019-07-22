<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Dieselexpense]].
 *
 * @see Dieselexpense
 */
class DieselexpenseQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dieselexpense[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dieselexpense|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
