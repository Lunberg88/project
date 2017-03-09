<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Battle of WarShips!');
?>
<div class="site-index">
        <div align="center">
        <h2><b><?=Yii::t('app', 'Hello') ?>, <?=Yii::$app->user->identity->username; ?>!</b></h2>
        <h4><?=Yii::t('app', 'Here is your Port of Battle Ships!') ?></h4>
        </div>
    <div class="body-content">
<table border="0" align="center">
 <tr>
  <td align="left" width="33%">
<div align="left">
<?php
 if(isset($model)) {
     echo '<h4><b>[ ' . $shipname->name . ' ]</b></h4>';
     echo '<br>';
     echo '<img src='.Yii::$app->homeUrl.'img/' . $model->ship_id . '.png>';
     echo '<hr style=width:300px; align=left>';
     echo Yii::t('app', 'Strength').': <b>' . $model->strength . '</b> | '.Yii::t('app', 'Experience').': <b>' . $model->exp . '</b> | '.Yii::t('app', 'Credits').': <b>' . $user->credits . '</b>. <br>';
?>
</div>
      <div>
          <h3><b><?=Yii::t('app', 'Statistics') ?>:</b></h3>
          <hr>
          <?php
          echo Yii::t('app', 'WIN').': <b>'.$user->win.'</b><br>';
          echo Yii::t('app', 'LOSE').': <b>'.$user->lose.'</b><br>';
          echo Yii::t('app', 'DRAW').': <b>'.$user->draw.'</b><br>';
          ?>
      </div>
   </td>
   <td width="33%">
  </td>
   <td align="left" width="33%">
   <?php
 if($model->stock_gun == 1 && $model->mod_gun == 0) {
        echo '<h3><b>'.Yii::t('app', 'Stock Gun').'</b></h3> - <img src='.Yii::$app->homeUrl.'img/stock_gun.png>';
        } elseif($model->stock_gun == 0 && $model->mod_gun == 1) {
                 echo '<h3><b>'.Yii::t('app', 'Modificate Gun').'</b></h3> - <img src='.Yii::$app->homeUrl.'img/mod_gun.png>';
        }
     if($model->stock_tower == 1 && $model->mod_tower == 0) {
        echo '<h3><b>'.Yii::t('app', 'Stock Tower').'</b></h3> - <img src='.Yii::$app->homeUrl.'img/stock_tower.png>';
        } elseif($model->stock_tower == 0 && $model->mod_tower == 1) {
                 echo '<h3><b>'.Yii::t('app', 'Modificate Tower').'</b></h3> - <img src='.Yii::$app->homeUrl.'img/mod_tower.png>';
        }

       } else {
       echo "<div align=\"center\"><h2><b>".Yii::t('app', 'There are no any WarShip\'s in Your port!')."</b></h2></div>";
       }
?>
   </td>
 </tr>
</table>
    </div>
</div>
