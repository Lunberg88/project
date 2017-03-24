<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Port;
use frontend\models\Ship;
use yii\db\ActiveQuery;

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
        /*
        $userships = Port::find()
        ->select('*')
        ->innerJoin('user', 'port.id = user.id')
//        ->leftJoin('user', 'port.user_id = user.id')
//        ->with('port')
        ->all();
*/
        /*
        echo  '<pre>'.print_r($userships,1).'</pre>';
        exit();
        */
 $userships = Port::find()
     ->joinWith('user')
     ->all();

echo '<pre>'.print_r($userships,1).'</pre>';
exit();
        return $this->render('index', [
           'userships' => $userships,
        ]);

    }
}
