<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Ship;
use common\models\Port;
use yii\web\Controller;

class CombatController extends Controller
{
    public function actionIndex()
    {
      if(!Yii::$app->user->isGuest) {
        //Session run;
        $session = Yii::$app->session;
        $session->open();
        //Set user;
        $user = User::findOne(['id' => Yii::$app->user->id]);
        //Set ship hp;
        $usership = Port::findOne(['user_id' => Yii::$app->user->id]);

        //Checking if user have any ship's in his port;
        if(isset($usership)) {

        //Find ship;
        $shipname = Ship::findOne(['id' => $usership->ship_id]);

        Yii::$app->Combat->fight($user->id);

            return $this->render('index', [
                'session' => $session,
                'usership' => $usership,
                'shipname' => $shipname,
            ]);
        } else {
            return $this->redirect('site/index');
        }
    } else {
      return $this->redirect('site/login');
    }
  }
    //Action Win.
    public function actionWin()
    {
     return $this->render('win');   
    }
    //Action Lose.
    public function actionLose()
    {
     return $this->render('lose');   
    }
}
