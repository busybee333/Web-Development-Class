<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="game.css" type="text/css" rel="stylesheet" />
        <title>The Wumpus Killed You</title>
    </head>
    <body>
    <?php echo present_header("Stalking the Wumpus"); ?>
    <div class="content">
        <figure>
            <img src="wumpus-wins.jpg" width="600" height="325" alt="Cat Cave"/>
        </figure>

        <p>You died and the Wumpus ate your brain!</p>

        <div class="links">
            <p><a href="game.php">New Game</a></p>
        </div>
    </div>
    </body>
</html>