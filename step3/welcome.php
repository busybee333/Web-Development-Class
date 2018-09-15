<?php
require 'format.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link href="game.css" type="text/css" rel="stylesheet" />
        <title>Welcome to Stalking the Wumpus</title>
    </head>
    <body>
    <?php echo present_header("Stalking the Wumpus"); ?>
    <div class="content">
            <figure>
                <img src="cave-evil-cat.png" width="600" height="325" alt="Cat Cave"/>
            </figure>

            <div id="stalking">Welcome to <a>Stalking the Wumpus</a></div>
            <div class="links">
                <p><a href="instructions.php">Instructions</a></p>
                <p><a href="game.php">Start Game</a></p>
            </div>
        </div>
    </body>
</html>