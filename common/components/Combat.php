<?php

namespace common\components;

use yii\base\Object;
use frontend\models\Port;
use common\models\User;
use yii\web\Controller;
use Yii;

class Combat extends Object
{
  public $exp;

  public $credits;

  public function fight($player)
  {
      $session = Yii::$app->session;
      $session->open();
      $user = User::findOne(['id' => Yii::$app->user->id]);
      $usership = Port::findOne(['user_id' => Yii::$app->user->id]);

      //Set battle_id for player;
      $battle_id = date('dhms');
      $user->updateCounters(['battle_id' => $battle_id]);

      //Set session hp for player;
      if (!isset($session['usershiphp']) && !isset($session['bothp'])) {
          $session['usershiphp'] = $usership->strength;
          $session['bothp'] = $usership->strength;
      }
      //Set formula param's;

      $playerdmg = $this->dmgPlayer($usership->ship_id, $usership->mod_gun);
      $botdmg = $this->dmgBot($usership->ship_id);

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
              $user->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
              Controller::redirect('combat/lose');
          } elseif ($session['bothp'] <= 0) {
              unset($session['usershiphp']);
              unset($session['bothp']);
              unset($session['battlelog_b']);
              unset($session['battlelog_p']);
              $usership->updateCounters(['exp' => $this->expirence($usership->ship_id)]);
              $user->updateCounters(['win' => 1]);
              $user->updateCounters(['credits' => +($this->giveMoney())]);
              $user->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
              Controller::redirect('combat/win');
          }
      }

      return [$playerdmg, $botdmg, $session['usershiphp'], $session['bothp'], $usership, $user];
  }

  public function dmgPlayer($id, $gun)
  {
      $playerdmg = (($id) * rand(80,90)) + ($gun) * 10;

      return $playerdmg;
  }

  public function dmgBot($id)
  {
      $botdmg = ($id) * 100;

      return $botdmg;
  }

  public function expirence($id)
  {
      $expirence = ($id*(10*$this->exp)+rand(10,20));

      return $expirence;
  }

  public function giveMoney()
  {
     $givemoney = (($this->credits)*100)+rand(0,50);

     return $givemoney;
  }
}