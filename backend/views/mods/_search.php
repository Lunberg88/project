<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mods-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'ship_id') ?>

    <?= $form->field($model, 'mod_gun') ?>

    <?= $form->field($model, 'mod_tower') ?>

    <?= $form->field($model, 'exp_gun') ?>

    <?php // echo $form->field($model, 'exp_tower') ?>

    <?php // echo $form->field($model, 'cost_gun') ?>

    <?php // echo $form->field($model, 'cost_tower') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
