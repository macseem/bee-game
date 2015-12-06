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

    <p> Bee game - it's game with one button hit in upper right corner in menu bar.
        You need to kill all bees around you;
        When you push the hit button, server randomly hit some bee;
        Before it'll be hitted bee make their own thins depends on type;
        You have <?php echo $game->getPlayer()->getLifespan();?> health
        So if you kill all bees - you are the winner.
        If they kill you - you are loser.
        Also if bee hit you before she's dead and you would die after that, then result will be draw.
    </p>

    <h3>Types of Bees</h3>

    <ul class="text-left">
        <li>
            <h4>Queen</h4>
            <p>It's the main unit. There is only 1 queen during the game.
                She is doing nothing, but if you kill her, you'll also kill everyone else!</p>
        </li>
        <li>
            <h4>Healer</h4>
            <p>It's cool unit for bees. Before you hit him, he choose random bee and heal it for honey from honey pool</p>
        </li>
        <li>
            <h4>Worker</h4>
            <p>It's unit for making honey</p>
        </li>
        <li>
            <h4>Drone</h4>
            <p>It's unit for hitting you</p>
        </li>
    </ul>

</div>
