<?php

namespace common\components;

use yii\base\Object;
use common\models\Port;
use common\models\User;
use common\models\Battles;
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

      /*
       * Set session hp for player;
       */
      if (!isset($session['usershiphp']) && !isset($session['bothp'])) {
          $session['usershiphp'] = $usership->strength;
          $session['bothp'] = $usership->strength;
      }

      if(!isset($battle)) {
          $battle = new Battles();
          $battle->bid = date('dhms');
          $battle->creator_id = $user->id;
          $battle->status = 0;
          $battle->date = date('d.m.Y');
          $battle->save();
      }
          $user->updateAll(['battle_id' => $battle->bid], ['id' => $user->id]);
      /*
       * Set formula param's;
       */
      $playerdmg = $this->dmgPlayer($usership->ship_id, $usership->mod_gun);
      $botdmg = $this->dmgBot($usership->ship_id);

      /*
       * If press button 'Attack';
       */
      if (Yii::$app->request->post('Attack')) {
          if (Yii::$app->request->post('shot')) {
              switch (Yii::$app->request->post('shot')) {
                  case 1:
                         $i = rand(0,10);
                         if($i == 7) {
                            $adddmg = (($usership->strength)*0.3);
                         } else {
                             $adddmg = (($usership->strength)*0.1);
                         }
                         $session['bothp'] = $session['bothp'] - ($this->shipTypePlayer($usership->type, $playerdmg) + $adddmg);
                         $session['usershiphp'] = $session['usershiphp'] - ($this->shipTypeBot($usership->type, $botdmg) + $adddmg);
                         $session['battlelog'] = Yii::t('app', 'You attacked the bot warship on -').'<b>'.($this->shipTypePlayer($usership->type, $playerdmg) + $adddmg).'</b><br>';
                         $session['battlelog'] .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.($this->shipTypeBot($usership->type, $botdmg) + $adddmg).'</b>';
                         break;
                  case 2:
                         $adddmg = (($usership->strength)*0.1);
                         $session['bothp'] = $session['bothp'] - ($this->shipTypePlayer($usership->strength, $playerdmg) + $adddmg);
                         $session['usershiphp'] = $session['usershiphp'] - ($this->shipTypeBot($usership->strength, $botdmg) + $adddmg);
                         $session['battlelog'] = Yii::t('app', 'You attacked the bot warship on -').'<b>'.($this->shipTypePlayer($usership->type, $playerdmg) + $adddmg).'</b><br>';
                         $session['battlelog'] .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.($this->shipTypeBot($usership->type, $botdmg) + $adddmg).'</b>';
                         break;
                  case 3:
                         $adddmg = (($usership->strength)*0.1);
                         $session['bothp'] = $session['bothp'] - ($this->shipTypePlayer($usership->strength, $playerdmg) + $adddmg);
                         $session['usershiphp'] = $session['usershiphp'] - ($this->shipTypeBot($usership->strength, $botdmg) + $adddmg);
                         $session['battlelog'] = Yii::t('app', 'You attacked the bot warship on -').'<b>'.($this->shipTypePlayer($usership->type, $playerdmg) + $adddmg).'</b><br>';
                         $session['battlelog'] .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.($this->shipTypeBot($usership->type, $botdmg) + $adddmg).'</b>';
                         break;
                  case 4:
                         $i = rand(1,30);
                         if($i == 23) {
                             $adddmg = $usership->strength;
                         } else {
                             $adddmg = (($usership->strength)*0.1);
                         }
                         $session['bothp'] = $session['bothp'] - ($this->shipTypePlayer($usership->strength, $playerdmg) + $adddmg);
                         $session['usershiphp'] = $session['usershiphp'] - ($this->shipTypeBot($usership->strength, $botdmg) + $adddmg);
                         $session['battlelog'] = Yii::t('app', 'You attacked the bot warship on -').'<b>'.($this->shipTypePlayer($usership->type, $playerdmg) + $adddmg).'</b><br>';
                         $session['battlelog'] .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.($this->shipTypeBot($usership->type, $botdmg) + $adddmg).'</b>';
                         break;
              }
              echo '<hr>';

              /*
               * Cheking for state - HP;
               */
              if ($session['usershiphp'] <= 0) {
                  unset($session['usershiphp']);
                  unset($session['bothp']);
                  unset($session['battlelog']);
                  $user->updateCounters(['lose' => 1]);
                  $user->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
                  $battle->updateAll(['status' => 1], ['creator_id' => $user->id]);
                  Controller::redirect('combat/lose');
              } elseif ($session['bothp'] <= 0) {
                  unset($session['usershiphp']);
                  unset($session['bothp']);
                  unset($session['battlelog']);
                  $usership->updateCounters(['exp' => $this->expirence($usership->ship_id)]);
                  $user->updateCounters(['win' => 1]);
                  $user->updateCounters(['credits' => +($this->giveMoney())]);
                  $user->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
                  $battle->updateAll(['status' => 1], ['creator_id' => $user->id]);
                  Controller::redirect('combat/win');
              }
          }
      }
      return [$playerdmg, $botdmg, $session['usershiphp'], $session['bothp'], $usership, $user];
  }

  /*
   * Calculate damage for player;
   */
  public function dmgPlayer($id, $gun)
  {
      $playerdmg = (($id) * rand(80,90)) + ($gun) * 10;

      return $playerdmg;
  }

  /*
   * Calculate damage for bot;
   */
  public function dmgBot($id)
  {
      $botdmg = ($id) * rand(80,10);

      return $botdmg;
  }

  /*
   * Set expirence for player;
   */
  public function expirence($id)
  {
      $expirence = ($id*(10*$this->exp)+rand(10,20));

      return $expirence;
  }

  /*
   * Set money for player;
   */
  public function giveMoney()
  {
     $givemoney = (($this->credits)*100)+rand(0,50);

     return $givemoney;
  }

  /*
   * Write battle log;
   */
  public function writeLog($bid, $pdmg, $bdmg)
  {
      $battleid = Battles::findOne(['bid' => $bid]);
      $battleid->updateAll(['logs' => new \yii\db\Expression("CONCAT('".$pdmg.'<br>'.$bdmg."')")], ['bid' => $bid]);
  }

  /*
   * Checking Playership type to calc new damage;
   */
  public function shipTypePlayer($type, $dmg)
  {
      if($type == 3) {
          $pdmg = $dmg - (rand(20, 30) * 1.5);
           return $pdmg;
      } elseif ($type == 2) {
          $pdmg = $dmg + (rand(40, 50) * 1.5);
           return $pdmg;
      } else {
          $pdmg = $dmg;
           return $pdmg;
      }
  }
    /*
     * Checking Botship type to calc new damage;
     */
    public function shipTypeBot($type, $dmg)
    {
        if($type == 3) {
            $bdmg = $dmg - (rand(19, 32) * 1.4);
            return $bdmg;
        } elseif ($type == 2) {
            $bdmg = $dmg + (rand(38, 50) * 1.5);
            return $bdmg;
        } else {
            $bdmg = $dmg;
            return $bdmg;
        }
    }
}