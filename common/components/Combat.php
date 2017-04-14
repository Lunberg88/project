<?php

namespace common\components;

use yii\base\Object;
use common\models\Battles;
use yii\web\Controller;
use Yii;

class Combat extends Object
{
  public $exp;

  public $credits;

  public function combat($userhp, $bothp, $type, $ship, $player, $battleid)
  {
      $playerdmg = $this->dmgPlayer($ship->ship_id, $ship->mod_gun);
      $botdmg = $this->dmgBot($ship->ship_id);

      switch ($type) {
          case 1:
              $i = rand(0,10);
              if($i == 7) {
                  $adddmg = (($ship->strength)*0.3);
              } else {
                  $adddmg = (($ship->strength)*0.1);
              }
              $bothp = $bothp - ceil(($this->shipTypePlayer($ship->type, $playerdmg) + $adddmg));
              $userhp = $userhp - ceil(($this->shipTypeBot($ship->type, $botdmg) + $adddmg));
              $log = Yii::t('app', 'You attacked the bot warship on -').'<b>'.ceil(($this->shipTypePlayer($ship->type, $playerdmg) + $adddmg)).'</b><br>';
              $log .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.ceil(($this->shipTypeBot($ship->type, $botdmg) + $adddmg)).'</b>';
              break;
          case 2:
              $adddmg = (($ship->strength)*0.1);
              $bothp = $bothp - ceil(($this->shipTypePlayer($ship->strength, $playerdmg) + $adddmg));
              $userhp = $userhp - ceil(($this->shipTypeBot($ship->strength, $botdmg) + $adddmg));
              $log = Yii::t('app', 'You attacked the bot warship on -').'<b>'.ceil(($this->shipTypePlayer($ship->type, $playerdmg) + $adddmg)).'</b><br>';
              $log .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.ceil(($this->shipTypeBot($ship->type, $botdmg) + $adddmg)).'</b>';
              break;
          case 3:
              $adddmg = (($ship->strength)*0.1);
              $bothp = $bothp - ceil(($this->shipTypePlayer($ship->strength, $playerdmg) + $adddmg));
              $userhp = $userhp - ceil(($this->shipTypeBot($ship->strength, $botdmg) + $adddmg));
              $log = Yii::t('app', 'You attacked the bot warship on -').'<b>'.ceil(($this->shipTypePlayer($ship->type, $playerdmg) + $adddmg)).'</b><br>';
              $log .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.ceil(($this->shipTypeBot($ship->type, $botdmg) + $adddmg)).'</b>';
              break;
          case 4:
              $i = rand(1,30);
              if($i == 23) {
                  $adddmg = $ship->strength;
              } else {
                  $adddmg = ceil(($ship->strength)*0.1);
              }
              $bothp = $bothp - ceil(($this->shipTypePlayer($ship->strength, $playerdmg) + $adddmg));
              $userhp = $userhp - ceil(($this->shipTypeBot($ship->strength, $botdmg) + $adddmg));
              $log = Yii::t('app', 'You attacked the bot warship on -').'<b>'.ceil(($this->shipTypePlayer($ship->type, $playerdmg) + $adddmg)).'</b><br>';
              $log .= Yii::t('app', 'Our warship were attacked by bot warship on -').'<b>'.ceil(($this->shipTypeBot($ship->type, $botdmg) + $adddmg)).'</b>';
              break;
      }
      $this->writeLog($battleid, $log);
      echo '<hr>';

      /*
       * Cheking for state - HP;
       */
      if ($userhp <= 0) {
          unset($userhp);
          unset($bothp);
          unset($log);
          unset($battleid);
          $player->updateCounters(['lose' => 1]);
          $player->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
          Controller::redirect('combat/lose');
      } elseif ($bothp <= 0) {
          unset($userhp);
          unset($bothp);
          unset($log);
          unset($battleid);
          $ship->updateCounters(['exp' => $this->expirence($ship->ship_id)]);
          $player->updateCounters(['win' => 1]);
          $player->updateCounters(['credits' => +($this->giveMoney())]);
          $player->updateAll(['battle_id' => 0], ['id' => Yii::$app->user->id]);
          Controller::redirect('combat/win');
      }

      return [$ship, $player, $log];

  }

    /**
     * @param $user
     * @param $item
     * @return mixed
     */
  public function addHp($user, $item)
  {
       if(Yii::$app->request->post('gethp')) {
           $user = $user + $item;
           return $user;
       }
  }

  /**
   * Calculate damage for player;
   */
  public function dmgPlayer($id, $gun)
  {
      $playerdmg = (($id) * rand(80,90)) + ($gun) * 10;

      return $playerdmg;
  }

  /**
  * @param $id
  * @return mixed
  */
  public function dmgBot($id)
  {
      $botdmg = ($id) * rand(80,10);

      return $botdmg;
  }

  /**
  * @param $id
  * @return mixed
  */
  public function expirence($id)
  {
      $expirence = ($id*(10*$this->exp)+rand(10,20));

      return $expirence;
  }

    /**
     * @return mixed
     */
  public function giveMoney()
  {
     $givemoney = (($this->credits)*100)+rand(0,50);

     return $givemoney;
  }

    /**
     * @param $bid
     * @param $pdmg
     */
  public function writeLog($bid, $pdmg)
  {
      $battleid = Battles::findOne(['bid' => $bid]);
      $battleid->updateAll(['logs' => new \yii\db\Expression("CONCAT('".$pdmg."')")], ['bid' => $bid]);
  }

    /**
     * @param $type
     * @param $dmg
     * @return mixed
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

    /**
     * @param $type
     * @param $dmg
     * @return mixed
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