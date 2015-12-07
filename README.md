Bee Game
===============================

Bee game - the game with one button "hit" in upper right corner in menu bar. 

You need to kill all bees around you; When you push the hit button, 
server randomly hits some bee; Before the bee is hitted it makes an action, 
which is defined by its type; 

You have 300 health. 

- If you kill all the bees - you are a winner. 
- If you are killed by the bees - you are a loser. 
- If the last bee kills you before its death then the result is draw.

Use cases diagram [here](https://drive.google.com/file/d/0B-X-YPz9DPQMRUc0WmJSV3F5elE/view?usp=sharing)

Installation
-------------------


1. Install [docker](http://docs.docker.com/mac/started/) and [docker-compose](http://docs.docker.com/compose/install/) tools
2. turn off any application that handles 80 port in you host machine 
3. cd bee-game
4. docker-compose up -d
5. docker exec -it beegame_php_1 composer install -vvv 
or docker exec -it beegame_php_1 /bin/bash and composer install -vvv
6. add to hosts bee-game.com domain for docker-daemon ip e.g. docker-machine ip default, if you use docker-machine 

Powered By
-------------------

[Yii2 Framework](http://www.yiiframework.com)
