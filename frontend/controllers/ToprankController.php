<?php

namespace frontend\controllers;

use frontend\models\Port;

class ToprankController extends \yii\web\Controller
{
    public function actionIndex()
    {

       $userships = Port::find()
        ->joinWith('user', 'ship')
        ->orderBy('user.win')
        ->all();

        return $this->render('index', [
           'userships' => $userships,
        ]);

    }
}
