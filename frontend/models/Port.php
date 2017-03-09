<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "port".
 *
 * @property integer $user_id
 * @property integer $ship_id
 * @property integer $exp
 * @property boolean $stock_gun
 * @property boolean $stock_tower
 * @property boolean $mod_gun
 * @property boolean $mod_tower
 * @property integer $strength
 *
 * @property User $user
 * @property Ship $ship
 */
class Port extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'port';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'ship_id', 'exp', 'strength'], 'required'],
            [['user_id', 'ship_id', 'exp', 'strength'], 'integer'],
            [['stock_gun', 'stock_tower', 'mod_gun', 'mod_tower'], 'boolean'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'user_id' => 'User ID',
            'ship_id' => 'Ship ID',
            'exp' => 'Exp',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['id' => 'ship_id']);
    }
}
