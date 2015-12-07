<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 *
 * @var \frontend\models\game\GameInterface $game
 */
function getProgressBarType($lifespanPercent) {
    switch($lifespanPercent){
        case $lifespanPercent>=75 :
            return 'info';
        case $lifespanPercent >= 50:
            return 'success';
        case $lifespanPercent >= 25;
            return 'warning';
        default:
            return 'danger';
    }
}
?>

<div>
    <div class="panel panel-info">
        <div class="panel-heading"> Basic info</div>
        <div class="panel-body">
            <table width="100%">
                <tr>
                    <td><span>Health</span> <span class="badge"><?=$game->getCharacterPool()->getPlayer()->getLifespan()?></span></td>
                    <td><span>Honey</span> <span class="badge"><?=$game->getHoneyPool()->amount()?></span></td>
                    <td><span>Count</span> <span class="badge"><?=count($game->getCharacterPool()->getBees());?></span></td>
                    <td><div> </div></td>
                    <td><a href="/game/hit"><span class="btn btn-warning pull-right">Hit</span></a></td>
                </tr>
            </table>

        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">Info about your enemies</div>

        <table class="table">
            <tr>
                <th>Type</th>
                <th>Health</th>
            </tr>
            <?php foreach($game->getCharacterPool()->getBees() as $bee):
                $lifespanPercent = round($bee->getLifespan()/$bee->getLifespanMax()*100);
                ?>
                <tr>
                    <td><?=ucfirst($bee->getType())?></td>
                    <td>
                        <div class="progress" style="margin:0">
                            <div class="progress-bar progress-bar-<?=getProgressBarType($lifespanPercent)?>" role="progressbar" aria-valuenow="<?=$bee->getLifespan()?>" aria-valuemin="0" aria-valuemax="<?=$bee->getLifespanMax()?>" style="width:<?=$lifespanPercent?>%">
                                <?=$bee->getLifespan()?>hp / <?=$lifespanPercent?>%
                            </div>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>


    </div>
</div>