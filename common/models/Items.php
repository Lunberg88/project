<?php

namespace common\models;


/**
 * This is the model class for table "items".
 *
 * @property integer $id
 * @property string $name
 * @property integer $hp
 * @property integer $qnt
 *
 * @property UserItems[] $userItems
 */
class Items extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'items';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['hp', 'qnt'], 'integer'],
            [['name'], 'string', 'max' => 50],
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
            'hp' => 'Hp',
            'qnt' => 'Qnt',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserItems()
    {
        return $this->hasMany(UserItems::className(), ['item_id' => 'id']);
    }
}
