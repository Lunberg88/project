<?php
/* @var $this yii\web\View */
?>
<div align="center"><h1><b><?=Yii::t('app', 'Top Rank users') ?>!</b></h1></div>
<br>
<p>
    <div width="90%">

<table align="left" width="90%" cellpadding="5" cellspacing="5" class="toprank">
        <tr class="toph">
            <td>#</td>
            <td><?=Yii::t('app', 'Username') ?></td>
            <td><?=Yii::t('app', 'Shipname') ?></td>
            <td><?=Yii::t('app', 'Img') ?></td>
            <td><?=Yii::t('app', 'Win') ?></td>
            <td><?=Yii::t('app', 'Lose') ?></td>
            <td><?=Yii::t('app', 'Draw') ?></td>
            <td><?=Yii::t('app', 'Mod Gun') ?></td>
            <td><?=Yii::t('app', 'Mod Tower') ?></td>
        </tr>
<?php
 $i = 1;
 foreach ($userships as $ships) {
?>
    <tr>
        <td><?=$i?></td>
        <td><h3><b><?=$ships->user->username ?></b></h3></td>
        <td><?=$ships->ship->name ?> [<?=$ships->ship->lvl ?>]</td>
        <td><img width="140" src="../img/ships/<?=$ships->ship->name ?>.png"></td>
        <td><?=$ships->user->win ?></td>
        <td><?=$ships->user->lose ?></td>
        <td><?=$ships->user->draw ?></td>
        <td><?php if($ships->mod_gun !=1) { echo "<img width='30' src='../img/stock_gun.png'>"; } else { echo "<img title='Modify' width='30' src='../img/mod_gun.png'>"; } ?></td>
        <td><?php if($ships->mod_tower !=1) { echo "<img width='30' src='../img/stock_tower.png'>"; } else { echo "<img title='Modify' width='30' src='../img/mod_tower.png'>"; } ?></td>
    </tr>
<?php
  ++$i;
 }
?>
</table>
    </div>
</p>
