<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tovar".
 *
 * @property integer $id
 * @property string $nazva
 * @property integer $parent
 * @property integer $od_vymiru
 * @property integer $is_directory
 * @property integer $deleted
 * @property string $barcode
 * @property double $cina_kup
 * @property double $cina_rozdr
 * @property string $manufacturer
 * @property string $myDeleted
 * @property string $myIsDirectory
 * @property string $ovymiru

 */
class Tovar extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tovar';
    }

        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'od_vymiru', 'is_directory', 'deleted', 'barcode'], 'integer'],
            [['cina_kup', 'cina_rozdr'], 'number'],
            [['nazva'], 'string', 'max' => 256],
            [['manufacturer'], 'string', 'max' => 100],
            [['myDeleted', 'myIsDirectory', 'ovymiru'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nazva' => 'Назва товару',
            'parent' => 'Група',
            'od_vymiru' => 'Одиниці',
            'is_directory' => 'Ознака групи',
            'myIsDirectory' => 'Ознака групи',
            'deleted' => 'Видаленно',
            'myDeleted' => 'Видалено',
            'barcode' => 'Штрих-код',
            'cina_kup' => 'Купівельна ціна',
            'cina_rozdr' => 'Роздрібна ціна',
            'manufacturer' => 'Виробник',
            'ovymiru' =>  \Yii::t("app", "Одиниці"),
        ];
    }

    /**
     * @inheritdoc
     * @return TovarQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TovarQuery(get_called_class());
    }

    /**
     * @param int $ovymiru
     */
    public function setOvymiru()
    {
        return OdVymiru::findOne($this->od_vymiru)->id;
    }

    /**
     * @return string $ovymiru
     */
    public function getOvymiru()
    {
        return $this->hasOne(OdVymiru::className(), ['id' => 'od_vymiru']);
    }

    /**
     * @return string
     */
    public function getMyIsDirectory()
    {
        return $this->is_directory == 1 ? 'Так' : '-';
    }

    /**
     * @return string
     */
    public function getMyDeleted()
    {
        return $this->deleted == 1 ? 'Так' : '-' ;
    }

}
