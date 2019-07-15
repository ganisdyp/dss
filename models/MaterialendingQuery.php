<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Materialending]].
 *
 * @see Materialending
 */
class MaterialendingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Materialending[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Materialending|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
