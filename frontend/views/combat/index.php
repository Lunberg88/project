<?php
/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
?>
<?php $form = ActiveForm::begin(['id' => 'battle-form']); ?>
<div align="center">
<h1><b>Battle Ship Combat Begin!</b></h1>
<hr>
</div>
<table border="0" width="80%" align="center" valign="top">
	<tr>
		<td width="50%">
		<div>
		<img src="http://localhost/projectgame/frontend/web/img/<?php echo $usership->ship_id; ?>.png">	
		</div>	
		<div>
			<b><?php echo Yii::$app->user->identity->username; ?></b> [<?php echo $session['usershiphp']; ?>]	
		</div>	
		</td>
		<td width="50%">
		<div>
		<img src="http://localhost/projectgame/frontend/web/img/<?php echo $usership->ship_id; ?>.png">	
		</div>	
		<div>
			<b>BotShip</b> [<?php echo $session['bothp']; ?>]	
		</div>
		</td>
	</tr>
	<tr>
		<td colspan="2" align="center">
		<br><div>
		<?= Html::submitButton(Yii::t('app', 'Attack'), ['class' => 'btn btn-primary',  'name' => 'Attack', 'id' => 'battle-form', 'value' => 'Attack', 'width' => 50]) ?>
		</div>
		</td>
	</tr>
        <tr>
             <td colspan="2">
<?php
echo $session['battlelog_b'].'<br>';
echo $session['battlelog_p'].'<br>';
?>
             </td>
        </tr>
</table>	
<?php ActiveForm::end(); ?>
