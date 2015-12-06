<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 * @var \frontend\models\game\GameInterface $game
 */
use yii\helpers\Html;
if($game->isStarted())
    $toPlay = Html::a('Continue playing', '/game/overview', ['class' => 'btn btn-success']);
else
    $toPlay = Html::a('Start Game', '/game/start', ['class' => 'btn btn-success']);

?>
<div class="jumbotron">
    <h1>Bee Game</h1>

    <h2>So, what is Bee Game</h2>

    <p> Bee game - the game with one button "hit" in upper right corner in menu bar.
        You need to kill all bees around you;
        When you push the hit button, server randomly hits some bee;
        Before the bee is hitted it makes an action, which is defined by its type;
        You have <?php echo $game->getPlayer()->getLifespan();?> health.
        If you kill all the bees - you are a winner.
        If you are killed by the bees - you are a loser.
        Also if the last bee kills you before its death then the result is draw.
    </p>
    <?=$toPlay?>
</div>

    <div class="col-lg-6">
        <div class="panel panel-default pull-left ">
            <div class="panel-heading">Types of Bees</div>
            <div class="panel-body">
                <ul class="text-left">
                    <li>
                        <h4>Queen</h4>
                        <p>It's the main unit. There is only 1 queen during the game, it does nothing.
                            But if the queen becomes dead, you become a winner of the game!</p>
                    </li>
                    <li>
                        <h4>Healer</h4>
                        <p>It's a cool unit for bees. Before you hit the healer,
                            it chooses a random bee and heals it for honey from the honey pool</p>
                    </li>
                    <li>
                        <h4>Worker</h4>
                        <p>It's a unit for making honey</p>
                    </li>
                    <li>
                        <h4>Drone</h4>
                        <p>It's a unit for hitting you</p>
                    </li>
                </ul>
                <div class="coll-lg-12 text-center">
                    <?=$toPlay?>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info">
            <div class="panel-heading">What you can do</div>
            <div class="panel-body">
                <p>Hit the bees </p>
                <div class="coll-lg-12 text-center">
                    <?=$toPlay?>
                </div>
            </div>
        </div>
    </div>



