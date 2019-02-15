<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Station]].
 *
 * @see Station
 */
class StationQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Station[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Station|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
