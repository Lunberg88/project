<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Port;
use frontend\models\Ship;

class ToprankController extends \yii\web\Controller
{
    /*
    public function actionIndex()
    {
        $models = User::find()->all();
        if($models) {
            foreach ($models as $model) {
                $userships = Port::findOne(['user_id' => $model->id]);
            }
        }
        $shipname = Ship::findOne([ 'id' => $userships->ship_id]);
        return $this->render('index', [
            'models' => $models,
            'userships' => $userships,
            'shipname' => $shipname,
        ]);
    }
*/
    public function actionIndex()
    {
        $userships = Port::find()
        ->select('*')
        ->innerJoin('ship', 'port.ship_id = ship.id')
        ->leftJoin('user', 'port.user_id = user.id')
        ->with('ship', 'user')
        ->all();

        /*
        echo  '<pre>'.print_r($userships,1).'</pre>';
        exit();
        */



        return $this->render('index', [
           'userships' => $userships,
        ]);

    }
}
