<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Ship */

$this->title = 'Update Ship: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Ships', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ship-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
