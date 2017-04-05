<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Ship */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ship-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lvl')->textInput() ?>

    <?= $form->field($model, 'stock_gun')->textInput() ?>

    <?= $form->field($model, 'stock_tower')->textInput() ?>

    <?= $form->field($model, 'mod_gun')->textInput() ?>

    <?= $form->field($model, 'mod_tower')->textInput() ?>

    <?= $form->field($model, 'strength')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
