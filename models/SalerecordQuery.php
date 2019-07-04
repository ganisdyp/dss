<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Salerecord]].
 *
 * @see Salerecord
 */
class SalerecordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Salerecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Salerecord|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
