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
     echo '<div align="center" style="width:350px;"><div class="progress"><div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;">100% HP</div></div></div>';
     echo '<img width=420 src='.Yii::$app->homeUrl.'img/ships/' . $shipname->name . '.png>';
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
       <div>
           <?php
           if($avaible_mods) {
               echo "<h2><b>" . Yii::t('app', 'Available Mods') . "</b></h2><hr>";
               if (($model->exp_gun) != 1) {
                   if (($model->exp) >= ($avaible_mods->exp_gun)) {
                       $form = ActiveForm::begin(['id' => 'exp_mod_gun']);
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_gun.png'> - <b>" . Yii::t('app', 'Modified Main Battery') . "</b>  " . Html::submitButton(Yii::t('app', 'Explore'), ['class' => 'btn btn-lg btn-success', 'style' => 'width: 140px; height: 25px; padding: 0px 3px 1px 3px', 'name' => 'expmodgun', 'id' => 'exp_mod_gun', 'value' => 'Explore']);
                       ActiveForm::end();
                   } else {
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_gun.png' style='opacity: 0.5;'> - <b>" . Yii::t('app', 'Modified Main Battery') . "</b>";
                   }
               } else {
                   if (($model->mod_gun) != 1) {
                       $form = ActiveForm::begin(['id' => 'buy_mod_gun']);
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_gun.png'> - <b>" . Yii::t('app', 'Modified Main Battery') . " - Already explored</b> ".Html::submitButton(Yii::t('app', 'Buy'), ['class' => 'btn btn-primary', 'style' => 'width: 70px; height: 25px; padding: 0px 3px 1px 3px', 'name' => 'buymodgun', 'id' => 'buy_mod_gun', 'value' => 'Buy']);
                       ActiveForm::end();
                   } else {
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_gun.png'> - <b>" . Yii::t('app', 'Modified Main Battery') . " - Installed</b>  ";
                   }
               }
               echo "<br>";
               if (($model->exp_tower) != 1) {
                   if (($model->exp) >= ($avaible_mods->exp_tower)) {
                       $form = ActiveForm::begin(['id' => 'exp_mod_tower']);
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_tower.png'> - <b>" . Yii::t('app', 'Improved Hit Points(HP)') . "</b>  " . Html::submitButton(Yii::t('app', 'Explore'), ['class' => 'btn btn-lg btn-success', 'style' => 'width: 140px; height: 25px; padding: 0px 3px 1px 3px', 'name' => 'expmodtower', 'id' => 'exp_mod_tower', 'value' => 'Explore']);
                       ActiveForm::end();
                   } else {
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_tower.png' style='opacity: 0.5;'> - <b>" . Yii::t('app', 'Improved Hit Points(HP)') . "</b>";
                   }
               } else {
                   if(($model->mod_tower) != 1) {
                       $form = ActiveForm::begin(['id' => 'buy_mod_tower']);
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_tower.png'> - <b>" . Yii::t('app', 'Improved Hit Points(HP)') . " - Already explored</b> ".Html::submitButton(Yii::t('app', 'Buy'), ['class' => 'btn btn-primary', 'style' => 'width: 70px; height: 25px; padding: 0px 3px 1px 3px', 'name' => 'buymodtower', 'id' => 'buy_mod_tower', 'value' => 'Buy']);
                       ActiveForm::end();
                   } else {
                       echo "<img src='" . Yii::$app->homeUrl . "img/mod_tower.png'> - <b>" . Yii::t('app', 'Improved Hit Points(HP)') . " Installed</b>";
                   }
               }
           }
           ?>
       </div>
       <br><br><br><br>
       <div>
           <h2><b><?=Yii::t('app', 'Installed modules') ?></b></h2>
       </div>
       <hr>
   <?php
 if($model->stock_gun == 1 && $model->mod_gun == 0) {
        echo '<b>'.Yii::t('app', 'Stock Gun').'</b> - <img src='.Yii::$app->homeUrl.'img/stock_gun.png>';
        } elseif($model->stock_gun == 0 && $model->mod_gun == 1) {
                 echo '<b>'.Yii::t('app', 'Modificate Gun').'</b> - <img src='.Yii::$app->homeUrl.'img/mod_gun.png>';
        }
     if($model->stock_tower == 1 && $model->mod_tower == 0) {
        echo '<b>'.Yii::t('app', 'Stock Tower').'</b> - <img src='.Yii::$app->homeUrl.'img/stock_tower.png>';
        } elseif($model->stock_tower == 0 && $model->mod_tower == 1) {
                 echo '<b>'.Yii::t('app', 'Modificate Tower').'</b> - <img src='.Yii::$app->homeUrl.'img/mod_tower.png>';
        }

       } else {
       echo "<div align=\"center\"><h2><b>".Yii::t('app', 'Please, chose your first Warship')."!</b></h2></div>";
?>
       <table border="0" valign="middle" width="90%">
           <tr>
               <td onmouseover="this.style='opacity: 1;'" onmouseout="this.style='opacity: 0.5;'" style="opacity: 0.5;">
                   <?php $form = ActiveForm::begin(['id' => 'shipone']); ?>
                   <div align="left">
                       <lable>
                           <img src="<?=Yii::$app->homeUrl; ?>img/ships/Leningrad.png?v2"><br>
                           <h2><b><?=Yii::t('app', 'Leningrad') ?></b></h2>
                       </lable>
                   </div>
                   <div align="left">
                       <?= Html::submitButton(Yii::t('app', 'getShip'), ['class' => 'btn btn-primary', 'style' => 'width: 320px',  'name' => 'shipfirst', 'id' => 'shipone', 'value' => '2', 'width' => 50]) ?>
                   </div>
                   <?php ActiveForm::end(); ?>
               </td>
               <td align="right" onmouseover="this.style='opacity: 1;'" onmouseout="this.style='opacity: 0.5;'" style="opacity: 0.5;">
                   <?php $form = ActiveForm::begin(['id' => 'shiptwo']); ?>
                   <div align="right">
                       <lable>
                           <img src="<?=Yii::$app->homeUrl; ?>img/ships/Warspite.png?v3"><br>
                           <h2><b><?=Yii::t('app', 'Warspite') ?></b></h2>
                       </lable>
                   </div>
                   <div align="right">
                       <?= Html::submitButton(Yii::t('app', 'getShip'), ['class' => 'btn btn-primary', 'style' => 'width: 320px', 'name' => 'shipsecond', 'id' => 'shiptwo', 'value' => '4', 'width' => 150]) ?>
                   </div>
                   <?php ActiveForm::end(); ?>
               </td>
           </tr>
       </table>
<?php
       }
?>
   </td>
 </tr>
</table>
    </div>
</div>
