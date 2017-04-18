<?php
/* @var $this yii\web\View */
use \yii\helpers\Html;
use \yii\bootstrap\ActiveForm;
?>
<div align="center">
<h1><b><?=Yii::t('app', 'Go Battle') ?></b>!</h1>
</div>
<p>
    <?php $form = ActiveForm::begin(['id' => 'battle-form']); ?>
    <?= Html::submitButton(Yii::t('app', 'Start battle'), ['class' => 'btn btn-outlined btn-primary', 'name' => 'start', 'id' => 'start-battle', 'value' => 'Start']) ?>
    <?php ActiveForm::end(); ?>
</p>
