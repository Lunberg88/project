<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Mods */

$this->title = 'Create Mods';
$this->params['breadcrumbs'][] = ['label' => 'Mods', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mods-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
