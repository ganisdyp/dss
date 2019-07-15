<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Materialaudit]].
 *
 * @see Materialaudit
 */
class MaterialauditQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Materialaudit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Materialaudit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
