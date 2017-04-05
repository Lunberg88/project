<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ModsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mods';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mods-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mods', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
       // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'ship_id',
            'mod_gun',
            'mod_tower',
            'exp_gun',
            'exp_tower',
            'cost_gun',
            'cost_tower',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
