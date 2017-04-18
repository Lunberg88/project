<?php

/* @var $this yii\web\View */
use yii\helpers\Html;
$this->title = 'Battle Win!';
?>
<div class="site-index">
    <div class="jumbotron">
        <h2><b><?= Yii::t('app', 'Congratulations, You are Win') ?>!</b></h2>
    </div>
    <div class="body-content" align="center">
     <a class="btn btn-lg btn-success" href="<?php echo Yii::$app->homeUrl; ?>"><?= Yii::t('app', 'Go Port') ?>! :)</a>
    </div>
</div>
