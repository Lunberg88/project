<?php

namespace frontend\controllers;

use Yii;
use common\models\User;
use common\models\Ship;
use common\models\Port;
use common\models\Battles;
use common\models\UserItems;
use yii\web\Controller;

class CombatController extends Controller
{
    public function actionIndex()
    {
      if(!Yii::$app->user->isGuest) {
        /**
        * Run sessions.
        */
        $session = Yii::$app->session;
        $session->open();
        $user = User::findOne(['id' => Yii::$app->user->id]);
        $usership = Port::findOne(['user_id' => Yii::$app->user->id]);
        /**
        * Checking user ship in port.
        */
        if(isset($usership)) {

        $user_items = UserItems::findOne(['user_id' => $user->id]);
        $shipname = Ship::findOne(['id' => $usership->ship_id]);
        $battle_log = Battles::findOne(['bid' => $session['battle_id']]);

        if (!isset($session['usershiphp']) && !isset($session['bothp'])) {
              $session['usershiphp'] = $usership->strength;
              $session['bothp'] = $usership->strength;
        }

        if(Yii::$app->request->post('Attack')) {
            if(Yii::$app->request->post('shot')) {
                $shottype = Yii::$app->request->post('shot');

                Yii::$app->Combat->combat($session['usershiphp'], $session['bothp'], $shottype, $usership, $user, $session['battle_id']);

            }
        }

        //Yii::$app->Combat->fight($user->id);

            return $this->render('index', [
                'session' => $session,
                'usership' => $usership,
                'shipname' => $shipname,
                'user_items' => $user_items,
                'user' => $user,
                'battle_log' => $battle_log,
            ]);
        } else {
            return $this->redirect('site/index');
        }
    } else {
      return $this->redirect('site/login');
    }
  }

    /**
     * Redirect to win page.
     * @return string
     */
    public function actionWin()
    {
     return $this->render('win');   
    }

    /**
     * Redirect to lose page.
     * @return string
     */
    public function actionLose()
    {
     return $this->render('lose');   
    }
}
