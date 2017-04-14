<?php
/* @var $this yii\web\View */

use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;

$this->title = Yii::t('app', 'Battle of WarShips!');

$curhpplayer = ceil(($session['usershiphp'] / $usership->strength)*100);
$curhpbot = ceil(($session['bothp'] / $usership->strength)*100);
?>
<?php $form = ActiveForm::begin(['id' => 'battle-form']); ?>
<div align="center">
<h1><b><?=Yii::t('app', 'Battle Ship Combat Begin') ?>!</b></h1>
</div>
<hr>
<table border="0" width="96%" align="center" valign="top">
	<tr>
		<td width="35%" align="left">
            <div>
                <b><?php echo Yii::$app->user->identity->username; ?></b> [<?php echo $session['usershiphp']; ?>/<?php echo $usership->strength ?>] <br>
                <div class="progress">
                    <div class="<?php if($curhpplayer > 70) {
                        echo 'progress-bar progress-bar-success';
                    } elseif($curhpplayer > 35) {
                        echo 'progress-bar progress-bar-warning';
                    } elseif($curhpplayer <> 35) {
                        echo 'progress-bar progress-bar-danger';
                    }  ?>" role="progressbar" aria-valuenow="<?php echo $session['usershiphp']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $curhpplayer; ?>%;">
                        <?php echo $curhpplayer; ?>% HP
                    </div>
                </div>
            </div>
		<div align=""left">
		<img width="420" src="<?php echo Yii::$app->homeUrl; ?>img/ships/<?php echo $shipname->name; ?>.png" align="left">
		</div>	
        <div>
            <h4><b>Items:</b></h4><hr>
            <?php
            if($user_items) {
                echo $user_items->hp.' +HP ['.$user_items->qnt.']<br>';
            echo Html::submitButton(Yii::t('app', 'getHP'), ['class' => 'btn btn-primary', 'name' => 'gethp', 'value' => 'gethp']);
            }
            ?>
        </div>
		</td>
        <td width="30%" align="center">
            <div align="center">
                <div align="left">
                <?php $form = ActiveForm::begin(['id' => 'my-test']); ?>
                    <div class="radio radio-danger"><?= Html::radio('shot', false, ['value' => '1', 'id' => 'radio1']); ?><?= Html::label('Выстрелить в пункт управления', 'radio1', false) ?></div>
                    <div class="radio radio-danger"><?= Html::radio('shot', false, ['value' => '2', 'id' => 'radio2']); ?><?= Html::label('Выстрелить в нос', 'radio2', false) ?></div>
                    <div class="radio radio-danger"><?= Html::radio('shot', false, ['value' => '3', 'id' => 'radio3']); ?><?= Html::label('Выстрелить в корму', 'radio3', false) ?></div>
                    <div class="radio radio-danger"><?= Html::radio('shot', false, ['value' => '4', 'id' => 'radio4']); ?><?= Html::label('Выстрелить в борт', 'radio4', false) ?></div>
                <?php ActiveForm::end(); ?>
                </div>
            </div>
        </td>
		<td width="35%" align="right">
            <div>
                <b>BotShip</b> [<?php echo $session['bothp']; ?>/<?php echo $usership->strength ?>] <br>
                <div class="progress">
                    <div class="<?php if($curhpbot > 70) {
                                        echo 'progress-bar progress-bar-success';
                               } elseif($curhpbot > 35) {
                                        echo 'progress-bar progress-bar-warning';
                               } elseif($curhpbot <> 35) {
                                        echo 'progress-bar progress-bar-danger';
                               }  ?>" role="progressbar" aria-valuenow="<?php echo $session['bothp']; ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $curhpbot; ?>%;">
                        <?php echo $curhpbot; ?>% HP
                    </div>
                </div>
            </div>
		<div align="right">
		<img width="420" src="<?php echo Yii::$app->homeUrl; ?>img/ships/<?php echo $shipname->name; ?>.png">
		</div>	

		</td>
	</tr>
	<tr>
		<td colspan="3" align="center">
		<br><hr><div>
         <?= Html::submitButton(Yii::t('app', 'Attack'), ['class' => 'btn btn-primary', 'style' => 'width: 220px', 'name' => 'Attack', 'id' => 'battle-form', 'value' => 'Attack']) ?>
		</div>
		</td>
	</tr>
        <tr>
             <td colspan="2">
<?php
echo $battle_log->logs.'<br>';
?>
             </td>
        </tr>
</table>	
<?php ActiveForm::end(); ?>
