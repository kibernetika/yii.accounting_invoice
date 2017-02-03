<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "od_vymiru".
 *
 * @property integer $id
 * @property string $name
 */
class OdVymiru extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'od_vymiru';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['name'], 'string', 'max' => 15],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Назва одиниці виміру'),
        ];
    }

    /**
     * @inheritdoc
     * @return OdVymiruQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new OdVymiruQuery(get_called_class());
    }
}
