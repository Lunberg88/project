<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "mods".
 *
 * @property integer $id
 * @property integer $ship_id
 * @property integer $mod_gun
 * @property integer $mod_tower
 *
 * @property Ship $ship
 */
class Mods extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mods';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ship_id'], 'required'],
            [['ship_id', 'mod_gun', 'mod_tower'], 'integer'],
            [['ship_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ship::className(), 'targetAttribute' => ['ship_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ship_id' => 'Ship ID',
            'mod_gun' => 'Mod Gun',
            'mod_tower' => 'Mod Tower',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShip()
    {
        return $this->hasOne(Ship::className(), ['id' => 'ship_id']);
    }
}
