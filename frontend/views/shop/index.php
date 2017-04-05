<?php
use \yii\widgets\ListView;
$this->title = Yii::t('app', 'Battle Shop');
$this->params['breadcrumbs'][] = $this->title;
?>
<div align="center">
<h1><b><?= Yii::t('app', 'Battle Shop') ?></b></h1><hr>
</div>
<p>
    <div class="row">
        <?= ListView::widget([
            'dataProvider' => $shopProvider,
            'layout' => '{items}',
            'options' => ['class' => 'projects-flow'],
            'itemOptions' => ['class' => 'item'],
            'itemView' => '_list'
        ]) ?>
    </div>
</p>
