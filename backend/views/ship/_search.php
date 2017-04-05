<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ShipSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="ship-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'lvl') ?>

    <?= $form->field($model, 'stock_gun') ?>

    <?= $form->field($model, 'stock_tower') ?>

    <?php // echo $form->field($model, 'mod_gun') ?>

    <?php // echo $form->field($model, 'mod_tower') ?>

    <?php // echo $form->field($model, 'strength') ?>

    <?php // echo $form->field($model, 'type') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
