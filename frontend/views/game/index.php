<?php
/**
 * Created by PhpStorm.
 * User: maksim.d
 * Date: 12/4/15
 * Time: 02:46
 * @var \frontend\models\game\GameInterface $game
 */
?>
<div class="jumbotron">
    <h1>Bee Game</h1>

    <h2>So, what is Bee Game</h2>

    <p> Bee game - the game with one button "hit" in upper right corner in menu bar.
        You need to kill all bees around you;
        When you push the hit button, server randomly hit some bee;
        Before the bee is hitted it makes an action, which is defined by its type;
        You have <?php echo $game->getPlayer()->getLifespan();?> health
        If you kill all bees - you are a winner.
        If you are killed by the bees - you are a loser.
        Also if the last bee kills you before its death then the result is draw.
    </p>

    <h3>Types of Bees</h3>

    <ul class="text-left">
        <li>
            <h4>Queen</h4>
            <p>It's the main unit. There is only 1 queen during the game, it does nothing.
               But if the queen becames dead, you became a winner of the game!</p>
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

</div>
