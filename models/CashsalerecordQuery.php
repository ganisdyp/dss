<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cashsalerecord]].
 *
 * @see Cashsalerecord
 */
class CashsalerecordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cashsalerecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cashsalerecord|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
