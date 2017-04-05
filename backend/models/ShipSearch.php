<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Ship;

/**
 * ShipSearch represents the model behind the search form about `common\models\Ship`.
 */
class ShipSearch extends Ship
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'lvl', 'stock_gun', 'stock_tower', 'mod_gun', 'mod_tower', 'strength', 'type'], 'integer'],
            [['name'], 'safe'],
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
        $query = Ship::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'lvl' => $this->lvl,
            'stock_gun' => $this->stock_gun,
            'stock_tower' => $this->stock_tower,
            'mod_gun' => $this->mod_gun,
            'mod_tower' => $this->mod_tower,
            'strength' => $this->strength,
            'type' => $this->type,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
