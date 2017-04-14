<?php

namespace frontend\controllers;

use \yii\web\Controller;
use common\models\Battles;

class LogsController extends Controller
{
    public function actionIndex()
    {
        $models = Battles::find(['status' => 1])->all();

        return $this->render('index', [
            'models' => $models,
        ]);
    }

}
