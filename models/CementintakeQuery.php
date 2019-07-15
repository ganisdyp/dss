<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Cementintake]].
 *
 * @see Cementintake
 */
class CementintakeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Cementintake[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Cementintake|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
