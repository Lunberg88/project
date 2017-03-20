<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use frontend\models\Ship;
use frontend\models\Port;
use yii\web\Controller;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;

class CombatController extends Controller
{
    public function actionIndex()
    {
      if(!Yii::$app->user->isGuest) {
        //Session run;
        $session = Yii::$app->session;
        $session->open();
        //Set user;
        $user = User::findOne(Yii::$app->user->getId());
        //Set ship hp;
        $usership = Port::findOne(Yii::$app->user->getId());
        //Find ship;
        $shipname = Ship::findOne($usership->ship_id);
        //Checking if user have any ship's in his port;
        if(isset($usership)) {
            //Set session hp for player;
            if (!isset($session['usershiphp']) && !isset($session['bothp'])) {
                $session['usershiphp'] = $usership->strength;
                $session['bothp'] = $usership->strength;
            }
            //Set formula param's;
            $playerdmg = (($usership->ship_id) * rand(80,90)) + ($usership->mod_gun) * 10;
            $botdmg = ($usership->ship_id) * 100;
            //If press button 'Attack';
            if (Yii::$app->request->post('Attack')) {
                $session['usershiphp'] = $session['usershiphp'] - $botdmg;
                $session['battlelog_b'] = 'We taken damage from bot warship -' . $botdmg;
                if($usership->type == 3) {
                    $session['bothp'] = $session['bothp'] - ($playerdmg - (rand(20,30) * 1.5));
                    $session['battlelog_p'] = 'We attacked bot warship on -<b>' . $playerdmg . '</b>';
                } elseif($usership->type == 2) {
                    $session['bothp'] = $session['bothp'] - ($playerdmg + (rand(40,50) * $usership->ship_id));
                    $session['battlelog_p'] = 'We attacked bot warship on -<b>' . $playerdmg . '</b>';
                } else {
                    $session['bothp'] = $session['bothp'] - $playerdmg;
                    $session['battlelog_p'] = 'We attacked bot warship on -<b>' . $playerdmg . '</b>';
                }
                echo '<hr>';
                //Cheking for state - HP.
                if ($session['usershiphp'] <= 0) {
                    unset($session['usershiphp']);
                    unset($session['bothp']);
                    unset($session['battlelog_b']);
                    unset($session['battlelog_p']);
                    $user->updateCounters(['lose' => 1]);
                    $this->redirect('combat/lose');
                } elseif ($session['bothp'] <= 0) {
                    unset($session['usershiphp']);
                    unset($session['bothp']);
                    unset($session['battlelog_b']);
                    unset($session['battlelog_p']);
                    $usership->updateCounters(['exp' => 50]);
                    $user->updateCounters(['win' => 1]);
                    $this->redirect('combat/win');
                }
            }
            return $this->render('index', [
                'session' => $session,
                'playerdmg' => $playerdmg,
                'botdmg' => $botdmg,
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
