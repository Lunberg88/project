<?php
/* @var $this yii\web\View */
$this->title = 'Battle logs';
?>
<h1>logs</h1>

<p>
    <?php
    if($models) {
        foreach ($models as $model) {
          //  echo '<h3>Viewing Full Battle Log</h3><hr>';
            echo '<br>'.$model->bid.' | '.$model->date.'<br>';
            echo '<br>'.$model->logs .'';
        }
    }
    ?>
</p>
