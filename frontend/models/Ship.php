<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "ship".
 *
 * @property integer $id
 * @property string $name
 * @property integer $lvl
 * @property boolean $stock_gun
 * @property boolean $stock_tower
 * @property boolean $mod_gun
 * @property boolean $mod_tower
 * @property integer $strength
 *
 * @property Port[] $ports
 */
class Ship extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ship';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'name', 'lvl', 'strength'], 'required'],
            [['id', 'lvl', 'strength'], 'integer'],
            [['stock_gun', 'stock_tower', 'mod_gun', 'mod_tower'], 'boolean'],
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'lvl' => 'Lvl',
            'stock_gun' => 'Stock Gun',
            'stock_tower' => 'Stock Tower',
            'mod_gun' => 'Mod Gun',
            'mod_tower' => 'Mod Tower',
            'strength' => 'Strength',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPorts()
    {
        return $this->hasMany(Port::className(), ['ship_id' => 'id']);
    }
}
