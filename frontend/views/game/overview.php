<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 *
 * @var \frontend\models\game\GameInterface $game
 */
?>

<div>
    <div class="panel panel-info">
        <div class="panel-heading"> Basic info</div>
        <div class="panel-body">
            <table width="100%">
                <tr>
                    <td><span>Health</span> <span class="badge"><?=$game->getPlayer()->getLifespan()?></span></td>
                    <td><span>Honey</span> <span class="badge"><?=$game->getHoneyPool()->amount()?></span></td>
                    <td><span>Count</span> <span class="badge"><?=count($game->getCharacterPool()->getBees());?></span></td>
                    <td><div> </div></td>
                    <td><span class="btn btn-warning pull-right"><a href="/game/hit">Hit</a></td>
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
            <?php foreach($game->getCharacterPool()->getBees() as $bee): ?>
                <tr>
                    <td><?=ucfirst($bee->getType())?></td>
                    <td><?=$bee->getLifespan()?></td>
                </tr>
            <?php endforeach; ?>
        </table>


    </div>
</div>