<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Port;
use frontend\models\Ship;

class ToprankController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $models = User::find()->all();
        $userships = Port::findOne(Yii::$app->user->getId());
        $shipname = Ship::findOne($userships->ship_id);
        return $this->render('index', [
            'models' => $models,
            'userships' => $userships,
            'shipname' => $shipname,
        ]);
    }

}
