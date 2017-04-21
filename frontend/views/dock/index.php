<?php
/* @var $this yii\web\View */
?>
<table border="0" class="dock" height="100%"><tr><td>
<h1>User Dock</h1>
<div align="center">
    <h4><b>Ships</b></h4>
</div>
<div align="right">
<p>
    <?php
    if($userships) {
        foreach ($userships as $ships) {
    ?>
    <div>
    <img width=420 src="<?php echo Yii::$app->homeUrl; ?>img/ships/<?php echo $ships->ship->name; ?>.png">
    </div>
<div>
    <?= $ships->ship->name; ?> | <?= $ships->user->username; ?>
</div>
<?php
    }
}
    ?>
</p></div>
        </td></tr>
</table>