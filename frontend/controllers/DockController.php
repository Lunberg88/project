<?php

namespace frontend\controllers;

use Yii;
use \yii\web\Controller;
use common\models\User;
use common\models\Port;

class DockController extends Controller
{
    public function actionIndex()
    {
        $player = User::findOne(['id' => Yii::$app->user->id]);
        $userships = Port::find()
            ->joinWith('user', 'ship')
            ->andWhere(['user_id' => $player->id])
            ->all();

        return $this->render('index', [
            'userships' => $userships,
            'player' => $player,
        ]);
    }

}
