<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="game.css" type="text/css" rel="stylesheet" />
        <title>Stalking the Wumpus</title>
    </head>
    <body>
        <?php
        require 'lib/game.inc.php';
        $view = new Wumpus\WumpusView($wumpus);
        ?>
        <header>
            <nav>
                <p><a href="welcome.php">New Game</a>  <a href="game.php">Game</a>  <a href="instructions.php">Instructions</a></p>
            </nav>
            <h1>Stalking the Wumpus</h1>
        </header>
        <div class="content">
            <div class="fig">
                <img src="cave.jpg" width="600" height="325" alt="Cave"/>
            </div>

            <?php
            echo $view->presentStatus();
            ?>

            <div class="rooms">
                <div class="room">
                    <p><?php echo $view->presentRoom(0); ?></p>
                </div><div class="room">
                    <p><?php echo $view->presentRoom(1); ?></p>
                </div><div class="room">
                    <p><?php echo $view->presentRoom(2); ?></p>
                </div>
            </div>
            <?php
            echo $view->presentArrows();
            ?>
        </div>
    </body>
</html>