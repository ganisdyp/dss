<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[SaleRecord]].
 *
 * @see SaleRecord
 */
class SaleRecordQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return SaleRecord[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return SaleRecord|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
