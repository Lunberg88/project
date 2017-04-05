<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mods;

/**
 * ModsSearch represents the model behind the search form about `common\models\Mods`.
 */
class ModsSearch extends Mods
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ship_id', 'mod_gun', 'mod_tower', 'exp_gun', 'exp_tower', 'cost_gun', 'cost_tower'], 'integer'],
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
        $query = Mods::find();

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
            'ship_id' => $this->ship_id,
            'mod_gun' => $this->mod_gun,
            'mod_tower' => $this->mod_tower,
            'exp_gun' => $this->exp_gun,
            'exp_tower' => $this->exp_tower,
            'cost_gun' => $this->cost_gun,
            'cost_tower' => $this->cost_tower,
        ]);

        return $dataProvider;
    }
}
