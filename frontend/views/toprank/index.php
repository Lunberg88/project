<?php
/* @var $this yii\web\View */
?>
<div align="center"><h1><b><?=Yii::t('app', 'Top Rank users') ?>!</b></h1></div>
<br>
<p>
    <?php
    foreach ($userships as $ships) {
     //   echo $ships->user_id.'<br>';
     //   echo $ships->ship_id.'<br>';
      echo $ships->ship_id.'<br>';
        echo $ships->username.'<br><hr>';
    }
    ?>
</p>
