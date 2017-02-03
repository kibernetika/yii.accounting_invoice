<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Tovar;

/**
 * TovarSearch represents the model behind the search form about `app\models\Tovar`.
 */
class TovarSearch extends Tovar
{
    public $ovymiru;
    public $myDeleted;
    public $myIsDirectory;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent', 'od_vymiru', 'is_directory', 'deleted', 'barcode'], 'safe'],
            [['nazva', 'manufacturer'], 'safe'],
            [['myDeleted', 'myIsDirectory', 'ovymiru'], 'safe'],
            [['cina_kup', 'cina_rozdr'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tovar::find();
        $query->joinWith(['ovymiru']);
        // add conditions that should always apply here
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $dataProvider->sort->attributes['myDeleted'] = [
            'asc' => ['deleted' => SORT_ASC],
            'desc' => ['deleted' => SORT_DESC],
            'label' => 'Видалено'
        ];

        $dataProvider->sort->attributes['myIsDirectory'] = [
            'asc' => ['is_directory' => SORT_ASC],
            'desc' => ['is_directory' => SORT_DESC],
            'label' => 'Ознака групи',
        ];

        $dataProvider->sort->attributes['ovymiru'] = [
            'asc' => ['od_vymiru' => SORT_ASC],
            'desc' => ['od_vymiru' => SORT_DESC],
        ];

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tovar.id' => $this->id,
            'parent' => $this->parent,
            'od_vymiru' => $this->od_vymiru,
            'is_directory' => $this->is_directory,
            'deleted' => $this->deleted,
            'barcode' => $this->barcode,
            'cina_kup' => $this->cina_kup,
            'cina_rozdr' => $this->cina_rozdr,
        ]);
        if( ! empty($this->myDeleted) ){
            $this->deleted = $this->myDeleted == 'Так' ? 1 : 0;
        }
        if( ! empty($this->myIsDirectory) ) {
            $this->is_directory = $this->myIsDirectory == 'Так' ? 1 : 0;
        }
        $query->andFilterWhere(['like', 'nazva', $this->nazva])
            ->andFilterWhere(['like', 'manufacturer', $this->manufacturer])
            ->andFilterWhere(['like', 'ovymiru.name', $this->ovymiru])
            ->andFilterWhere(['like', 'deleted', $this->deleted])
            ->andFilterWhere(['like', 'is_directory', $this->is_directory]);
        return $dataProvider;
    }
    
}
