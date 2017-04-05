<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mods */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mods-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ship_id')->textInput() ?>

    <?= $form->field($model, 'mod_gun')->textInput() ?>

    <?= $form->field($model, 'mod_tower')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
