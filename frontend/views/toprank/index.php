<?php
/* @var $this yii\web\View */
?>
<div align="center"><h1><b><?=Yii::t('app', 'Top Rank users') ?>!</b></h1></div>
<br>
<p>
    <?php
     if($models) {
         if($userships) {
             echo '<table border=\'0\' align=\'left\'>';
             foreach ($models as $model) {
                 echo '<tr><td><b>' . $model->username . '</b></td><td><b>' . Yii::t('app', 'WIN') . ':</b> ' . $model->win . '<br>Ships -'.$shipname->name.' <img width="140" src="'.Yii::$app->homeUrl.'/img/ships/'.$shipname->name.'"></td></tr>';
             }
         }
       echo '</table>';
     }
    ?>
</p>
