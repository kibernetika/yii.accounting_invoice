<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Tovar]].
 *
 * @see Tovar
 */
class TovarQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return Tovar[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return Tovar|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
