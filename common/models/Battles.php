<?php

namespace common\models;

/**
 * This is the model class for table "battles".
 *
 * @property integer $id
 * @property resource $logs
 * @property integer $bid
 * @property integer $creator_id
 * @property string $date
 * @property integer $status
 *
 * @property User $creator
 */
class Battles extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'battles';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['logs'], 'string'],
            [['bid', 'creator_id', 'status'], 'required'],
            [['bid', 'creator_id', 'status'], 'integer'],
            [['date'], 'safe'],
            [['creator_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['creator_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'logs' => 'Logs',
            'bid' => 'Bid',
            'creator_id' => 'Creator ID',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreator()
    {
        return $this->hasOne(User::className(), ['id' => 'creator_id']);
    }
}
