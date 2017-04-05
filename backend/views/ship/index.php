<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ShipSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Ships';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="ship-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Ship', ['create'], ['class' => 'btn btn-success'], ['style' => 'width: 240px']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            //'id',
            'name',
            'lvl',
            'stock_gun',
            'stock_tower',
            'mod_gun',
            'mod_tower',
            'strength',
            'type',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
